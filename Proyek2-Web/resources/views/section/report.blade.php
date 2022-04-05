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
