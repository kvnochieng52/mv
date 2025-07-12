<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return Inertia::render('Login/Login');
    }


    public function LoginUser(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();
            return redirect('/movie');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }


    public function register(Request $request)
    {
        return Inertia::render('Register/Register');
    }

    public function RegisterUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/movie');
    }
}
