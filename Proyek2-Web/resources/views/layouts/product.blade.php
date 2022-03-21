@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')
<div class="jumbotron2">
    <div class="container">
        <div class="intro ">
            <div class="title text-center">
                <h3>Katalog Produk</h3>
            </div>
            <div class="filter text-center" style="margin-top: 80px">
                <a href="/produk" class="btn filter-btn {{ request()->is('produk') ? 'active' : '' }}"
                    data-filter="all">All</a>
                <a href="/gelas" class="btn filter-btn {{ request()->is('gelas') ? 'active' : '' }}"
                    data-filter="gelas">Gelas</a>
                <a href="/vas" class="btn filter-btn {{ request()->is('vas') ? 'active' : '' }}" data-filter="pot">Vas
                    Bunga</a>
                <a href="/guci " class="btn filter-btn {{ request()->is('guci') ? 'active' : '' }}"
                    data-filter="celengan">Guci</a>
                <a href="/aksesoris " class="btn filter-btn {{ request()->is('aksesoris') ? 'active' : '' }}"
                    data-filter="aksesoris">Aksesoris</a>
            </div>
        </div>
    </div>
</div>
<section class="product" id="product">
    <ol class="arrows">
        <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
        <li><a href="/produk">Katalog Produk</a></li>
    </ol>
    <div class="container ps-5 pe-5 pt-1" style="background-color: rgba(228, 228, 228, 0.481); border-radius: 40px">
        <div class="list-product">
            <div class="wrap-filter d-flex mt-5 mb-3 align-items-center">
                <form class="search-bar" action="{{ route('all') }}" method="GET">
                    <div class="search-box">
                        <button class="btn-search" type="submit"><i class="bi bi-search"></i></button>
                        <input type="text" name="search" value="{{ request('search') }}" class="input-search" placeholder="Cari produk...">
                    </div>
                </form>
            @if ($status)
            @foreach ($produk as $p)
            @if ($p->category_id === 1)
            <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-mahal">
                    Harga Termahal <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="/produk/termurah" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-murah ">
                    Harga Termurah <i class="bi bi-sort-up"></i>
                </button>
            </form>
            @break
            @elseif ($p->category_id === 2)
            <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-mahal">
                    Harga Termahal <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-murah ">
                    Harga Termurah <i class="bi bi-sort-up"></i>
                </button>
            </form>
            @break
            @elseif ($p->category_id === 3)
            <form action="/produk/termahal" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-mahal">
                    Harga Termahal <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="/produk/termurah" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-murah ">
                    Harga Termurah <i class="bi bi-sort-up"></i>
                </button>
            </form>
            @break
            @elseif ($p->category_id === 4)
            <form action="/produk/termahal" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-mahal">
                    Harga Termahal <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                <button type="submit" class="btn btn-murah ">
                    Harga Termurah <i class="bi bi-sort-up"></
                </button>
            </form>
            @break
            @endif
            @endforeach
            @else
            <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                    <input type="hidden" name="status" value="mahal">
                    <button type="submit" class="btn btn-mahal">
                        Harga Termahal <i class="bi bi-sort-up"></i>
                    </button>
            </form>
            <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="status" value="murah">
                <button type="submit" class="btn btn-murah ">
                    Harga Termurah <i class="bi bi-sort-up"></i>
                </button>
        </form>
            @endif
        </div>

        <div class="line"></div>
        <div class="row">
            @forelse ($produk as $p)
            <div class="col-md-4">
                <div class="wsk-cp-product" style="font-family: PT Serif">
                  <div class="wsk-cp-img"><img src="{{ asset('/storage/' . $p->featured_image) }}" alt="Product" class="img-responsive" /></div>
                  <div class="wsk-cp-text">
                    <div class="category">
                      <span>{{ $p->category->name }}</span>
                    </div>
                    <div class="title-product">
                      <h3>{{ $p->nama }}</h3>
                    </div>
                    <div class="description-prod">
                      <p>{{ $p->keterangan }}</p>
                    </div>
                    <div class="product-footer">
                      <div class="wcf-left"><span class="price"> Rp. {{ number_format($p->harga, 0, ',', '.') }}</span></div>
                      <div class="wcf-right"><a href="/details/{{ $p->slug }}" class="buy-btn"><i class="bi bi-bag-fill"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
            <div class="col-12 text-center mt-5 mb-5">
                <h1 style="color: rgb(226, 226, 226)">PRODUK KOSONG</h1>
            </div>
            @endforelse
        </div>
    </div>
    </div>
</section>
@endsection