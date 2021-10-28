@extends('master.main')
@section('container')
    <div class="content-body">

        <!-- row -->
        <h1 class="mb-3 ml-4">Admin</h1>
        @if (session()->has('info'))
            <div class="alert alert-danger solid alert-dismissible fade show w-50 text-center mx-auto">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                {{ session('info') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Admin</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr style="color: black">
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->created_at }}</td>
                                        <td>
                                            <div class="aksi d-flex">
                                                <a data-toggle="modal" id="updateAdmin" data-target="#modal-info{{$u->id}}"
                                                    class="btn btn-info mr-2"><i class="fa fa-info"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-info{{$u->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-judul">Detail {{ $u->name }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama" style="font-weight:bold;color:black">Nama</label>
                                                        <p style="color:black">{{ $u->name }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" style="font-weight:bold;color:black">Email</label>
                                                        <p style="color:black">{{ $u->email }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dibuat" style="font-weight:bold;color:black">Dibuat pada</label><br>
                                                        <p style="color:black">{{ $u->created_at }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="diupdate" style="font-weight:bold;color:black">Terakhir update</label><br>
                                                        <p style="color:black">{{ $u->updated_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus"></i>&nbsp;Tambahkan Data User</a>
        </button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukkan User Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="nama" placeholder="Masukkan Nama"
                                    required value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="slug" placeholder="Masukkan Email" required value="{{ old('email') }}">
                                @error('email')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Masukkan Password" required
                                    value="{{ old('password') }}">
                                @error('password')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
