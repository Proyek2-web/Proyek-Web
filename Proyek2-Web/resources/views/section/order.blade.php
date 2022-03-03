@extends('master.main')
@section('container')
    <div class="content-body">
        <!-- row -->
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
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/"><i class="bi bi-person-fill"></i> Admin </a></li>
              <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
            </ol>
          </nav>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-center bg-dark">
                    <h2 class="card-title text-uppercase text-white">Data Pesanan <i class="bi bi-bag-check"></i></h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th class="border text-center" scope="col">No</th>
                                    <th class="border text-center" scope="col">Nama</th>
                                    <th class="border text-center" scope="col">Nomor WA</th>
                                    {{-- <th class="border" scope="col">Catatan</th> --}}
                                    {{-- <th scope="col">Email</th> --}}
                                    {{-- <th scope="col">Alamat</th> --}}
                                    <th class="border text-center" scope="col">Produk</th>
                                    <th class="border text-center" scope="col">Jumlah</th>
                                    <th class="border text-center" scope="col">Total</th>
                                    <th class="border text-center" scope="col">Status</th>
                                    <th class="border text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $p)
                                    <tr style="color: black">
                                        <th class="border text-center" style="line-height: 100px">{{ $loop->iteration }}</th>
                                        <td class="border text-center">{{ $p->nama }}</td>
                                        <td class="border text-center">{{ $p->phone_number }}</td>
                                        <td class="border text-center">{{ $p->product->nama }}</td>
                                        <td class="border text-center">{{ $p->quantity }}</td>
                                        <td class="border text-center">Rp. {{ number_format($p->amount) }}</td>

                                        <td class="border text-center">
                                            @if ($p->status == 'PAID')
                                                <span class="px-2 py-1  bg-success  text-white rounded-sm ">
                                                    {{ $p->status }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1  bg-danger  text-white rounded-sm ">
                                                    {{ $p->status }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="border text-center">
                                            <div class="aksi d-flex justify-content-center">
                                                <a href="{{ route('nota.cetak', $p->id) }}" class="btn btn-secondary mr-2"><i
                                                        class="fa fa-print"></i></a>
                                                <div class="aksi">
                                                    <a data-toggle="modal" id=""
                                                        data-target="#modal-info{{ $p->id }}"
                                                        class="btn btn-primary text-white mr-1"><i class="fa fa-info"></i></a>
                                                </div>
                                                @if ($p->status === 'PAID' && $p->resi === null)
                                                    <a data-toggle="modal" id="update"
                                                        data-target="#modal-edit{{ $p->id }}"
                                                        class="btn btn-dark text-white mr-2"><i class="bi bi-truck"></i></i>
                                                    </a>
                                                    <div class="modal fade" id="modal-edit{{ $p->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modal-judul">Masukkan Resi
                                                                        Pengiriman</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('resi.update', $p->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="Resi"
                                                                                style="color: black;font-weight: bold">Resi</label>
                                                                            <input
                                                                                style="width: 12.375cm;height:1cm;border:0.01;"
                                                                                type="text"
                                                                                class="form-control d-block mb-2"
                                                                                name="resi" required>
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $p->nama }}">
                                                                            <input type="hidden" name="phone_number"
                                                                                value="{{ $p->phone_number }}">
                                                                            <input type="hidden" name="custom"
                                                                                value="{{ $p->custom }}">
                                                                            <input type="hidden" name="email"
                                                                                value="{{ $p->email }}">
                                                                            <input type="hidden" name="kota"
                                                                                value="{{ $p->kota }}">
                                                                            <input type="hidden" name="alamat"
                                                                                value="{{ $p->alamat }}">
                                                                            <input type="hidden" name="product_id"
                                                                                value="{{ $p->product_id }}">
                                                                            <input type="hidden" name="category_id"
                                                                                value="{{ $p->category_id }}">
                                                                            <input type="hidden" name="merchant_ref"
                                                                                value="{{ $p->merchant_ref }}">
                                                                            <input type="hidden" name="amount"
                                                                                value="{{ $p->amount }}">
                                                                            <input type="hidden" name="status"
                                                                                value="{{ $p->status }}">
                                                                            <input type="hidden" name="quantity"
                                                                                value="{{ $p->quantity }}">
                                                                            <input type="hidden" name="delivery_id"
                                                                                value="{{ $p->delivery_id }}">
                                                                            
                                                                            <input type="hidden" name="reference"
                                                                                value="{{ $p->reference }}">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($p->status === 'PAID' && $p->resi !== null )
                                                    <a data-toggle="modal" id="update"
                                                        data-target="#modal-updates{{ $p->id }}"
                                                        class="btn btn-warning mr-2"><i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="https://api.whatsapp.com/send?phone={{ $p->phone_number }}&text=*---------------------Keramik*%20*Kinasih---------------------*%0ANama:%20{{ $p->nama }}%0APesanan:%20{{ $p->product->nama }}%20 {{ $p->quantity }}x%0AResi:%20{{ $p->resi }}%0A*-------------------------------------------------------------*%0A*BARANG*%20*DALAM*%20*PENGIRIMAN*" class="btn btn-success mr-2"><i
                                                        class="fa fa-whatsapp"></i></a>
                                                    <div class="modal fade" id="modal-updates{{ $p->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modal-judul">Edit Resi
                                                                        Pengiriman</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('resi.update', $p->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="Resi"
                                                                                style="color: black;font-weight: bold">Resi</label>
                                                                            <input
                                                                                style="width: 12.375cm;height:1cm;border:0.01;"
                                                                                type="text"
                                                                                class="form-control d-block mb-2"
                                                                                name="resi" required value="{{ $p->resi }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $p->nama }}">
                                                                            <input type="hidden" name="phone_number"
                                                                                value="{{ $p->phone_number }}">
                                                                            <input type="hidden" name="custom"
                                                                                value="{{ $p->custom }}">
                                                                            <input type="hidden" name="email"
                                                                                value="{{ $p->email }}">
                                                                            <input type="hidden" name="kota"
                                                                                value="{{ $p->kota }}">
                                                                            <input type="hidden" name="alamat"
                                                                                value="{{ $p->alamat }}">
                                                                            <input type="hidden" name="product_id"
                                                                                value="{{ $p->product_id }}">
                                                                            <input type="hidden" name="category_id"
                                                                                value="{{ $p->category_id }}">
                                                                            <input type="hidden" name="merchant_ref"
                                                                                value="{{ $p->merchant_ref }}">
                                                                            <input type="hidden" name="amount"
                                                                                value="{{ $p->amount }}">
                                                                            <input type="hidden" name="status"
                                                                                value="{{ $p->status }}">
                                                                            <input type="hidden" name="quantity"
                                                                                value="{{ $p->quantity }}">
                                                                            <input type="hidden" name="delivery_id"
                                                                                value="{{ $p->delivery_id }}">
                                                                            
                                                                            <input type="hidden" name="reference"
                                                                                value="{{ $p->reference }}">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-info{{ $p->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-judul">Detail Pesanan</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="email" style="font-weight:bold;color:black">Kode
                                                            Referensi</label>
                                                        <p style="color:black">{{ $p->reference }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" style="font-weight:bold;color:black">Nama
                                                            Pelanggan</label>
                                                        <p style="color:black">{{ $p->nama }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email"
                                                            style="font-weight:bold;color:black">Alamat</label>
                                                        <p style="color:black">{{ $p->alamat }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama" style="font-weight:bold;color:black">Nama
                                                            Produk</label>
                                                        <p style="color:black">{{ $p->product->nama }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" style="font-weight:bold;color:black">Pesanan
                                                            Tambahan</label>
                                                        <p style="color:black">{{ $p->custom }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dibuat" style="font-weight:bold;color:black">Jumlah
                                                            Beli</label><br>
                                                        <p style="color:black">{{ $p->quantity }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dibuat"
                                                            style="font-weight:bold;color:black">Pengiriman</label><br>
                                                        <p style="color:black">{{ $p->delivery->nama }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="diupdate"
                                                            style="font-weight:bold;color:black">Total</label><br>
                                                        <p style="color:black">{{ $p->amount }}</p>
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
    @endsection
