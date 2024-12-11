@extends('layouts.app')

@section('content')
<div class="container px-3">
    <h1 class="custom-font">Author Details</h1>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" value="{{ $author->first_name }}" disabled>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" value="{{ $author->last_name }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3" disabled>{{ $author->description }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">Nationality</label>
            <input type="text" class="form-control" value="{{ $author->nationality }}" disabled>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label">Photo URL</label>
            <input type="text" class="form-control" value="{{ $author->author_photo_url }}" disabled>
        </div>
    </div>
</div>
@endsection
