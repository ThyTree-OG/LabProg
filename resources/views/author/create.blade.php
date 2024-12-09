@extends('layouts.admin')

@section('content')
<h1>New Author</h1>
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

<form name="author" method="POST" action="{{ route('author.store') }}">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" name="nationality" id="nationality" required>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="author_photo_url" class="form-label">Author Photo URL</label>
            <input type="text" class="form-control" name="author_photo_url" id="author_photo_url">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create Author</button>
</form>
@endsection
