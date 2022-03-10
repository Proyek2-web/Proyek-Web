@extends('master.mainWeb')
@include('layouts.navbar')

@section('body')
<section>
    <div class="container">
        <div class="title col-lg-12 mx-auto mt-5">
            <h1>Keranjang Anda</h1>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="table text-center" style="vertical-align: middle; font-family: PT Serif">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)     
                        <tr>
                          <th scope="row" >{{ $loop->iteration }}</th>
                          <td ><a href="#"><img src="{{url($d->featured_image)}}" width="150" alt="Product"></a></td>
                          <td >{{ $d->nama }}</td>
                          <td>Rp {{number_format($d->harga, 2)}} / pcs </td>
                          <td>{{ $d->qty }}x</td>
                          <td>Rp {{ number_format($d->harga * $d->qty, 2)}}</td>
                          <td>
                            <form action="{{route('cart.destroy', $d->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                            </form></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="total text-center" style="font-family: PT Serif">
                    <h3 style="font-weight: bold">Harga Total : <span id="blink">Rp. {{number_format($sub_total, 2)}}</span> </h3>
                    <p>Belum termasuk ongkos kirim</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="total text-center">
                    <a href="/form-order" class="btn btn-conf">Konfirmasi <i class="bi bi-check-circle-fill"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var blink = document.getElementById('blink');
    setInterval(function() {
      blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 800);
  </script>
@endsection
