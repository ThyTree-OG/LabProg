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
        @foreach ($plans as $plan)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="text-orange-500 font-bold mb-4">{{ $plan->name }}</h3>
                    <p class="text-gray-700">
                        @switch($plan->name)
                            @case('Basic Plan')
                                Start your child’s learning journey for free!
                                @break
                            @case('Standard Plan')
                                Perfect for regular learners looking for more resources.
                                @break
                            @case('Premium Plan')
                                Best for dedicated learners.
                                @break
                        @endswitch
                    </p>
                    <ul class="list-unstyled my-3">
                        @switch($plan->name)
                            @case('Basic Plan')
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Access to 10 stories</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Basic vocabulary exercises</li>
                                @break
                            @case('Standard Plan')
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Access to 50 stories</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Intermediate vocabulary exercises</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Weekly progress reports</li>
                                @break
                            @case('Premium Plan')
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Unlimited stories</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Advanced vocabulary exercises</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Printable worksheets</li>
                                <li><i class="bi bi-check-circle-fill text-orange-500"></i> Live storytelling sessions</li>
                                @break
                        @endswitch
                    </ul>
                    <h4 class="text-orange-500 font-bold">
                        @if ($plan->name == 'Basic Plan')
                            Free
                        @elseif ($plan->name == 'Standard Plan')
                            $9.99/month
                        @elseif ($plan->name == 'Premium Plan')
                            $19.99/month
                        @endif
                    </h4>
                </div>
                <div class="card-footer text-center">
                    @auth
                        @php
                            // Get the user's current subscription (if any)
                            $userPlan = Auth::user()->currentSubscription ? Auth::user()->currentSubscription->plan : null;
                        @endphp
                        @if ($userPlan && $userPlan->id == $plan->id)
                            <button class="btn btn-warning" disabled>Current Plan</button>
                        @else
                            <!-- Form to request a plan change -->
                            <form action="{{ route('request.plan.change') }}" method="POST">
                                @csrf
                                <input type="hidden" name="new_plan_id" value="{{ $plan->id }}">
                                <button type="submit" class="btn btn-warning">Change</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning">Sign In</a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection

@push('scripts')
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@endpush