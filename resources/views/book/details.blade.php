@extends('layouts.app')

@section('title', 'Book Details - ' . $book->title)

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Book Cover -->
        <div class="col-md-4">
            <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="img-fluid rounded shadow-sm">
        </div>

        <!-- Book Details -->
        <div class="col-md-8">
            <h1>{{ $book->title }}</h1>
            <h4 class="text-muted">by {{ $book->author }}</h4>
            <p class="mt-3"><strong>Description:</strong> {{ $book->description }}</p>
            <p><strong>Category:</strong> {{ $book->category }}</p>
            <p><strong>Published Date:</strong> {{ $book->published_date }}</p>
            <p><strong>Price:</strong> ${{ $book->price }}</p>

            <!-- Action Buttons -->
            <div class="mt-4">
                <!-- Read Button -->
                <a href="{{ route('book.pdf', $book->id) }}" class="btn btn-primary">
                    Read Book <i class="fas fa-book-open"></i>
                </a>

                <!-- Audiobook Button -->
                @if($book->audiobook_url)
                <a href="{{ $book->audiobook_url }}" class="btn btn-secondary" target="_blank">
                    Listen to Audiobook <i class="fas fa-headphones-alt"></i>
                </a>
                @else
                <button class="btn btn-secondary disabled" title="Audiobook not available">
                    Audiobook Unavailable <i class="fas fa-headphones-alt"></i>
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Activity Section -->
    <div class="mt-5">
        <h3>Activities</h3>
        <p>Engage with the book in new ways:</p>
        <ul>
            <li><a href="">Take a Quiz</a></li>
            <li><a href="">Join the Discussion</a></li>
            <li><a href="">Complete a Challenge</a></li>
        </ul>
    </div>
</div>
@endsection
