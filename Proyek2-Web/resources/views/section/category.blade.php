@extends('master.main')
@section('container')
    <div class="content-body">
        <!-- row -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/"><i class="bi bi-person-fill"></i> Admin </a></li>
              <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
          </nav>
        <div>
            @if (session()->has('success'))
                <div class="alert alert-danger solid alert-dismissible fade show w-50 text-center mx-auto">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('edited'))
                <div class="alert alert-primary solid alert-dismissible fade show w-50 text-center mx-auto">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session('edited') }}
                </div>
            @endif
            @if (session()->has('Added'))
                <div class="alert alert-primary solid alert-dismissible fade show w-50 text-center mx-auto">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session('Added') }}
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-center bg-dark">
                    <h4 class="card-title text-uppercase text-white">Data Kategori <i class="bi bi-tags text-white"></i></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th class="border text-center" scope="col">No</th>
                                    <th class="border text-center" scope="col">Nama Kategori</th>
                                    <th class="border text-center" scope="col">Dibuat</th>
                                    <th class="border text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr style="color: black">
                                        <th class="border text-center">{{ $loop->iteration }}</th>
                                        <td class="border text-center">{{ $c->name }}</td>
                                        <td class="border text-center">{{ $c->created_at }}</td>
                                        <td class="border text-center">
                                            <div class="aksi d-flex justify-content-center">
                                                <a data-toggle="modal" id="updateKategori"
                                                    data-target="#modal-edit{{ $c->id }}"
                                                    class="btn btn-warning mr-2"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('category.destroy', $c->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah yakin?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-edit{{ $c->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-judul">Edit Kategori
                                                        {{ $c->name }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('category.update', $c->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="nama_produk" style="font-weight: bold;color:black">Nama Kategori</label>
                                                            <input type="text" class="form-control d-block" name="name"
                                                               style="width: 10cm;height: 1cm;border:0" id="nama_kategori" value="{{ $c->name }}" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus"></i>&nbsp;Tambah Kategori</a>
        </button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukkan Data Kategori Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama" style="color: black;font-weight: bold">Nama</label>
                                <input style="width: 12.375cm;height:1cm;border:0.01;" type="text"
                                    class="form-control d-block mb-2" name="name" id="nama_produk"
                                    placeholder="   Masukkan Nama Kategori" required>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <script>
        const name = document.querySelector('#kategori');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/category/checkSlug?name=' + name.value)
            dd(name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

    </script>
@endsection
