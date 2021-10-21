@extends('master.mainWeb')
@section('body')
    <div class="gallery col-md-4 filter center nature">

        <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="">
        <p>{{ $produk->nama }}</p>
    </div>
@endsection
