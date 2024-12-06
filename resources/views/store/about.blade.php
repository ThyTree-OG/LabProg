<!-- resources/views/store/about.blade.php -->

@extends('layouts.app')

@section('title', 'About Us - Storytail')

@section('content')

<!-- About Section with Vibrant Background -->
<header style="background-image: url('{{ asset('assets/img/about-kids-background.png') }}'); background-size: cover; background-position: center;">
    <div class="container mx-auto text-center py-16">
        <h1 class="text-5xl font-bold">Welcome to Storytail!</h1>
        <p class="mt-4 text-xl text-black">
            Learn English through the joy of storytelling.
        </p>
    </div>
</header>

<!-- Mission Section -->
<section class="container my-5 text-center">
    <h2 class="text-orange-500 text-3xl font-bold mb-4">Our Mission</h2>
    <p class="text-gray-700 text-lg">
        At Storytails, we believe in the magic of books to teach children English. 
        Through fun stories, interactive activities, and engaging visuals, 
        we inspire kids to learn, imagine, and grow.
    </p>
    <img src="{{ asset('assets/img/mission-kids.png') }}" alt="Our Mission" class="mx-auto my-4" style="max-width: 400px;">
</section>

<!-- Team Section -->
<section class="bg-yellow-50 py-5">
    <div class="container text-center">
        <h2 class="text-orange-500 text-3xl font-bold mb-4">Meet Our Team</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Team Member 1 -->
            <div class="col">
                <img class="rounded-circle mb-3 border border-orange-500" src="https://dummyimage.com/150x150/ddd/6c757d.jpg" alt="Team Member">
                <h5 class="fw-bold text-gray-800">John Book</h5>
                <p class="text-gray-600">Founder</p>
            </div>
            <!-- Team Member 2 -->
            <div class="col">
                <img class="rounded-circle mb-3 border border-orange-500" src="https://dummyimage.com/150x150/ddd/6c757d.jpg" alt="Team Member">
                <h5 class="fw-bold text-gray-800">John Content</h5>
                <p class="text-gray-600">Content Curator</p>
            </div>
            <!-- Team Member 3 -->
            <div class="col">
                <img class="rounded-circle mb-3 border border-orange-500" src="https://dummyimage.com/150x150/ddd/6c757d.jpg" alt="Team Member">
                <h5 class="fw-bold text-gray-800">John Image</h5>
                <p class="text-gray-600">Illustrator</p>
            </div>
        </div>
        <!-- Team Member 4 -->
        <div class="col">
                <img class="rounded-circle mb-3 border border-orange-500" src="https://dummyimage.com/150x150/ddd/6c757d.jpg" alt="Team Member">
                <h5 class="fw-bold text-gray-800">John Audio</h5>
                <p class="text-gray-600">AudioBooks</p>
            </div>
        </div>
    </div>
</section>

<!-- Fun Facts Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="text-orange-500 text-3xl font-bold mb-4">Fun Facts About Us</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded">
                    <h3 class="text-2xl font-bold text-orange-500">1+</h3>
                    <p class="text-gray-700">Stories Published</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded">
                    <h3 class="text-2xl font-bold text-orange-500">1+</h3>
                    <p class="text-gray-700">Happy Readers</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded">
                    <h3 class="text-2xl font-bold text-orange-500">0</h3>
                    <p class="text-gray-700">Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="container my-5 text-center">
    <h2 class="text-orange-500 text-3xl font-bold mb-4">Contact Us</h2>
    <p class="text-gray-700 text-lg">
        Have questions or feedback? Reach out to us at 
        <a href="mailto:contact@storytails.com" class="text-orange-500 font-bold">contact@storytails.com</a>
        or follow us on social media!
    </p>
    <div class="mt-4">
        <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-facebook"></i></a>
        <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-twitter"></i></a>
        <a href="#" class="mx-2 text-orange-500 text-xl"><i class="bi bi-instagram"></i></a>
    </div>
</section>

@endsection
