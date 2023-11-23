@extends('backend.layouts.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Forgot Password')
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
                            <h2 class="text-primary text-center">Forgot Password</h2>
                        </div>
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                <small>{{ Session::get('fail') }}</small>
                            </div>
                        @endif

                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                <small>{{ Session::get('success') }}</small>
                            </div>
                        @endif
                        <h6 class="mb-20" style="font-size: 15px">Enter your email address to reset your password</h6>
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" placeholder="Email"
                                    name="email" value="{{ old('email') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>
                            @error('email')
                                <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">

                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">

                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('login') }}">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

