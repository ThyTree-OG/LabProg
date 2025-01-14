<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserPlanController extends Controller
{
    public function index()
{
    $users = User::with(['plan' => function($query) {
        $query->select('plans.*');
    }])->get();
    
    return view('user-plans.index', compact('users'));
}

public function revoke(User $user)
{
    $standardPlanId = 2; // ID for Standard Plan
    
    $user->subscription()->update([
        'plan_id' => $standardPlanId,
        'start_date' => now()
    ]);

    return redirect()->route('user-plans.index')
        ->with('success', 'User plan has been changed to Standard successfully');
}

}
