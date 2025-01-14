<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PricingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $userSubscription = auth()->user() ? auth()->user()->currentSubscription : null;
        return view('store.pricing', compact('plans', 'userSubscription'));
    }
}
