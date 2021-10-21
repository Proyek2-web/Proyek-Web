<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin | Kinasih Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css?" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>

<body style=" background-image: linear-gradient(to left top, #e7e7e7, #d2d6ea, #b1c8ee, #7fbdef, #12b4eb);">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            {{--  --}}
            <div class="row h-100 ">
                <h2 class="text-center">Keramik Kinasih</h2>
                <div class="logo col-md-7 ">
                    <img src="https://airid.com/wp-content/uploads/2020/10/01-Sys-admin-1024x632.png" alt="" width="750">
                </div>
                <div class="col-md-4">
                    @if (session()->has('loginFailed'))
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                        {{ session('loginFailed') }}
                    </div>
                    @endif
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in</h4>
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="form-group has-feedback-left">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder=" Email Address " required
                                                value="{{ old('email') }}" autofocus>
                                                
                                            @error('email')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror)"
                                                name="password" id="password" placeholder="Password" required
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn-log  btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    

</body>

</html>
