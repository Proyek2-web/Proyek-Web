<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use tidy;

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
    //   $data = $request->validate([
    //         'nama' => 'required',
    //         'harga' => 'required',
    //         'category_id' => 'required',
    //         'berat' => 'required',
    //         'featured_image' => 'image|file|max:2048|required',
    //         'keterangan' => 'required',
    //     ]);
        
    //     $save = new Product;
    //     $save->featured_image = $image_name;
    //     $save->nama = $request->nama;
    //     $save->harga = $request->harga;
    //     $save->berat = $request->berat;
    //     $save->category_id = $request->category_id;
    //     $save->keterangan = $request->keterangan;
    //     $save->save();
    
    if ($request->hasFile('featured_image')) {
        $file = $request->file('featured_image');
            $imageName = time().'.'.$file->getClientOriginalName();
            $file->move(public_path('cover_product'), $imageName);
    }
    if ($request->hasFile('video_product')){
        $fileVideo = $request->file('video_product');
        $videoName = $fileVideo->getClientOriginalName();
        $fileVideo->move(public_path('video_product'), $videoName);  
   }

    $data = new Product([
            'nama' =>  $request->nama,
            'harga' => $request->harga,
            'category_id' => $request->category_id,
            'berat' => $request->berat,
            'stok'=> $request->stok, 
            'featured_image' => $imageName,
            'video_product' => $videoName,
            'keterangan' => $request->keterangan,
        ]);
        $data->save();

        // $new = Product::create($data);
        
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = $data['nama'].'-image-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path('image_product'), $imageName);
                Image::create([
                    'product_id'=> $data->id,
                    'image' => $imageName
                ]);
            }
        }
        

        // Product::create($insert_data);
        Alert::success('Berhasil Menambahkan Produk', '');
        return redirect('/product');
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
        $product = Product::findOrFail($id);
        if (file_exists(public_path('cover_product/'.$product->featured_image))) {
            unlink(public_path('cover_product/'.$product->featured_image));
        }
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
                $product->featured_image = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('cover_product'), $product->featured_image);
                $request['fetaured_image'] = $product->featured_image;

        }

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'berat' => $request->berat,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'keterangan' => $request->keterangan,
            'featured_image' => $product->featured_image,
        ]);
        
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = $product['nama'].'-image-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path('image_product'), $imageName);
                Image::create([
                    'product_id'=> $id,
                    'image' => $imageName
                ]);
            }
        }
        Alert::success('Berhasil Memperbarui Produk', '');
        return back();
        // $request->validate([
        //     'nama' => 'required',
        //     'category_id' => 'required',
        //     'harga' => 'required',
        //     'berat' => 'required',
        //     'featured_image' => 'required',
        //     'keterangan' => 'required',
        // ]);
        // $save = Product::find($id);
        // $save->featured_image = $image_name;
        // $save->nama = $request->nama;
        // $save->harga = $request->harga;
        // $save->berat = $request->berat;
        // $save->category_id = $request->category_id;
        // $save->keterangan = $request->keterangan;
        // $save->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (file_exists(public_path('cover_product/'.$product->featured_image))) {
            unlink(public_path('cover_product/'.$product->featured_image));
        }
        $images = Image::where('product_id', $product->id)->get();
        foreach($images as $i){
                unlink(public_path('image_product/'.$i->image));
        }

        if (file_exists(public_path('video_product/'.$product->video_product))) {
            unlink(public_path('video_product/'.$product->video_product));
        }
        
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Data berhasil dihapus!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}