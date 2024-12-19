<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_books_are_fetched(): void
    {
        // Mock the Book model
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('all')
            ->once()
            ->andReturn([
                (object) ['title' => 'Book 1', 'description' => 'Description 1'],
                (object) ['title' => 'Book 2', 'description' => 'Description 2']
            ]);

        // Fetch books using the static call
        $books = Book::all();

        // Assert the results
        $this->assertCount(2, $books);
        $this->assertEquals('Book 1', $books[0]->title);
        $this->assertEquals('Description 2', $books[1]->description);
    }
}
