@extends('layouts.admin')

@section('content')
<h1>New Product</h1>
<div class="mb-3 col-md-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<form name="product" method="POST" action="{{ route('product.store') }}">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="product" class="form-label">Product</label>
            <input type="text" class="form-control" id="product" name="name" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-2">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-2">
            <label for="vat" class="form-label">VAT</label>
            <input type="text" class="form-control" name="vat" id="vat" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-2">
            <label for="sala_price" class="form-label">Sale Price</label>
            <input type="text" class="form-control" name="sala_price" id="sala_price" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-2">
            <label for="sale" class="form-label">Sale</label>
            <select value="" class="form-select" name="sale" aria-label="Sale" required>
                <option selected>Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-2">
            <label for="barcode" class="form-label">Bar Code</label>
            <input type="number" class="form-control" name="barcode" id="barcode" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-10">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" aria-describedby="product" required>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="number" class="form-control" name="weight" id="weight" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-3">
            <label for="width" class="form-label">Width</label>
            <input type="number" class="form-control" name="width" id="width" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-3">
            <label for="height" class="form-label">Height</label>
            <input type="number" class="form-control" name="height" id="height" aria-describedby="product" required>
        </div>

        <div class="mb-3 col-md-3">
            <label for="length" class="form-label">Length</label>
            <input type="number" class="form-control" name="length" id="length" aria-describedby="product" required>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" name="sku" id="sku" aria-describedby="product" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" aria-describedby="product" required>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id" aria-describedby="product" required>
            <option selected>Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="color_id" class="form-label">Color</label>
            <select class="form-select" name="color_id" id="color_id" aria-describedby="product" required>
            <option selected>Select Color</option>
                @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="size_id" class="form-label">Size</label>
            <select class="form-select" name="size_id" id="size_id" aria-describedby="product" required>
            <option selected>Select Size</option>
                @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="brand_id" class="form-label">Brand</label>
            <select class="form-select" name="brand_id" id="brand_id" aria-describedby="product" required>
                <option selected>Select Brand</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection