<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        return view('layouts.address', [
            'alamat' => Address::all()->where('user_id', '=', auth()->user()->id),
            'provinces' => $provinces
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
        $address = new Address();
        $address->user_id = $request->user_id;
        $address->nama_penerima = $request->name;
        $address->province_id = $request->province_destination;
        $address->label = $request->label;
        $address->city_id = $request->city_destination;
        $address->no_telepon = $request->no_hp;
        $address->zip_code = $request->zip;
        $address->alamat = $request->alamat;
        $address->save();
        Alert::success('Alamat Berhasil Ditambahkan', '');
        return back();
        
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
    public function edit($id)
    {
        //
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
        $alamat = Address::all()->where('status','=','1');
        if($alamat){
           foreach($alamat as $a){
               $add = Address::find($a->id);
               $add->status = 0;
               $add->save();
           }
        }
        $address = Address::find($id);
        $address->status = 1;
        $address->save(); 
        Alert::success('Di Atur Sebagai Alamat Utama', '');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::find($id)->delete();
        return redirect()->back()->with('success', 'Alamat Berhasil Dihapus');
        
    }
}