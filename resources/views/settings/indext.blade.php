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
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-hospital"></i> {{ 'Clínicas' }}</h1>
    </div>
    <div class="col-md-4  text-center">
        <a href="{{ route('settings.create') }}" class="btn btn-outline-info btn-sm">{{ __('New') }}</a>
    </div>
    <div class="col-md-4 ">
        
    </div>
</div>
<table class="table table-hover small" id="table">
    <thead>
        <tr>
            <th scope="col">Imagen</th>
            <th scope="col">Nombre</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Web</th>
            <th scope="col">Dirección</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($settings as $setting)
        <tr>
            <td><img width="100" src="{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}">
                <td style="vertical-align : middle;" >{{ $setting->name }}</td>
                <td style="vertical-align : middle;" >{{ $setting->phone }}</td>
                <td style="vertical-align : middle;" >{{ $setting->web }}</td>
                <td style="vertical-align : middle;" >{{ $setting->address }}</td>
                <td style="vertical-align : middle;" class="text-center">
                    <form class="form-delete" id="{{ $setting->id }}"
                        action="{{ route('settings.destroy', $setting->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        @can('users.edit')
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('settings.edit', $setting->id) }}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('roles.destroy')
                            <button class="btn btn-outline-danger btn-sm submit" type="button"
                            data-id="{{ $setting->id }}"
                            data-msj="¿Realmente quiere eliminar <b>{{ $setting->name }}</b>?"
                            type="button"><i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                        @endcan
                    </form>
                </td>
            </tr>
            @empty
            <div class="text-center text-danger">No hay coincidencias para esa busqueda</div>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex table-responsive-sm" style="margin-bottom:-25px">
        <div class="ml-auto p-2 pagination-sm">{{ $settings->links() }}</div>
    </div>
    @endsection
    @section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
    @endsection
    @section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
    var URLSHOW = '{{URL::to('settings')}}/';
    $( document ).ready(function() {
    $('#table').DataTable( {
    responsive: true,
    "paging":   false,
    "info":     false,
    "searching": false
    });
    $('.show').click(function() {
    var id = $(this).attr('data-id')
    window.location.href = URLSHOW + id;
    return false;
    });
    $("#table").on("click", ".submit", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var msj = $(this).attr('data-msj');
    $.confirm({
    title: '!Confirme esta acción!',
    content: msj,
    type: 'red',
    icon: 'fas fa-fw fa-exclamation-circle',
    theme: 'modern',
    buttons: {
    si: {
    btnClass: 'btn-red',
    action: function(){
    document.getElementById(id).submit()
    }
    },
    no: {
    btnClass: 'btn-blue',
    action: function(){
    }
    },
    }
    });
    });
    });
    </script>
    @endsection