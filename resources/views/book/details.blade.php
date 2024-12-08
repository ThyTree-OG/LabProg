@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container my-5">
    <h1>{{ $book->title }}</h1>
    <p>{{ $book->description }}</p>
    <p><strong>Read Time:</strong> {{ $book->read_time }} mins</p>
    <p><strong>Age Group:</strong> {{ $book->age_group }}</p>
    <p><strong>Access Level:</strong> {{ $book->access_level }}</p>

    @if($book->pdf_path)
    <a href="{{ route('book.pdf', $book->id) }}" class="btn btn-primary">Read PDF</a>
    @else
    <p>No PDF available for this book.</p>
    @endif
</div>
@endsection
