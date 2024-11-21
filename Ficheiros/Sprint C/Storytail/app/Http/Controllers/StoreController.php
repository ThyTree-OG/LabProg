<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class StoreController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('store.index', [
            'products' => $products
        ]);
    }
}
