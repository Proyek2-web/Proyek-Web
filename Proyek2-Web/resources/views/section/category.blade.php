@extends('master.main')
@section('container')
    <div class="content-body">
        <!-- row -->
        <h1 class="mb-3 ml-4">Kategori</h1>
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
                    <h4 class="card-title">Data Seluruh Kategori</h4>
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
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr style="color: black">
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->created_at }}</td>
                                        <td>
                                            <div class="aksi d-flex">
                                                <a data-toggle="modal" id="updateAdmin" data-target=""
                                                    class="btn btn-success mr-2"><i class="fa fa-edit"></i></a>
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
                                <input type="text" class="form-control" name="name" id="kategori"
                                    placeholder="Masukkan nama kategori" required>
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
