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
                        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-trash-alt"></i> {{ 'Usuaros Eliminados' }}</h1>
                    </div>
                    <div class="col-md-4 space text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('users.index') }}"
                                class="btn btn-outline-primary btn-sm">{{ 'Volver a Usuarios' }}</a>
                        </div>
                    </div>
                    <div class="col-md-4 space">

                    </div>
                </div>
                <table class="table table-hover table-responsive-lg small">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Rol</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if(\Carbon\Carbon::parse($user->date)->age === 0)
                                {{ \Carbon\Carbon::parse($user->date)->diff(\Carbon\Carbon::now())->format('%m meses %d días') }}
                                @elseif(\Carbon\Carbon::parse($user->date)->age < 3)
                                    {{ \Carbon\Carbon::parse($user->date)->age }} año
                                    {{ \Carbon\Carbon::parse($user->date)->diff(\Carbon\Carbon::now())->format('%m meses') }}
                                    @elseif(\Carbon\Carbon::parse($user->date)->age === 1)
                                    {{ \Carbon\Carbon::parse($user->date)->age }} año
                                    @else
                                    {{ \Carbon\Carbon::parse($user->date)->age }} años
                                    @endif
                            </td>
                            <td>{{ !empty($user->roles()->first()->name) ? $user->roles()->first()->name:'S/R' }}</td>
                            <td class="text-center">
                                <form class="form-delete" id="{{ $user->id }}"
                                    action="{{ route('users.restore', $user->id) }}" method="GET">
                                    {{ csrf_field() }}
                                    @can('users.restore')
                                    <button class="btn btn-outline-warning btn-sm submit" type="button"
                                        data-id="{{ $user->id }}"
                                        data-msj="¿Realmente quiere restaurar los datos de <b>{{ $user->name }}</b>?"
                                        type="button"><i class="fas fa-trash-restore-alt"></i>
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="text-center text-danger">No hay coincidencias para esa busqueda</div>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex table-responsive-sm" style="margin-bottom:-25px">
                    <div class="ml-auto p-2 pagination-sm">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    $(".submit").click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var msj = $(this).attr('data-msj');
        $.confirm({
            title: '!Confirme esta acción!',
            content: msj,
            type: 'orange',
            icon: 'fas fa-fw fa-exclamation-circle',
            theme: 'modern',
            buttons: {
                si: {
                    btnClass: 'btn-orange',
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


</script>
@endsection
