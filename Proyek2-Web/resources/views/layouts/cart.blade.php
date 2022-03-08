@extends('master.mainWeb')
@include('layouts.navbar')

@section('body')
<section>
    <div class="container">
        <div class="title col-lg-12 mx-auto mt-5">
            <h1>Keranjang Anda</h1>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="table text-center" style="vertical-align: middle">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr >
                        <th scope="row" >1</th>
                        <td ><img  src="https://lh3.googleusercontent.com/-nOHCec7ka04/WPhKvAiX05I/AAAAAAAAPYI/M9MRxpEr8nMBdqWW-qEO2XN9g46OLiOvQCLIB/w1080-h608-p-k-no-v0/" width="150" alt=""></td>
                        <td  >Otto</td>
                        <td>Rp. 30.000</td>
                        <td>2x</td>
                        <td><a href="" class="btn btn-danger"><i class="bi bi-x-lg"></i></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td><img  src="https://lh3.googleusercontent.com/-nOHCec7ka04/WPhKvAiX05I/AAAAAAAAPYI/M9MRxpEr8nMBdqWW-qEO2XN9g46OLiOvQCLIB/w1080-h608-p-k-no-v0/" width="150" alt=""></td>
                        <td>Thornton</td>
                        <td>Rp. 30.000</td>
                        <td>5x</td>
                        <td><a href="" class="btn btn-danger"><i class="bi bi-x-lg"></i></a></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td><img  src="https://lh3.googleusercontent.com/-nOHCec7ka04/WPhKvAiX05I/AAAAAAAAPYI/M9MRxpEr8nMBdqWW-qEO2XN9g46OLiOvQCLIB/w1080-h608-p-k-no-v0/" width="150" alt=""></td>
                        <td>Thornton</td>
                        <td>Rp. 30.000</td>
                        <td>3x</td>
                        <td><a href="" class="btn btn-danger"><i class="bi bi-x-lg"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="total text-center">
                    <h3>Harga Total : Rp. 90.000</h3>
                    <p>Belum termasuk ongkos kirim</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="total text-center">
                    <a href="/form-order" class="btn btn-conf">Konfirmasi <i class="bi bi-check-circle-fill"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection