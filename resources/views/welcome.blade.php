<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url('{{ asset('img/portada.jpg') }} ');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.33);
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.33);
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

        .links>a:hover {
            color: #367fa9;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.33);
        }

        .m-b-md {
            margin-bottom: 30px;
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
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('/img/logo.png') }}" alt="Logo SYSMED" width="100">
            </div>
            <div class="title m-b-md">

                <span style="color:#367fa9;">SYS</span><b>MED</b>
            </div>

            <div class="links">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/home') }}">{{ __('Home') }}</a>
                @else
                <a href="{{ route('login') }}">{{ __('Login') }}</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
                @endif
                <a href="/construction">Conocenos</a>
                <a href="/construction">Documentación</a>
                <a href="/construction">Precios</a>
                <a href="/construction">Contactanos</a>
            </div>

        </div>
        <div class="footer flex-center cr">
            <span>Copyright &copy; Emprende en la Web 2019</span>
        </div>
    </div>

</body>

</html>
