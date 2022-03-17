@extends('master.mainWeb')
@include('layouts.navbar')

@section('body')
    <section>
        <div class="container">
            <div class="title col-lg-12 mx-auto mt-5">
                <h1>Riwayat Transaksi</h1>
            </div>
            <form action="{{ route('transaction.index') }}" method="GET" enctype="multipart/form-data">
                <button type="submit" class="btn btn-mahal">
                    Belum Dibayar <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="{{ route('transaction.index') }}" method="GET" enctype="multipart/form-data">
                <input type="hidden" name="paid" value="paid">
                <button type="submit" class="btn btn-murah ">
                    Sudah Dibayar <i class="bi bi-sort-down-alt"></i>
                </button>
            </form>
            <form action="{{ route('transaction.index') }}" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="send" value="send">
                <button type="submit" class="btn btn-murah ">
                    Dikirim <i class="bi bi-sort-down-alt"></i>
                </button>
            </form>
            <form action="{{ route('transaction.index') }}" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="receive" value="receive">
                <button type="submit" class="btn btn-murah ">
                    Diterima <i class="bi bi-sort-down-alt"></i>
                </button>
            </form>
            <div class="row">
                @foreach ($order as $o)
                    <form action="{{ route('transaction.show', $o->id) }}" method="GET">
                        @if ($status)
                            <input type="hidden" name="status" value="1">
                        @endif
                        <a style="text-decoration: none;color: black;">
                            <div class="col-md-12 mt-5">
                                <div class="card text-start">
                                    <div class="card-header">
                                        {{ $o->merchant_ref }} {{ date('j \\ F Y', strtotime($o->created_at)) }}
                                        <button class="btn btn-primary" type="submit">Lihat</button>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </form>

                @endforeach
            </div>


        </div>
    </section>

@endsection
