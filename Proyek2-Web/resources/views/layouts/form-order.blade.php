@extends('master.mainWeb')
@section('body')

    <div class="form-order">
        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title col-lg-12 mx-auto mb-5">
                <h1>Ringkasan Pesanan</h1>
            </div>
            <div class="container">
                <div class="row mt-5 mb-5">
                    <div class="row justify-content-center">
                        <div class="wrap-order p-4 col-md-4 bg-white"
                            style="border-radius: 20px 0px 0px 20px;box-shadow: rgba(51, 51, 51, 0.4) 0px 30px 90px; ">
                            {{-- <h4 class="text-center">Ringkasan Pesanan</h4>
                            <div class='line'></div> --}}
                            @foreach ($data as $d)
                                <div class="card mb-3 border-0"
                                    style="max-width: 445px; font-family: PT-Serif; background-color: rgba(226, 230, 230, 0.877); border-radius: 20px;">
                                    <div class="row g-0 align-items-center ">
                                        <div class="col-md-4">
                                            <img src="cover_product/{{ $d->featured_image }}" class="img-fluid" alt="..."
                                                style="border-radius: 20px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title text-capitalize" style="font-weight: bold">
                                                    {{ $d->nama }}</h5>
                                                <p class="card-text text-light"> <span
                                                        style="border-radius: 8px; padding-inline: 20px; padding-block: 5px; font-weight: bold; background-color: #51698687; font-size: 14px">Rp.
                                                        {{ number_format($d->harga, 2) }}</span> </p>
                                                <p class="card-text text-dark"><small
                                                        style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #bcbec2b9">Jumlah
                                                        : {{ $d->qty }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class='line'></div>
                            <div class="card border-0 text-center text-dark"
                                style="max-width: 50rem; font-family: sans-serif; background-color: #81b29a">
                                <ul class="list-group list-group-flush p-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Total Order</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Rp. {{ number_format($subtotal, 2) }}</p>
                                        </div>
                                        <p style="margin-top: -25px">
                                            ................................................................
                                        </p>
                                        <div class="col-md-6">
                                            <p>Total berat</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $total_berat }} Gr</p>
                                        </div>
                                        <p style="margin-top: -25px">
                                            ................................................................
                                        </p>
                                        <div class="col-md-6">
                                            <p>Biaya Ongkir</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p id="sub_ongkir">Rp. {{ number_format(0, 2) }}</p>
                                        </div>
                                        <p style="margin-top: -25px">
                                            ................................................................
                                        </p>
                                        <div class="col-md-6 " style="background-color: #e07a5f">
                                            <p class="mt-3 text-light" style="font-weight: bold">Total Bayar</p>
                                        </div>
                                        <div class="col-md-6" style="background-color: #e07a5f">
                                            <p class="mt-3 text-light" style="font-weight: bold" id="total_checkout">Rp.
                                                {{ number_format($subtotal, 2) }}</p>
                                        </div>
                                    </div>
                                </ul>
                                <div class="d-flex mb-3 justify-content-center">
                                    <a href="/cart" class="btn btn-back"><i class="bi bi-x-circle-fill me-2"></i>Batal</a>
                                    <input type="hidden" name="sub_total" value="{{ $subtotal }}">
                                    <input type="hidden" name="total_ongkir" value="">
                                    <input type="hidden" name="total_hari" value="">
                                    <input type="hidden" name="total">
                                    <button type="submit" id="checkout-button" class="btn btn-conf d-none text-dark"
                                        style="background-color: #f2cc8f">Bayar <i class="bi bi-credit-card"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 p-5"
                            style="background-color: #24243a; border-radius: 0px 20px 20px 0px;box-shadow: rgba(51, 51, 51, 0.4) 20px 30px 90px;">
                            {{-- <h6>Jumlah Pembayaran</h6> --}}
                            <div class="row p-4 text-light">
                                <div class=" d-flex   justify-content-between mt-1 mb-3" style="margin-left: -6px">
                                    <select id="id_select2_example" name="method" class=" input-field "
                                        aria-label="Default select example" required>
                                        <option value="0"
                                            data-img_src="{{ url('https://static.thenounproject.com/png/3187853-200.png') }}">
                                            -- pilih metode pembayaran --</option>
                                        @foreach ($channels as $channel)
                                            @if ($channel->active)
                                                <option class="align-items-center"
                                                    data-img_src="{{ asset('storage/payment/' . $channel->code) . '.png' }}"
                                                    style="background: #c04242; color: rgb(240, 242, 243)"
                                                    value="{{ $channel->code }}">
                                                    {{ $channel->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <select id="id_select3_example" class=" kurir input-field " name="courier">
                                        <option value="0"
                                            data-img_src2="{{ url('https://d338t8kmirgyke.cloudfront.net/icons/icon_pngs/000/000/163/original/delivery.png') }}">
                                            -- pilih metode pengiriman --</option>
                                        <option style="background: #31527a; color: aliceblue"
                                            data-img_src2="{{ url('https://seeklogo.com/images/T/Tiki_JNE-logo-09BD368D04-seeklogo.com.png') }}"
                                            value="jne">JNE</option>
                                        <option style="background: #31527a; color: aliceblue"
                                            data-img_src2="{{ url('https://cdn.kibrispdr.org/data/icon-pos-indonesia-10.png') }}"
                                            value="pos">POS</option>
                                        <option style="background: #31527a; color: aliceblue"
                                            data-img_src2="{{ url('https://cdn.kibrispdr.org/data/icon-jne-png-47.png') }}"
                                            value="tiki">TIKI</option>
                                    </select>

                                </div>
                                <div class=" d-flex justify-content-between mt-2 mb-">
                                    {{-- <label for="Provinsi" class="mb-2">Pilih Provinsi</label> --}}
                                </div>
                                Alamat detail
                                @foreach ($address as $a)
                                    <textarea name="alamat" disabled id="" cols="20"
                                        rows="10">{{ $a->label }} {{ $a->user->name }} {{ $a->no_telepon }} {{ $a->province_id }}
                                                    {{ $a->city_id }} {{ $a->alamat }} {{ $a->zip_code }}</textarea>
                                    <input type="hidden" name="kotta" value="{{ $a->city_id }}">
                                    <input type="hidden" name="namaa" value="{{ $a->user->name }}">
                                    <input type="hidden" name="provinsi" value="{{ $a->province_id }}">
                                    <input type="hidden" name="cit" value="{{ $a->city_id }}">
                                    <input type="hidden" name="phone" value="{{ $a->no_telepon }}">
                                    <input type="hidden" name="zip_code" value="{{ $a->zip_code }}">
                                @endforeach
                                <a href="/alamat" class="mb-3" style="font-size: 14px">Tambah / Ganti alamat</a>
                                <div class='line'></div>
                                {{-- <input class='input-field ' type="text" name="alamat" id="exampleFormControlInput1"
                                required> --}}
                                Catatan Produk
                                @foreach ($data as $d)
                                    <input class='input-field ' type="text"
                                        placeholder="{{ $d->nama }} : {{ $d->catatan != null ? $d->catatan : '-' }}"
                                        disabled id="exampleFormControlInput1" required>
                                @endforeach
                                {{-- Catatan produk
                            <textarea name="custom" class=" input-field" id="exampleFormControlTextarea1" rows="6"
                                required></textarea> --}}


                                <div class=" text-center">
                                    <input type="hidden" class="form-control" name="weight" id="weight"
                                        value="{{ $total_berat }}" disabled>
                                    <div class="ongkir-card">
                                        <div class="row mt-4">
                                            <div class="">
                                                <div class="card ongkir d-none "
                                                    style="background: rgba(255,255,255,0.1); color: aliceblue">
                                                    <div class="card-body ">
                                                        <ul class="list-group" id="ongkir">

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="btn-check" class="btn btn-conf mt-5"
                                        style="background-color: #81b29a">Konfirmasi <i
                                            class="bi bi-check-circle-fill"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </div>
    </form>

    </div>
    <script type="text/javascript">
        function custom_template(obj) {
            var data = $(obj.element).data();
            var text = $(obj.element).text();
            if (data && data['img_src']) {
                img_src = data['img_src'];
                template = $("<div><img src=\"" + img_src +
                    "\" style=\"width:40px;\"/><p style=\"font-weight: 700;font-size:9pt; display:inline-block; padding:5px; margin-right:50px\">" +
                    text + "</p></div>");
                return template;
            }
        }
        var options = {
            'templateSelection': custom_template,
            'templateResult': custom_template,
        }
        $('#id_select2_example').select2(options);
        $('.select2-container--default .select2-selection--single').css({
            'height': '40px',
            'background': '#f4f1de',
            'margin-right': '0px'
        });

    </script>
    <script type="text/javascript">
        function custom_template(obj) {
            var data = $(obj.element).data();
            var text = $(obj.element).text();
            if (data && data['img_src2']) {
                img_src = data['img_src2'];
                template2 = $("<div><img src=\"" + img_src +
                    "\" style=\"width:40px;\"/><p style=\"font-weight: 700;font-size:9pt; display:inline-block; padding:5px; margin-right:0px\">" +
                    text + "</p></div>");
                return template2;
            }
        }
        var options = {
            'templateSelection': custom_template,
            'templateResult': custom_template,
        }
        $('#id_select3_example').select2(options);
        $('.select2-container--default .select2-selection--single').css({
            'height': '40px',
            'background': '#f4f1de',
            'margin-left': '10px',
            'border-radius': '5px'
        });

    </script>
    <script>
        $('#ongkir').click(function() {
            const ongkir = $('input[name=ongkir-kurir]:checked').val();
            var sub_total = $('input[name=sub_total]').val();
            const hari = $('input[name=hari]').val();
            total = parseInt(sub_total) + parseInt(ongkir);
            $('input[name=total]').val(total);
            $('input[name=total_ongkir]').val(ongkir);
            $('input[name=total_hari]').val(hari);
            $("#total_checkout").text("Rp. " + number_format(total, 2));
            $('#checkout-button').addClass('d-block');
            $('#sub_ongkir').text("Rp. " + number_format(ongkir, 2));
        });
        let isProcessing = false;
        $('#btn-check').click(function(e) {
            $('.ongkir').addClass('d-none');
            $('#btn-check').addClass('d-none');
            $('#checkout-button').addClass('d-none');
            e.preventDefault();
            let token = $("meta[name='csrf-token']").attr("content");
            console.log(token);
            let city_origin = $('select[name=city_origin]').val();
            let kutho = $('input[name=kotta]').val();
            let city_destination = $('input[name=kotta]').val();
            console.log(city_destination);
            let courier = $('select[name=courier]').val();
            console.log(courier);
            let weight = $('#weight').val();

            if (isProcessing) {
                return;
            }
            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token: token,
                    city_origin: 369,
                    city_destination: city_destination,
                    courier: courier,
                    weight: weight,

                },
                dataType: "JSON",
                type: "POST",
                success: function(response) {
                    console.log(weight)
                    console.log(response)
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').removeClass('d-none');
                        $('#checkout-button').removeClass('d-none');
                        $.each(response[0]['costs'], function(key, value) {
                            $('#ongkir').append(
                                '<li class="list-group-item" style="background: rgba(255, 255, 255, 0.267); color: aliceblue">' +
                                '<input type ="hidden" name="hari" value="' + value.cost[0]
                                .etd + '">' +
                                '<input  type="radio" required name="ongkir-kurir" value="' +
                                value.cost[0].value + '"> ' + response[0].code
                                .toUpperCase() + ' : <strong>' + value.service +
                                '</strong> - Rp. ' + number_format(value.cost[0].value, 2) +
                                ' (' + value.cost[0].etd + ') hari </li>')
                        });
                    }
                }
            });
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
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

    </script>
    <script>

    </script>
@endsection
