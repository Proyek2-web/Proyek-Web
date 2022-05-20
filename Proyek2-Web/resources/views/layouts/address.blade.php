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
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="label" name="label"
                                        placeholder="Label Alamat">
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="name" id=""
                                        placeholder="Nama penerima">
                                </div>
                                <div class="mb-2">
                                    <input type="number" class="form-control" name="no_hp" id=""
                                        placeholder="Nomor Telepon (Whatsapp)">
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-control provinsi-tujuan" name="province_destination">
                                        <option value="0">-- pilih provinsi tujuan --</option>
                                        @foreach ($provinces as $province => $value)
                                        <option value="{{ $province  }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-control kota-tujuan" name="city_destination">
                                        <option value="">-- pilih kota tujuan --</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <input type="number" class="form-control" name="zip" id="" placeholder="Kode Pos">
                                </div>
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
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        {{ $a->label }}
                        <form action="{{ route('alamat.update', $a->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-primary" type="submit">Jadikan alamat utama</button>
                        </form>
                    </div>
                    {{-- @php
                    $city = \App\Models\City::where('province_id', '=', $a->province_id)
                    ->where('id ', '=', $a->city_id)
                    ->get();
                    foreach ($city as $c) {
                    $kota = $c->name;
                    }
                    @endphp --}}
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $a->user->name }}</li>
                        <li class="list-group-item">{{ $a->no_telepon }}</li>
                        {{-- <li class="list-group-item">{{ $kota }}</li> --}}
                        <li class="list-group-item">{{ $a->zip_code }}</li>
                        <li class="list-group-item">{{ $a->alamat }}</li>
                        <li class="list-group-item">A third item</li>
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