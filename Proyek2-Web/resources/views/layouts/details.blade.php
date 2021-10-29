@extends('master.mainWeb')

@section('body')

<section class="detail" style="margin-bottom: 180px">
    <h1 class="text-center">Detail Product</h1>
    <div class="detail-page">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="500">
                </div>
                <div class="desc col-lg-7">
                    <h2>{{ $produk->nama }}</h2>
                    <p>{{ $produk->keterangan }}</p>
                    <h3>Rp.{{number_format($produk->harga, 0, "," , ".")}}</h3>
                    {{-- <a href="https://wa.me/6287863947193?text=Nama%20%20%20%20%20%20%20%20%20%20%20%3A%0AAlamat%20Lengkap%20%3A%0AJumlah%20pesanan%20%3A%0ALink%20Barang%20%20%20%20%3A"
                        class="btn btn-success mt-5" target="_blank">Order Via Whatsapp <i
                            class="bi bi-whatsapp"></i></a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="form-order">
        <form action="{{ route('custorder.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <h2 style="">Form Order</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="nama" class="form-control" id="exampleFormControlInput1"
                                placeholder="* Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone_number" class="form-control" id="exampleFormControlInput1"
                                placeholder="* Nomor Whatsapp" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="custom" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Tambahkan catatan jika terdapat kei" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="* E-mail" required>
                        </div>
                        <div class="mb-3">
                            <select name="delivery_id" class="form-select" aria-label="Default select example" required>
                                @foreach ($deliveries as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input required type="number" name="qty" min="1" max="9999" maxlength="4" placeholder="* Jumlah" name="qty"
                                oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 1) ? (1/1) : this.value;">
                        </div>
                        <input type="hidden" name="product_id" value="{{ $produk->id }}">
                        <input type="hidden" name="category_id" value="{{ $produk->category->id }}">
                        <input type="hidden" name="total" value="0">
                    </div>
                    <div class="col-md-6">
                        <button onclick="return confirm('Apakah yakin ingin membeli {{ $produk->nama }}?')" class="btn btn-warning">Order Now</button>
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection