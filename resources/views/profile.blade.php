
@extends('layouts.app')

@section('content')
    

    <!-- Container Centralizado -->
    <div class="form-container">
        <h1 class="custom-font">My Profile</h1>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
            @error('first_name') <span class="error-message">{{ $message }}</span> @enderror

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
            @error('last_name') <span class="error-message">{{ $message }}</span> @enderror

            <label for="user_name">Username:</label>
            <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}" disabled>
            @error('user_name') <span class="error-message">{{ $message }}</span> @enderror

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            @error('email') <span class="error-message">{{ $message }}</span> @enderror

            <button type="submit">Update</button>
        </form>
    </div>

    @endsection
    