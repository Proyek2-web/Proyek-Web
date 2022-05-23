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
            @forelse ($orders as $or)
            @if ($or->status == 'UNPAID' && $or->resi == null)
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan (Belum Bayar)</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            @break
            @continue
            @elseif($or->status == 'PAID' && $or->resi == null)
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan (Di Proses)</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            @break
            @continue
            @elseif($or->status == 'PAID' && $or->resi && $or->order_notes == null)
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan (Di Kirim)</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            @break
            @continue
            @elseif($or->status == 'PAID' && $or->resi && $or->order_notes != null)
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan (Pesanan di terima)</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            @break
            @endif
            @empty
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kosong</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            @endforelse
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a style="color: #222237" href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table" id="table1" style="table-layout: fixed; width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 50px">No.</th>
                            <th>Tanggal Pesanan</th>
                            <th>Nama Penerima</th>
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
                            <td>{!! date('d M y', strtotime($o->created_at)) !!}</td>
                            <td>{{ $o->nama }}</td>
                            <td>{{ $o->merchant_ref }}</td>
                            <td>{{ $o->user->name }}</td>
                            <td>Rp.{{ number_format($o->amount,0) }}</td>
                            @if ($o->status == 'UNPAID')
                            <td><span class="badge bg-danger">UNPAID</span></td>
                            @elseif($o->status == 'PAID' && $o->order_notes != null)
                            <td><span class="badge bg-success">SELESAI</span></td>
                            @elseif($o->status == 'PAID' && $o->resi && $o->order_notes == null)
                            <td><span class="badge bg-dark">Di Kirim</span></td>
                            @elseif($o->status == 'PAID' && $o->resi == null)
                            <td><span class="badge bg-warning">PAID</span></td>
                            @endif
                            <td>
                                <div class="aksi d-flex justify-content-center">
                                    <a data-bs-toggle="modal" id="update" data-bs-target="#modal-info{{ $o->id }}"
                                        class="btn btn-primary me-2"><i class="fa fa-info"></i>
                                    </a>
                                    @if (!$status)
                                    <a data-bs-toggle="modal" id="update" data-bs-target="#modal-edit{{ $o->id }}"
                                        class="btn btn-secondary me-2"><i class="fa fa-truck"></i>
                                    </a>
                                    @endif
                                    <!--Basic Modal info user-->
                                    <div class="modal fade text-left" id="modal-info{{ $o->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="myModalLabel1">Detail
                                                        data
                                                        pesanan {!! date('d M y', strtotime($o->created_at)) !!}</h5>
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
                                                        <textarea class="form-control mb-2" cols="20" rows="5" disabled>- {{ $p->nama }} : {{ $c->qty }} pcs  
- Catatan: {{ $c->catatan !=null?$c->catatan:'-' }}. 
- Status Produk: {{ $c->status_produk }}</textarea>

                                                        @endif
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Nomor HP</label>
                                                        <input type="text" class="form-control" name="harga"
                                                            placeholder="Masukkan email" value="{{ $o->phone_number }}"
                                                            disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            placeholder="Masukkan email" value="{{ $o->email }}"
                                                            disabled>
                                                    </div>
                                                    @php
                                                    $tabel = DB::table('cities')
                                                    ->join('provinces', 'cities.province_id', '=',
                                                    'provinces.province_id')
                                                    ->select('cities.name','cities.city_id','cities.province_id','provinces.name as nama_provinsi')
                                                    ->where('cities.province_id','=',$o->province_id)
                                                    ->where('cities.city_id','=',$o->city_id)
                                                    ->get();
                                                    foreach ($tabel as $c) {
                                                    $kota = $c->name;
                                                    $prop = $c->nama_provinsi;
                                                    }
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="basicInput">Alamat Pengiriman</label>

                                                        <textarea class="form-control" cols="20" rows="5"
                                                            disabled>{{ $o->alamat }}. 
{{ $kota }}, {{ $prop }}, ID {{ $o->zip_code }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Total Biaya</label>
                                                        <textarea class="form-control" cols="20" rows="5"
                                                        disabled>Total Produk = Rp.{{ $o->total_produk }}
Total Ongkir = Rp.{{ $o->total_ongkir }}
----------------------------------- 
Total Seluruh = Rp.{{ $o->amount }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Nomor Pesanan</label>
                                                        <input type="text" class="form-control" name="roles"
                                                            placeholder="Masukkan email" value="{{ $o->merchant_ref }}"
                                                            disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Jasa Pengiriman</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan email"
                                                            value="{{ Str::of($o->delivery)->limit(110)->upper() }}"
                                                            disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Nomor Resi</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Resi Kosong"
                                                            value="{{ $o->resi }}"
                                                            disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basicInput">Estimasi</label>
                                                        <input type="text" class="form-control" name="alamat"
                                                            placeholder="Masukkan email"
                                                            value="{{ $o->day }} + 5 hari mendatang" disabled>
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
                                    <div class="modal fade text-left" id="modal-edit{{ $o->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <form action="{{ route('order.update', $o->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="myModalLabel1">
                                                            Input Resi</h5>
                                                        <button type="button" class="close rounded-pill"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="basicInput">Masukkan Resi</label>
                                                            <input name="resi" required type="text" class="form-control"
                                                                placeholder="Masukkan Resi">
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
                                                        <button type="submit" class="btn btn-primary">
                                                            Kirim
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center border px-4 py-2" style="">PESANAN KOSONG</td>
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