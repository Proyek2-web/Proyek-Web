@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="detail" style="margin-bottom: 180px">
    <div class="detail-page ">
        <ol class="arrows" style="margin-top: 120px; margin-bottom: -30px">
            <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
            <li><a href="/produk">Katalog Produk</a></li>
            <li><a href="#">Detail produk</a></li>
         </ol>
        <div class="container">
            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (Auth::check())
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="product_id" value="{{ $produk->id }}">
                <input type="hidden" name="status" value="pending">
                @endif
                <div class="row  d-flex">
                    <div class="wrap-detail col-lg-6 col-12 text-center ">
                        <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="500"
                            class="img-fluid">
                    </div>
                    <div class="desc col-lg-5 ms-lg-5" style="margin-top: 150px">
                        <h2>{{ $produk->nama }}</h2>
                        <p><i class="bi bi-bookmarks-fill"></i> Kategori : {{ $produk->category->name }}</p>
                        <p><i class="bi bi-speedometer"></i> Berat : 34 gr</p>
                        <h3>Rp.{{number_format($produk->harga, 0, "," , ".")}}</h3>
                        <div class="garis-detail mb-4"></div>
                        <p>Deskripsi : {{ $produk->keterangan }}</p>
                        <div class="quantity buttons_added mb-4">
                            <input type="hidden" id='regeh' value="{{ $produk->harga }}">
                            <input type="button" value="-" class="minus"><input required id="quan" type="number"
                            onchange="calc()" step="1" min="1" max="" name="quantity" value="1" title="Qty"
                            class="input-text qty text" size="4"><input type="button" value="+" class="plus">
                                
                        </div>
                        @if (Auth::check())
                        <div class="d-flex">
                            <a href="/produk" class="btn btn-back"><i class="bi bi-arrow-left-circle-fill"></i>
                                Kembali</a>
                            <button type="submit" class="btn btn-buy">Tambahkan Ke Keranjang <i
                                    class="bi bi-cart-plus"></i></button>
                        </div>
                        @else

                        <div class="d-flex">
                            <a href="#" class="btn btn-back"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
                            <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#login">Tambah ke
                                keranjang <i class="bi bi-cart-plus"></i></a>
                            {{-- modal --}}
                            {{-- <div id="login-cart" class="modal fade">
                                <div class="main">
                                    <input type="checkbox" id="chk" aria-hidden="true">
                                    <div class="signup">
                                        <form>
                                            <label for="chk" aria-hidden="true">Sign up</label>
                                            <input type="text" name="txt" placeholder="User name" required="">
                                            <input type="email" name="email" placeholder="Email" required="">
                                            <input type="password" name="pswd" placeholder="Password" required="">
                                            <button>Sign up</button>
                                        </form>
                                    </div>
                                    <div class="login">
                                        <form>
                                            <label for="chk" aria-hidden="true">Login</label>
                                            <input type="email" name="email" placeholder="Email" required="">
                                            <input type="password" name="pswd" placeholder="Password" required="">
                                            <button>Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                            
                        </div>
                        @endif
                        <div class="form-group mt-5 p-4"
                            style="font-family: PT Serif; border: 3px solid rgb(186, 186, 186); border-radius: 10px">
                            <label style="font-size: 20px">Total Harga (Belum termasuk ongkir)</label>
                            <div class="input-group ">
                                <h3 class="price text-success" id="output">Rp. - </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row mt-5 p-5 text-center" style="background-color: rgb(225, 225, 225)">
                <div class="col-md-4">
                    <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="300" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="300" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('/storage/' . $produk->featured_image) }}" alt="" width="300" class="img-fluid">
                </div>
            </div>
            <div class="row mt-5 p-5" style="background-color: rgb(225, 225, 225)">
                <div class="text-center mt-3">
                    <h3>Photo product with 360</h3>
                </div>
                <div class="img360 text-center mt-3">
                    <iframe
                        src="https://momento360.com/e/u/a9dfe999753e41c4b4495bc8ada9f3e2?utm_campaign=embed&utm_source=other&heading=53.75&pitch=-42.39&field-of-view=75&size=medium"
                        frameborder="0" width="1200px" height="550px"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
        $("input").on("input", function () {
            let price = $('#regeh').val();
            let qty = $('#quan').val();
            let result = parseInt(price) * parseInt(qty);
            $("#output").text("Rp. " + number_format(result, 2));
        });
        function calc() {
                let price = $('#regeh').val();
                let qty = $('#quan').val();
                let result = parseInt(price) * parseInt(qty);
                $("#output").text("Rp. " + number_format(result, 2));
            }
    </script>
    {{-- 
    <div class="form-order">
        <form action="/transaksi-post" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <h2 style="">Form Order</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Provinsi">Pilih Provinsi</label>
                            <select name="state_id" class="form-select" aria-label="Default select example" required>
                                @foreach ($state as $c)
                                php artisan serve              <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
    </select>
    </div>
    <div class="mb-3">
        <input type="text" name="kota" class="form-control" id="exampleFormControlInput1" placeholder="* Nama Kota"
            required>
    </div>
    <div class="mb-3">
        <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" placeholder="* Nama Lengkap"
            required>
    </div>
    <div class="mb-3">
        <input type="text" name="alamat" class="form-control" id="exampleFormControlInput1"
            placeholder="* Alamat Lengkap " required>
    </div>
    <div class="mb-3">
        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="* E-mail"
            required>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="mb-3">
                <input readonly class="form-control" id="exampleFormControlInput1" maxlength="13"
                    placeholder="* Nomor Whatsapp" value="+62" required>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="mb-3">
                <input type="text" name="phone_number" class="form-control" id="exampleFormControlInput1" maxlength="11"
                    placeholder="Nomor" required>
            </div>
        </div>
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
        {{-- <input type="hidden" name="harga_del" value="{{ $produ }}"> --}}
        {{-- <input type="hidden" name="product_id" value="{{ $produk->id }}"> --}}
        {{-- <input type="hidden" name="reference" value="null">
                        <input type="hidden" name="merchant_ref" value="null"> --}}

        {{-- <input type="hidden" name="category_id" value="{{ $produk->category->id }}"> --}}
        {{-- <input type="hidden" name="amount" value=0> --}}
        {{-- </div>
                    <div class="col-md-6">
                        <button onclick="return confirm('Apakah yakin ingin membeli {{ $produk->nama }}?')"
        class="btn btn-warning">Order Now</button>
    </div>
    </div>
    </div>
    </div> --}}

</section>
@endsection