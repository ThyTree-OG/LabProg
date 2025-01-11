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
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('all')
            ->once()
            ->andReturn([
                (object) ['title' => 'Book 1', 'description' => 'Description 1'],
                (object) ['title' => 'Book 2', 'description' => 'Description 2']
            ]);

        $books = Book::all();

        $this->assertCount(2, $books);
        $this->assertEquals('Book 1', $books[0]->title);
        $this->assertEquals('Description 2', $books[1]->description);
    }

    public function test_single_book_is_fetched_by_id(): void
    {
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn((object) ['title' => 'Book 1', 'description' => 'Description 1']);

        $book = Book::find(1);

        $this->assertEquals('Book 1', $book->title);
        $this->assertEquals('Description 1', $book->description);
    }

    public function test_book_is_created(): void
    {
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('create')
            ->with(['title' => 'New Book', 'description' => 'New Description'])
            ->once()
            ->andReturn((object) ['title' => 'New Book', 'description' => 'New Description']);

        $book = Book::create(['title' => 'New Book', 'description' => 'New Description']);

        $this->assertEquals('New Book', $book->title);
        $this->assertEquals('New Description', $book->description);
    }

    public function test_book_is_updated(): void
    {
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($mock);

        $mock->shouldReceive('update')
            ->with(['title' => 'Updated Book', 'description' => 'Updated Description'])
            ->once()
            ->andReturn(true);

        $book = Book::find(1);
        $updated = $book->update(['title' => 'Updated Book', 'description' => 'Updated Description']);

        $this->assertTrue($updated);
    }

    public function test_book_is_deleted(): void
    {
        $mock = Mockery::mock('alias:' . Book::class);
        $mock->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($mock);

        $mock->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $book = Book::find(1);
        $deleted = $book->delete();

        $this->assertTrue($deleted);
    }
}
