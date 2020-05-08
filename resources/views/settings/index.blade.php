@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 ">
            <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-cogs"></i> {{ 'Configuración' }}</h1>
        </div>
        <div class="col-md-4  text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('settings.create') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-plus-circle"></i> {{ __('New') }}</a>
                <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-info"><i
                        class="fas fa-fw fa-edit"></i> {{ 'Editar' }}</a>
            </div>
        </div>
        <div class="col-md-4 ">
        </div>
    </div>
    <hr  style="margin-top: -10px">
    <h5 class="text-gray-800"><i class="fas fa-fw fa-hospital"></i> Información del la Clínica
    </h5>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <label>Logo de la Clínica</label><br>
            <img class="img-fluid"
                 src="{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}">
        </div>
        <div class="col-md-3">
            <label>Nombre</label>
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

@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
@endsection
@section('js')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                "paging": false,
                "info": false,
                "searching": false
            });
        });
    </script>
@endsection
