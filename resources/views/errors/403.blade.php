@extends('layouts.app')

@section('content')
<div class="container text-center" style="margin-top: 150px;">
    <h1>Access Denied</h1>
    <h3>You do not have permission to access this book.</h3>
    <h3>Please Subscribe Premium Plan</h3>
    <a href="{{ route('pricing') }}" class="btn btn-primary">To subsciptions</a>
</div>
@endsection