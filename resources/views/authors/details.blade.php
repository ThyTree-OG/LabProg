@extends('layouts.app')

@section('content')
<div class="container px-3 py-5">
    <h1 class="custom-font text-center">Author Details</h1>
    <div class="row mt-4 align-items-center">
        <!-- Foto do autor -->
        <div class="col-md-4 text-center">
            <img 
                src="{{ $author->author_photo_url ? asset($author->author_photo_url) : asset('storage/authors/a.webp') }}" 
                alt="{{ $author->first_name }} {{ $author->last_name }}" 
                class="img-fluid rounded-circle shadow" 
                style="max-width: 300px;">
        </div>

        <!-- Detalhes principais do autor -->
        <div class="col-md-8">
            <h2 class="fw-bold">Name</h2>
            <p style="font-size: 1.25rem;">{{ $author->first_name }} {{ $author->last_name }}</p>

            <h3 class="fw-bold mt-4">Description</h3>
            <p class="text-muted" style="font-size: 1.25rem;">{{ $author->description }}</p>

            <h3 class="fw-bold mt-4">Nationality</h3>
            <p style="font-size: 1.25rem;">{{ $author->nationality }}</p>
        </div>
    </div>

    
    </div>
</div>
@endsection
