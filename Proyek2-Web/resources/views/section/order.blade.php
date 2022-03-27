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
                    <h3>Data User</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a style="color: #222237" href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    {{-- <button type="button" class="btn btn-primary ml-3 p-2" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah">
                    Tambah data User <i class="fa fa-plus ms-2"></i>
                </button> --}}
                    <!--Basic Modal Tambah Produk-->
                    {{-- <div class="modal fade text-left" id="modal-tambah" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="myModalLabel1">Tambah Data User</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical" action="{{ route('category.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="basicInput">Nama User</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Masukkan nama User" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">E-mail</label>
                                        <input name="email" type="text" class="form-control"
                                            placeholder="Masukkan email User" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Nama User</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Masukkan nama User" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tambah</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
                </div>
                <div class="card-body">
                    <table class="table" id="table1" style="table-layout: fixed; width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 50px">No.</th>
                                <th>Nama Penerima</th>
                                <th>Nomer HP</th>
                                <th>Alamat</th>
                                <th>No Pesanan</th>
                                <th>Akun</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $o)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $o->nama }}</td>
                                    <td>{{ $o->phone_number }}</td>
                                    <td>{{ $o->alamat }}</td>
                                    <td>{{ $o->merchant_ref }}</td>
                                    <td>{{ $o->user->name }}</td>
                                    <td>{{ $o->amount }}</td>
                                    <td>{{ $o->status }}</td>
                                    <td>
                                        <div class="aksi d-flex justify-content-center">
                                            <a data-bs-toggle="modal" id="update"
                                                data-bs-target="#modal-info{{ $o->id }}"
                                                class="btn btn-warning me-2"><i class="fa fa-info"></i>
                                            </a>
                                            <!--Basic Modal info user-->
                                            <div class="modal fade text-left" id="modal-info{{ $o->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title text-white" id="myModalLabel1">Detail
                                                                Data
                                                                Pesanan</h5>
                                                            <button type="button" class="close rounded-pill"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="basicInput">Nama Penerima</label>
                                                                <input name="name" type="text" class="form-control"
                                                                    placeholder="Masukkan nama user" disabled
                                                                    value="{{ $o->nama }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicInput">Produk</label>
                                                                @foreach ($carts as $c)
                                                                    @foreach ($product as $p)
                                                                        @if ($o->id == $c->order_id)
                                                                            @if ($c->product_id == $p->id)
                                                                                <input name="name" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Masukkan nama user"
                                                                                    disabled
                                                                                    value="{{ $p->nama }} : {{ $c->qty }} pcs">
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="basicInput">Nomor HP</label>
                                                                <input type="text" class="form-control" name="harga"
                                                                    placeholder="Masukkan email"
                                                                    value="{{ $o->phone_number }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicInput">Catatan</label>
                                                                <input type="text" class="form-control" name="alamat"
                                                                    placeholder="Masukkan email"
                                                                    value="{{ $o->custom }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicInput">Alamat</label>
                                                                {{-- <input type="text" style="weight" class="form-control" name="roles"
                                                                    placeholder="Masukkan email"
                                                                    value="{{ $o->alamat }}asdsadasdasdasdasdasdas | Kode Pos : {{ $o->zip_code }}" disabled> --}}
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{ $o->alamat }} | Kode Pos: {{ $o->zip_code }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicInput">Total Biaya</label>
                                                                <input type="text" class="form-control" name="roles"
                                                                    placeholder="Masukkan email" value="Total Produk: {{ $o->total_produk }} | Total Ongkir : {{ $o->total_ongkir }} = Rp.{{ $o->amount }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicInput">Nomor Pesanan</label>
                                                                <input type="text" class="form-control" name="roles"
                                                                    placeholder="Masukkan email"
                                                                    value="{{ $o->merchant_ref }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span style="font-size: 12px">Terakhir di rubah: <span
                                                                    style="color: #222237">{{ $o->updated_at }}</span>
                                                            </span>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Tutup</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center border px-4 py-2" style="">PESANAN KOSONG</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
    <!-- Sweet Alert Delete -->
    <script>
        function deleteItem(d) {
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
                    window.location = "/user/delete/" + id
                }
            })
        }

    </script>
    <!-- End Sweet Alert Delete -->
@endsection
