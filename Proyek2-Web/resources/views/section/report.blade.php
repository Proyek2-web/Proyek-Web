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
                @if($or->status == 'PAID' && $or->resi && $or->order_notes != null)
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pesanan (Pesanan Selesai)</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                @endif
                @break
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
                            <li class="breadcrumb-item active" aria-current="page">Total Pendapatan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <form action="{{ route('report.index') }}" method="GET">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 mb-1">
                                    <label for="date">Dari</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input required type="date" name="from_date" id="from_date" class="form-control" placeholder="Choose a date" id="password-id-icon" value="{{ request('from_date') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <label for="date">Sampai</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input required type="date" name="to_date" id="to_date" class="form-control" placeholder="Choose a date" id="password-id-icon" value="{{ request('to_date') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-1 d-flex">
                                    <div class="dropdown mt-4 me-3">
                                        <button type="submit" class="btn btn-primary loading-search"><i class="bi bi-search"></i></button>
                                    </div>
                                    <div class="refresh mt-4">
                                        <a href="{{ route('report.index') }}" class="btn btn-warning"><i class="bi bi-arrow-repeat"></i></a>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-2 loading-text d-none">Loading ...</div>
                        </div>
                    </form>
                </div>
                <div class="card-header" style="margin-bottom: -20px">
                </div>
                <div class="ms-4 col-md-12 buttons">
                    <form action="{{ request('from_date') && request('to_date') ? route('export-order-parameter') : route('export-order.index') }}" method="GET">
                        @if (request('from_date') && request('to_date'))
                        <input type="hidden" name="fromDate" value="{{ request('from_date') }}">
                        <input type="hidden" name="toDate" value="{{ request('to_date') }}">
                        @endif
                        <button type="submit" class="btn btn-success rounded-3 pl-3 pr-3">Cetak Laporan .xlsx
                            <i class="fa fa-print ml-2"></i></button>
                        <span>Periode:
                            @if (request('from_date') && request('to_date'))
                            {{ \Carbon\Carbon::parse(request('from_date'))->isoFormat('DD MMMM YYYY') }} - {{ \Carbon\Carbon::parse(request('to_date'))->isoFormat('DD MMMM YYYY') }}
                            @else
                            {{\Carbon\Carbon::now()->isoFormat('MMMM YYYY')}}
                            @endif
                        </span>

                    </form>
                </div>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center border px-4 py-2" style="">TIDAK ADA PESANAN</td>
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
