@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')
<div class="jumbotron2">
    <div class="container">
        <div class="intro ">
            <div class="title text-center">
                <h3>Katalog Produk</h3>
            </div>
        </div>
    </div>
</div>
<ol class="arrows">
    <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
    <li><a href="/produk">Katalog Produk</a></li>
 </ol>
<section class="product" id="product">
    <div class="container">
        <div class="list-product">
            <div class="filter text-center">
                <a href="/produk" class="btn filter-btn {{ request()->is('produk') ? 'active' : ''}}"
                    data-filter="all">All</a>
                <a href="/gelas" class="btn filter-btn {{ request()->is('gelas') ? 'active' : ''}}"
                    data-filter="gelas">Gelas</a>
                <a href="/vas" class="btn filter-btn {{ request()->is('vas') ? 'active' : ''}}" data-filter="pot">Vas
                    Bunga</a>
                <a href="/guci " class="btn filter-btn {{ request()->is('guci') ? 'active' : ''}}"
                    data-filter="celengan">Guci</a>
                <a href="/aksesoris " class="btn filter-btn {{ request()->is('aksesoris') ? 'active' : ''}}"
                    data-filter="aksesoris">Aksesoris</a>
            </div>
            <div class="row">
                @forelse ($produk as $p)
                <div class="col-lg-4 col-md-6 col-12 " style="margin-bottom: 150px">
                    <div class="gallery ">
                        <a href="/details/{{ $p->slug }}"><img src="{{ asset('/storage/'.$p->featured_image)}}" alt=""
                                class="img-fluid text-center"></a>
                    </div>
                    <div class="product-det d-flex justify-content-between align-content-center">
                        <div class="text-pro ">
                            <p>{{ $p->nama }}</p>
                            <p><i class="bi bi-bookmarks-fill"></i>{{ $p->category->name}}</p>
                        </div>
                        <h4 class="mt-3"> Rp.{{number_format($p->harga, 0, "," , ".")}}</h4>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center mt-5">
                    <h1 style="color: rgb(226, 226, 226)">PRODUK KOSONG</h1>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection