@extends('layouts.app')

@section('title', 'Contact Us - Storytails')

@section('content')

<!-- Contact Header -->
<header style="background-image: url('{{ asset('assets/img/contact-kids-background.png') }}'); background-size: cover; background-position: center;">
    <div class="container mx-auto text-center py-16">
        <h1 class="text-5xl font-bold text-white">Get in Touch!</h1>
        <p class="mt-4 text-xl text-white">
            Have a question or just want to say hi? We're here to help.
        </p>
    </div>
</header>

<!-- Codigo em falta para copiar para aqui -->

<!-- Contact Info Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="text-orange-500 text-3xl font-bold mb-4">Other Ways to Reach Us</h2>
        <p class="text-gray-700 text-lg">
            Prefer to email or call? Here's how you can reach us:
        </p>
        <p class="mt-4 text-gray-600">
            <i class="bi bi-envelope-fill text-orange-500"></i> 
            <a href="mailto:contact@storytails.com" class="text-orange-500">contact@storytails.com</a>
        </p>
        <p class="text-gray-600">
            <i class="bi bi-telephone-fill text-orange-500"></i> +1 (123) 456-7890
        </p>
        <div class="mt-4">
            <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-facebook"></i></a>
            <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-twitter"></i></a>
            <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</section>

@endsection
