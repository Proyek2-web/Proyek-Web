<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Image;
use App\Models\Image360;
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
        $products = Product::all();
        return view('section.product', [
            'product' => $products,
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
    
    if ($request->hasFile('featured_image')) {
        $file = $request->file('featured_image');
            $imageName = time().'.'.$file->getClientOriginalName();
            $file->move(public_path('cover_product'), $imageName);
    }
    if ($request->hasFile('video_product')){
        $fileVideo = $request->file('video_product');
        $videoName = time().'.'.$fileVideo->getClientOriginalName();
        $fileVideo->move(public_path('video_product'), $videoName);  
   }
   $status_produk = 'Pre-Order';
   if($request->stok){
       $status_produk = 'Tersedia';
   }
    $data = new Product([
            'nama' =>  $request->nama,
            'harga' => $request->harga-$request->diskon,
            'category_id' => $request->category_id,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'diskon' => $request->diskon,
            'status'=>'aktif',
            'status_produk' => $status_produk,
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
        if ($request->hasFile('image360')) {
            $files = $request->file('image360');
            foreach ($files as $file) {
                $image360Name = $data['nama'].'-image360-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path('image_360'), $image360Name);
                Image360::create([
                    'product_id'=> $data->id,
                    'image360' => $image360Name
                ]);
            }
        }
    
        // Product::create($insert_data);
        Alert::success('Berhasil Menambahkan Produk', '');
        return back();
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
        if (file_exists(public_path('video_product/'.$product->video_product))) {
            unlink(public_path('video_product/'.$product->video_product));
        }
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
                $product->featured_image = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('cover_product'), $product->featured_image);
                $request['fetaured_image'] = $product->featured_image;

        }
        if ($request->hasFile('video_product')){
            $fileVideo = $request->file('video_product');
            $product->video_product = time().'.'.$fileVideo->getClientOriginalName();
            $fileVideo->move(public_path('video_product'), $product->video_product);
            $request['video_product'] = $product->video_product;  
       }

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga-$request->diskon,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'diskon' => $request->diskon,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'keterangan' => $request->keterangan,
            'featured_image' => $product->featured_image,
            'video_product' => $product->video_product,
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
        if ($request->hasFile('image360')) {
            $files = $request->file('image360');
            foreach ($files as $file) {
                $image360Name = $product['nama'].'-image360-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path('image_360'), $image360Name);
                Image360::create([
                    'product_id'=> $product->id,
                    'image360' => $image360Name
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
        if($product->status == 'aktif'){
            Alert::error('Gagal Menghapus', 'Silahkan nonaktifkan produk');
            return back();
        }else{
            if (file_exists(public_path('cover_product/'.$product->featured_image))) {
                unlink(public_path('cover_product/'.$product->featured_image));
            }
            $images = Image::where('product_id', $product->id)->get();
            foreach($images as $i){
                    unlink(public_path('image_product/'.$i->image));
            }
            $image360 = Image360::where('product_id', $product->id)->get();
            foreach($image360 as $i){
                    unlink(public_path('image_360/'.$i->image360));
            }
    
            if (file_exists(public_path('video_product/'.$product->video_product))) {
                unlink(public_path('video_product/'.$product->video_product));
            }
            
            $product->delete();
            Alert::success('Berhasil Dihapus', '');
            return back();
        }
        
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
    public function active()
    {
        $category = Category::all();
        return view('section.product', [
            'products' => Product::orderBy('updated_at', 'desc')->where('status','=','aktif')->get(),
            'categories' => $category
        ]);
    }
    public function deactive()
    {
        $category = Category::all();
        return view('section.product', [
            'products' => Product::orderBy('updated_at', 'desc')->where('status','=','nonaktif')->get(),
            'categories' => $category
        ]);
    }
    public function deactivated(Request $request,$id)
    {
        $product = Product::find($id);
        $product->status = 'nonaktif';
        $product->save();
        Alert::success('Produk NonAktif', '');
        return redirect('/deactive');
        
    }
    public function activated(Request $request,$id)
    {
        $product = Product::find($id);
        $product->status = 'aktif';
        $product->save();
        Alert::success('Produk Aktif', '');
        return redirect('/active');
        
    }
}