@extends('layouts.admin')

@section('content')

<h1>Categories</h1>

<form name="category" method="" action="{{ route('category.index') }}">
    @csrf
    <div class="mb-3 col-md-4">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="name" aria-describedby="category" placeholder="{{ $category->name }}" disabled>
    </div>
    <div class="mb-3 col-md-4">
    <select class="form-select" name="status" aria-label="Status" disabled>
        <option value="" selected>Select Status</option>
        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    </div>
    <a class="btn btn-primary" href="{{ route('category.index') }}">Voltar</a>
</form>
@endsection