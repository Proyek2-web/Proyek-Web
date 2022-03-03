<?php

namespace App\Http\Controllers;

use App\Models\Province;
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

    public function register(){
        $provinces = Province::pluck('name', 'province_id');
        return view('auth.register',[
            'provinces' => $provinces
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:7|max:255',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->roles === 'admin') {
                return redirect()->intended('dashboard');
            }else{
                return redirect()->intended('/');
            }
        }
        return back()->with('loginFailed', 'Login Failed');
    }
    // Proses untuk registrasi
    public function registration(Request $request)
    {
        $save = new User();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->password =Hash::make($request->password);
        $save->no_hp = $request->no_hp;
        $save->province_id = $request->province_origin;
        $save->city_id = $request->city_origin;
        $save->alamat = $request->alamat;
        $save->roles = $request->roles;
        $save->save();
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}