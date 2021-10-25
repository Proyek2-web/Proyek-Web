@extends('master.mainWeb')

@section('body')

<section class="product" id="product">
    <div class="container">
        <div class="title col-lg-12 mx-auto">
            <h1>Product</h1>
        </div>
        <div class="list-product">
            <div class="filter text-center">
                <a href="/produk" class="btn filter-btn {{ request()->is('produk') ? 'active' : ''}}" data-filter="all">All</a>
                <a href="/gelas" class="btn filter-btn {{ request()->is('gelas') ? 'active' : ''}}" data-filter="gelas">Gelas</a>
                <a href="/vas" class="btn filter-btn {{ request()->is('vas') ? 'active' : ''}}" data-filter="pot">Vas Bunga</a>
                <a href="/guci "class="btn filter-btn {{ request()->is('guci') ? 'active' : ''}}" data-filter="celengan">Guci</a>
            </div>
            <div class="row">
                @foreach ($produk as $p)
                <div class="gallery col-md-3 filter center nature" >
                    <div class="img-wrapper">
                        <a href="/details/{{ $p->slug }}"><img src="{{ asset('/storage/'.$p->featured_image)}}" alt="" ></a>
                        <div class="text-wrapper">
                            <h4>{{ $p->category->name}}</h4>
                        </div>
                    </div>
                </div>
                {{-- <div class="gallery col-md-4 filter center nature">
                    <a href="/details/{{ $p->slug }}"><img src="{{ asset('/storage/'.$p->featured_image)}}" alt="" ></a>
                </div> --}}
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection