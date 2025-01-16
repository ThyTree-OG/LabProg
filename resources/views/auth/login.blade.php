            <!-- Exibir mensagem de erro enviada pelo middleware -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login</h2>



            <!-- Exibir mensagens de validação -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="user_name">Username</label>
                    <input type="user_name" id="user_name" name="user_name" class="form-control" placeholder="Enter your username" autofocus required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
            <p class="text-center mt-3">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>.
            </p>
        </div>
    </div>
</div>

@endsection
