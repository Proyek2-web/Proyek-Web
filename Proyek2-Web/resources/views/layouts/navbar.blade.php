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
<nav class="navbar navbar-expand-lg navbar-light shadow-lg position-fixed w-100 " style="z-index: 99">
    <div class="container">
        <a class="navbar-brand " href="#">Keramik Kinasih</a>
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
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <div class="dropdown-menu p-2 text-center" aria-labelledby="dropdownMenuButton">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="#">
                                    <button type="submit" class="btn btn-primary mb-3">Logout</button>
                                </a>
                            </form>
                        </div>
                        <!-- Modal -->
                    </div>
                    <div>
                        <a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart"
                            aria-hidden="true"></i> <span>Keranjang <span id="cart-qty"
                                class="cart-quantity">
                            @php
                            $cart_count = \App\Models\Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', 'pending')->count();
                            @endphp
                            {{ $cart_count }}
                            </span></span></a>
                    </div>
                    
                    
                @else
                    <div class="dropdown">
                        <div class="wrap-btn d-flex">
                            <a href="/cart" class="btn btn-keranjang2 "><i class="bi bi-cart-check-fill fa-lg"></i></a>
                        <button class="btn btn-login"  type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > 
                            Sign-in <i class="bi bi-box-arrow-in-right"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#login">Masuk</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#register">Daftar</a></li>
                          </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- Modal Login -->
<div id="login" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @include('sweetalert::alert')
                <h1 class="modal-title">Masuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="handleAjax" name="postForm" role="form" method="POST" action="/login">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input required type="email"
                                class="form-control @error('email') is-invalid @enderror input-lg" name="email">
                            @error('email')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input required type="password"
                                class="form-control @error('password') is-invalid @enderror input-lg" name="password">
                            @error('password')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div>
                            <button type="submit" class="btn btn-success">OK</button>
                            <a class="btn btn-link" href="#">Forgot Your Password?</a>
                        </div>
                    </div>
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
                            <input type="password" class="form-control input-lg" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Periksa Password Anda"
                                required>
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
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
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


