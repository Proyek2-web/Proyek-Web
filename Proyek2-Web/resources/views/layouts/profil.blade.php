@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="address" style="margin-top: 120px">
    <ol class="arrows">
        <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
        <li><a href="/profil">Profil</a></li>
    </ol>
    <div class="container">

        {{-- <form action="{{route('profil.edit',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="formFileSm" class="form-label">Unggah gambar profil<span class="text-danger">*</span></label>
                <input class="form-control form-control-sm" type="file" name="featured_image"
                id="cover" required>
                <button type="submit">OK</button>
            </div>
        </form> --}}
        <form action="{{route('halaman_profil.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="mb-2">
            <label for="formFileSm" class="form-label">
                Gambar Profil</label><br>
            Nama: {{auth()->user()->name}}<br>
            No_telp: {{auth()->user()->no_hp}}<br>
            email: {{auth()->user()->email}}
            @if (auth()->user()->gambar != "")
            <img src="/profil/{{ auth()->user()->gambar }}" alt=""
            style="width: 20%">
            @endif
            <input required class="form-control form-control-sm" type="file"
                name="featured_image">
                <button type="submit">OK</button>
        </div>
        </form>

        <button type="button" class="btn btn-login mt-2 mb-3 p-2" data-bs-toggle="modal" data-bs-target="#modal-alamat">
            Ganti Password <i class="bi bi-plus-circle"></i> </i>
        </button>
        <!--Basic Modal Tambah Produk-->
        <!-- Modal Add-->
        <div class="modal fade" id="modal-alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-biasa">
                        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form onsubmit="return verifyPassword()" action="{{ route('halaman_profil.update',auth()->user()->id) }}" method="POST"
                        enctype="application/x-www-form-urlencoded">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="passwd1" name="passwd1"
                                        placeholder="Password Baru">
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="passwd2" class="form-control" name="passwd2" id=""
                                        placeholder="Konfirmasi Password baru">
                                    <span id="pesan" style="color:red"> </span>
                                </div>
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
            sadas
        </div>
    </div>
</section>
<script>
    function verifyPassword() {
        let pw1 = document.getElementById('passwd1').value;
        let pw2 = document.getElementById('passwd2').value;

        if (pw1 == "" || pw2 == "") {
            document.getElementById("pesan").innerHTML = "**Mohon isi password!";
            return false;
        }
        if (pw1 != pw2) {
            document.getElementById('pesan').innerHTML = "**Password yang anda masukkan harus sama"
            return false;
        }
        if (pw1.length<8||pw2.length<8){
            document.getElementById('pesan').innerHTML = "**Password harus lebih dari 8 karakter"
            return false;
        }
    }

</script>

@endsection
