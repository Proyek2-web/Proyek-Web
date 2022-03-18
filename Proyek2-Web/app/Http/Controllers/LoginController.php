<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


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
            if (auth()->user()->roles === 'admin') {
                Alert::info('Login Sukses', '');
                return redirect()->intended('dashboard');
            } else {
                Alert::info('Login Sukses', 'Selamat Datang' );
                return redirect()->intended('/');
            }
        }else{
        Alert::error('Login Gagal', 'Username Atau Password tidak sesuai');
            return back();
        }
        
    }
    // Proses untuk registrasi
    public function registration(Request $request)
    {
        $save = new User();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->password = Hash::make($request->psw);
        $save->no_hp = $request->no_hp;
        $save->alamat = $request->alamat;
        $save->roles = $request->roles;
        $save->save();
        Alert::success('Sukses Mendaftar', '');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::info('Berhasil Logout', '');

        return redirect('/');
    }
    public function alert()
    {
        Alert::info('Anda Harus Login', '');
        return back();
    }
}