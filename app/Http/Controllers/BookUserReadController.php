<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookUserReadController extends Controller
{
    public function saveProgress(Request $request, $bookId)
{
    $request->validate([
        'progress' => 'required|numeric|min:0|max:100',
    ]);

    try {
        $userId = Auth::id(); // Obter o usuário autenticado

        // Atualizar ou criar o progresso
        DB::table('book_user_read')->updateOrInsert(
            ['book_id' => $bookId, 'user_id' => $userId],
            ['progress' => $request->progress, 'updated_at' => now()]
        );

        return response()->json(['message' => 'Progress saved successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to save progress.', 'error' => $e->getMessage()], 500);
    }
}
}
