@extends('layouts.app')

@section('title', 'Your Favorites')

@section('content')
<div class="container py-5">
    <h1 class="custom-font text-center">Your Favorite Books</h1>

    @if($favorites->isEmpty())
        <p class="text-center text-muted">You have no favorite books yet.</p>
    @else
        <div class="row mt-4">
            @foreach($favorites as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($book->cover_url) }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                        <a href="{{ route('book.details', $book->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection