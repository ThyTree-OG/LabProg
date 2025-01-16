@extends('layouts.admin')

@section('content')
<h1>Create New Activity</h1>
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

<form name="activity" method="POST" action="{{ route('activity.store') }}">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" maxlength="255" required>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('activity.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
