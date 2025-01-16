<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class PdfToImageController extends Controller
{
    public function showFirstPage($bookId)
    {
        $book = Book::findOrFail($bookId);

        // Validate access based on book's access_level
        if ($book->access_level == 2) {
            if (!auth()->check()) {
                // Redirect to login page if not logged in
                return redirect()->route('login')->with('error', 'You must be logged in to access this book.');
            }

            $userSubscription = DB::table('subscriptions')
                ->where('user_id', auth()->id())
                ->value('plan_id');

            if ($userSubscription != 2) {
                abort(403, 'You need a premium subscription to access this book.');
            }
        }

        // Validate if the book has a PDF
        if (!$book->pdf_path) {
            abort(404, 'PDF not found for this book.');
        }

        $outputDir = public_path('storage/pdf_images/' . $bookId);

        // Ensure the output directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Check if directory is empty and generate images if necessary
        $existingFiles = array_diff(scandir($outputDir), ['.', '..']);
        if (empty($existingFiles)) {
            // Path to the PDF
            $pdfPath = public_path($book->pdf_path);

            // MuPDF command to convert PDF to images
            $mutoolPath = 'C:\mupdf-1.25.2-windows\mutool.exe'; // Update this to your MuPDF binary path
            $command = escapeshellcmd("$mutoolPath draw -o $outputDir/page-%d.png -r 300 $pdfPath");

            try {
                shell_exec($command); // Execute the command
            } catch (\Exception $e) {
                abort(500, 'Failed to generate images from the PDF.');
            }

            // Refresh the list of files after generation
            $existingFiles = array_diff(scandir($outputDir), ['.', '..']);
        }

        // Fetch all files and filter out directories
        $files = array_filter($existingFiles, function ($file) use ($outputDir) {
            return is_file($outputDir . '/' . $file);
        });

        // Apply natural sorting
        usort($files, function ($a, $b) {
            return strnatcmp($a, $b); // Natural order comparison
        });

        // Generate URLs for sorted files
        $pages = array_map(fn($file) => asset("storage/pdf_images/{$bookId}/{$file}"), $files);

        // Determine the page to start from
        $startPage = 1; // Default to the first page

        if (auth()->check()) {
            // Fetch the user's progress for this book if logged in
            $progress = DB::table('book_user_read')
                ->where('book_id', $bookId)
                ->where('user_id', auth()->id())
                ->value('progress') ?? 0;

            // Calculate the starting page based on progress
            $totalPages = count($pages);
            $startPage = max(1, min($totalPages, ceil(($progress / 100) * $totalPages)));
        }

        // Get the first page based on calculated progress
        $firstPage = $pages[$startPage - 1] ?? null;

        return view('book.first_page', compact('book', 'firstPage', 'pages', 'startPage'));
    }
}
