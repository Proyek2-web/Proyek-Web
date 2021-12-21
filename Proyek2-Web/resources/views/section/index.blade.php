@extends('master.main')
@section('container')
    <div class="content-body">
        <!-- row -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card-1">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <i class="bi bi-cart4 fa-3x text-white"></i>
                                <div class="stat-text  text-white">Jumlah Order</div>
                                <hr style="border-top: solid 2px rgb(224, 224, 224)">
                                <h3 class=" text-white">{{ $count0 }}</h3>
                            </div>
                            {{-- <div class="progress">
                                <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-2">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <i class="bi bi-card-list fa-3x text-white"></i>
                                <div class="stat-text text-white">Jumlah Produk</div>
                                <hr style="border-top: solid 2px rgb(224, 224, 224)">
                                <h3 class=" text-white">{{ $count2 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-3">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <i class="bi bi-tags fa-3x text-white"></i>
                                <div class="stat-text text-white">Jumlah Kategori</div>
                                <hr style="border-top: solid 2px rgb(224, 224, 224)">
                                <h3 class=" text-white">{{ $count }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-4">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <i class="bi bi-cash-coin fa-3x text-white"></i>
                                <div class="stat-text text-white">Jumlah Pendapatan</div>
                                <hr style="border-top: solid 2px rgb(224, 224, 224)">
                                <h3 class=" text-white">Rp. {{ number_format($total,0,',','.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
        </div>
    </div>
@endsection
