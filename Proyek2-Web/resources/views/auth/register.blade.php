<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <title>Laravel Raja Ongkir - SantriKoding.com</title>
</head>
<body style="background: #f3f3f3">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Daftar</h3>
                    <hr>
                    <form action="/register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">NAMA</label>
                        <input type="text" name="name" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">EMAIL</label>
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">PASSWORD</label>
                        <input type="text" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">NO HP</label>
                        <input type="text" name="no_hp" placeholder="Nomor HP">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">PROVINSI</label>
                        <select class="form-control provinsi-asal" name="province_origin">
                            <option value="0">-- pilih provinsi asal --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN </label>
                        <select class="form-control kota-asal" name="city_origin">
                            <option value="">-- pilih kota asal --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">ALAMAT LENGKAP</label>
                        <input type="text" name="alamat" placeholder="Alamat">
                        <input type="hidden" name="roles" value="user">
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
                </div>
            </div>
        </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        //active select2
        $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
            theme:'bootstrap4',width:'style',
        });
        //ajax select kota asal
        $('select[name="province_origin"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
            }
        });
    });
</script>
</body>
</html>