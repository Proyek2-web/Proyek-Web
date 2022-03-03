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
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/login">Login</a>
                            <a class="dropdown-item" href="/register">Register</a>
                        </div>
                    </div>
                    {{-- <a class="btn btn-login nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login
                    <i class="bi bi-person-circle"></i></a> --}}
                    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="" style="z-index: 9999;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="z-index: 9999">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-5">
                                        <i class="fas fa-envelope prefix grey-text"></i>
                                        <input type="email" id="defaultForm-email" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="defaultForm-email">Your
                                            email</label>
                                    </div>

                                    <div class="md-form mb-4">
                                        <i class="fas fa-lock prefix grey-text"></i>
                                        <input type="password" id="defaultForm-pass" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Your
                                            password</label>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button class="btn btn-default">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal"
                            data-target="#modalLoginForm" >Launch
                            Modal Login Form</a>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                      </button>
                      
                      <!-- Modal -->
                      <div style="z-index: 9999" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ...
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                @endif
            </div>
        </div>
    </div>
</nav>
