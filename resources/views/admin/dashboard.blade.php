@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Storytail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        .intro-section {
            background-color: #FF8C00;
            color: white;
            padding: 2rem 1rem;
            border-radius: 10px;
        }
        .intro-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .intro-section p {
            font-size: 1.25rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Introductory Section -->
        <div class="intro-section text-center">
            <h1>Welcome to the Storytail Backoffice</h1>
            <p>
                The Storytail Backoffice is your hub for managing all aspects of your digital library.
                From maintaining book details and author profiles to monitoring user activities, 
                this platform offers powerful tools to ensure a seamless experience for your readers.
            </p>
        </div>

        <!-- Features Section -->
        <div class="mt-4">
            <h2 class="text-center">Backoffice Features</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Book Management</h5>
                            <p class="card-text">Add, edit, or delete books and ensure the catalog is always up to date.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Author Profiles</h5>
                            <p class="card-text">Create and update author profiles with photos and biographies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">User Analytics</h5>
                            <p class="card-text">Track user activities and gain insights into reading trends.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-5 text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-orange btn-lg">
                Go to Dashboard
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection