@extends('master.main')
@section('container')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <div class="content-body">
        <!-- row -->
        <h1 class="mb-3 ml-4">Riwayat Transaksi</h1>
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
                    <label for="from"> Dari</label>
                    <input required class="date form-control mr-2" name="fromDate" style="width: 20%" type="text" value="{{ request('fromDate') }}">
                    <label for="to">Sampai</label>
                    <input required class="date form-control mr-2" name="toDate" style="width: 20%" type="text" value="{{ request('toDate') }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $('.date').datepicker({
                format: 'yyyy-mm-dd'
            });

        </script>
        <div class="col-lg-12 mt-3">
            <div class="card">
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
                                @foreach ($order as $p)
                                    <tr style="color: black">
                                        <th style="line-height: 100px">{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->reference }}</td>
                                        <td>{{ date('Y-m-d', strtotime($p->created_at)) }}</td>
                                        <td>Rp. {{ number_format($p->amount) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
