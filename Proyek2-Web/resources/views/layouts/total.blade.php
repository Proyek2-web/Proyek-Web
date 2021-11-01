@extends('master.mainWeb')

@section('body')

<section class="total">
    <h1 style="margin-top: 120px">Konfirmasi Pembayaran</h1>
    <p class="text-center"><i>{{ $detail->customer_name}}</i></p>

    <div class="container-sm">
        <div class="wrap">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Detail Transaksi</p>
                    <p class="text-center"><i>{{ $detail->reference}}</i></p>
                    <hr class="mx-auto">
                </div>
                <div class="col-md-6">
                    <p class="text-center">Harga</p>
                    <p class="text-center">Pengiriman</p>
                    <p class="text-center">Total Tagihan</p>
                </div>
                <div class="col-md-6">
                    @foreach ($detail->order_items as $i)
                    <p class="text-center">Rp.{{ number_format($i->price) }} | {{  $i->quantity}}x</p>
                    @endforeach
                    <p class="text-center">Rp. {{ number_format($detail->amount) }}</p>
                </div>
                <div class="col-md-4 mx-auto">
                    <div class="alert alert-danger d-flex align-items-center" role="alert" style="padding-inline: 30%">
                        <i class="bi bi-exclamation-circle-fill me-2 "></i>
                        <div class="">
                            {{ $detail->status }}
                        </div>
                    </div>
                </div>
                
                <h5 class="mt-5 text-center">Instruksi Pembayaran</h5>
                @foreach ($detail->instructions as $ts)
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ $ts->title }}
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($ts->steps as $s)
                                <li style="list-style-type:none">{{ $loop->iteration }}. {!! $s !!}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
</section>
@endsection