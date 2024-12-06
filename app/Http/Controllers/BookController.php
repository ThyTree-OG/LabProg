<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\AuthorBook;
// TODO: Adicionar o Tipo de Utilizador
use App\Models\UserType;


class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::all();

        return view('book.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $author_books = AuthorBook::all();
        return view('book.create',[
            'authors'=>$authors,
            'author_books'=>$author_books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
    
        return view('book.details', [
            'book' => $book,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function viewPdf($id)
    {
        $book = Book::findOrFail($id);
    
        // Ensure the book has a valid PDF path
        if (!$book->pdf_path || !file_exists(public_path($book->pdf_path))) {
            abort(404, 'PDF not found');
        }
    
        return view('book.pdf', [
            'pdfPath' => asset($book->pdf_path),
            'book' => $book,
        ]);
    }

}
