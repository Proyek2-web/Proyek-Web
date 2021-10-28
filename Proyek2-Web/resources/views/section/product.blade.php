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
                <div class="card-header">
                    <h4 class="card-title">Data Seluruh Produk</h4>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            style="border-radius:6px;border: 1px solid black " placeholder="Search">
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
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr style="color: black">
                                        <th style="line-height: 100px">{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->harga }}</td>
                                        <td>{{ $p->category->name }}</td>
                                        <td><img src="{{ asset('/storage/' . $p->featured_image) }}" width="80"
                                                height="100" alt="">
                                        </td>
                                        <td>{{ $p->keterangan }}</td>
                                        <td>
                                            <div class="aksi d-flex">
                                                <a data-toggle="modal" id="update"
                                                    data-target="#modal-edit{{ $p->id }}"
                                                    class="btn btn-success mr-2"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('product.destroy', $p->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah yakin?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-edit{{ $p->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-judul">Edit data Produk
                                                        {{ $p->nama }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('product.update', $p->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="nama"
                                                                style="color: black;font-weight: bold">Nama</label>
                                                            <input style="width: 12.375cm;height:1cm;border:0.01;"
                                                                type="text" class="form-control d-block mb-2" name="nama"
                                                                id="nama_p" value="   {{$p->nama }}" required>
                                                            <label style="color: black;font-weight: bold"
                                                                for="harga">Harga</label>
                                                            <input type="number"
                                                                style="width: 12.375cm;height:1cm;border:0.01;"
                                                                class="form-control d-block mb-2" name="harga" id="harga"
                                                                value="{{ $p->harga }}" required>
                                                            <label for="nama"
                                                                style="color: black;font-weight: bold">Kategori</label>
                                                            <select class="form-select form-select-lg w-100"
                                                                style="height: 1cm" name="category_id">
                                                                @foreach ($categories as $c)
                                                                    <option  {{ $c->id == $p->category_id  ? 'selected':'' }} value="   {{ $c->id }}">
                                                                           {{ $c->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="mt-2 mb-3">
                                                                <label for="featured_image"
                                                                    style="color: black;font-weight: bold"
                                                                    class="form-label">Gambar Produk</label>
                                                                <input
                                                                    class="form-control d-block  @error('featured_image') is-invalid @enderror form-control-sm"
                                                                    id="featured_image" type="file" name="featured_image">
                                                                @error('featured_image')
                                                                    <div id="" class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <label style="color: black;font-weight: bold"
                                                                for="keterangan">Keterangan</label>
                                                            <input style="width: 12.375cm;height:1cm;border:0.01;"
                                                                type="text" class="form-control d-block mb-2"
                                                                name="keterangan" id="keterangan"
                                                                value="   {{ $p->keterangan }}" required>
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
        <div class="d-block float-right">
            {{ $products->links() }}
        </div>
        <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus"></i>&nbsp;Tambahkan Data Produk</a>
        </button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukkan Data Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama" style="color: black;font-weight: bold">Nama</label>
                                <input style="width: 12.375cm;height:1cm;border:0.01;" type="text"
                                    class="form-control d-block mb-2" name="nama" id="nama_produk"
                                    placeholder="   Masukkan Nama Produk" required>
                                <label style="color: black;font-weight: bold" for="harga">Harga</label>
                                <input type="number" style="width: 12.375cm;height:1cm;border:0.01;"
                                    class="form-control d-block mb-2" name="harga" id="harga"
                                    placeholder="   Masukkan Harga Produk" required>
                                <label for="nama" style="color: black;font-weight: bold">Kategori</label>
                                <select class="form-select form-select-lg w-100" style="height: 1cm" name="category_id">
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2 mb-3">
                                    <label for="featured_image" style="color: black;font-weight: bold"
                                        class="form-label">Gambar Produk</label>
                                    <input
                                        class="form-control d-block  @error('featured_image') is-invalid @enderror form-control-sm"
                                        id="featured_image" type="file" name="featured_image">
                                    @error('featured_image')
                                        <div id="" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <label style="color: black;font-weight: bold" for="keterangan">Keterangan</label>
                                <input style="width: 12.375cm;height:1cm;border:0.01;" type="text"
                                    class="form-control d-block mb-2" name="keterangan" id="keterangan"
                                    placeholder="   Masukkan Keterangan" required>
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
        const name = document.querySelector('#nama_produk');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/product/checkSlug?name=' + name.value)
            dd(name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

    </script>
@endsection
