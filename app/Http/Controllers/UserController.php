<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validação dos dados
        $validatedData = $request->validate([
            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            
        ]);

        // Atualizar os dados do utilizador
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Data updated successfully!');
    }
}
