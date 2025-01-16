@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container px-3 py-5">
    <h1 class="custom-font text-center">{{ $book->title }}</h1>
    <div class="row mt-4 align-items-center">
        <!-- Imagem de capa do livro -->
        <div class="col-md-4 text-center">
            <img
                src="{{ $book->cover_url ? asset($book->cover_url) : asset('storage/img/d.webp') }}"
                alt="{{ $book->title }}"
                class="img-fluid rounded shadow"
                style="max-height: 300px; width: auto;">

            <!-- Avaliação do Livro -->
            @auth
            @php
            $isCompleted = $user->completedBooks()->where('book_id', $book->id)->exists();
            $inProgress = !$isCompleted && $user->readingBooks()->where('book_id', $book->id)->exists();

            $currentRating = $isCompleted
            ? $user->completedBooks()->where('book_id', $book->id)->first()->pivot->rating
            : 0;
            @endphp

            <!-- Seção para Livro Concluído -->
            @if($isCompleted)
            <div class="mt-4">
                <h3 class="text-warning text-center">You've completed this book!</h3>
                <form action="{{ route('books.rate', ['id' => $book->id]) }}" method="POST" class="text-center">
                    @csrf
                    <div class="rating d-flex justify-content-center flex-row-reverse">
                        @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star-{{ $i }}" name="rating" value="{{ $i }}"
                            class="d-none" {{ $currentRating == $i ? 'checked' : '' }}>
                        <label for="star-{{ $i }}" class="star">
                            <i class="{{ $i <= $currentRating ? 'fas' : 'far' }} fa-star"></i>
                        </label>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Rate</button>
                </form>
            </div>
            @endif

            <!-- Seção para Livro em Progresso -->
            @if($inProgress)
            <div class="mt-4">
                <h3 class="text-warning text-center">You are currently reading this book!</h3>
            </div>
            @endif

            <!-- Seção para Livro Não Iniciado -->
            @if(!$inProgress && !$isCompleted)
            <div class="mt-4">
                <h3 class="text-muted text-center">You haven't started this book yet.</h3>
            </div>
            @endif
            @endauth
        </div>

        <!-- Detalhes principais do livro -->
        <div class="col-md-8">
            <h2 class="fw-bold" style="font-size: 1.75rem;">Description</h2>
            <p class="text-muted" style="font-size: 1.25rem;">{{ $book->description }}</p>

            <h3 class="fw-bold mt-4" style="font-size: 1.5rem;">Age Group</h3>
            <p style="font-size: 1.25rem;">{{ $book->age_group }}</p>

            <h3 class="fw-bold mt-4" style="font-size: 1.5rem;">Authors</h3>
            <ul class="list-unstyled">
                @forelse ($book->authors as $author)
                <li style="font-size: 1.25rem;">
                    <a href="{{ route('author.details', ['id' => $author->id]) }}" class="btn btn-primary mt-3">
                        <strong>{{ $author->first_name }} {{ $author->last_name }}</strong>
                    </a>
                </li>
                @empty
                <li style="font-size: 1.25rem;">No authors associated with this book.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Seção de Favoritos -->
    @auth
    <div class="row mt-4">
        <div class="col text-center">
            <form action="{{ route('book.favorite', ['id' => $book->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light border-0 d-flex align-items-center justify-content-center" aria-label="Add to Favorites">
                    @if(auth()->user()->favorites->contains($book->id))
                    <i class="bi bi-heart-fill me-2" style="font-size: 1.5rem; color: red;"></i> <span>Added to Favorites</span>
                    @else
                    <i class="bi bi-heart me-2" style="font-size: 1.5rem; color: red;"></i> <span>Add to Favorites</span>
                    @endif
                </button>
            </form>
        </div>
    </div>
    @endauth

    <!-- Informações adicionais -->
    <div class="row mt-5">
        <div class="col-md-4">
            <h4 class="fw-bold" style="font-size: 1.5rem;">Read Time</h4>
            <p style="font-size: 1.25rem;">{{ $book->read_time }} minutes</p>
        </div>
        <div class="col-md-4">
            <h4 class="fw-bold" style="font-size: 1.5rem;">Status</h4>
            <p style="font-size: 1.25rem;">{{ $book->is_active ? 'Active' : 'Inactive' }}</p>
        </div>
        <div class="col-md-4">
            <h4 class="fw-bold" style="font-size: 1.5rem;">Access Level</h4>
            <p style="font-size: 1.25rem;">{{ $plans->firstWhere('access_level', $book->access_level)->name ?? 'N/A' }}</p>
        </div>
    </div>
    <!-- Read Button -->
    <div class="text-center mt-4">
        <a href="{{ route('books.first-page', $book->id) }}" class="btn btn-primary mt-3">
            <i class="fas fa-book-open"></i> Read
        </a>

        <a class="btn btn-primary  btn-lg" href="{{ url('/activities') }}">Go to Activities</a>
    </div>
</div>
@endsection