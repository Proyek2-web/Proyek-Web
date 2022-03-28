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
                    <div class="wrap-detail col-lg-6 col-12 text-center main_view">
                        <img src="/cover_product/{{ $produk->featured_image }}" alt="" width="500"
                            class="img-fluid " id="main" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Klik, untuk memperbesar tampilan gambar">
                        <div class="row mt-5">
                             <div class="col-md-3 side_view mb-3">
                                <img src="/cover_product/{{ $produk->featured_image }}" onclick="change(this.src)"
                                    alt="" width="150" class="tool img-fluid border-4"
                                    style="cursor: pointer; border-radius: 10px" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Klik, untuk ganti gambar">

                            </div>
                            @foreach ($produk->images as $i)                                
                            <div class="col-md-3 side_view mb-3">
                                <img src="/image_product/{{ $i->image}}" onclick="change(this.src)"
                                    alt="" width="150" class="tool img-fluid border-4"
                                    style="cursor: pointer; border-radius: 10px" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Klik, untuk ganti gambar">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="desc col-lg-6 " style="margin-top: 100px; padding: 50px; background-color: #24243a">
                        <h2>{{ $produk->nama }}</h2>
                        <p>{{ $produk->keterangan }}</p>
                        <p><i class="bi bi-bookmarks-fill"></i> Kategori : {{ $produk->category->name }}</p>
                        <p><i class="bi bi-speedometer"></i> Berat : {{ $produk->berat }} gram</p>
                        <div class="garis-detail mb-4"></div>
                        <div class="d-flex justify-content-between mb-3">
                            <h3>Rp.{{number_format($produk->harga, 0, "," , ".")}}</h3>
                            <div class="quantity buttons_added mb-4">
                                <input type="hidden" id='regeh' value="{{ $produk->harga }}">
                                <input type="button" value="-" class="minus"><input required id="quan" type="number"
                                    onchange="calc()" step="1" min="1" max="" name="quantity" value="1" title="Qty"
                                    class="input-text qty text" size="4"><input type="button" value="+" class="plus">

                            </div>
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
                            <a href="/produk" class="btn btn-back"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
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
                        <div class="form-group mt-5 p-4 text-center"
                            style="font-family: Inter; border: 3px solid rgb(186, 186, 186); border-radius: 10px">
                            <label style="font-size: 14px; color: rgb(196, 194, 193)">Total Harga (Belum termasuk
                                ongkir)</label>
                            <div class="input-group justify-content-center">
                                <h3 style="font-family: Interl; color: #81b29a" class="price-detail mt-3" id="output">
                                    Rp. - </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-5 pb-5">
                <div class="text-center mt-3">
                    <h3>Photo product with 360</h3>
                </div>
                <div class="img360 text-center mt-3 " >
                    <iframe
                        src="https://momento360.com/e/u/a9dfe999753e41c4b4495bc8ada9f3e2?utm_campaign=embed&utm_source=other&heading=53.75&pitch=-42.39&field-of-view=75&size=medium"
                        frameborder="1" width="100%" height="650px" allowfullscreen="true" style="border: 24px solid #24243a"></iframe>
                </div>
                <!-- The Modal -->
                <div id="myModal" class="modal-product">
                    <span class="close">&times;</span>
                    <img class="modal-content-product border-0" id="img01">
                    <div id="caption"></div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("main");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>

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
    <script type="text/javascript">
        const change = src => {
            document.getElementById("main").src = src
        }
    </script>

</section>
@endsection