<style>
    #message p {
        padding: 10px 35px;
        font-size: 18px;
    }

    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "✖";
    }
</style>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark shadow-lg position-fixed w-100 " style="z-index: 99">
    <div class="container">
        <a class="navbar-brand mt-3" href="#"><img src="/images/logo1.png" width="225" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="/produk">Katalog Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Profil Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Kontak</a>
                </li>
            </ul>

            <div class="sign-user">
                @if (Auth::check())
                <div class="d-flex">
                    <div>
                        <a href="{{route('cart.index')}}" class="btn btn-keranjang2 me-3"><i
                                class="bi bi-cart-check-fill fa-lg"></i>
                            <span>Keranjang <span id="cart-qty" class="cart-quantity">
                                    @php
                                    $cart_count = \App\Models\Cart::all()->where('user_id', '=', Auth::user() == null ?
                                    '' : Auth::user()->id)->where('status', '=', 'pending')->count();
                                    @endphp
                                    <span class="badge">{{ $cart_count }}</span></a>
                        </a>
                        {{-- <a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>Keranjang <span id="cart-qty" class="cart-quantity">
                                @php
                                $cart_count = \App\Models\Cart::all()->where('user_id', '=', Auth::user() == null ? '' :
                                Auth::user()->id)->where('status', '=', 'pending')->count();
                                @endphp
                                {{ $cart_count }}
                            </span></span></a> --}}
                    </div>
                    <div class="dropdown user">
                        <button class="btn btn-login dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu bg-secondary" style="font-family: PT Serif"
                            aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-light" href="#"><i class="bi bi-person-circle me-3"></i>
                                    Profile</a></li>
                            <li class="mb-2"><a class="dropdown-item text-light" href="#"><i
                                        class="bi bi-credit-card me-3"></i> Transaksi</a></li>
                            <li class="text-center">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a href="#">
                                        <button type="submit" class="btn btn-login "><i
                                                class="bi bi-box-arrow-left"></i> Keluar</button>
                                    </a>
                                </form>
                            </li>
                        </ul>
                        <!-- Modal -->
                    </div>

                </div>


                @else
                <div class="dropdown">
                    <button class="btn btn-login" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Sign-in <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                    <ul class="dropdown-menu bg-secondary" style="font-family: PT Serif"
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal"
                                data-bs-target="#login">Masuk</a>
                        </li>
                        <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal"
                                data-bs-target="#login">Daftar</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- Modal Login -->
<div id="login" class="modal fade">
    <div class="modal-dialog" role="document" style="font-family: PT Serif">
        <div class="modal-content">

            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="signup">
                <form role="form" method="POST" action="/register">
                    @csrf
                    <button type="button" class="btn-close mt-3 ms-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <label style="margin-block: -2px" class="label" for="chk" aria-hidden="true">Daftar</label>
                    <input placeholder="Nama" type="text" class="input input-lg" name="name" value="">
                    <input placeholder="E-mail" type="email" class="input @error('email') is invalid @enderror input-lg" name="email"
                        value="">
                    @error('email')
                    <div id="" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <input placeholder="No.Handphone" type="number" class="input input-lg" name="no_hp" value="">
                    <input placeholder="Alamat" type="text" class="input input-lg" name="alamat" value="">
                    <input placeholder="Password" type="password" class="input input-lg" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Minimal 8 karakter Dan Minimal 1 huruf kapital" required>
                    <input type="hidden" name="roles" value="user">
                    <button type="submit" class="btn-modal">Daftar <i class="bi bi-person-plus-fill"></i></button>
                </form>
            </div>
            <div class="login">
                <form id="handleAjax" name="postForm" role="form" method="POST" action="/login">
                    @csrf
                    <label class="label" for="chk" aria-hidden="true">Login</label>
                    <input required placeholder="E-mail" type="email"
                        class="input @error('email') is-invalid @enderror input-lg" name="email">
                    @error('email')
                    <div id="" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <input required placeholder="Password" type="password"
                        class="input @error('password') is-invalid @enderror input-lg" name="password">
                    @error('password')
                    <div id="" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <button class="btn-modal" type="submit">Masuk <i class="bi bi-box-arrow-in-right"></i></button>
                </form>
            </div>
           
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Login -->
<div id="register" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Daftar Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="/register">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Nama</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control @error('email') is invalid @enderror input-lg"
                                name="email" value="">
                            @error('email')
                            <div id="" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nomor HP</label>
                        <div>
                            <input type="number" class="form-control input-lg" name="no_hp" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="alamat" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" id="psw" name="psw"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Periksa Password Anda" required>
                        </div>
                    </div>
                    <input type="hidden" name="roles" value="user">
                    <div class="form-group mt-2">
                        <div>
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="message">
                <p id="letter" class="invalid"><b>Huruf kecil</b> </p>
                <p id="capital" class="invalid"><b>Huruf Kapital</b> letter</p>
                <p id="number" class="invalid"><b>Angka</b></p>
                <p id="length" class="invalid">Minimal <b>8 karakter</b></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function () {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function () {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function () {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script> --}}