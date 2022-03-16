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
                                    <img src="{{ asset('/storage/' . $d->featured_image) }}" class="img-fluid" alt="..."
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
                            style="max-width: 50rem; font-family: sans-serif; background-color: #becbe7c9">
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
                                        <p>Biaya Ongkir</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p id="sub_ongkir">Rp. {{ number_format(0, 2) }}</p>
                                    </div>
                                    <p style="margin-top: -25px">
                                        ................................................................
                                    </p>
                                    <div class="col-md-6 " style="background-color: rgb(252, 117, 117)">
                                        <p class="mt-3 text-light" style="font-weight: bold">Total Bayar</p>
                                    </div>
                                    <div class="col-md-6" style="background-color: rgb(252, 117, 117)">
                                        <p class="mt-3 text-light" style="font-weight: bold" id="total_checkout">Rp.
                                            {{ number_format($subtotal, 2) }}</p>
                                    </div>
                                </div>
                            </ul>
                            <div class="d-flex mb-3 justify-content-center">
                                <a href="/cart" class="btn btn-back"><i class="bi bi-x-circle-fill me-2"></i>Batal</a>
                                <input type="hidden" name="sub_total" value="{{ $subtotal }}">
                                <input type="hidden" name="total_ongkir" value="">
                                <input type="hidden" name="total">
                                <button type="submit" id="checkout-button" class="btn btn-conf d-none">Bayar <i
                                        class="bi bi-credit-card"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 p-5"
                        style="background-color: #4488dd; border-radius: 0px 20px 20px 0px;box-shadow: rgba(51, 51, 51, 0.4) 20px 30px 90px;">
                        {{-- <h6>Jumlah Pembayaran</h6> --}}
                        <div class="row p-4 text-light">
                            Nama
                            <input class='input-field ' type="text" name="nama" id="exampleFormControlInput1"
                                required></input>
                            Alamat detail
                            <input class='input-field ' type="text" name="alamat" id="exampleFormControlInput1"
                                required></input>
                            <table class='half-input-table'>
                                <tr>
                                    <td>No. Handphone
                                        <input class='input-field ' type="number" name="nomor_hp"
                                            id="exampleFormControlInput1" required></input>
                                    </td>
                                    <td class="ms-2">Kode Pos
                                        <input class='input-field ' type="number" name="zip_code"
                                            id="exampleFormControlInput1" required></input>
                                    </td>
                                </tr>
                            </table>
                            Catatan produk
                            <textarea name="custom" class=" input-field" id="exampleFormControlTextarea1" rows="6"
                                required></textarea>
                            <div class='line'></div>
                            <div class=" d-flex justify-content-between mt-2">
                                {{-- <label for="Provinsi" class="mb-2">Pilih Provinsi</label> --}}
                                <select class="input-field   provinsi-tujuan me-3 " name="province_destination">
                                    <option value="0">-- pilih provinsi tujuan --</option>
                                    @foreach ($provinces as $province => $value)
                                    <option style="background: #31527a; color: aliceblue" value="{{ $province }}">
                                        {{ $value }}</option>
                                    @endforeach
                                </select>
                                {{-- <label for="Provinsi" class="mb-2 mt-4">Pilih Kota</label> --}}
                                <select class="input-field  kota-tujuan " name="city_destination">
                                    <option style="background: #4488dd; color: rgb(225, 226, 226)" value=" ">-- pilih
                                        kota tujuan --</option>
                                </select>
                            </div>
                            <div class=" d-flex justify-content-between">
                                <select name="method" class=" input-field me-3"
                                    aria-label="Default select example" required>
                                    <option value="0">-- pilih metode pembayaran --</option>
                                    @foreach ($channels as $channel)
                                    @if ($channel->active)
                                    <option style="background: #31527a; color: aliceblue" value="{{ $channel->code }}">
                                        {{ $channel->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <select class=" kurir input-field " name="courier">
                                    <option value="0">-- pilih metode pengiriman --</option>
                                    <option style="background: #31527a; color: aliceblue" value="jne">JNE</option>
                                    <option style="background: #31527a; color: aliceblue" value="pos">POS</option>
                                    <option style="background: #31527a; color: aliceblue" value="tiki">TIKI</option>
                                </select>
                            </div>
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
                                <button id="btn-check" class="btn btn-conf mt-5">Konfirmasi <i
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
<script>
    $('#ongkir').click(function () {
        const ongkir = $('input[name=ongkir-kurir]:checked').val();
        var sub_total = $('input[name=sub_total]').val();
        total = parseInt(sub_total) + parseInt(ongkir);
        $('input[name=total]').val(total);
        $('input[name=total_ongkir]').val(ongkir);
        $("#total_checkout").text("Rp. " + number_format(total, 2));
        $('#checkout-button').addClass('d-block');
        $('#sub_ongkir').text("Rp. " + number_format(ongkir, 2));
    });
    $('select[name="province_destination"]').on('change', function () {
        let provindeId = $(this).val();

        if (provindeId) {
            jQuery.ajax({
                url: '/cities/' + provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {

                    $('select[name="city_destination"]').empty();
                    $('select[name="city_destination"]').append(
                        '<option  value="">-- pilih kota tujuan --</option>');
                    $.each(response, function (key, value) {
                        $('select[name="city_destination"]').append(
                            '<option style="background: #31527a; color: aliceblue" value="' +
                            key + '">' + value + '</option>');
                    });
                },
            });
        } else {
            $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
        }
    });
    let isProcessing = false;
    $('#btn-check').click(function (e) {
        $('.ongkir').addClass('d-none');
        $('#checkout-button').addClass('d-none');
        e.preventDefault();
        let token = $("meta[name='csrf-token']").attr("content");
        console.log(token);
        let city_origin = $('select[name=city_origin]').val();
        let city_destination = $('select[name=city_destination]').val();
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
            success: function (response) {
                console.log(weight)
                console.log(response)
                isProcessing = false;
                if (response) {
                    $('#ongkir').empty();
                    $('.ongkir').removeClass('d-none');
                    $('#checkout-button').removeClass('d-none');
                    $.each(response[0]['costs'], function (key, value) {
                        $('#ongkir').append(
                            '<li class="list-group-item" style="background: rgba(255, 255, 255, 0.267); color: aliceblue">' +
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
</script>
<script>

</script>
@endsection