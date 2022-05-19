@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

    <section class="address" style="margin-top: 120px">
        <ol class="arrows">
            <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
            <li><a href="/alamat">Alamat</a></li>
        </ol>
        <div class="container">
            <button type="button" class="btn btn-login mt-5 mb-3 p-2" data-bs-toggle="modal" data-bs-target="#modal-alamat">
                Tambah Alamat <i class="bi bi-plus-circle"></i> </i>
            </button>
            <!--Basic Modal Tambah Produk-->
            <!-- Modal -->
            <div class="modal fade" id="modal-alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-biasa">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('alamat.store') }}" method="POST"
                            enctype="application/x-www-form-urlencoded">
                            @csrf
                            <div class="modal-body">
                                <div class="form">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="text" name="label" id="" placeholder="Label">
                                    <input type="text" name="name" id="" placeholder="Nama">
                                    <input type="text" name="no_hp" id="" placeholder="Nomor Telepon">
                                    <div class="form-group">
                                        <label class="font-weight-bold">PROVINSI</label>
                                        <select class="form-control provinsi-tujuan" name="province_destination">
                                            <option value="0">-- pilih provinsi tujuan --</option>
                                            @foreach ($provinces as $province => $value)
                                                <option value="{{ $province  }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">KOTA / KABUPATEN</label>
                                        <select class="form-control kota-tujuan" name="city_destination">
                                            <option value="">-- pilih kota tujuan --</option>
                                        </select>
                                    </div>
                                    <input type="text" name="zip" id="" placeholder="Kode Pos">
                                    <textarea name="alamat" class="form-control" placeholder="Tulis detail alamat"
                                        id="floatingTextarea"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-login">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($alamat as $a)
                <div class="col-md-3 mb-3">
                    <div class="card" style="width: 18rem; background-color: rgb(235, 235, 235) ">
                            <form action="{{ route('alamat.destroy', $a->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="float: right"><i class="bi bi-x-circle text-black" ></i></button>
                            </form>
                            <form action="{{ route('alamat.update', $a->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit">set jadi alamat utama</button>
                            </form>
                        <p class="card-text text-dark ps-4 pe-4 pb-4  text-center">{{ $a->alamat }}</p>
                    </div>
                </div>
                @empty
                    <h1 class="text-center">Alamat Kosong</h1>
                @endforelse
            </div>
        </div>
    </section>
    <script>
          $('select[name="province_destination"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
            }
        });
    </script>

@endsection
