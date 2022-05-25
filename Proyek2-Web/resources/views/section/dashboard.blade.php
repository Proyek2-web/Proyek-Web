@extends('master.main');
@section('body')
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total produk</h6>
                                    @php
                                    $harga_total = \App\Models\Product::select("*")
                                    ->sum('harga');
                                    @endphp
                                    <h6 class="font-extrabold mb-0">Rp. {{ number_format($harga_total) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <img src="https://cdn2.iconfinder.com/data/icons/business-management-2-12/66/161-512.png" width="35" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Proses</h6>
                                    @php
                                        $order = \App\Models\Order::all()
                                        ->where('status', '=', 'PAID') 
                                        ->where('order_notes','==',null)
                                        ->sum('amount');
                                    @endphp
                                    <h6 class="font-extrabold mb-0">Rp. {{ number_format($order) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <img src="https://icons.veryicon.com/png/o/system/linear-chh/order-fulfillment-1.png" width="40" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Transaksi</h6>
                                    @php
                                    $orders = \App\Models\Order::select("*")
                                     ->where('status', '=', 'PAID')
                                     ->where('resi', '!=', null)
                                     ->where('order_notes','!=',null)
                                    ->sum('amount');
                                    @endphp
                                    <h6 class="font-extrabold mb-0">Rp. {{ number_format($orders) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <img src="https://i.pinimg.com/originals/1a/ca/e0/1acae0f9d418461f2bda666c101bffc7.png" width="40" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pendapatan</h6>
                                    @php
                                    $orders = \App\Models\Order::select("*")
                                     ->where('status', '=', 'PAID')
                                     ->where('resi', '!=', null)
                                     ->where('order_notes','!=',null)
                                    ->sum('total_produk');
                                    @endphp
                                    <h6 class="font-extrabold mb-0">Rp. {{ number_format($orders) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Proses Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        @forelse ($recent_order_proses as $p)
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nomor Merchant</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    {{ $loop->iteration }}
                                                    <p class="font-bold ms-3 mb-0">{{ $p->nama }}</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">{{ $p->merchant_ref }}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Rp.{{ number_format( $p->amount) }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <h5 class="text-muted text-center">KOSONG</h5>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Selesai Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        @forelse ($recent_order as $o)
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nomor Merchant</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    {{ $loop->iteration }}
                                                    <p class="font-bold ms-3 mb-0">{{ $o->nama }}</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">{{ $o->merchant_ref }}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Rp.{{ number_format( $o->amount) }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <h5 class="text-muted text-center">KOSONG</h5>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card" style="background-color: #909396f3">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center" style="margin-top: -30px">
                        <div class="avatar avatar-xl">
                            <img src="https://img.icons8.com/bubbles/500/admin-settings-male.png" alt="Face 1">
                        </div>
                        <div class="ms-3 name mt-5">
                            @if (Auth::check())
                            <h5 class="font-bold text-light">{{ Auth::user()->name}}</h5>
                            <h6 class="text-dark mb-0" style="font-size: 0.8rem">{{ Auth::user()->email}}</h6>
                            <form action="/logout" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-primary mt-3" style="padding: 5px 10px; font-size: 0.7rem"> <i
                                        class="bi bi-box-arrow-left me-1 "></i> LOGOUT</button>
                            </form>
                            @else
                            <h5 class="font-bold">Tidak ada User</h5>
                            <h6 class="text-muted mb-0">@xxxx</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Daftar user terbaru</h4>
                </div>
                <div class="card-content pb-4">
                    @foreach ($recent_user as $u)
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="assets/images/faces/4.jpg">
                        </div>
                        <div class="name ms-4" style=" overflow: hidden; white-space: nowrap;text-overflow: ellipsis;">
                            <h5 style=" overflow: hidden; white-space: nowrap;text-overflow: ellipsis;" class="mb-1">{{ $u->name}}</h5>
                            <h6 style=" overflow: hidden; white-space: nowrap;text-overflow: ellipsis;" class="text-muted mb-0">{{ $u->email }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Order Masuk Terbaru</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nomor Merchant</th>
                                    <th>Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recent_order_in as $r)
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            {{ $loop->iteration }}
                                            <p class="font-bold ms-3 mb-0">{{ $r->nama }}</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class=" mb-0">{{ $r->merchant_ref }}</p>
                                    </td>
                                    <td class="col-auto">
                                        <p class=" mb-0">Rp.{{ number_format( $r->amount) }}</p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class="text-muted text-center">KOSONG</h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection