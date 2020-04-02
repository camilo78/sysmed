@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif

<div class="row">
    <div class="col-xl-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body" style="margin-top:-20px">
                <div class="row">
                    <div class="col-md-4 space">
                        <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>
                    </div>
                    <div class="col-md-4 space text-center">
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-outline-info btn-sm">{{ 'Editar Información' }}</a>
                    </div>
                    <div class="col-md-4 space">

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 img">
                            <img src="{{ Gravatar::get($user->email, ['size'=>150])}}" alt="" class="img-fluid ">
                        </div>
                        <div class="col-md-6 details" style="padding-top: 15px">
                            <blockquote>
                                <h5>{{ $user->name }}</h5>
                                <small><cite title="Source Title">{{ $user->address }}<i
                                            class="icon-map-marker"></i></cite></small>
                            </blockquote>
                            <p>
                                {{ $user->email }}<br>
                                {{ $user->phone }} <br>
                                @if(\Carbon\Carbon::parse($user->date)->age == 0)
                                {{ \Carbon\Carbon::parse($user->date)->diff(\Carbon\Carbon::now())->format('%m meses y %d días') }}
                                @else
                                {{ \Carbon\Carbon::parse($user->date)->age }} años
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style type="text/css">
    .container {
        padding: 5%;
    }

    .container .img {
        text-align: center;
    }

    .container .details {
        border-left: 3px solid #ded4da;
    }

    .container .details p {
        font-size: 15px;
        font-weight: bold;
    }
</style>
@endsection

@section('js')

@endsection
