@extends('backend.layouts.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')
@section('content')

    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="{{ asset('backend/auth/vendors/images/deskapp-logo.svg') }}" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center justify-content-center flex-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('backend/auth/vendors/images/forgot-password.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box box-shadow border-radius-10 bg-white">
                        <div class="login-title">
                            <h2 class="text-primary text-center">Reset Password</h2>
                        </div>
                        <h6 class="mb-20">Enter your new password, confirm and submit</h6>
                        <form action="{{ route('password.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <input type="hidden" name="email" value="{{ $request->email }}">

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="Password"
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

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="Password Confirmation" name="password_confirmation" id="confirmPassword">
                                <div class="input-group-append custom" style="cursor: pointer;" id="showConfirmPassword">
                                    <span class="input-group-text"><i class="icon-copy fa fa-eye-slash" aria-hidden="true"
                                            id="show_eye_confirm"></i><i class="icon-copy dw dw-eye d-none"
                                            id="hide_eye_confirm"></i></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror

                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="input-group mb-0">

                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">

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
        const showConfirmPassword = document.getElementById("showConfirmPassword");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const show_eye = document.getElementById("show_eye");
        const show_eye_confirm = document.getElementById("show_eye_confirm");
        const hide_eye = document.getElementById("hide_eye");
        const hide_eye_confirm = document.getElementById("hide_eye_confirm");

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

        showConfirmPassword.addEventListener("click", function() {
            hide_eye_confirm.classList.remove("d-none");

            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
                show_eye_confirm.style.display = "none";
                hide_eye_confirm.style.display = "block";
            } else {
                confirmPassword.type = "password";
                show_eye_confirm.style.display = "block";
                hide_eye_confirm.style.display = "none";
            }
        });
    </script>
@endsection

