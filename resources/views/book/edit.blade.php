@extends('layouts.admin')

@section('content')
<h1>Edit Book</h1>
<div class="mb-3 col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<form name="book" method="POST" action="{{ route('book.update', $book->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" maxlength="255" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="cover_url" class="form-label">Cover URL</label>
            <input type="text" class="form-control" name="cover_url" id="cover_url" maxlength="255" value="{{ $book->cover_url }}">
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $book->description }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="read_time" class="form-label">Read Time (minutes)</label>
            <input type="number" class="form-control" name="read_time" id="read_time" min="0" value="{{ $book->read_time }}" required>
        </div>

        <div class="mb-3 col-md-3">
            <label for="age_group" class="form-label">Age Group</label>
            <select class="form-control form-select" name="age_group" id="age_group" required>
                <option value="">Select age group</option>
                @foreach($age_groups as $age_group)
                <option value="{{ $age_group->age_group }}" {{ $book->age_group == $age_group->age_group ? 'selected' : '' }}>
                    {{ $age_group->age_group }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="is_active" class="form-label">Status</label>
            <select class="form-control form-select" name="is_active" id="is_active" required>
                <option value="">Select status</option>
                <option value="1" {{ $book->is_active == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $book->is_active == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="access_level" class="form-label">Access Level</label>
            <select class="form-control form-select" name="access_level" id="access_level" required>
                <option value="">Select a plan</option>
                @foreach($plans as $plan)
                <option value="{{ $plan->access_level }}" {{ $book->access_level == $plan->access_level ? 'selected' : '' }}>
                    {{ $plan->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
