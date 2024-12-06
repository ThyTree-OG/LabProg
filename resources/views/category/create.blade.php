@extends('layouts.admin')

@section('content')
<h1>New Category</h1>
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
<form name="category" method="POST" action="{{ route('category.store') }}">
    @csrf
    <div class="mb-3 col-md-4">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="name" aria-describedby="category" required>
    </div>
    <div class="mb-3 col-md-4">
    <select value="" class="form-select" name="status" aria-label="Status" required>
        <option selected>Select Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
