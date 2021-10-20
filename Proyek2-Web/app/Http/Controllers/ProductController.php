<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('section.product', [
            'products' => Product::all(),
            'categories' => $category
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
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'category_id' => 'required',
            'featured_image' => 'image|file|max:2048|required',
            'keterangan' => 'required',
        ]);
        if($request->file('featured_image')){
            $image_name = $request->file('featured_image')->store('gambar-produk', 'public');
        }
        $save = new Product;
        $save->featured_image = $image_name;
        $save->nama = $request->nama;
        $save->harga = $request->harga;
        $save->category_id = $request->category_id;
        $save->keterangan = $request->keterangan;
        $save->save();

        // Product::create($insert_data);
        return redirect('/product')->with('Added', 'Produk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required',
            'harga' => 'required',
            'featured_image' => 'required',
            'keterangan' => 'required',
        ]);
        if($request->file('featured_image')){
            $image_name = $request->file('featured_image')->store('gambar-produk', 'public');
        }
        $save = Product::find($id);
        $save->featured_image = $image_name;
        $save->nama = $request->nama;
        $save->harga = $request->harga;
        $save->category_id = $request->category_id;
        $save->keterangan = $request->keterangan;
        $save->save();
        // Product::where('id', $id)
        //     ->update($insert_data);

        return back()
            ->with('edited', 'Produk Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return back()->with('success', 'Produk Berhasil Dihapus');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}