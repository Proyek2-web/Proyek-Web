@extends('master.mainWeb')

@section('body')

<section class="product" id="product">
    <div class="container">
        <div class="title col-lg-12 mx-auto">
            <h1>Product</h1>
        </div>
        <div class="list-product">
            <div class="filter text-center">
                <a href="/produk" class="btn filter-btn " data-filter="all">All</a>
                <a class="btn filter-btn" data-filter="gelas">Gelas</a>
                <a class="btn filter-btn" data-filter="pot">Pot Bunga</a>
                <a class="btn filter-btn" data-filter="celengan">Celengan</a>
            </div>
            <div class="row">
                @foreach ($produk as $p)
                <div class="gallery col-md-4 filter center nature">
                    <a href="/details/{{ $p->slug }}"><img src="{{ asset('/storage/'.$p->featured_image)}}" alt=""></a>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection