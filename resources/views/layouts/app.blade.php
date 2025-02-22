<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<html lang="en">
<head>
    @include('layouts.partials.header')
</head>
<body>

    <!-- Main Content Section -->
    @yield('content')
    @stack('scripts')
    @if (session('message'))
<div class="alert alert-success text-center">
    {{ session('message') }}
</div>
@endif
    <!-- Footer Section -->
    @include('layouts.partials.footer')

</body>
</html>

