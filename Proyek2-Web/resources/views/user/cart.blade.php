@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="detail" style="margin-bottom: 180px;margin-top: 10%">
    <h1 class="text-center">Detail Product</h1>
    <div class="detail-page">
        <div class="container">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                    <th scope="col"> Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td class="cart_product_img">
                            <a href="#"><img src="{{url($d->featured_image)}}" alt="Product"></a>
                            <h5>{{$d->nama}}</h5>
                        </td>
                        <td>
                            <span>{{ $d->qty }}</span>
                        </td>
                        <td class="price"><span>Rp {{number_format($d->harga, 2)}} / pcs </span></td>
                        <td class="total_price"><span>Rp {{ number_format($d->harga * $d->qty, 2)}}</span></td>
                        <td class="action">
                            <form action="{{route('cart.destroy', $d->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-delete" style="width: 75px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

</section>
@endsection
