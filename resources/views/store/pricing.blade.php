@extends('layouts.app')

@section('title', 'Pricing - Storytails')

@section('content')

<!-- Pricing Header -->
<header style="background-image: url('{{ asset('assets/img/pricing-kids-background.png') }}'); background-size: cover; background-position: center;">
    <div class="container mx-auto text-center py-16">
        <h1 class="text-5xl font-bold text-white">Affordable Plans for Every Learner</h1>
        <p class="mt-4 text-xl text-white">
            Choose the plan that fits your child’s English learning journey.
        </p>
    </div>
</header>

<!-- Pricing Plans Section -->
<section class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Free Plan -->
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="text-orange-500 font-bold mb-4">Free Plan</h3>
                    <p class="text-gray-700">Start your child’s learning journey for free!</p>
                    <ul class="list-unstyled my-3">
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Access to 10 stories</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Basic vocabulary exercises</li>
                    </ul>
                    <h4 class="text-orange-500 font-bold">Free</h4>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-warning">Sign Up</a>
                </div>
            </div>
        </div>
        <!-- Standard Plan -->
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="text-orange-500 font-bold mb-4">Standard Plan</h3>
                    <p class="text-gray-700">Perfect for regular learners looking for more resources.</p>
                    <ul class="list-unstyled my-3">
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Access to 50 stories</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Intermediate vocabulary exercises</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Weekly progress reports</li>
                    </ul>
                    <h4 class="text-orange-500 font-bold">$9.99/month</h4>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-warning">Get Standard</a>
                </div>
            </div>
        </div>
        <!-- Premium Plan -->
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="text-orange-500 font-bold mb-4">Premium Plan</h3>
                    <p class="text-gray-700">Best for dedicated learners.</p>
                    <ul class="list-unstyled my-3">
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Unlimited stories</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Advanced vocabulary exercises</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Printable worksheets</li>
                        <li><i class="bi bi-check-circle-fill text-orange-500"></i> Live storytelling sessions</li>
                    </ul>
                    <h4 class="text-orange-500 font-bold">$19.99/month</h4>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-warning">Get Premium</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
