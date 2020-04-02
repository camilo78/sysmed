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
        @if ($message = Session::get('info'))
        <div class="alert alerta alert-info alert-dismissible d-flex flex-row">
            <i class="fas fa-fw fa-info-circle mr-3 mt-1"></i>
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body" style="margin-top:-20px">
                <div class="row">
                    <div class="col-md-4 space">
                        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-cogs"></i> {{ 'Configuración' }}</h1>
                    </div>
                    <div class="col-md-4 space text-center">
                            <a href="{{ route('settings.create') }}" class="btn btn-outline-info btn-sm">{{ __('New') }}</a>
                            <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-fw fa-edit"></i> {{ 'Editar' }}</a>
                    </div>
                    <div class="col-md-4 space">
                    </div>
                </div>
                <hr>
                <h5 class="text-gray-800"><i class="fas fa-fw fa-hospital"></i> Información del la Clínica</h5>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <label>Logo de la Clínica</label><br>
                        <img class="img-fluid" src="{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}">
                    </div>
                    <div class="col-md-3">
                        <label >Nombre</label>
                        <p class="text-gray-800">{{ $setting->name ?: 'No Definido' }}</p>
                    </div>
                    <div class="col-md-3">
                        <label>Teléfono</label>
                        <p class="text-gray-800">{{ $setting->phone ?: 'No Definido' }}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Dirección</label>
                        <p class="text-gray-800">{{ $setting->address ?: 'No Definido' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')

@endsection

@section('js')

@endsection
