@extends('layouts.app')

@section('title', 'Currently Reading')

@section('content')
<div class="container py-5">
    <h1 class="custom-font text-center">Books You're Reading</h1>

    @if($currentlyReading->isEmpty())
        <p class="text-center text-muted">You are not currently reading any books.</p>
    @else
        <div class="row mt-4">
            @foreach($currentlyReading as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($book->cover_url) }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->description, 100) }}</p>

                        <!-- Barra de progresso -->
                        <div class="progress mt-3" style="height: 25px;">
                            <div class="progress-bar custom-progress-bar" role="progressbar"
                                 style="width: {{ $book->progress ?? 0 }}%;"
                                 aria-valuenow="{{ $book->progress ?? 0 }}" aria-valuemin="0" aria-valuemax="100" >
                                {{ $book->progress ?? 0 }}%
                            </div>
                        </div>

                        <!-- Botão para continuar lendo -->
                        <a href="{{ route('books.first-page', $book->id) }}" class="btn btn-primary mt-3 w-100">
                            Continue Reading
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
