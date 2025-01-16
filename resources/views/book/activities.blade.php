@extends('layouts.app')

@section('content')
<div class="container px-3 py-5">
    <h1 class="custom-font text-center">Activities for {{ $book->title }}</h1>
    <div class="row mt-4">
        @foreach($activities as $activity)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $activity->title }}</h5>
                        <p class="card-text">{{ $activity->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
