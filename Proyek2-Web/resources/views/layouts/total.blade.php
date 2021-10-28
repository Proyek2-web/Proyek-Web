@extends('master.mainWeb')

@section('body')
    <section class="total">
        <h1 style="margin-top: 120px">Total Harga</h1>
        <div class="container-total">
            <div class="row py-5 mb-5">
                <div class="col-md-6">
                   <h4 class="text-center">Jumlah Total</h4>
                </div>
                <div class="col-md-6">
                    <h4 class="text-center">Rp.200.000</h4>
                </div>
                <hr class="kuitansi mx-auto">
                <div class="col-md-6">
                   <p class="text-center">Vas Bunga Motif</p>
                </div>
                {{-- <div class="col-md-2">
                   <p class="text-center">4x</p>
                </div> --}}
                <div class="col-md-6">
                    <p class="text-center">2X | Rp.150.000</p>
                </div>
                <div class="col-md-6">
                   <p class="text-center">Pengiriman JNT</p>
                </div>
                <div class="col-md-6">
                    <p class="text-center">Rp.50.000</p>
                </div>
                <hr class="kuitansi mx-auto">
                <p class="text-center">Silahkan melakukan pembayaran pada No. Rekening Di bawah</p>
                <h4 class="text-center"><i class="bi bi-bank2"></i> 843739273931</h4>
                <div class="col-md-12 text-center mt-5">
                    <a href="#" class="btn btn-dark">Kirim Bukti Pembayaran</a>
                 </div>
                
            </div>
        </div>
    </section>
@endsection