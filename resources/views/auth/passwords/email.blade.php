@extends('layouts.app1')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alerta bg-gradient-primary text-white alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times; </button>
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('/img/logo.png') }}"  alt="Logo SYSMED" width="60">
                                    <h1 class="h4 text-gray-900 mb-4"><span style="color:#367fa9;">SYS</span><b>MED</b>
                                    </h1>
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">{{ __('Reset Password') }}</h1>
                                    <p class="mb-4 small">
                                        {{ __("Enter your email address below and we'll send you a link to reset your password.") }}
                                    </p>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control-user form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}"
                                            placeholder="{{ __('E-Mail Address') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Send Link') }}
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">{{ __('Return to login!') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @endsection

        @section('css')
        <style>
            .bg-img {
                background-image: url('{{ asset('img/portada1.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                /* Set the fixed height of the footer here */
                height: 60px;
                line-height: 60px;
                /* Vertically center the text there */
            }

            .cr {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-shadow: 0 0 10px rgba(0, 0, 0, 0.33);
            }

            .alerta {
                width: 400px;
                position: absolute;
                padding: 25px;
                top: 60px;
                right: 15px;
                z-index: 5000;
                opacity: 0.90;
                -webkit-box-shadow: 2px 2px 5px 3px rgba(0, 0, 0, 0.34);
                -moz-box-shadow: 2px 2px 5px 3px rgba(0, 0, 0, 0.34);
                box-shadow: 2px 2px 5px 3px rgba(0, 0, 0, 0.34);
            }
        </style>
        @endsection

        @section('js')
        <script>
            window.setTimeout(function () {
            $(".alerta").fadeTo(1000, 0).slideUp(1000, function () {
                $(this).remove();
            })}, 5000);

        </script>
        @endsection
