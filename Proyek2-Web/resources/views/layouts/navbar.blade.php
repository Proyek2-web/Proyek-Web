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
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="/produk">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                </li>
            </ul>

            <div class="sign-user">
                @if (Auth::check())
                <div class="dropdown">
                    <button class="btn btn-user dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i>
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </ul>
                </div>
                @else
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Akun
                    </button>
                    <div class="dropdown-menu p-2 text-center" aria-labelledby="dropdownMenuButton">
                        <a href="#">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#login">Login</button>
                        </a>
                        <a href="#">
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#register">Register</button>
                        </a>
                    </div>

                    <!-- Modal -->
                </div>
                {{-- <a class="btn btn-login nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login
                    <i class="bi bi-person-circle"></i></a> --}}
                    
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
                <h1 class="modal-title">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div>
                            <button type="submit" class="btn btn-success">Login</button>

                            <a class="btn btn-link" href="">Forgot Your Password?</a>
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
                <h1 class="modal-title">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div>
                            <button type="submit" class="btn btn-success">Login</button>

                            <a class="btn btn-link" href="">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->