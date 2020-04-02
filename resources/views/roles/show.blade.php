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
    <div class="col-xl-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body" style="margin-top:-20px">
                <div class="row">
                    <div class="col-md-4 space">
                        <h1 class="h3 mb-4 text-gray-800">{{ $role->name }}</h1>
                    </div>
                    <div class="col-md-4 space text-center">
                        <a href="{{ route('roles.edit', $role->id) }}"
                            class="btn btn-outline-info btn-sm">{{ 'Editar Información' }}</a>
                    </div>
                    <div class="col-md-4 space">

                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                        	<p>Descrición: <span>{{ $role->description }}</span></p>
                            <p>Slug: <span>{{ $role->slug }}</span></p>
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
