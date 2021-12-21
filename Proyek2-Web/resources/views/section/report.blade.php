@extends('master.main')
@section('container')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <div class="content-body">
        <!-- row -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-person-fill"></i> Admin </a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Transaksi</li>
            </ol>
        </nav>
        {{-- <p>filter</p>
    <form action="/filter" method="GET">
        <label for="Dari tanggal">
            <input type="text"> 
        </label>
        sampai
        <label for="Sampai">
            <input type="name"> 
        </label>
        <button type="submit" class="btn btn-primary">filter</button>
        
    </form> --}}
        <div class="container">
            <form action="{{ route('report.index') }}" method="GET">
                @csrf
                <div class="d-flex justify-content-center">
                    <input required placeholder="Dari" class="date form-control mr-2 ml-2" name="fromDate" style="width: 20%"
                        type="text" value="{{ request('fromDate') }}">
                    <label for="to" class="mt-2">-</label>
                    <input required placeholder="Sampai" class="date form-control mr-2 ml-2" name="toDate" style="width: 20%"
                        type="text" value="{{ request('toDate') }}">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $('.date').datepicker({
                format: 'yyyy-mm-dd'
            });
        </script>
        <div class="col-lg-12 mt-3">
            <hr>
            <div class="row">
                @forelse ($order as $p)
                    <div class="col-sm-4">
                        <div class="card text-center border-primary"
                            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $p->nama }}</h5>
                                <p class="card-text">{{ $p->reference }}</p>
                                <div class="alert alert-success d-flex align-items-center" role="alert"
                                    style="padding-inline: 30%">
                                    <i class="bi bi-check-square-fill mr-2"></i>
                                    Rp. {{ number_format($p->amount) }}
                                </div>
                                <p class="card-text">{{ date('Y-m-d', strtotime($p->created_at)) }}</p>
                            </div>
                        </div>
                    </div>

                @empty
                    <h2 style="margin-left: 650px; color: silver">Data Tidak Di Temukan</h2>
                @endforelse
            </div>
            {{-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Riwayat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order as $p)
                                    <tr style="color: black">
                                        <th style="line-height: 100px">{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->reference }}</td>
                                        <td>{{ date('Y-m-d', strtotime($p->created_at)) }}</td>
                                        <td>Rp. {{ number_format($p->amount) }}</td>
                                    </tr>
                                </tbody>
                                @empty
                                <tr>
                                    <td colspan="6" class=" px-4 py-2 text-center">
                                       <h2 class="mt-5" style="color: rgba(160, 160, 160, 0.74)">Data tidak ada</h2> 
                                    </td>
                                </tr>
                        @endforelse
                            </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection
