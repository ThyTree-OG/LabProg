@extends('layouts.admin')

@section('content')
<h1>Book Details</h1>

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" value="{{ $book->title }}" disabled>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Cover URL</label>
        <input type="text" class="form-control" value="{{ $book->cover_url }}" disabled>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" disabled>{{ $book->description }}</textarea>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-3">
        <label class="form-label">Read Time (minutes)</label>
        <input type="text" class="form-control" value="{{ $book->read_time }}" disabled>
    </div>

    <div class="mb-3 col-md-3">
        <label class="form-label">Age Group</label>
        <input type="text" class="form-control" value="{{ $book->age_group }}" disabled>
    </div>

    <div class="mb-3 col-md-3">
        <label class="form-label">Status</label>
        <input type="text" class="form-control" value="{{ $book->is_active ? 'Active' : 'Inactive' }}" disabled>
    </div>

    <div class="mb-3 col-md-3">
        <label class="form-label">Access Level</label>
        <input type="text" class="form-control" value="{{ $plans->firstWhere('access_level', $book->access_level)->name }}" disabled>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Authors</label>
        <input type="text" class="form-control" value="{{ implode(', ', $book->authors->pluck('first_name')->toArray()) }}" disabled>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('book.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
