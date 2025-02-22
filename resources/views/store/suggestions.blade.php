@extends('layouts.app')

@section('title', 'Suggestions - Storytails')

@section('content')

<!-- Search Section with Background Image -->
<header style="background-image: url('{{ asset('assets/img/background.png') }}');">
    <div class="container mx-auto text-center py-16">
        <h1 class="text-4xl font-bold text-gray-800">Find a book</h1>
        <form action="" method="GET" class="d-flex justify-content-center">
            <input
                type="text"
                name="query"
                placeholder="e.g. title, author..."
                class="form-control w-50 py-2 rounded-end border-0"
                style="max-width: 500px;"
            >
            <button type="submit" class="btn btn btn-warning rounded">
                <i class="bi bi-search"></i> Search
            </button>

            <a href="{{ route('book.indexRequest') }}" class="btn btn-warning rounded">
            <i class="bi bi-funnel"></i> Filter
        </a>
        </form>
    </div>
</header>

<!-- Navigation Tabs for the Home Page -->
<nav class="bg-white shadow-md mt-4">
    <div class="container mx-auto flex justify-around py-4">
        <a href="#" class="text-orange-500 font-semibold">New Books</a>
        <a href="#" class="text-gray-600 hover:text-orange-500">Our Picks</a>
        <a href="{{ route('books.popular') }}" class="text-gray-600 hover:text-orange-500">Most Popular</a>
        <a href="{{ route('book.suggestions') }}" class="text-gray-600 hover:text-orange-500">Sugestions</a>
    </div>
</nav>

<!-- Main Content for the page -->
<main class="container my-5">
    <h2 class="text-warning mb-4">Suggested Books</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($books as $book)
        <div class="col mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="{{ $book->cover_url }}" alt="{{ $book->title }}" />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">{{ $book->title }}</h5>
                        <p>{{ $book->description }}</p>
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a class="btn btn-warning mt-auto text-capitalize" href="{{ route('book.read', $book->book_id) }}" target="_blank">
                            <i class="bi bi-book lowe"></i> Read
                        </a>
                        <a class="btn btn-outline-dark mt-auto" href="{{ route('book.details', $book->book_id) }}">View details</a>
                        <a class="btn btn-primary mt-2" href="{{ url('/activities') }}" >Go to Activities</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

@endsection
