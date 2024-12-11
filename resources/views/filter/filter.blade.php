@extends('layouts.app')

@section('content')
<div class="container px-3">
    <h1 class="custom-font">Filter Books</h1>

    <!-- Formulário de Filtro -->
    <form action="{{ route('book.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ request('title') }}">
            </div>
            <div class="col-md-4">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ request('author') }}">
            </div>
            <div class="col-md-4">
                <label for="age_group" class="form-label">Age Group</label>
                <select id="age_group" name="age_group" class="form-select">
                    <option value="">Select Age Group</option>
                    <option value="Adult" {{ request('age_group') == 'Adult' ? 'selected' : '' }}>Adult</option>
                    <option value="Young Adult" {{ request('age_group') == 'Young Adult' ? 'selected' : '' }}>Young Adult</option>
                    <option value="Children" {{ request('age_group') == 'Children' ? 'selected' : '' }}>Children</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="access_level" class="form-label">Access Level</label>
                <select id="access_level" name="access_level" class="form-select">
                    <option value="">Select Access Level</option>
                    <option value="1" {{ request('access_level') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('access_level') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('access_level') == '3' ? 'selected' : '' }}>3</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Listagem de Livros -->
    <div class="row">
        @foreach ($books as $book)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ $book->cover_url }}" class="card-img-top" alt="{{ $book->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('book.details', $book->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
