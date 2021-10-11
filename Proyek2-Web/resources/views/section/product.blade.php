@extends('master.main')
@section('container')
    <div class="content-body">
        <!-- row -->
        <h1 class="mb-3 ml-4">Produk</h1>
        <div>
            @if (session()->has('success'))
                <div class="alert alert-danger solid alert-dismissible fade show w-50 text-center mx-auto">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('Added'))
                <div class="alert alert-success solid alert-dismissible fade show w-50 text-center mx-auto">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session('Added') }}
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Seluruh Produk</h4>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr style="color: black">
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->harga }}</td>
                                        <td>{{ $p->category->name}}</td>
                                        <td>{{ $p->featured_image}}</td>
                                        <td>{{ $p->keterangan}}</td>
                                        <td>
                                            <div class="aksi d-flex">
                                                <a data-toggle="modal" id="updateAdmin" data-target=""
                                                    class="btn btn-success mr-2"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('category.destroy', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus"></i>&nbsp;Tambahkan Data Kategori</a>
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
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="nama_kategori"
                                    placeholder="Masukkan nama kategori" required>
                                <label for="nama">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Masukkan slug"
                                    required>
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

@endsection
