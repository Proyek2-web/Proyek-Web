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
    <section class="product" id="product">
        <ol class="arrows">
            <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
            <li><a href="/produk">Katalog Produk</a></li>
         </ol>
        <div class="container">
            <div class="list-product">
                <div class="filter text-center">
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
                <form action="/cari" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari Produk">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                <div class="dropdown mb-3">
                    <button class="btn btn-login dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Filter
                    </button>
                    <ul class="dropdown-menu bg-secondary" style="font-family: PT Serif"
                        aria-labelledby="dropdownMenuButton1">
                        @if ($status)
                        @foreach ($produk as $p)
                        @if ($p->category_id === 1)
                        <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-primary">
                                     Murah
                                </button>
                        </li>
                        </form>
                        <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-danger">
                                    Mahal
                               </button>
                        </li>
                        </form>
                        @break   
                        @elseif ($p->category_id === 2)
                        <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-primary">
                                     Murah
                                </button>
                        </li>
                        </form>
                        <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-danger">
                                    Mahal
                               </button>
                        </li>
                        </form>
                        @break  
                        @elseif ($p->category_id === 3)
                        <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-primary">
                                     Murah
                                </button>
                        </li>
                        </form>
                        <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-danger">
                                    Mahal
                               </button>
                        </li>
                        </form>
                        @break  
                        @elseif ($p->category_id === 4)
                        <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-primary">
                                     Murah
                                </button>
                        </li>
                        </form>
                        <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="cat_id" value="{{ $p->category_id }}">
                                <button type="submit" class="btn btn-danger">
                                     Mahal
                                </button>
                        </li>
                        </form>
                        @break      
                        @endif  
                        @endforeach
                        @else
                        <form action="/produk/termurah" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="status" value="murah">
                                <button type="submit" class="btn btn-primary">
                                     Murah
                                </button>
                        </li>
                        </form>
                        <form action="/produk/termahal" method="GET" enctype="multipart/form-data">
                            <li class="text-center">
                                <input type="hidden" name="status" value="mahal">
                                <button type="submit" class="btn btn-danger">
                                     Mahal
                                </button>
                        </li>
                        </form>   
                        @endif
                        
                    </ul>
                    <!-- Modal -->
                </div>

                <div class="row">
                    @forelse ($produk as $p)
                        <div class="col-lg-4 col-md-6 col-12 " style="margin-bottom: 150px">
                            <div class="gallery ">
                                <a href="/details/{{ $p->slug }}"><img
                                        src="{{ asset('/storage/' . $p->featured_image) }}" alt=""
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
