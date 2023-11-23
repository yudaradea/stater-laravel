@extends('backend.layouts.auth_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Verify Email')
@section('content')

    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="{{ asset('backend/auth/vendors/images/deskapp-logo.svg') }}" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center justify-content-center flex-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('backend/auth/src/images/verify-email.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box box-shadow border-radius-10 bg-white">
                        <div class="login-title">
                            <h2 class="text-primary text-center">Verify Email</h2>
                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success">
                                <small>Link verifikasi telah terkirim, cek email anda.</small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status') == 'registrasi-success')
                            <div class="alert alert-success">
                                <small>Registrasi berhasil</small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <p class="mb-20" style="font-size: 15px">Terima kasih telah mendaftar! Sebelum memulai, Verifikasi
                            email anda terlebih
                            dahulu, dengan mengklik tautan yang sudah kami kirimkan ke email anda.</p>
                        <p class="mb-30" style="font-size: 15px">Tidak menerima email? silakan request link verifikasi yang
                            baru.</p>

                        <div class="row align-items-center">

                            <div class="col-12">
                                <form action="{{ route('verification.send') }}" method="POST">
                                    @csrf
                                    <div class="input-group d-block mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit"
                                            value="Kirim ulang link verifikasi">
                                    </div>
                                </form>
                            </div>

                            <div class="col-12">
                                <div class="font-16 weight-600 pb-10 pt-10 text-center" data-color="#707373">OR
                                </div>
                            </div>

                            <div class="col-12">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-0">
                                        <button type="submit"
                                            class="btn btn-outline-primary btn-lg btn-block">Logout</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

