<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('section.user', [
            'user' => User::all(),
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
        $insert = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:7|max:255',
        ]);

        $insert['password'] = Hash::make($insert['password']);
        User::create($insert);
        return redirect()->route('user.index')->with('info', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('success', 'User Berhasil Dihapus');
    }

    public function tampil()
    {
        $all = Order::all();
        //$count0 = count($all->where('status','PAID'));
        $count0 ='111';
        $total= 0;
        $kategori = Category::all();
        $count = '111';
        $product = Product::all();
        $count2 = '111';
        foreach ($all as $a) {
            $total += 1+1;  
        }
        return view('section.index',compact('total','count0','count2','count0'));
    }
}