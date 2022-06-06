<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('layouts.profil', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
                $imageName = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('profil'), $imageName);
        }
        $user = User::find($id);
        $user->gambar = $imageName;
        $user->save();
        Alert::info('Gambar Diupdate', '');
        return redirect('/');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
                $imageName = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('profil'), $imageName);
                $user = User::find($id);
                $user->gambar = $imageName;
                $user->save();
                Alert::info('Berhasil Diubah', 'Silahkan Login Kembali');
                return redirect('/halaman_profil');
        }else if($request->passwd1){
        $user = User::find($id);
        $user->password = Hash::make($request->passwd1);
        $user->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::info('Berhasil Diubah', 'Silahkan Login Kembali');
        return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
