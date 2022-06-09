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
                    <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="/produk">Katalog
                        Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Profil
                        Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Kontak</a>
                </li>
            </ul>

            <div class="sign-user">
                @if (Auth::check())
                    <div class="d-flex">
                        <div>
                            @php
                                $cart_count = \App\Models\Cart::all()
                                    ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                                    ->where('status', '=', 'pending')
                                    ->count();
                            @endphp
                            @if ($cart_count < 1)
                                <a href="#" class="btn btn-keranjang2 me-3"><i class="bi bi-cart-check-fill fa-lg"></i>
                                    <span>Keranjang <span id="cart-qty" class="cart-quantity">
                                            @php
                                                $cart_count = \App\Models\Cart::all()
                                                    ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                                                    ->where('status', '=', 'pending')
                                                    ->count();
                                            @endphp
                                            <span class="badge">{{ $cart_count }}</span></a>
                                </a>
                            @else
                                <a href="{{ route('cart.index') }}" class="btn btn-keranjang2 me-3"><i
                                        class="bi bi-cart-check-fill fa-lg"></i>
                                    <span>Keranjang <span id="cart-qty" class="cart-quantity">
                                            @php
                                                $cart_count = \App\Models\Cart::all()
                                                    ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                                                    ->where('status', '=', 'pending')
                                                    ->count();
                                            @endphp
                                            <span class="badge">{{ $cart_count }}</span></a>
                                </a>
                            @endif

                        </div>
                        <div class="dropdown user">
                            <button class="btn btn-login dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->gambar != "")
                                <img src="/profil/{{ auth()->user()->gambar }}" alt=""
                                                            style="width: 20;height: 20; border-radius: 50%"> {{ auth()->user()->name }}
                                @else
                                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                                @endif


                            </button>
                            <ul class="dropdown-menu bg-secondary" style="font-family: PT Serif"
                                aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-light" href="/halaman_profil"><i
                                    class="bi bi-person-circle me-3"></i>
                                Profil</a>
                                 </li>
                                <li><a class="dropdown-item text-light" href="/alamat">
                                    <i class="bi bi-house me-3"></i>
                                        Alamat</a>
                                </li>
                                @php
                                    $order_count = \App\Models\Order::all()
                                        ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                                        ->count();
                                @endphp
                                <li class="mb-2"><a class="dropdown-item text-light"
                                        href="{{ route('transaction.index') }}"><i class="bi bi-credit-card me-3"></i>
                                        Transaksi <span class="badge badge-danger">{{ $order_count }}</span></a></a></li>
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
                        <button class="btn btn-login" type="button" data-bs-toggle="modal" aria-haspopup="true"
                            aria-expanded="false" data-bs-target="#login">
                            Sign-in <i class="bi bi-box-arrow-in-right"></i>
                        </button>
                        {{-- <ul class="dropdown-menu bg-secondary" style="font-family: PT Serif"
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal"
                                data-bs-target="#login">Masuk</a>
                        </li>
                        <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal"
                                data-bs-target="#login">Daftar</a></li>
                    </ul> --}}
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
                    <button type="button" class="btn-close mt-3 ms-3 bg-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <label style="margin-block: -2px" class="label" for="chk" aria-hidden="true">Daftar</label>
                    <input placeholder="Nama" type="text" class="input input-lg" name="name" value="">
                    <input placeholder="E-mail" type="email" class="input @error('email') is invalid @enderror input-lg"
                        name="email" value="">
                    @error('email')
                        <div id="" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input placeholder="No.Handphone" type="number" class="input input-lg" name="no_hp" value="">
                    {{-- <input placeholder="Alamat" type="text" class="input input-lg" name="alamat" value=""> --}}
                    <input placeholder="Password" type="password" class="input input-lg" id="id_password" name="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Minimal 8 karakter Dan Minimal 1 huruf kapital" required>
                    <div class="show-pw d-flex align-items-center" style="margin-top: -27px">
                        <input type="checkbox" onclick="show()" style="margin-left: 42px; font-size: 0.1rem"> <p class="mt-3 ms-1 text-light" style="font-size: 0.7rem; font-family: Arial, Helvetica, sans-serif">Tampilkan password</p>
                    </div>

                    <input placeholder="Konfirmasi Password" class="@error('password_confirmation') is-invalid @enderror input input-lg" id="password" style="margin-top: -1px" type="password" name="password_confirmation" required>
                    @error('password_confirmation')
                    <span class="text-light bg-danger" style="font-size: 10px; margin: auto; display: table">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="roles" value="user">
                    <button type="submit" class="btn-modal">Daftar <i class="bi bi-person-plus-fill"></i></button>
                </form>
            </div>
            <div class="login">
                <form id="handleAjax" name="postForm" role="form" method="POST" action="/login">
                    @csrf
                    <label class="label" for="chk" aria-hidden="true">Login</label>
                    <div class="text-center" style="margin-bottom: -30px">
                        <img src="/images/logo1.png" width="250" alt="">
                    </div>
                    <input required placeholder="E-mail" type="email"
                        class="input @error('email') is-invalid @enderror input-lg" name="email">
                    @error('email')
                        <div id="" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                        <input required placeholder="Password" type="password"
                            class="input @error('password') is-invalid @enderror input-lg " name="password" autocomplete="current-password" id="id_password2">
                            <div class="show-pw d-flex align-items-center" style="margin-top: -27px">
                                <input type="checkbox" onclick="show2()" style="margin-left: 42px; font-size: 0.1rem"> <p class="mt-3 ms-1" style="font-size: 0.7rem; font-family: Arial, Helvetica, sans-serif">Tampilkan password</p>
                            </div>
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

    // show / hide PW
//   const togglePassword = document.querySelector('#togglePassword');
//   const password = document.querySelector('#id_password');

//   togglePassword.addEventListener('click', function (e) {
//     // toggle the type attribute
//     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
//     password.setAttribute('type', type);
//     // toggle the eye slash icon
//     this.classList.toggle('bi-eye-slash-fill');
// });
function show() {
  var x = document.getElementById("id_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function show2() {
  var x = document.getElementById("id_password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

