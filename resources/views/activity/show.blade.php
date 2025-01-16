@extends('layouts.admin')

@section('content')
<h1>Activity Details</h1>

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" value="{{ $activity->title }}" disabled>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" disabled>{{ $activity->description }}</textarea>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label class="form-label">Associated Books</label>
        <ul class="list-group">
            @foreach($activity->books as $book)
                <li class="list-group-item">{{ $book->title }}</li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Created At</label>
        <input type="text" class="form-control" value="{{ $activity->created_at }}" disabled>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Updated At</label>
        <input type="text" class="form-control" value="{{ $activity->updated_at }}" disabled>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('activity.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
