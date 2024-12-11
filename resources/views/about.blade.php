<!-- About Page -->
@extends('layouts.app')

@section('content')
<header class="text-center py-5" style="background-image: url('public/assets/img/background.png'); background-size: cover; color: white;">
    <h1 class="display-4 font-weight-bold">About Us</h1>
    <p class="lead">Learn more about our journey, vision, and the people behind Storytails.</p>
</header>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-4">Our Story</h2>
        <p class="text-center mb-5">Storytails started with a passion for books and a desire to connect readers with stories they'll love. We believe every book has the power to change lives and bring people together.</p>
        
        <div class="row">
            <div class="col-md-6">
                <img src="public/assets/img/our-story.jpg" class="img-fluid rounded" alt="Our Story">
            </div>
            <div class="col-md-6">
                <h3 class="font-weight-bold">Our Mission</h3>
                <p>To create a seamless platform for book lovers to discover, share, and celebrate the joy of reading. We aim to be a hub where stories come to life.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-4">Meet the Team</h2>
        <p>We are a group of passionate individuals dedicated to bringing the best reading experience to you.</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <img src="public/assets/img/team1.jpg" class="rounded-circle mb-3" alt="Team Member 1" style="width: 150px; height: 150px;">
                <h5 class="font-weight-bold">Jane Doe</h5>
                <p>Founder & CEO</p>
            </div>
            <div class="col-md-4">
                <img src="public/assets/img/team2.jpg" class="rounded-circle mb-3" alt="Team Member 2" style="width: 150px; height: 150px;">
                <h5 class="font-weight-bold">John Smith</h5>
                <p>CTO</p>
            </div>
            <div class="col-md-4">
                <img src="public/assets/img/team3.jpg" class="rounded-circle mb-3" alt="Team Member 3" style="width: 150px; height: 150px;">
                <h5 class="font-weight-bold">Emily Brown</h5>
                <p>Creative Director</p>
            </div>
        </div>
    </div>
</section>

<footer class="custom-footer text-white py-5">
    <div class="container text-center">
        <img src="logo.png" alt="Storytails Logo" class="mx-auto mb-4" style="height: 50px;">
        <div class="d-flex justify-content-center gap-4">
            <a href="#" class="text-white text-decoration-none">Books</a>
            <a href="#" class="text-white text-decoration-none">Pricing</a>
            <a href="#" class="text-white text-decoration-none">Support</a>
            <a href="#" class="text-white text-decoration-none">Login</a>
            <a href="#" class="text-white text-decoration-none">Terms</a>
        </div>
        <p class="mt-4">&copy; 2021 storytail.pt</p>
    </div>
</footer>
@endsection
