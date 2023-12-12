<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[\W_]).+$/|'
            // 'password' => [
            //     'required',
            //     'min:8',
            //     'confirmed',
            //     'regex:/^(?=.*[A-Z])(?=.*[\W_]).+$/'
            // ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('login-success', 'You have been registered successfully!');

    }


    public function login(Request $request) {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);


        // Check 
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return back()->withErrors([
            'wrongCredentials' => 'The provided credentials do not match our records'
        ]);
    }
}
