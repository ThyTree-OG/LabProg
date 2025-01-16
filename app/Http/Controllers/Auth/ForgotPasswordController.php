<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function checkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ]);

    $user = User::where('email', $request->email)->first();
    
    if ($user) {
        // Generate password reset token
        $token = Password::createToken($user);
        
        // Redirect to reset password form with token and email
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    return back()->withErrors(['email' => 'Email not found']);
}

}
