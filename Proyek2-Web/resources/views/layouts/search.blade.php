@extends('master.mainWeb')
@section('body')

    <section class="product" id="product">
        <div class="container">
            <div class="title col-lg-12 mx-auto">
                <h1>Product</h1>
            </div>
            <section class="product" id="product">
                <form action="/search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search"
                            value="{{ request('search') }}" required>
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </form>
                @if (request('search'))
                @if ($data!==null)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr style="color: black">
                                    <th scope="col">Nama</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr style="color: black">
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->product->nama }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>Rp. {{ number_format($data->amount) }}</td>
                                   
                                    <td>
                                        @if ($data->status == 'PAID')
                                        <span class="px-2 py-1  bg-success  text-white rounded-sm " >
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
                <p>Data Tidak Ditemukan</p>
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
