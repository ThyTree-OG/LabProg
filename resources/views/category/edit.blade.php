@extends('layouts.admin')

@section('content')
<h1>New Category</h1>

<form name="category" method="POST" action="{{ route('category.update', $category->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3 col-md-4">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="name" aria-describedby="category" placeholder="{{ $category->name }}">
    </div>
    <div class="mb-3 col-md-4">
        <select class="form-select" name="status" aria-label="Status">
            <option value="" selected>Select Status</option>
            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection