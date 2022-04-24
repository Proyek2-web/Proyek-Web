@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="total" style="margin-top: 170px">
    {{-- <h1 style="margin-top: 120px">Konfirmasi Pembayaran</h1> --}}
    <ol class="arrows">
        <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
        <li><a href="/transaction">Transaksi</a></li>
        <li><a href="#">Detail</a></li>
    </ol>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-7">
                <div class="wrap justify-content-center">
                    @if ($status)
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Pesananmu dalam pengiriman</span>
                            <span class="order">Order - {{ $detail->reference }}</span><br>
                            <div class="input-group mb-3 ">
                                <input disabled class="form-control" value="{{ $order->resi }}"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2" id="myInput"
                                    style="font-size: 0.8rem;font-family: Arial, Helvetica, sans-serif; background-color: transparent">
                                <button onclick="copyResi()" class="input-group-text" id="basic-addon2"
                                    style="font-size: 0.9rem">Copy No. Resi</i></button>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-md-12">
                                    <form action="{{ route('checkout.update', $order->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <input type="hidden" name="received" value="1">
                                        <button class="btn btn-conf p-2" type="submit">Pesanan Diterima <i
                                                class="bi bi-check-circle-fill me-2 "></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/safe-delivery-3686974-3072046.png"
                            width="350" class="img-fluid ms-5" />
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($order->status == 'PAID' && $order->resi != null)
                            <div class="alert alert-success d-flex align-items-center justify-content-center"
                                role="alert" style="padding-inline: 30%">
                                <i class="bi bi-check-circle-fill me-2 "></i>
                                <div>
                                    {{ $order->status }}
                                </div>
                            </div>
                            <div class="detail"> <span class="d-block summery text-center"
                                    style="font-size: 1.2rem">Silahkan
                                    lakukan pelacakan paket sesuai pilihan pengiriman</span> </div>
                            <hr style="width: 100%">
                            <div class="wrap-track d-flex justify-content-center mt-3">
                                <a href="https://www.jne.co.id/id/tracking/trace" style="text-decoration: none">
                                    <div class="card text-center text-dark p-3"
                                        style="margin-inline: 10px; background-color: rgba(169, 169, 170, 0.514); font-weight: bold">
                                        <img src="https://4.bp.blogspot.com/-yKgaARxg8ds/Wg0ZLKrbnpI/AAAAAAAAE9o/lJ3vLsqmUE0k4OPDMd99zynr9I1qVj3ewCLcBGAs/s1600/JNE.png"
                                            width="100" alt="">
                                        <p style="font-style: none; text-decoration: none;">Tracking JNE</p>
                                    </div>
                                </a>
                                <a href="https://www.tiki.id/id/tracking" style="text-decoration: none">
                                    <div class="card text-center text-dark p-3"
                                        style="margin-inline: 10px; background-color: rgba(169, 169, 170, 0.514); font-weight: bold">
                                                                    <img src="
                                        https://www.tikibanjarmasin.com/images/Logo-TIKI.png" width="203" alt="">
                                        <p style="font-style: none; text-decoration: none;">Tracking TIKI</p>
                                    </div>
                                </a>
                                <a href="https://www.posindonesia.co.id/id/tracking" style="text-decoration: none">
                                    <div class="card text-center text-dark p-3"
                                        style="margin-inline: 10px; background-color: rgba(169, 169, 170, 0.514); font-weight: bold">
                                                                    <img src="
                                        https://i0.wp.com/www.desaintasik.com/wp-content/uploads/2019/04/Logo-PT-Pos-Indonesia-png-vector-corel-draw-download-desaintasik.png?resize=328%2C225"
                                        width="110" alt="">
                                        <p style="font-style: none; text-decoration: none;">Tracking POS</p>
                                    </div>
                                </a>
                            </div>
                            @else
                            <div class="alert alert-danger d-flex align-items-center justify-content-center"
                                role="alert" style="padding-inline: 30%">
                                <i class="bi bi-check-circle-fill me-2 "></i>
                                <div id="blink2">
                                    {{ $order->status }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    @if ($order->status == 'UNPAID')
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Segera lakukan pembayaran,
                                {{ $detail->customer_name }}</span>
                            <span class="order">Order - {{ $detail->reference }}</span><br>
                        </div>
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/connect-banking-card-for-online-payment-3323736-2791565.png"
                            width="400" class="img-fluid" />
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                            style="padding-inline: 30%">
                            <i class="bi bi-exclamation-circle-fill me-2 "></i>
                            <div id="blink2">
                                {{ $order->status }}
                            </div>
                        </div>
                        <div class="detail"> <span class="d-block summery text-center"
                                style="font-size: 1.2rem">Silahkan
                                lakukan pembayaran sesuai intruksi di
                                bawah ini</span>
                        </div>
                        <hr style="width: 100%">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($detail->instructions as $ts)
                                <div class="accordion" id="accordionExample"
                                    style="background-color: rgba(204, 203, 202, 0.575)">
                                    <div class="accordion-item mb-3" style="background-color: transparent">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button text-dark collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne"
                                                style="background-color: transparent; font-weight: bold;">
                                                {{ $ts->title }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse "
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body" style="background-color: transparent">
                                                @foreach ($ts->steps as $s)
                                                <li style="list-style-type:none">
                                                    {{ $loop->iteration }}. {!! $s !!}
                                                </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @elseif($order->order_notes != null )
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Horeee, Pesananmu sudah sampai
                                {{ $detail->customer_name }}</span>
                            <span class="order">Order - {{ $detail->reference }}</span><br>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/762/762152.png" width="320"
                            class="img-fluid" />
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                            style="padding-inline: 30%">
                            <i class="bi bi-exclamation-circle-fill me-2 "></i>
                            <div>
                                {{ $order->status }}
                            </div>
                        </div>
                        <div class="detail"> <span class="d-block summery text-center" style="font-size: 1.2rem">Pesanan
                                Di Terima</span>
                        </div>

                        <hr style="width: 100%">
                    </div>
                    @else
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Terima kasih <br> telah melakukan
                                pembayaran, <br> {{ $detail->customer_name }}</span>
                            <span class="order">Order - {{ $detail->reference }}</span><br>
                        </div>
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/successful-payment-2161433-1815075.png"
                            width="380" class="img-fluid" />
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                            style="padding-inline: 30%">
                            <i class="bi bi-exclamation-circle-fill me-2 "></i>
                            <div>
                                {{ $order->status }}
                            </div>
                        </div>
                        <div class="detail"> <span class="d-block summery text-center" style="font-size: 1.2rem">Pesanan
                                Di Proses</span>
                        </div>

                        <hr style="width: 100%">
                    </div>
                    @endif
                    @endif


                </div>
            </div>
            <div class="col-md-5">
                <div class="wrap-nota p-4 mb-5" style="background-color: #c9c9c946; border-radius: 25px 5px 25px 5px">
                    <h4 style="font-family: Marck Script; font-size: 2rem" class=" theme-color mb-5">Thanks for your
                        order !</h4>
                    <span class="theme-color" style="font-family: PT Serif; font-size: 1.2rem">Ringkasan Pesanan</span>
                    <div class="mb-3">
                        <hr class="new1" style="width: 50%">
                    </div>
                    @foreach ($data as $d)
                    <div class="card mb-3 border-0"
                        style="max-width: 445px; font-family: PT-Serif; background-color: rgba(226, 230, 230, 0.029); border-radius: 10px;">
                        <div class="row g-0 align-items-center ">
                            <div class="col-md-4">
                                <img src="/cover_product/{{ $d->featured_image }}" class="img-fluid" alt="..."
                                    style="border-radius: 10px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize" style="font-weight: bold">
                                        {{ $d->nama }}</h5>
                                    <p class="card-text text-light"> <span
                                            style="border-radius: 8px; padding-inline: 20px; padding-block: 5px; font-weight: bold; background-color: #51698687; font-size: 14px">Rp.
                                            {{ number_format($d->harga, 2) }}</span> </p>
                                    <p class="card-text text-light"><small
                                            style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #252535a2">Jumlah
                                            : {{ $d->qty }}</small></p>
                                    <p class="card-text text-dark"><small
                                            style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #25253529">Sub
                                            Total
                                            : {{ number_format($d->harga * $d->qty, 2) }}</small></p>
                                    <p class="card-text text-dark"><small
                                            style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #1212b329">Catatan
                                            : {{ $d->catatan !=null?$d->catatan:'-' }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                    @endforeach
                    @foreach ($data as $d)
                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">Total order</span>
                        <span class="text-muted">Rp. {{ number_format($d->total_produk) }}</span>
                    </div>
                    <div class="d-flex justify-content-between"> <small>Pengiriman</small> <small>Rp.
                            {{ number_format($d->total_ongkir) }}</small> </div>
                    <div class="d-flex justify-content-between">
                        <small><b>{{ Str::of($d->delivery)->limit(110)->upper() }}</b></small>
                        <small></small>
                    </div>
                    <div class="d-flex justify-content-between"> <small><b>Estimasi Dikirim ({{ $d->hari }} hari)+(5
                                hari produksi)</b></small>
                    </div>
                    @break
                    @endforeach

                    <div class="d-flex justify-content-between mt-3 bg-light p-2"> <span
                            style="font-weight: bold">Total</span> <span class="font-weight-bold theme-color"
                            style="font-weight: bold">Rp. {{ number_format($detail->amount) }}</span> </div>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            var blink = document.getElementById('blink2');
            setInterval(function () {
                blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
            }, 800);
        </script>
        <script type="text/javascript">
            function copyResi() {
                /* Get the text field */
                var copyText = document.getElementById("myInput");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("Nomor resi berhasil di salin: " + copyText.value);
            }
        </script>

</section>

@endsection


{{-- <section class="total" style="margin-top: 170px">
    <h1 style="margin-top: 120px">Konfirmasi Pembayaran</h1>

    <div class="container-sm">
        <div class="row">
            <div class="col-md-7">
                <div class="wrap justify-content-center">
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info"> <span class="d-block name">Thank You, {{ $detail->customer_name}}</span>
<span class="order">Order - {{ $detail->reference}}
</span> </div> <img
    src="https://cdni.iconscout.com/illustration/premium/thumb/connect-banking-card-for-online-payment-3323736-2791565.png"
    width="400" class="img-fluid" />
</div>
<div class="col-md-12">
    @if ($order->status == 'PAID')
    <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2 "></i>
        <div>
            {{ $order->status }}
        </div>
    </div>
    <div class="detail"> <span class="d-block summery text-center" style="font-size: 1.2rem">Terima Kasih telah
            melakukan pembayaran, pesanan dalam proses</span> </div>
    @else
    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2 "></i>
        <div id="blink2">
            {{ $order->status }}
        </div>
    </div>
    <div class="detail"> <span class="d-block summery text-center" style="font-size: 1.2rem">Silahkan lakukan pembayaran
            sesuai intruksi di
            bawah ini</span> </div>
    <hr style="width: 100%">
    @foreach ($detail->instructions as $ts)
    <div class="accordion" id="accordionExample" style="background-color: rgba(204, 203, 202, 0.575)">
        <div class="accordion-item mb-3" style="background-color: transparent">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button text-dark collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                    style="background-color: transparent; font-weight: bold;">
                    {{ $ts->title }}
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body" style="background-color: transparent">
                    @foreach ($ts->steps as $s)
                    <li style="list-style-type:none">{{ $loop->iteration }}. {!! $s !!}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>

</div>
</div>
<div class="col-md-5">
    <div class="wrap-nota p-4 mb-5" style="background-color: #25253546; border-radius: 25px 5px 25px 5px">
        <h4 style="font-family: Marck Script; font-size: 2rem" class=" theme-color mb-5">Thanks for your order !</h4>
        <span class="theme-color" style="font-family: PT Serif; font-size: 1.2rem">Ringkasan Pesanan</span>
        <div class="mb-3">
            <hr class="new1" style="width: 50%">
        </div>
        @foreach ($data as $d)
        <div class="card mb-3 border-0"
            style="max-width: 445px; font-family: PT-Serif; background-color: rgba(226, 230, 230, 0.029); border-radius: 10px;">
            <div class="row g-0 align-items-center ">
                <div class="col-md-4">
                    <img src="{{ asset('/storage/' . $d->featured_image) }}" class="img-fluid" alt="..."
                        style="border-radius: 10px">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize" style="font-weight: bold">
                            {{ $d->nama }}</h5>
                        <p class="card-text text-light"> <span
                                style="border-radius: 8px; padding-inline: 20px; padding-block: 5px; font-weight: bold; background-color: #51698687; font-size: 14px">Rp.
                                {{ number_format($d->harga, 2) }}</span> </p>
                        <p class="card-text text-light"><small
                                style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #252535a2">Jumlah
                                : {{ $d->qty }}</small></p>
                        <p class="card-text text-dark"><small
                                style="border-radius: 5px; padding-inline: 15px; padding-block: 5px; background-color: #25253529">Sub
                                Total
                                : {{ number_format(($d->harga * $d->qty), 2)  }}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="line"></div>
        @endforeach
        @foreach ($data as $d)
        <div class="d-flex justify-content-between"> <span class="font-weight-bold">Total order</span> <span
                class="text-muted">Rp. {{ number_format($d->total_produk) }}</span> </div>
        <div class="d-flex justify-content-between"> <small>Pengiriman</small> <small>Rp.
                {{number_format($d->total_ongkir)}}</small> </div>
        @break
        @endforeach

        <div class="d-flex justify-content-between mt-3 bg-light p-2"> <span style="font-weight: bold">Total</span>
            <span class="font-weight-bold theme-color" style="font-weight: bold">Rp.
                {{ number_format($detail->amount) }}</span> </div>
    </div>
</div>

</div>
<script type="text/javascript">
    var blink = document.getElementById('blink2');
    setInterval(function () {
        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 800);
</script>
</section> --}}