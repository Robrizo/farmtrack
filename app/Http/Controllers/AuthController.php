<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // app/Http/Controllers/AuthController.php
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' =>    $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user,    'redirect' => '/dashboard']);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function show()
    {
        $user = Auth::user();

        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout the user
    
        $request->session()->invalidate(); // Invalidate the session
    
        $request->session()->regenerateToken(); // Regenerate the CSRF token
    
        return response()->json(['redirect' => ('/')]);
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $users->update($request->all());

        return response()->json(['message' => 'user updated successfully', 'users' => $users]);
    }
}
