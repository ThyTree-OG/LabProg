<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use App\Models\Author;

class AuthorControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_authors_are_fetched(): void
    {
        $mock = Mockery::mock('alias:' . Author::class);
        $mock->shouldReceive('all')
            ->once()
            ->andReturn([
                (object) ['first_name' => 'John', 'last_name' => 'Doe', 'description' => 'An author'],
                (object) ['first_name' => 'Jane', 'last_name' => 'Smith', 'description' => 'Another author']
            ]);

        $authors = Author::all();

        $this->assertCount(2, $authors);
        $this->assertEquals('John', $authors[0]->first_name);
        $this->assertEquals('Another author', $authors[1]->description);
    }

    public function test_author_is_created(): void
    {
        $mock = Mockery::mock('alias:' . Author::class);
        $mock->shouldReceive('create')
            ->with([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'description' => 'An author',
                'nationality' => 'American',
                'author_photo_url' => null
            ])
            ->once()
            ->andReturn((object) ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe']);

        $author = Author::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'description' => 'An author',
            'nationality' => 'American',
            'author_photo_url' => null
        ]);

        $this->assertEquals('John', $author->first_name);
        $this->assertEquals('Doe', $author->last_name);
    }

    public function test_single_author_is_fetched_by_id(): void
    {
        $mock = Mockery::mock('alias:' . Author::class);
        $mock->shouldReceive('findOrFail')
            ->with(1)
            ->once()
            ->andReturn((object) ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe']);

        $author = Author::findOrFail(1);

        $this->assertEquals('John', $author->first_name);
        $this->assertEquals('Doe', $author->last_name);
    }

    public function test_author_is_updated(): void
    {
        $mock = Mockery::mock('alias:' . Author::class);
        $mock->shouldReceive('findOrFail')
            ->with(1)
            ->once()
            ->andReturn($mock);

        $mock->shouldReceive('update')
            ->with(['first_name' => 'John Updated', 'last_name' => 'Doe Updated'])
            ->once()
            ->andReturn(true);

        $author = Author::findOrFail(1);
        $updated = $author->update(['first_name' => 'John Updated', 'last_name' => 'Doe Updated']);

        $this->assertTrue($updated);
    }

    public function test_author_is_deleted(): void
    {
        $mock = Mockery::mock('alias:' . Author::class);
        $mock->shouldReceive('findOrFail')
            ->with(1)
            ->once()
            ->andReturn($mock);

        $mock->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $author = Author::findOrFail(1);
        $deleted = $author->delete();

        $this->assertTrue($deleted);
    }
}
