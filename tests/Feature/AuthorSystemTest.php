<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorSystemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Run before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Drop the view if it exists before running tests
        DB::statement("DROP VIEW IF EXISTS PopularBooksLast3Months;");
        
        // Optionally, reapply migrations (if needed)
        $this->artisan('migrate');
    }

    /**
     * Test that the index route displays all authors.
     */
    public function test_index_displays_all_authors()
    {
        // Arrange: Create some authors
        Author::factory()->create(['first_name' => 'John', 'last_name' => 'Doe']);
        Author::factory()->create(['first_name' => 'Jane', 'last_name' => 'Smith']);

        // Act: Send a GET request to the index route
        $response = $this->get(route('author.index'));

        // Assert: Verify the response contains the authors' details
        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('Jane Smith');
    }

    /**
     * Test that the store route creates a new author.
     */
    public function test_store_creates_an_author()
    {
        // Arrange: Define the data to send
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'description' => 'A great author',
            'nationality' => 'American',
            'author_photo_url' => null,
        ];

        // Act: Send a POST request to the store route
        $response = $this->post(route('author.store'), $data);

        // Assert: Verify the database contains the new author
        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseHas('authors', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /**
     * Test that the show route displays a specific author.
     */
    public function test_show_displays_an_author()
    {
        // Arrange: Create an author
        $author = Author::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        // Act: Send a GET request to the show route
        $response = $this->get(route('author.show', $author->id));

        // Assert: Verify the response contains the author's details
        $response->assertStatus(200);
        $response->assertSee('John Doe');
    }

    /**
     * Test that the update route modifies an author's details.
     */
    public function test_update_modifies_an_author()
    {
        // Arrange: Create an author
        $author = Author::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        // Act: Send a PUT request to the update route
        $response = $this->put(route('author.update', $author->id), [
            'first_name' => 'Updated John',
            'last_name' => 'Updated Doe',
        ]);

        // Assert: Verify the database contains the updated author
        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseHas('authors', [
            'first_name' => 'Updated John',
            'last_name' => 'Updated Doe',
        ]);
    }

    /**
     * Test that the destroy route deletes an author.
     */
    public function test_destroy_deletes_an_author()
    {
        // Arrange: Create an author
        $author = Author::factory()->create();

        // Act: Send a DELETE request to the destroy route
        $response = $this->delete(route('author.destroy', $author->id));

        // Assert: Verify the author is no longer in the database
        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseMissing('authors', [
            'id' => $author->id,
        ]);
    }
}
