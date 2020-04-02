@extends('layouts.app1')

@section('content')
<div class="container">


    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-4">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">

                                <div class="text-center">
                                    <img src="{{ asset('/img/logo.png') }}" alt="Logo SYSMED" width="60">
                                    <h1 class="h4 text-gray-900 mb-4"><span style="color:#367fa9;">SYS</span><b>MED</b></h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
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

                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control-user form-control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password"
                                            placeholder="{{ __('Password') }}">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Login') }}
                                    </button>

                                </form>
                                <hr>
                                @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}" class="small"
                                        href="forgot-password.html">{{ __('Forgot Your Password?') }}</a>
                                </div>
                                @endif
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
            background-image: url('{{ asset('img/portada1.jpg') }} ');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .cr {
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
    @endsection

    @section('js')

    @endsection
