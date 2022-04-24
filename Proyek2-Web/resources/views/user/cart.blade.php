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
                            @forelse ($data as $d)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><img src="cover_product/{{ $d->featured_image }}" alt="Product" width="150"
                                            class="img-fluid"></td>
                                    <td>{{ $d->nama }}</td>
                                    <td>Rp {{ number_format($d->harga, 2) }} / pcs </td>
                                    <td>{{ $d->qty }}x</td>
                                    <td>Rp {{ number_format($d->harga * $d->qty, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $d->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            @if ($d->stok != null)
                                            <input type="hidden" name="stok" value="{{ $d->stok }}">
                                            <input type="hidden" name="quan" value="{{ $d->qty }}">
                                            <input type="hidden" name="product_id" value="{{ $d->product_id }}">
                                            @endif
                                            <button class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class=" px-4 py-2 text-center">
                                        <h1 style="color: rgb(226, 226, 226); text-align: center">KERANJANG KOSONG</h1>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="total text-center" style="font-family: PT Serif">
                        <h3 style="font-weight: bold">Harga Total : <span id="blink">Rp.
                                {{ number_format($sub_total, 2) }}</span> </h3>
                        <p>Belum termasuk ongkos kirim</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="total text-center">
                        <form action="{{ route('checkout.index') }}" method="GET" enctype="multipart/form-data">
                            <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-conf">Konfirmasi <i
                                    class="bi bi-check-circle-fill"></i></button>
                        </form>
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
