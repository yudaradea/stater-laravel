<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('pageTitle')</title>
        <!-- CSS files -->
        <link href="{{ asset('backend/dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />

        {{-- Toaster --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
        {{-- Ijabo-crop-image --}}
        <link rel="stylesheet" href="{{ asset('backend/vendor/ijabo/ijaboCropTool.min.css') }}">

        @stack('stylesheets')
        @livewireStyles
        <link href="{{ asset('backend/dist/css/demo.min.css') }}" rel="stylesheet" />
        <style>
            @import url('https://rsms.me/inter/inter.css');

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>
    <body>
        <div class="page">
            <!-- Sidebar -->
            @include('backend.layouts.includes.sidebar')
            <!-- Navbar -->
            @include('backend.layouts.includes.header')
            <div class="page-wrapper">

                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        @yield('content')
                    </div>
                </div>
                @include('backend.layouts.includes.footer')
            </div>
        </div>

        <!-- Libs JS -->
        <script src="{{ asset('backend/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
        <script src="{{ asset('backend/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
        <script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
        <script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
        <!-- Tabler Core -->
        <script src="{{ asset('backend/dist/js/tabler.min.js') }}" defer></script>

        {{-- jQuery --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Toaster -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        {{-- Ijabo-crop-image --}}
        <script src="{{ asset('backend/vendor/ijabo/ijaboCropTool.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true,
                }
            });

            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.pesan, event.detail.title ?? '')
            });


            @if (Session::has('message'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "hideDuration": 3000,
                    "newestOnTop": true,
                }
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ");
                        break;
                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ");
                        break;
                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ");
                        break;
                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ");
                        break;
                }
            @endif
        </script>

        @stack('scripts')
        @livewireScripts

        <script src="{{ asset('backend/dist/js/demo.min.js?1684106062') }}" defer></script>
    </body>
</html>

