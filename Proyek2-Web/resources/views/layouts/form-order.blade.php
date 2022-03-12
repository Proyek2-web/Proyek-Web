@extends('master.mainWeb')
@section('body')
    <div class="title col-lg-12 mx-auto">
        <h1>Form Order</h1>
    </div>
    <h3>Barang :</h3>
    <div class="form-order" style="margin-top: -1px">
        @foreach ($data as $d)
            <div class="mb-2">
                <a href="#"><img src="{{ url($d->featured_image) }}" width="150" alt="Product"></a>
                <p>Nama Barang :{{ $d->nama }}</p>
                <p>Jumlah :{{ $d->qty }}</p>
                <p>Harga :{{ $d->harga }}</p>
                <p>------------------------------------</p>
            </div>
        @endforeach

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h5 class="card-header">Pembayaran</h5>
                            <div class="card-body">
                                <select name="method" class="form-select" aria-label="Default select example" required>
                                    @foreach ($channels as $channel)
                                        @if ($channel->active)
                                            <option value="{{ $channel->code }}">{{ $channel->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h5 class="card-header">Pengiriman </h5>
                            <div class="card-body">
                                <select class="form-control kurir" name="courier">
                                    <option value="0">-- pilih kurir --</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h6 class="card-header">Kota Tujuan</h6>
                            <div class="card-body">
                                <label for="Provinsi" class="mb-2">Pilih Provinsi</label>
                                <select class="form-control provinsi-tujuan" name="province_destination">
                                    <option value="0">-- pilih provinsi tujuan --</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <label for="Provinsi" class="mb-2 mt-4">Pilih Kota</label>
                                <select class="form-control kota-tujuan" name="city_destination">
                                    <option value="">-- pilih kota tujuan --</option>
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
                                            placeholder="* Nama Penerima" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class=" col-12">
                                        <input type="number" name="" class="form-control" id="exampleFormControlInput1"
                                            placeholder="* Nomor HP" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class=" col-12">
                                        <input type="text" name="" class="form-control" id="exampleFormControlInput1"
                                            placeholder="* Alamat" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 ">
                                        <input type="number" name="" class="form-control" id="exampleFormControlInput1"
                                            placeholder="* Kode Pos" required>
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
                        <a href="/cart" class="btn btn-back"><i class="bi bi-x-circle-fill me-2"></i>Batal</a>
                        <a href="#" class="btn btn-conf">Bayar <i class="bi bi-check-circle-fill"></i></a>
                        
                    </div>
                </div>
            </div>
        </form>
        <div class="form-group">
            <label class="font-weight-bold">BERAT (GRAM)</label>
            <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan Berat (GRAM)">
        </div>
        <button id="btn-check" class="btn btn-conf">CEK <i class="bi bi-check-circle-fill"></i></button>
        <div class="ongkir-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ongkir d-none">
                        <div class="card-body">
                            <ul class="list-group" id="ongkir">
            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('select[name="province_destination"]').on('change', function() {
            let provindeId = $(this).val();
            
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append(
                            '<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="city_destination"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
            }
        });
        let isProcessing = false;
        $('#btn-check').click(function(e) {
            $('.ongkir').addClass('d-none');
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
                success: function(response) {
                console.log(weight)
                    console.log(response)
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').removeClass('d-none');
                        $.each(response[0]['costs'], function(key, value) {
                            $('#ongkir').append('<li class="list-group-item">' +
                                '<input type="radio" name="ongkir-kurir" value="' +
                                value.cost[0].value + '"> ' + response[0].code
                                .toUpperCase() + ' : <strong>' + value.service +
                                '</strong> - Rp. ' + number_format(value.cost[0].value, 2) +
                                ' (' + value.cost[0].etd + ') hari</li>')
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
