@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

    <section class="product" id="product">
        <div class="container">
            <div class="title col-12 ">
                <p class="title-search">Masukkan Kode Merchant Ref</p>
            </div>
            <section class="product" id="product">
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
                @if ($data!==null)
                <div class="card-body ">
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
                                        <span class="px-2 py-1  bg-success  text-white rounded-sm" >
                                            {{ $data->status }}
                                       </span> 
                                        @else
                                        <span class="px-2 py-1  bg-danger  text-white rounded-sm " >
                                            {{ $data->status }}
                                        </span> 
                                     @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
                @else
                <p class="kode-null">Data Tidak Ditemukan !<i class="bi bi-emoji-frown-fill"></i></p>
                @endif
                
                @endif
                {{-- <div id="list"></div> --}}
            </section>
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
