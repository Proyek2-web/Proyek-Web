@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')


<section class="total" style="margin-top: 170px">
    {{-- <h1 style="margin-top: 120px">Konfirmasi Pembayaran</h1> --}}

    <div class="container-sm">
        <div class="row">
            <div class="col-md-7">
                <div class="wrap justify-content-center">
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Thank You, {{ $detail->customer_name}}</span> <span class="order">Order - {{ $detail->reference}}
                        </span> </div> <img src="https://cdni.iconscout.com/illustration/premium/thumb/connect-banking-card-for-online-payment-3323736-2791565.png" width="400"  class="img-fluid" />
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="padding-inline: 30%">
                            <i  class="bi bi-exclamation-circle-fill me-2 "></i>
                            <div id="blink2">
                                {{ $detail->status }}
                            </div>
                        </div>
                    </div>
                    <div class="detail"> <span class="d-block summery">Silahkan lakukan pembayaran sesuai intruksi di bawah ini</span> </div>
                    <hr style="width: 100%">
                    @foreach ($detail->instructions as $ts)
                        <div class="accordion" id="accordionExample" style="background-color: rgba(204, 203, 202, 0.575)">
                            <div class="accordion-item mb-3" style="background-color: transparent">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button text-dark collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: transparent; font-weight: bold;">
                                        {{ $ts->title }}
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body" style="background-color: transparent">
                                        @foreach ($ts->steps as $s)
                                        <li style="list-style-type:none" >{{ $loop->iteration }}. {!! $s !!}</li>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        @endforeach
                </div>
            </div>
            <div class="col-md-5">
                <div class="wrap-nota p-4" style="background-color: rgb(221, 220, 219)">
                    <h4 style="font-family: Marck Script;" class=" theme-color mb-5">Thanks for your order !</h4> <span class="theme-color">Ringkasan Pembayaran</span>
                    <div class="mb-3">
                        <hr class="new1">
                    </div>
                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">Total order</span> <span class="text-muted">$1750.00</span> </div>
                    <div class="d-flex justify-content-between"> <small>Pengiriman</small> <small>$175.00</small> </div>
                    <div class="d-flex justify-content-between mt-3 bg-light p-2"> <span style="font-weight: bold">Total</span> <span class="font-weight-bold theme-color" style="font-weight: bold">Rp. {{ number_format($detail->amount) }}</span> </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var blink = document.getElementById('blink2');
            setInterval(function () {
                blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
            }, 800);
        </script>
</section>
@endsection