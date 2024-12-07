@extends('layouts.admin')

@section('content')

<h1>Products</h1>

<form name="category" method="" action="{{ route('category.index') }}">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="product" class="form-label">Product</label>
            <input type="text" class="form-control" id="product" name="name" aria-describedby="product" placeholder="{{ $product->name }}" disabled>
        </div>

        <div class="mb-3 col-md-2">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" aria-describedby="product" placeholder="{{ $product->price }}" disabled>
        </div>

        <div class="mb-3 col-md-2">
            <label for="vat" class="form-label">VAT</label>
            <input type="text" class="form-control" name="vat" id="vat" aria-describedby="product" placeholder="{{ $product->vat }}" disabled>
        </div>

        <div class="mb-3 col-md-2">
            <label for="sala_price" class="form-label">Sale Price</label>
            <input type="text" class="form-control" name="sala_price" id="sala_price" aria-describedby="product" placeholder="{{ $product->sala_price }}" disabled>
        </div>

        <div class="mb-3 col-md-2">
            <label for="sale" class="form-label">Sale</label>
            <input type="text" class="form-control" name="sale" id="sale" aria-describedby="product" placeholder="{{ $product->sale == '1' ? 'Active' : 'Inactive' }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-2">
            <label for="barcode" class="form-label">Bar Code</label>
            <input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="product" placeholder="{{ $product->barcode }}" disabled>
        </div>

        <div class="mb-3 col-md-10">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" aria-describedby="product" placeholder="{{ $product->description }}" disabled>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" class="form-control" name="weight" id="weight" aria-describedby="product" placeholder="{{ $product->weight }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="width" class="form-label">Width</label>
            <input type="text" class="form-control" name="width" id="width" aria-describedby="product" placeholder="{{ $product->width }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="height" class="form-label">Height</label>
            <input type="text" class="form-control" name="height" id="height" aria-describedby="product" placeholder="{{ $product->height }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="length" class="form-label">Length</label>
            <input type="text" class="form-control" name="length" id="length" aria-describedby="product" placeholder="{{ $product->length }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" name="sku" id="sku" aria-describedby="product" placeholder="{{ $product->sku }}" disabled>
        </div>
        <div class="mb-3 col-md-4">
            <label for="stock" class="form-label">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock" aria-describedby="product" placeholder="{{ $product->stock }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="category_id" class="form-label">Category</label>
            <input type="text" class="form-control" name="category_id" id="category_id" aria-describedby="product" placeholder="{{ $category->name }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="color_id" class="form-label">Color</label>
            <input type="text" class="form-control" name="color_id" id="color_id" aria-describedby="product" placeholder="{{ $color->name }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="size_id" class="form-label">Size</label>
            <input type="text" class="form-control" name="size_id" id="size_id" aria-describedby="product" placeholder="{{ $color->name }}" disabled>
        </div>

        <div class="mb-3 col-md-3">
            <label for="brand_id" class="form-label">Brand</label>
            <input type="text" class="form-control" name="brand_id" id="brand_id" aria-describedby="product" placeholder="{{ $brand->name }}" disabled>
        </div>
        
    </div>
    <a class="btn btn-primary" href="{{ route('product.index') }}">Voltar</a>
</form>
@endsection