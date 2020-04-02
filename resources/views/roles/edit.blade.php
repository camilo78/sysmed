@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
{{-- @include('flash::message') --}}

<div class="row">
    <div class="col-md-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body" style="margin-top:-20px">
                <div class="row">
                    <div class="col-md-4 space">
                        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-edit"></i> {{ 'Editar Rol' }}</h1>
                    </div>
                    <div class="col-md-12 mx-auto">
                        {!! Form::model($role, ['route' => ['roles.update',$role->id],
                        'method' => 'PUT','enctype' => 'multipart/form-data']) !!}

                        @include('roles.partials.form')

                        {!! Form::close() !!}
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
