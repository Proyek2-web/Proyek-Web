@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

    <section class="product" id="product">
        <div class="container">
            <div class="wrap-content">
                <div class="title col-12">
                    <p class="title-search">Masukkan kode reference</p>
                    <p class="text-center">Contoh : DEV - ***************</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form action="/search">
                            <div class="input-group mb-3 ">
                                <input type="text" class="form-control" id="search" placeholder="Search" name="search"
                                    value="{{ request('search') }}" required>
                                <button class="btn btn-warning" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (request('search'))
                    @if ($data !== null)
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            
                                            <button class="accordion-button collapsed fw-bold text-uppercase" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                {{ $data->nama }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body text-center">
                                                <p>Produk : <span class="fw-bolder">{{ $data->product->nama }} |
                                                        {{ $data->quantity }}pcs (Rp.
                                                        {{ number_format($data->product->harga, 0, ',', '.') }} / pcs)</span>
                                                </p>
                                                <hr class="search mx-auto">
                                                <p>Pengiriman : <span class="fw-bolder">{{ $data->delivery->nama }} |
                                                        (Rp. {{ number_format($data->delivery->harga, 0, ',', '.') }})</span>
                                                </p>
                                                <hr class="search mx-auto">
                                                <h6>Total Pembayaran : <span class="fw-bolder">Rp.
                                                        {{ number_format($data->amount) }}</span></h6>
                                                <hr class="search-total mx-auto">
                                                <div class="col-md-4 mx-auto">
                                                    @if ($data->status == 'PAID')
                                                        <div class="alert alert-success d-flex align-items-center"
                                                            role="alert" style="padding-inline: 30%">
                                                            <i class="bi bi-check-square-fill me-2"></i>
                                                            <div class="">
                                                                {{ $data->status }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="alert alert-danger d-flex align-items-center"
                                                            role="alert" style="padding-inline: 30%">
                                                            <i class="bi bi-exclamation-circle-fill me-2 "></i>
                                                            <div class="">
                                                                {{ $data->status }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr style="color: white">
                                            <th scope="col">Nama</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="color: rgb(255, 255, 255)">
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->product->nama }}</td>
                                            <td>{{ $data->quantity }}</td>
                                            <td>Rp. {{ number_format($data->amount) }}</td>

                                            <td>
                                                @if ($data->status == 'PAID')
                                                    <span class="px-2 py-1  bg-success  text-white rounded-sm">
                                                        {{ $data->status }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1  bg-danger  text-white rounded-sm ">
                                                        {{ $data->status }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    @else
                        <p class="kode-null">Data Tidak Ditemukan !<i class="bi bi-emoji-frown-fill"></i></p>
                    @endif

                @endif
            </div>
            {{-- <div id="list"></div> --}}
        </div>
    </section>
    {{-- <script type="text/javascript">
        $(document).ready(function () {
         
            $('#search').on('keyup',function() {
                var query = $(this).val(); 
                $.ajax({
                   
                    url:"{{ route('search') }}",
              
                    type:"GET",
                   
                    data:{'search':query},
                   
                    success:function (data) {
                      
                        $('#list').html(data);
                    }
                })
                // end of ajax call
            });
    
            
            $(document).on('click', 'li', function(){
              
                var value = $(this).text();
                $('#search').val(value);
                $('#list').html("");
            });
        });
    </script> --}}
@endsection
