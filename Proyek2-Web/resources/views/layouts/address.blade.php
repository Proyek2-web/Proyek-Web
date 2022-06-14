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
        <!-- Modal Add-->
        <div class="modal fade" id="modal-alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-biasa">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('alamat.store') }}" method="POST"
                        enctype="application/x-www-form-urlencoded " >
                        @csrf
                        <div class="modal-body">
                            <div class="form">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="label" name="label"
                                        placeholder="Label Alamat" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="name" id=""
                                        placeholder="Nama penerima" required>
                                </div>
                                <div class="mb-2">
                                    <input type="number" class="form-control" name="no_hp" id=""
                                        placeholder="Nomor Telepon (Whatsapp)" required>
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-control provinsi-tujuan" name="province_destination" required>
                                        <option value="0">-- pilih provinsi tujuan --</option>
                                        @foreach ($provinces as $province => $value)

                                        <option value="{{ $province }}" >{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-control kota-tujuan" name="city_destination" required>
                                        <option value="">-- pilih kota tujuan --</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <input type="number" class="form-control" name="zip" id="" placeholder="Kode Pos" required>
                                </div>
                                <textarea name="alamat" class="form-control" placeholder="Tulis detail alamat"
                                    id="floatingTextarea" required></textarea>
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
                <div class="card" style="width: 18rem;">
                    <div class="card-header d-flex ">
                        {{ $a->label }}
                        <button type="submit" style="float: right; margin-left: 150px; margin-right: 10px" data-bs-toggle="modal"
                            data-bs-target="#modal-editAlamat"><i class="bi bi-pencil-square"></i></button>
                        <form action="{{ route('alamat.destroy', $a->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float: right; "><i
                                    class="bi bi-trash-fill"></i></button>
                        </form>
                    </div>
                    <!-- Modal EDIT-->
                    <div class="modal fade" id="modal-editAlamat" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-biasa">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Alamat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('alamat.edit', $a->id) }}" method="PUT"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" id="label" name="label"
                                                    placeholder="Label Alamat" value="{{ $a->label }}">
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" name="name" id=""
                                                    placeholder="Nama penerima" value="{{ $a->nama_penerima }}">
                                            </div>
                                            <div class="mb-2">
                                                <input type="number" class="form-control" name="no_hp" id=""
                                                    placeholder="Nomor Telepon (Whatsapp)" value="{{ $a->no_telepon }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <select class="form-control provinsi-tujuan"
                                                    name="province_destination" required>
                                                    @php
                                                    $tabel = DB::table('cities')
                                                    ->join('provinces', 'cities.province_id', '=', 'provinces.province_id')
                                                    ->select('cities.name','cities.city_id','cities.province_id','provinces.name as nama_provinsi')
                                                    ->where('cities.province_id','=',$a->province_id)
                                                    ->where('cities.city_id','=',$a->city_id)
                                                    ->get();
                                                    foreach ($tabel as $c) {
                                                    $kota = $c->name;
                                                    $prop = $c->nama_provinsi;
                                                    }
                                                    @endphp
                                                    <option value="{{ $kota }}">{{ $kota }}</option>
                                                    @foreach ($provinces as $province => $value)

                                                    <option value="{{ $province }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <select class="form-control kota-tujuan" name="city_destination" required>
                                            <option value="0">{{ $prop }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <input type="number" class="form-control" name="zip" id=""
                                                    placeholder="Kode Pos" value="{{ $a->zip_code }}">
                                            </div>
                                            <textarea name="alamat" class="form-control"
                                                placeholder="Tulis detail alamat" id="floatingTextarea">{{ $a->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit"  class="btn btn-login">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $a->nama_penerima }}</li>
                        <li class="list-group-item">{{ $a->no_telepon }}</li>
                        <li class="list-group-item">{{ $kota }}, {{ $prop }} {{ $a->zip_code }}</li>
                        <li class="list-group-item">{{ $a->alamat }}</li>
                        @if ($a->status )
                        <li class="list-group-item text-light text-center bg-dark">Alamat Dipakai Saat ini</li>
                        @else
                        <li class="list-group-item text-center">
                            <form action="{{ route('alamat.update', $a->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success" type="submit">Jadikan alamat utama</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </div>

                {{-- <div class="card" style="width: 18rem; background-color: rgb(235, 235, 235) ">
                            <form action="{{ route('alamat.destroy', $a->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="float: right"><i class="bi bi-x-circle text-black"></i></button>
                </form>
                <form action="{{ route('alamat.update', $a->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">set jadi alamat utama</button>
                </form>
                <p class="card-text text-dark ps-4 pe-4 pb-4  text-center">{{ $a->alamat }}</p>
            </div> --}}
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
                url: '/cities/' + provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="city_destination"]').empty();
                    $('select[name="city_destination"]').append(
                        '<option value="">-- pilih kota tujuan --</option>');
                    $.each(response, function (key, value) {
                        $('select[name="city_destination"]').append('<option value="' +
                            key + '">' + value + '</option>');
                    });
                },
            });
        } else {
            $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
        }
    });
</script>

@endsection