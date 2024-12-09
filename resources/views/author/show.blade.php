@extends('layouts.admin')

@section('content')
<h1>Author Details</h1>

<div class="row">
    <div class="mb-3 col-md-4">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" value="{{ $author->first_name }}" disabled>
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" value="{{ $author->last_name }}" disabled>
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Nationality</label>
        <input type="text" class="form-control" value="{{ $author->nationality }}" disabled>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" disabled>{{ $author->description }}</textarea>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Author Photo URL</label>
        <input type="text" class="form-control" value="{{ $author->author_photo_url }}" disabled>
    </div>
</div>

<a class="btn btn-primary" href="{{ route('author.index') }}">Back to List</a>
@endsection
