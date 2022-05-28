@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')
<section class="detail" style="margin-bottom: 110px">
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
                <input type="hidden" name="status_produk" value="{{ $produk->status_produk }}">
                <input type="hidden" name="status" value="pending">
                @endif
                <div class="row  d-flex">
                    <div class="wrap-detail col-lg-6 col-12 text-center main_view">
                        <img src="/cover_product/{{ $produk->featured_image }}" alt="" width="500" class="img-fluid "
                            id="main" data-bs-toggle="tooltip" data-bs-placement="bottom"
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
                                <img src="/image_product/{{ $i->image }}" onclick="change(this.src)" alt="" width="150"
                                    class="tool img-fluid border-4" style="cursor: pointer; border-radius: 10px"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Klik, untuk ganti gambar">
                            </div>
                            @endforeach
                            <video width="350" height="240" controls src="/video_product/{{ $produk->video_product }}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                    <div class="desc col-lg-6 " style="margin-top: 100px; padding: 50px; background-color: #24243a">
                        @if ($produk->stok != null && $produk->stok != 0)
                        <span class="bg-success text-light pe-3 ps-3 pt-1 pb-1"
                            style="font-weight: bold; border-radius: 10px">Tersedia</span>
                        @elseif($produk->stok == null && $produk->stok == 0)
                        <span class="bg-warning text-light pe-3 ps-3 pt-1 pb-1"
                            style="font-weight: bold; border-radius: 10px">Pre-Order</span>
                        @endif
                        <h2>{{ $produk->nama }}</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque debitis ea suscipit, quibusdam
                            tempora consequuntur error, laudantium voluptatem sapiente asperiores magni ipsam explicabo,
                            eum voluptas optio impedit? Facilis, iure fugiat sint excepturi eos enim in blanditiis et
                            explicabo laborum, reprehenderit eaque alias at doloribus dolorum. Illum non saepe quia et.
                        </p>
                        {{-- <p>{{ $produk->keterangan }}</p> --}}
                        <div class="detailing1 d-flex">
                            <p><i class="bi bi-bookmarks-fill"></i> Kategori : {{ $produk->category->name }}</p>
                            <p><i class="bi bi-speedometer ms-3"></i> Berat : {{ $produk->berat }} gram</p>
                        </div>
                        <div class="detailing2 d-flex">
                            <p><i class="bi bi-"></i> Panjang : {{ $produk->panjang }} cm</p>
                            <p><i class="bi  ms-3"></i> Lebar : {{ $produk->lebar }} cm</p>
                            <p><i class="bi ms-3"></i> Tinggi : {{ $produk->tinggi }} cm</p>
                        </div>
                        <div class="garis-detail mb-4"></div>
                        <div class="d-flex justify-content-between ">
                            <h3>Rp.{{ number_format($produk->harga, 0, ',', '.') }}</h3>
                            <div class="quantity buttons_added mb-4">
                                <input type="hidden" id='regeh' value="{{ $produk->harga }}">
                                <input type="hidden" id="stok2" value="{{ $produk->stok }}">
                                <input type="button" value="-" class="minus"><input required id="quan" type="number"
                                    onchange="calc()" step="1" min="1"
                                    max="{{ $produk->stok != null ? $produk->stok: 255 }}" name="quantity" value="1"
                                    title="Qty" class="input-text qty text" size="4"><input type="button" value="+"
                                    class="plus">

                            </div>
                        </div>
                        @if ($produk->stok != null && $produk->stok != 0)
                        <div class="d-flex stok ">
                            <p><i class="bi bi-bag-fill"></i> Stok :
                                <p class="d-block ms-2" id=stok>{{ $produk->stok }}</p> buah</p>
                        </div>
                        <input type="hidden" name="stok" value="{{ $produk->stok }}">
                        @endif
                        @if (Auth::check())
                        <div class="d-flex">
                            <a href="/produk" class="btn btn-back"><i class="bi bi-arrow-left-circle-fill"></i>
                                Kembali</a>
                            @if ($produk->stok == 0)
                            <button type="submit" class="btn btn-buy">Tambahkan Ke Keranjang <i
                                    class="bi bi-cart-plus"></i></button>
                            @else
                            <button type="submit" class="btn btn-buy">Tambahkan Ke Keranjang <i
                                    class="bi bi-cart-plus"></i></button>
                            @endif
                        </div>
                        @else
                        <div class="d-flex">
                            <a href="/produk" class="btn btn-back"><i class="bi bi-arrow-left-circle-fill"></i>
                                Back</a>
                            <a class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#login">Tambah ke
                                keranjang <i class="bi bi-cart-plus"></i></a>
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
            <div class="row mt-5">
                <div class="text-center mt-3">
                     <img src="https://cdn.iconscout.com/icon/free/png-256/360-degree-camera-1514118-1285713.png" width="80" class="border-0" style="box-shadow: none" alt="">
                   
                </div>
                    <div class="img36" style="width: 450px; margin: 0 auto;">
                        <div class="rotation">
                            @foreach ($produk->image360 as $u)
                            <img src="/image_360/{{ $u->image360 }}" alt="" width="50" class="img-fluid">
                            @endforeach
                        </div>
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

    <script src="/js/360deg.js"></script>
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
            let stok = $('#stok2').val();
            let result = parseInt(price) * parseInt(qty);
            let result2 = parseInt(stok) - parseInt(qty);
            $("#output").text("Rp. " + number_format(result, 2));
            if (result2 < 0) {
                result2 = 0;
                $("#stok").text(result2);
            } else {
                $("#stok").text(result2);
            }

        }
    </script>
    <script type="text/javascript">
        const change = src => {
            document.getElementById("main").src = src
        }
    </script>

</section>
@endsection