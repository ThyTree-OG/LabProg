<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class StoreController extends Controller
{
    //
    public function index()
    {
        $books = Book::all();
        return view('store.index', [
            'books' => $books
        ]);
    }
}
