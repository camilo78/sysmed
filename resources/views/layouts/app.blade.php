<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/favicon.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <style>
        .loader-page {
            position: fixed;
            z-index: 25000;
            background: rgb(255, 255, 255);
            left: 0px;
            top: 0px;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition:all .3s ease;
        }
        .loader-page::before {
            content: "";
            position: absolute;
            border: 2px solid rgb(50, 150, 176);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-sizing: border-box;
            border-left: 2px solid rgba(50, 150, 176,0);
            border-top: 2px solid rgba(50, 150, 176,0);
            animation: rotarload 1s linear infinite;
            transform: rotate(0deg);
        }
        @keyframes rotarload {
            0%   {transform: rotate(0deg)}
            100% {transform: rotate(360deg)}
        }
        .loader-page::after {
            content: "";
            position: absolute;
            border: 2px solid rgba(50, 150, 176,.5);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-sizing: border-box;
            border-left: 2px solid rgba(50, 150, 176, 0);
            border-top: 2px solid rgba(50, 150, 176, 0);
            animation: rotarload 1s ease-out infinite;
            transform: rotate(0deg);
        }
        .nav-item.active{
            background:none !important;
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/custom.js') }}" ></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" defer rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div id="app">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('partials.sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content" style="background: #FFFFFF">

                    <!-- Topbar -->
                    @include('partials.topbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        @yield('content')

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('partials.footer')
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
    </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}" ></script>
    <script type="text/javascript" >
        $(document).ready(function() {
            $('button.btn').addClass("btn-sm");
            $('a.btn').addClass("btn-sm");
        });
        $(window).on('load', function () {
            setTimeout(function () {
                $(".loader-page").css({visibility:"hidden",opacity:"0"})
            }, 300);

        });
    </script>
    @yield('js')

</body>

</html>
