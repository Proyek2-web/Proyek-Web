@extends('master.main')
@section('body')
<style>
    table.dataTable td {
        padding: 15px 8px;
    }

    .fontawesome-icons .the-icon svg {
        font-size: 24px;
    }
</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Produk</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a style="color: #222237" href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary ml-3 p-2" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah">
                    Tambah data produk <i class="fa fa-plus ms-2"></i>
                </button>
                <!--Basic Modal Tambah Produk-->
                <div class="modal fade text-left" id="modal-tambah" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="myModalLabel1">Tambah Data Produk</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical" action="{{ route('product.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="basicInput">Nama Produk</label>
                                        <input name="nama" type="text" class="form-control" id="nama_produk"
                                            placeholder="Masukkan nama produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Harga Produk</label>
                                        <input type="number" class="form-control" name="harga" id="harga"
                                            placeholder="Masukkan harga produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Berat Produk (gr)</label>
                                        <input type="number" class="form-control" id="berat" name="berat"
                                            placeholder="Masukkan berat produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Kategori Produk</label>
                                        <select class="choices form-select" name="category_id" required>
                                            @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="formFileSm" class="form-label">Gambar Cover Produk</label>
                                        <input class="form-control form-control-sm" type="file" name="featured_image"
                                            id="cover" required>
                                    </div>
                                    <img id="preview-image"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKrp91TeEJpAvzANkhTLnk8nY0qxC-xwB4AxKG-uLdEYh8IAXoQtCLMg4FxrBLV_1DREE&usqp=CAU"
                                        alt="" style="width: 30%">
                                    <div class="mb-2 mt-3">
                                        <label for="formFileSm" class="form-label">Gambar
                                            Produk</label>
                                        <input id="images" class="form-control form-control-sm" type="file"
                                            name="images[]" multiple required>
                                    </div>
                                    <div class="images-preview-div"></div>
                                    <div class="mb-2 mt-3">
                                        <label for="formFileSm" class="form-label">Video Produk</label>
                                        <input class="form-control form-control-sm" type="file" name="video_product"
                                            id="video" required accept="video/*">
                                    </div>
                                    <div class="form-group with-title mb-3 mt-3">
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                            required></textarea>
                                        <label>Deskripsi Produk</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tambah</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table1" style="table-layout: fixed; width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 50px">No.</th>
                            <th>Name</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Berat</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $p)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $p->nama }}</td>
                            <td><img src="cover_product/{{ $p->featured_image }}" width="80" height="100" alt="">
                            </td>
                            <td>{{ $p->category->name }}</td>
                            <td>{{ $p->berat}}gr</td>
                            <td>Rp. {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td style=" overflow: hidden; white-space: nowrap;text-overflow: ellipsis;">
                                {{ $p->keterangan }}</td>
                            <td>
                                <div class="aksi d-flex justify-content-center">
                                    <a data-bs-toggle="modal" id="update" data-bs-target="#modal-edit{{ $p->id }}"
                                        class="btn btn-warning me-2"><i class="fa fa-edit"></i>
                                    </a>
                                    <!--Basic Modal update Produk-->
                                    <div class="modal fade text-left" id="modal-edit{{ $p->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="myModalLabel1">Update Data
                                                        Produk</h5>
                                                    <button type="button" class="close rounded-pill"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('product.update', $p->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="basicInput">Nama Produk</label>
                                                            <input name="nama" type="text" class="form-control"
                                                                id="nama_produk" placeholder="Masukkan nama produk"
                                                                required value="{{ $p->nama }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="basicInput">Harga Produk</label>
                                                            <input type="number" class="form-control" name="harga"
                                                                id="harga" placeholder="Masukkan harga produk"
                                                                value="{{ $p->harga }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="basicInput">Berat Produk (gr)</label>
                                                            <input type="number" class="form-control" id="berat"
                                                                name="berat" placeholder="Masukkan berat produk"
                                                                value="{{ $p->berat }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="basicInput">Kategori Produk</label>
                                                            <select class="choices form-select" name="category_id"
                                                                required>
                                                                @foreach ($categories as $c)
                                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="formFileSm" class="form-label">Ganti Gambar
                                                                Cover
                                                                Produk</label>
                                                            <input class="form-control form-control-sm" type="file"
                                                                name="featured_image">
                                                        </div>
                                                        <img src="/cover_product/{{ $p->featured_image }}" alt=""
                                                            style="width: 20%">
                                                        <div class="mb-2 mt-3">
                                                            <label for="formFileSm" class="form-label">Tambah Gambar
                                                                Produk</label>
                                                            <input class="form-control form-control-sm" type="file"
                                                                name="images[]" multiple>
                                                        </div>
                                                        @foreach ($p->images as $img)

                                                        <img src="/image_product/{{ $img->image }}" alt=""
                                                            style="width: 20%">
                                                        @endforeach
                                                        <div class="mb-2 mt-3">
                                                            <label for="formFileSm" class="form-label">Video Produk</label>
                                                            <input class="form-control form-control-sm" type="file" name="video_product"
                                                                id="video" required accept="video/*">
                                                        </div>
                                                        <div class="form-group with-title mb-3 mt-3">
                                                            <textarea class="form-control" name="keterangan"
                                                                id="keterangan" rows="3">{{ $p->keterangan }}</textarea>
                                                            <label>Deskripsi Produk</label>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Update</span>
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <form action="{{ route('product.destroy', $p->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE') --}}
                                    <button onclick="deleteItem(this)" class="deleted btn btn-danger"
                                        data-id="{{$p->id}}" data-name="{{$p->nama}}"><i
                                            class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center border px-4 py-2" style="">PRODUK KOSONG</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Sweet Alert Delete -->
<script>
    function deleteItem(d) {
        var id = d.getAttribute('data-id');
        var name = d.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah yakin?',
            text: "Ingin menghapus data (" + name + ")",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#222237',
            cancelButtonColor: '#AAAAAA',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'Hold on, delete in progress'
                })
                window.location = "/product/delete/" + id
            }
        })
    }
</script>
<!-- End Sweet Alert Delete -->
<script>
    $('#cover').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>
<script>
    $(function () {
        // Multiple images preview with JavaScript
        var previewImages = function (input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $($.parseHTML('<img style="max-width: 30%; margin-right:7px;">')).attr('src',
                            event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function () {
            previewImages(this, 'div.images-preview-div');
        });
    });
</script>
<script>
    const name = document.querySelector('#nama_produk');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function () {
        fetch('/product/checkSlug?name=' + name.value)
        dd(name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>

@endsection