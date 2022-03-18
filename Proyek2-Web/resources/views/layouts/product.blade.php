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
    <div class="container">
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
                    Harga Termurah <i class="bi bi-sort-down-alt"></i>
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
                    Harga Termurah <i class="bi bi-sort-down-alt"></i>
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
                    Harga Termurah <i class="bi bi-sort-down-alt"></i>
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
                    Harga Termurah <i class="bi bi-sort-down-alt"></i>
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
                    Harga Termurah <i class="bi bi-sort-down-alt"></i>
                </button>
        </form>
            @endif
        </div>

        {{-- <form action="/cari" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari Produk">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form> --}}


        <div class="row">
            @forelse ($produk as $p)
            <div class="col-lg-4 col-md-6 col-12 " style="margin-bottom: 150px">
                <div class="gallery ">
                    <a href="/details/{{ $p->slug }}"><img src="{{ asset('/storage/' . $p->featured_image) }}" alt=""
                            class="img-fluid text-center"></a>
                </div>
                <div class="product-det d-flex justify-content-between align-content-center">
                    <div class="text-pro ">
                        <p>{{ $p->nama }}</p>
                        <p><i class="bi bi-bookmarks-fill"></i>{{ $p->category->name }}</p>
                    </div>
                    <h4 class="mt-3"> Rp.{{ number_format($p->harga, 0, ',', '.') }}</h4>
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