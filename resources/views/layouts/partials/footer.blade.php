<!-- resources/views/layouts/partials/footer.blade.php -->
<!-- Footer Section -->
<footer class="custom-footer text-white py-5">
    <div class="container text-center">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/storytail-logo-06.png') }}" alt="Storytail Logo" style="width: 55px; height: auto;">
        </a>
        <div class="d-flex justify-content-center gap-4 mt-3">
            <a href="{{ route('store') }}" class="text-white text-decoration-none">Books</a>
            <a href="{{ route('pricing') }}" class="text-white text-decoration-none">Pricing</a>
            <a href="{{ route('contact') }}" class="text-white text-decoration-none">Contacts</a>
            <a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a>
            <a href="{{ route('terms') }}" class="text-white text-decoration-none">Terms</a>
            <a href="{{ route('about') }}" class="text-white text-decoration-none">About</a>
        </div>
        <p class="mt-4">&copy; 2021 storytail.pt</p>
    </div>
</footer>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
