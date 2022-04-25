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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form">
                <textarea class="form-control" placeholder="Tulis detail alamat" id="floatingTextarea"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-login">Simpan</button>
        </div>
      </div>
    </div>
  </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card" style="width: 18rem; background-color: rgb(214, 214, 213) ">
                    <a href="#" class="mt-2 me-2" ><i class="bi bi-x-circle text-black" style="float: right"></i></a>
                    <p class="card-text text-dark p-4">Some quick example text to build on the card title and make up
                        the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection