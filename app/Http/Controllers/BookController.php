<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Plan;
use App\Models\AgeGroup;

use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return view('book.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $author_books = AuthorBook::all();
        $plans = Plan::orderBy('access_level', 'desc')->get();
        $age_groups = AgeGroup::all();

        return view('book.create', [
            'authors' => $authors,
            'author_books' => $author_books,
            'plans' => $plans,
            'age_groups' => $age_groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:3|unique:books',
            'description' => 'required|min:5',
            'cover_url' => 'nullable|max:255',
            'read_time' => 'required|integer|min:1',
            'rating_medio' => 'nullable|numeric|between:0,5',
            'age_group' => 'required|max:50',
            'is_active' => 'required|between:0,1',
            'access_level' => 'required|integer|between:0,2',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $book = new Book();

        $book->title = $request->title;
        $book->description = $request->description;
        $book->cover_url = $request->cover_url;
        $book->read_time = $request->read_time;
        $book->rating_medio = $request->rating_medio;
        $book->age_group = $request->age_group;
        $book->access_level = $request->access_level;
        $book->is_active = $request->is_active;
	$book->pdf_path = $request->pdf_path;

        // Handle PDF file upload
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('public/pdf'); // Store in storage/app/public/pdf
        }

        $book->save();

        if ($request->has('authors')) {
            foreach ($request->authors as $authorId) {
                AuthorBook::create([
                    'book_id' => $book->id,
                    'author_id' => $authorId
                ]);
            }
        }

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        $plans = Plan::orderBy('access_level', 'desc')->get();
        $authors = Author::all();
        $age_groups = AgeGroup::all();

        return view('book.show', [
            'book' => $book,
            'plans' => $plans,
            'authors' => $authors,
            'age_groups' => $age_groups,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $plans = Plan::orderBy('access_level', 'desc')->get();
        $authors = Author::all();
        $age_groups = AgeGroup::all();

        return view('book.edit', [
            'book' => $book,
            'plans' => $plans,
            'authors' => $authors,
            'age_groups' => $age_groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Book::where('id', $id)->exists()) {
            $request->validate([
                'title' => 'required|max:255|min:3|unique:books,title,' . $id,
                'description' => 'required|min:5',
                'cover_url' => 'nullable|max:255',
                'read_time' => 'required|integer|min:1',
                'rating_medio' => 'nullable|numeric|between:0,5',
                'age_group' => 'required|max:50',
                'is_active' => 'required|between:0,1',
                'access_level' => 'required|integer|between:0,2',
            ]);

            $book = Book::find($id);

            $book->title = $request->title;
            $book->description = $request->description;
            $book->cover_url = $request->cover_url;
            $book->read_time = $request->read_time;
            $book->rating_medio = $request->rating_medio;
            $book->age_group = $request->age_group;
            $book->is_active = $request->is_active;
            $book->access_level = $request->access_level;

            $book->save();

            return redirect()->route('book.index')->with('success', 'Book updated successfully.');
        }

        return redirect()->route('book.index')->with('error', 'Book not found.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Delete associated PDF if exists
        if ($book->pdf_path && file_exists(public_path($book->pdf_path))) {
            unlink(public_path($book->pdf_path));
        }

        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
    }

    /**
     * Display the PDF file for a book.
     */
    public function viewPdf($id)
    {
        $book = Book::findOrFail($id);

        // Ensure the book has a valid PDF path
        if (!$book->pdf_path || !file_exists(public_path($book->pdf_path))) {
            abort(404, 'PDF not found');
        }

        return response()->file(public_path($book->pdf_path));
    }
}