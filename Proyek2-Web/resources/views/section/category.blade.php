@extends('master.main')
@section('body')
<style>
    table.dataTable td {
        padding: 15px 8px;
    }

    .fontawesome-icons .the-icon svg {
        font-size: 24px;
    }
</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kategori</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a style="color: #222237" href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary ml-3 p-2" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah">
                    Tambah data kategori <i class="fa fa-plus ms-2"></i>
                </button>
                <!--Basic Modal Tambah Produk-->
                <div class="modal fade text-left" id="modal-tambah" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="myModalLabel1">Tambah Data Kategori</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('category.store') }}" method="POST" id="formId">
                                    @csrf
                                    <div class="form-group">
                                        <label for="basicInput">Nama Kategori</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Masukkan nama kategori" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button id="btnId" type="submit" class="btn btn-primary ">Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table1" style="table-layout: fixed; width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 50px">No.</th>
                            <th>Nama kategori</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $c)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $c->name }}</td>
                            <td>
                                <div class="aksi d-flex justify-content-center">
                                        <button onclick="deleteItem(this)" class="deleted btn btn-danger" data-id="{{$c->id}}" data-name="{{$c->name}}"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center border px-4 py-2" style="">KATEGORI KOSONG</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>
<script>
$(document).ready(function () {
    $('#btnId').on('click',function()
  {
    $(this).val('Please wait ...')
      .attr('disabled',true);
    $('#formId').submit();
  });

});
    </script>
<!-- Sweet Alert Delete -->
<script>
    function deleteItem(d){
            var id = d.getAttribute('data-id');
            var name = d.getAttribute('data-name');
            Swal.fire({
                title: 'Apakah yakin?',
                text: "Ingin menghapus data (" + name + ")",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#222237',
                cancelButtonColor: '#AAAAAA',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'info',
                        title: 'Hold on, delete in progress'
                    })
                    window.location = "/category/delete/" + id
                }
            })
    }
    </script>
        
    <!-- End Sweet Alert Delete -->
@endsection
