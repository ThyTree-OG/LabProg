<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Book;

class AccessLevelMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $bookId = $request->route('book');
        $book = Book::find($bookId);

        // Verify if the book exists
        if (!$book) {
            abort(404, 'Book not found.');
        }

        $user = auth()->user();

        // Check access for non-logged-in users
        if (!$user) {
            if ($book->access_level == 2) {
                // Allow access to books with access_level = 2
                return $next($request);
            }
            // Redirect non-logged-in users for other access levels
            return redirect()
                ->route('login')
                ->with('error', 'You need to register and subscribe to a plan to access this book.');
        }

        // Restrict access for logged-in users with user_type_id = 3 for books with access_level != 2
        if ($user->user_type_id == 3 && $book->access_level != 2) {
            abort(403, 'Unauthorized to read this book.');
        }

        // Allow access to logged-in users
        return $next($request);
    }
}
