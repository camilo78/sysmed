@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
<div class="row">
    <div class="col-md-12 space">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-plus"></i> {{ 'Crear Rol' }}</h1>
    </div>
    <div class="col-md-12 mx-auto">
        {!! Form::open(['route' => 'roles.store']) !!}
        @include('roles.partials.form')
        {!! Form::close() !!}
    </div>
</div>

@endsection
@section('css')
@endsection
@section('js')
@endsection