@extends('master.mainWeb')
@include('layouts.navbar')

@section('body')
    <section>
        <div class="container">
            <div class="title col-lg-12 mx-auto mt-5">
                <h1>Riwayat Transaksi</h1>
            </div>
            <form action="#" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="paid" value="">
                <button type="submit" class="btn btn-mahal">
                    Belum Dibayar <i class="bi bi-sort-up"></i>
                </button>
            </form>
            <form action="#" method="GET" enctype="multipart/form-data">

                <input type="hidden" name="unpaid">
                <button type="submit" class="btn btn-murah ">
                   Sudah Dibayar <i class="bi bi-sort-down-alt"></i>
                </button>
            </form>
            <div class="row">
                @foreach ($order as $o)
                    <a href="{{ route('transaction.show',$o->id)}}" style="text-decoration: none;color: black;">
                        <div class="col-md-12 mt-5">
                            <div class="card text-start">
                                <div class="card-header">
                                    {{ $o->merchant_ref }} {{ date('j \\ F Y', strtotime($o->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>


        </div>
    </section>

@endsection
