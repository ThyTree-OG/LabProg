<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanChangeRequest;
use App\Models\Plan;
use Auth;

class PlanChangeRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'new_plan_id' => 'required|exists:plans,id|different:current_subscription.plan_id',  // Ensures it's a valid plan and different from current plan
        ]);        

        // Get the current user's subscription and the requested plan
        $user = Auth::user();
        $currentSubscription = $user->currentSubscription;

        // Validate the requested plan (you might want to handle this more robustly)
        $newPlanId = $request->input('new_plan_id');
        $newPlan = Plan::findOrFail($newPlanId);

        // Ensure the user is not requesting the same plan they already have
        if ($currentSubscription && $currentSubscription->plan_id == $newPlanId) {
            return redirect()->back()->with('error', 'You are already on this plan.');
        }

        // Create a new plan change request
        PlanChangeRequest::create([
            'user_id' => $user->id,
            'old_plan_id' => $currentSubscription ? $currentSubscription->plan_id : null,
            'new_plan_id' => $newPlanId,
            'status' => 'pending',
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your request has been submitted and is pending approval.');
    }
}
