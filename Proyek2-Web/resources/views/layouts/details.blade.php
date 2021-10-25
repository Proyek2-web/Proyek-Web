

@extends('master.mainWeb')

@section('body')

<section class="detail" style="margin-bottom: 180px">
    <h1 class="text-center">Detail Product</h1>
    <div class="detail-page" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" >
                    <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="580">
                </div>
                <div class="desc col-lg-6">
                    <h2>{{ $produk->nama }}</h2>
                    <p>{{ $produk->keterangan }}</p>
                    <h3>Rp.{{number_format($produk->harga, 0, "," , ".")}}</h3>
                    <a href="https://wa.me/6287863947193?text=Nama%20%20%20%20%20%20%20%20%20%20%20%3A%0AAlamat%20Lengkap%20%3A%0AJumlah%20pesanan%20%3A%0ALink%20Barang%20%20%20%20%3A" class="btn btn-success mt-5" target="_blank">Order Via Whatsapp <i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection