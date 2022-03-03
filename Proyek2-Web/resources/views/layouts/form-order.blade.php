@extends('master.mainWeb')
@section('body')
<div class="title col-lg-12 mx-auto">
    <h1>Form Order</h1>
</div>
<div class="form-order" style="margin-top: -1px">
    <form action="/transaksi-post" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <h5 class="card-header">Pembayaran</h5>
                        <div class="card-body">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1" style="background-image: url('/images/1.jpg')">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <h5 class="card-header">Pengiriman </h5>
                        <div class="card-body">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1" style="background-image: url('/images/1.jpg')">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <h6 class="card-header">Kota Tujuan</h6>
                        <div class="card-body">
                            <label for="Provinsi" class="mb-2">Pilih Provinsi</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <label for="Provinsi" class="mb-2 mt-4">Pilih Kota</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="row">
                                <div class=" col-12">
                                    <input type="text" name="nama" class="form-control" id="exampleFormControlInput1"
                                        placeholder="* Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class=" col-12">
                                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="* E-mail" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 ">
                                    <input type="text" name="phone_number" class="form-control"
                                        id="exampleFormControlInput1" placeholder="* Nomor Whatsapp" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <textarea name="custom" class="form-control" id="exampleFormControlTextarea1" rows="6"
                            placeholder="Tambahkan catatan produk yang akan dipesan" required></textarea>
                    </div>

                </div>
                <hr class="mt-5">
                <div class="row mt-5">
                    <div class="card" style="width: 1 8rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-5 justify-content-center">
                    <a href="/produk" class="btn btn-back"><i class="bi bi-x-circle-fill me-2"></i>Batal</a>
                    <a href="/form-order" class="btn btn-conf">Konfirmasi <i class="bi bi-check-circle-fill"></i></a>
                </div>
            </div>

            {{-- <h2 style="">Form Order</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Provinsi">Pilih Provinsi</label>
                        <select name="state_id" class="form-select" aria-label="Default select example" required>
                            @foreach ($state as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="kota" class="form-control" id="exampleFormControlInput1" placeholder="* Nama Kota"
                required>
        </div>
        <div class="mb-3">
            <input type="text" name="nama" class="form-control" id="exampleFormControlInput1"
                placeholder="* Nama Lengkap" required>
        </div>

        <div class="mb-3">
            <input type="text" name="alamat" class="form-control" id="exampleFormControlInput1"
                placeholder="* Alamat Lengkap " required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="* E-mail"
                required>
        </div>
        <div class="mb-3">
            <input type="text" name="phone_number" class="form-control" id="exampleFormControlInput1"
                placeholder="* Nomor Whatsapp" required>
        </div>
</div>
<div class="col-md-6">
    <div class="mb-3 mt-4">
        <input required type="number" min="1" max="9999" maxlength="4" placeholder="* Jumlah" name="quantity"
            oninput="this.value=this.value.slice(0,this.maxLength||1/1);this.value=(this.value   < 1) ? (1/1) : this.value;">
    </div>
    <div class="mb-3">
        <textarea name="custom" class="form-control" id="exampleFormControlTextarea1" rows="3"
            placeholder="Tambahkan catatan produk yang akan dipesan" required></textarea>
    </div>
    <div class="mb-3">
        <label for="">Pengiriman</label>
        <select name="delivery_id" class="form-select" aria-label="Default select example" required>
            @foreach ($deliveries as $c)
            <option value="{{ $c->id }}">{{ $c->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="">Pembayaran</label>
        <select name="method" class="form-select" aria-label="Default select example" required>
            @foreach ($channels as $channel)
            @if ($channel->active)
            <option value="{{ $channel->code}}">{{ $channel->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <input type="hidden" name="harga" value="{{ $produk->harga }}">
    <input type="hidden" name="product_id" value="{{ $produk->id }}">
    <input type="hidden" name="category_id" value="{{ $produk->category->id }}">
</div>
<div class="col-md-6">
    <button onclick="return confirm('Apakah yakin ingin membeli {{ $produk->nama }}?')" class="btn btn-warning">Order
        Now</button>
</div>
</div> --}}
</div>
</div>
@endsection