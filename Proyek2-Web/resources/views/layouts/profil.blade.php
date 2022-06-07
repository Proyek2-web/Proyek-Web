@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')
<style>
.wrap {
  position: relative;
  width: 80%;
}

    .img-profil {
        opacity: 1;
        display: block;
        width: 30%;
        border-radius: 50%;
        height: 90%;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .wrap:hover .img-profil {
        opacity: 0.5;
    }

    .wrap:hover .middle  {
        opacity: 1;
        cursor: pointer;
    }
</style>

<section class="profil" style="margin-top: 120px; font-family: PT Serif;">
    <ol class="arrows">
        <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
        <li><a href="/profil">Profil</a></li>
    </ol>
    <div class="container">
        <form action="{{route('halaman_profil.update',auth()->user()->id)}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mt-5 mb-3 align-items-center justify-content-center text-center">
                <div class="wrap row justify-content-center">
                    @if (auth()->user()->gambar != "")
                    <img src="/profil/{{ auth()->user()->gambar }}" alt="" class="img-profil mb-4"
                        id="preview-image-profil">
                    @endif
                    <div class="middle" onclick="$('#imgupload').trigger('click'); return false;">
                        <div class="text ">
                            <i class="bi bi-image-fill"></i>
                            <h5 style="font-weight: bold">Ganti Foto</h5>
                        </div>
                    </div>
                </div>

                <h3>{{auth()->user()->name}}</h3>
                <h5> {{auth()->user()->email}}</h5>
                <h5>{{auth()->user()->no_hp}}</h5>
            </div>
            <input required class="form-control form-control-sm" type="file" id="imgupload" name="featured_image"
                style="display: none">
            <div class="d-flex justify-content-center">
                <button class="btn btn-dark me-3" type="submit">Simpan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-alamat">
            Ganti Password
        </button>
    </div>

    <!--Basic Modal Tambah Produk-->
    <!-- Modal Add-->
    <div class="modal fade" id="modal-alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-biasa ">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Ganti Password</h5>
                    <button style="color: aliceblue" type="button" class=" btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form onsubmit="return verifyPassword()"
                    action="{{ route('halaman_profil.update',auth()->user()->id) }}" method="POST"
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
    </div>
</section>
<script>
    $('#OpenImgUpload').click(function () {
        $('#imgupload').trigger('click');
    });
    $('#imgupload').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-profil').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>
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
        if (pw1.length < 8 || pw2.length < 8) {
            document.getElementById('pesan').innerHTML = "**Password harus lebih dari 8 karakter"
            return false;
        }
    }
</script>

@endsection