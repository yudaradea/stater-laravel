<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8">
        <title>@yield('pageTitle')</title>

        <!-- Site favicon -->
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('backend/auth/vendors/images/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('backend/auth/vendors/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16"
            href="{{ asset('backend/auth/vendors/images/favicon-16x16.png') }}">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/auth/vendors/styles/core.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/auth/vendors/styles/icon-font.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/auth/vendors/styles/style.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('backend/auth/src/plugins/jquery-steps/jquery.steps.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

        @stack('stylesheets')

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-119386393-1');
        </script>
    </head>
    <body class="login-page">

        @yield('content')

        {{-- jQuery --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- js -->
        <script src="{{ asset('backend/auth/vendors/scripts/core.js') }}"></script>
        <script src="{{ asset('backend/auth/vendors/scripts/script.min.js') }}"></script>
        <script src="{{ asset('backend/auth/vendors/scripts/process.js') }}"></script>
        <script src="{{ asset('backend/auth/vendors/scripts/layout-settings.js') }}"></script>
        <script src="{{ asset('backend/auth/src/plugins/jquery-steps/jquery.steps.js') }}"></script>
        <script src="{{ asset('backend/auth/vendors/scripts/steps-setting.js') }}"></script>

        <!-- Toaster -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
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

        <script src="{{ asset('backend/auth/vendors/scripts/layout-settings.js') }}"></script>
    </body>
</html>

