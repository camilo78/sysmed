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
    </div>
</div>
<div class="row">
    <div class="col-md-4 ">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-cogs"></i> {{ 'Configuración' }}</h1>
    </div>
    <div class="col-md-4  text-center">
        <a href="{{ route('settings.create') }}" class="btn btn-outline-info btn-sm">{{ __('New') }}</a>
        <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-fw fa-edit"></i> {{ 'Editar' }}</a>
    </div>
    <div class="col-md-4 ">
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

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
@endsection
@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
<script>
$( document ).ready(function() {
$('#table').DataTable( {
responsive: true,
"paging":   false,
"info":     false,
"searching": false
});
});
</script>
@endsection