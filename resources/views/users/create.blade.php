@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-fw fa-user-plus"></i>  Nuevo Usuario</h1>
    </div>
    <div class="col-md-12 mx-auto">
        {!! Form::open(['route' => 'users.store']) !!}
        @include('users.partials.form')
        {!! Form::close() !!}
    </div>
</div>

@endsection
@section('css')
@endsection
@section('js')
@endsection