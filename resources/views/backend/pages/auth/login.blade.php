@extends('backend.layouts.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')
@section('content')

    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="/">
                    <img src="{{ asset('backend/auth/vendors/images/deskapp-logo.svg') }}" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center justify-content-center flex-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('backend/auth/vendors/images/login-page-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box box-shadow border-radius-10 bg-white">
                        <div class="login-title">
                            <h2 class="text-primary text-center">Login To DeskApp</h2>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    <small>{{ Session::get('success') }}</small>
                                </div>
                            @endif

                            @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}

                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Email/Username"
                                    name="login_id" value="{{ old('login_id') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            @error('login_id')
                                <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********"
                                    name="password" id="password">
                                <div class="input-group-append custom" style="cursor: pointer;" id="showPassword">
                                    <span class="input-group-text"><i class="icon-copy fa fa-eye-slash" aria-hidden="true"
                                            id="show_eye"></i><i class="icon-copy dw dw-eye d-none"
                                            id="hide_eye"></i></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror

                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            name="remember">
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password"><a href="{{ route('password.request') }}">Forgot
                                            Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">

                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">

                                    </div>
                                    <div class="font-16 weight-600 pb-10 pt-10 text-center" data-color="#707373">OR
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('register') }}">Register To
                                            Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const showPassword = document.getElementById("showPassword");
        const password = document.getElementById("password");
        const show_eye = document.getElementById("show_eye");
        const hide_eye = document.getElementById("hide_eye");

        showPassword.addEventListener("click", function() {
            hide_eye.classList.remove("d-none");
            showPassword.removeAttribute("title");

            if (password.type === "password") {
                password.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                password.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        });
    </script>
@endsection

