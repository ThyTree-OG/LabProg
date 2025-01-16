<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Plan;
use App\Models\AgeGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


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

    public function indexRequest(Request $request)
    {
        $query = Book::query();

        // Filtro por título
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filtro por autor
        if ($request->filled('author')) {
            $query->whereHas('authors', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->author . '%')
                    ->orWhere('last_name', 'like', '%' . $request->author . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $request->author . '%');
            });
        }

        // Filtro por faixa etária
        if ($request->filled('age_group')) {
            $query->where('age_group', $request->age_group);
        }

        // Filtro por nível de acesso
        if ($request->filled('access_level')) {
            $query->where('access_level', $request->access_level);
        }

        // Obter os resultados
        $books = $query->paginate(9);

        return view('filter.filter', compact('books'));
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
            'pdf' => 'required|file|mimes:pdf',
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
            $pdfFile = $request->file('pdf');
            $filename = $pdfFile->getClientOriginalName();
            $pdfFile->storeAs('public/livros', $filename);
            $book->pdf_path = 'storage/livros/' . $filename;
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
    public function showAdmin(string $id)
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

    public function showUser(string $id)
    {
        // Carrega o livro e os autores associados
        $book = Book::with('authors')->findOrFail($id);

        $plans = Plan::orderBy('access_level', 'desc')->get();
        $age_groups = AgeGroup::all();

        return view('book.details', [
            'book' => $book,
            'plans' => $plans,
            'age_groups' => $age_groups,
            'user' => auth()->user(), // Passa o usuário autenticado para a view

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
                'authors' => 'required|array|min:1',
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

            // Sync the authors
            $book->authors()->sync($request->authors);

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

    public function popularBooks()
    {
        $popularBooks = DB::table('popularbookslast3months')
            ->select([
                'book_id',
                'title',
                'description',
                'cover_url',
                'total_reads',
                'average_rating',
                'avg_progress'
            ])
            ->get();
        return view('store.popular', ['books' => $popularBooks]);
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);

        // Permitir leitura de PDFs apenas para visitantes e usuários com permissão
        return response()->file(public_path($book->pdf_path));
    }

    public function suggestions()
    {
        $userId = auth()->id();

        $suggestedBooks = DB::select('CALL SuggestedBooksForUser(?)', [$userId]);

        return view('store.suggestions', [
            'books' => $suggestedBooks
        ]);
    }

    public function addToFavorites($id)
    {
        $user = auth()->user();

        // Check if already favorited
        $favoriteExists = DB::table('book_user_favourite')
            ->where('book_id', $id)
            ->where('user_id', $user->id)
            ->exists();

        if ($favoriteExists) {
            return redirect()->back()->with('message', 'Book is already in your favorites.');
        }

        // Add to favorites
        DB::table('book_user_favourite')->insert([
            'book_id' => $id,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Book added to your favorites!');
    }
    public function isFavorite(Book $book)
    {
        return auth()->user()->favorites()->where('book_id', $book->id)->exists();
    }
    public function toggleFavorite($id)
    {
        $user = auth()->user();
        $book = Book::findOrFail($id);

        if ($user->favorites->contains($book->id)) {
            // Remove from favorites
            $user->favorites()->detach($book->id);
        } else {
            // Add to favorites
            $user->favorites()->attach($book->id);
        }

        return redirect()->back();
    }
    public function favorites()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('authors')->get(); // Load related data if needed

        return view('book.favorites', compact('favorites'));
    }


    public function flip(Book $book)
    {
        // Path to the PDF
        $pdfPath = public_path("storage/livros/" . basename($book->pdf_path));

        // Convert PDF pages to images
        $images = $this->convertPdfToImages($pdfPath);

        // Pass images to the view
        return view('books.flip', compact('book', 'images'));
    }

    public function currentlyReading()
    {
        $user = auth()->user();

        // Buscar livros que o usuário está lendo (progresso entre 1% e 99%)
        $currentlyReading = DB::table('book_user_read')
            ->join('books', 'book_user_read.book_id', '=', 'books.id')
            ->where('book_user_read.user_id', $user->id)
            ->where('book_user_read.progress', '>', 0)
            ->where('book_user_read.progress', '<', 100)
            ->select('books.*', 'book_user_read.progress')
            ->get();

        return view('book.currently_reading', compact('currentlyReading'));
    }

    public function saveProgress(Request $request, $bookId)
    {
        try {
            \Log::info('saveProgress called', ['bookId' => $bookId, 'progress' => $request->progress]);

            $request->validate([
                'progress' => 'required|numeric|min:0|max:100',
            ]);

            // Verificar se o livro existe
            $book = Book::find($bookId);
            if (!$book) {
                Log::warning('Book not found', ['bookId' => $bookId]);
                return response()->json(['message' => 'Book not found.'], 404);
            }

            // Obter o usuário autenticado
            $user = auth()->user();
            if (!$user) {
                \Log::warning('User not authenticated');
                return response()->json(['message' => 'User not authenticated.'], 401);
            }

            \Log::info('User authenticated', ['userId' => $user->id]);

            // Inserir ou atualizar o progresso
            $result = DB::table('book_user_read')->updateOrInsert(
                ['book_id' => $book->id, 'user_id' => $user->id], // Condição de busca
                [
                    'progress' => $request->progress,
                    'rating' => 0, // Define rating como 0 por padrão
                    'read_date' => now(), // Define a data de leitura como now
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            \Log::info('Database operation result', ['result' => $result]);

            return response()->json(['message' => 'Progress saved successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error in saveProgress', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to save progress.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function rateBook(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();
        $book = Book::findOrFail($id);

        // Atualizar ou criar o rating na tabela pivot
        DB::table('book_user_read')->updateOrInsert(
            ['book_id' => $book->id, 'user_id' => $user->id],
            ['rating' => $request->rating, 'updated_at' => now()]
        );

        return redirect()->back()->with('success', 'Your rating has been submitted.');
    }

    public function showBookDetails($bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = auth()->user();

        $isCompleted = false;
        $currentRating = 0;

        if ($user) {
            // Verificar se o livro está concluído
            $completedBook = $user->completedBooks()->where('book_id', $bookId)->first();

            if ($completedBook) {
                $isCompleted = true;
                $currentRating = $completedBook->pivot->rating;
            }
        }

        return view('book.details', compact('book', 'isCompleted', 'currentRating'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
}
