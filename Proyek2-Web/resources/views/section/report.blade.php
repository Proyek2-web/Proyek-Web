@extends('master.main')
@section('container')
<div class="content-body">
    <!-- row -->
    <h1 class="mb-3 ml-4">Total Pendapatan</h1>
    <div class="col-lg-12">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Detail Pendapatan</div>
                        <div class="stat-digit">Rp. {{ number_format($total,0,',','.') }}</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
    
    <p></p>
</div>
@endsection
