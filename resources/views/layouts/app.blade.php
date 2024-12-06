<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.header')
</head>
<body>

    <!-- Main Content Section -->
    @yield('content')

    <!-- Footer Section -->
    @include('layouts.partials.footer')

</body>
</html>

