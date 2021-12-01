<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:7|max:255',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->with('loginFailed', 'Login Failed');
    }
    // Proses untuk registrasi
    public function auth(Request $request)
    {
        $insert = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:7|max:255',
        ]);

        $insert['password'] = Hash::make($insert['password']);
        User::create($insert);
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}