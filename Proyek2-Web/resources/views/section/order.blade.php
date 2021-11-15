@extends('master.main')
@section('container')
<div class="content-body">
    <!-- row -->
    <h1 class="mb-3 ml-4">Pesanan</h1>
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
                <h4 class="card-title">Data Pesanan</h4>
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" style="border-radius:6px;border: 1px solid black " placeholder="Search">
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
                                <th scope="col">Nomor WA</th>
                                {{-- <th scope="col">Catatan</th> --}}
                                {{-- <th scope="col">Email</th> --}}
                                {{-- <th scope="col">Alamat</th> --}}
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $p)
                            <tr style="color: black">
                                <th style="line-height: 100px">{{ $loop->iteration }}</th>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->phone_number }}</td>
                                <td>{{ $p->product->nama }}</td>
                                <td>{{ $p->quantity }}</td>
                                <td>Rp. {{ number_format($p->amount) }}</td>
                               
                                <td>
                                    @if ($p->status == 'PAID')
                                    <span class="px-2 py-1  bg-success  text-white rounded-sm " >
                                        {{ $p->status }}
                                   </span> 
                                    @else
                                    <span class="px-2 py-1  bg-danger  text-white rounded-sm " >
                                        {{ $p->status }}
                                    </span> 
                                 @endif
                                </td>
                                
                                <td>
                                    <div class="aksi d-flex">
                                        <a href="{{ route('nota.cetak', $p->id) }}" class="btn btn-light mr-2"><i class="fa fa-print"></i></a>
                                            <div class="aksi d-flex">
                                                <a data-toggle="modal" id="updateAdmin" data-target="#modal-info{{$p->id}}"
                                                    class="btn btn-info mr-2"><i class="fa fa-info"></i></a>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-info{{$p->id}}">
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
                                                <label for="email" style="font-weight:bold;color:black">Kode Referensi</label>
                                                <p style="color:black">{{ $p->reference}}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:bold;color:black">Nama Pelanggan</label>
                                                <p style="color:black">{{ $p->nama }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:bold;color:black">Alamat</label>
                                                <p style="color:black">{{ $p->alamat }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:bold;color:black">Kota / Provinsi</label>
                                                <p style="color:black">{{ $p->kota}}, {{ $p->state->name }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" style="font-weight:bold;color:black">Nama Produk</label>
                                                <p style="color:black">{{ $p->product->nama }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="font-weight:bold;color:black">Pesanan Tambahan</label>
                                                <p style="color:black">{{ $p->custom }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="dibuat" style="font-weight:bold;color:black">Jumlah Beli</label><br>
                                                <p style="color:black">{{ $p->quantity }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="dibuat" style="font-weight:bold;color:black">Pengiriman</label><br>
                                                <p style="color:black">{{ $p->delivery->nama }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="diupdate" style="font-weight:bold;color:black">Total</label><br>
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
    {{-- <div class="d-block float-right">
        {{$orders->links() }}
    </div> --}}
    {{-- <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#modal-default">
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
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control mb-2" name="nama" id="nama_produk"
                                placeholder="Masukkan nama produk....." required>
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control mb-2" name="harga" id="harga"
                                placeholder="Masukkan harga produk......" required>
                            <label for="nama">Kategori</label>
                            <select class="form-select form-select-lg w-100" name="category_id">
                                @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-2 mb-3">
                                <label for="featured_image" class="form-label">Gambar Produk</label>
                                <input
                                    class="form-control  @error('featured_image') is-invalid @enderror form-control-sm"
                                    id="featured_image" type="file" name="featured_image">
                                @error('featured_image')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control mb-2" name="keterangan" id="keterangan"
                                placeholder="Masukkan keterangan produk...." required>
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

    name.addEventListener('change', function () {
        fetch('/product/checkSlug?name=' + name.value)
        dd(name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script> --}}
@endsection