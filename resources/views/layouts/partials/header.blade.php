<!-- resources/views/layouts/partials/header.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Storytail')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/storytail.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Header with Home, Login, Register, and Conditional Display -->
<nav class="navbar navbar-expand-lg py-3" style="background-color: rgba(0, 0, 0, 0.8); backdrop-filter: blur(5px);">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Home Button (Storytail) -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/storytail-logo-02.png') }}" alt="Storytail Logo" style="width: 55px; height: auto;">
            <span class="ms-2 text-orange-500 fw-bold">Storytail</span>
        </a>

        <!-- Toggle Button for Navbar on Mobile -->
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links and items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Conditionally display Login, Register, or Dashboard -->
                @guest
                    <!-- Login and Register buttons when user is not logged in -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    <!-- Dashboard button when the user is logged in -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ url('/admin') }}">Dashboard</a>
                    </li>
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white fw-bold">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
