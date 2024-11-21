<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        
        return view('product.index',
        ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sizes= Size::all();
        $colors=Color::all();
        return view('product.create',[
            'categories'=>$categories,
            'brands'=>$brands,
            'sizes'=>$sizes,
            'colors'=>$colors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255|min:3|unique:products',
            'sku' =>'required|max:255|min:3',
            'description' =>'required|min:5|max:255',
            'barcode' =>'required|integer|max:255|min:3',
            'category_id' =>'required|exists:categories,id',
            'price' =>'required|numeric|min:0',
            'sala_price' =>'required|numeric|min:0',
            'stock' =>'required|integer|min:0',
            'weight' =>'required|numeric|min:0',
            'color_id' =>'required|exists:colors,id',
            'size_id' =>'required|exists:sizes,id',
            'width' =>'required|numeric|min:0',
            'height' =>'required|numeric|min:0',
            'length' =>'required|numeric|min:0',
            'vat' =>'required|in:0.06,0.13,0.23',
            'brand_id' =>'required|exists:brands,id',
            'sale' =>'required|in:active,inactive',
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->barcode = $request->barcode;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->sala_price = $request->sala_price;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->color_id = $request->color_id;
        $product->size_id = $request->size_id;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->length = $request->length;
        $product->vat = $request->vat;
        $product->brand_id = $request->brand_id;

        if ($request->sale == 'active') {
            $product->sale = 1;
        } else {
            $product->sale = 0;
        }

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $brand = Brand::find($product->brand_id);
        $size= Size::find($product->brand_id);
        $color=Color::find($product->color_id);

        return view('product.show',[
            'product' => $product,
            'category'=>$category,
            'brand'=>$brand,
            'size'=>$size,
            'color'=>$color,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $sizes= Size::all();
        $colors=Color::all();

        return view('product.edit',[
            'product' => $product,
            'categories'=>$categories,
            'brands'=>$brands,
            'sizes'=>$sizes,
            'colors'=>$colors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Product::where('id', $id)->exists()) {

            $product = Product::find($id);

            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->barcode = $request->barcode;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->sala_price = $request->sala_price;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->color_id = $request->color_id;
            $product->size_id = $request->size_id;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->length = $request->length;
            $product->vat = $request->vat;
            $product->brand_id = $request->brand_id;

            if ($request->sale == 'active') {
                $product->sale = 1;
            } else {
                $product->sale = 0;
            }

            $product->save();
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();
        }
        return redirect()->route('product.index');
    }
}
