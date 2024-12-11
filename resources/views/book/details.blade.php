@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container px-3">
    <h1 class="custom-font">Book Details</h1>
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
            <input type="text" class="form-control" value="{{ $plans->firstWhere('access_level', $book->access_level)->name ?? 'N/A' }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label class="form-label">Authors</label>
            <ul class="list-group">
                @forelse ($book->authors as $author)
                    <li class="list-group-item">
                        <a href="{{ route('author.details', ['id' => $author->id]) }}">
                            <strong>{{ $author->first_name }} {{ $author->last_name }}</strong>
                        </a>
                    </li>
                @empty
                    <li class="list-group-item">No authors associated with this book.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
