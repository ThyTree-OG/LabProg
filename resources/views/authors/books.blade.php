@extends('layouts.app')

@section('content')
<div class="container px-3 py-5">
    <h1 class="custom-font text-center">Books by {{ $author->first_name }} {{ $author->last_name }}</h1>

    <div class="row mt-4">
        @if($author->books->count() > 0)
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($author->books as $book)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset($book->cover_url) }}"
                        class="card-img-top"
                        alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Book</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            <p class="text-muted">No books found for this author.</p>
        </div>
        @endif
    </div>
</div>
@endsection