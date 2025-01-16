@extends('layouts.app')

@section('content')
<div class="container px-3 py-5">
    <h1 class="custom-font text-center">Book Details</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <img src="{{ asset($book->cover_url) }}"
                alt="{{ $book->title }}"
                class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8">
            <h2 class="fw-bold">{{ $book->title }}</h2>
            <p class="text-muted">{{ $book->description }}</p>
        </div>
    </div>
</div>
@endsection