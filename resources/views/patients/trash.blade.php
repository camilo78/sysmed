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
                            <a href="{{ route('patients.index') }}"
                                class="btn btn-outline-primary btn-sm">{{ 'Volver a Usuarios' }}</a>
                        </div>
                    </div>
                    <div class="col-md-4 space">

                    </div>
                </div>
                <table class="table table-hover table-responsive-sm small">
                    <thead>
                        <tr>
                            <th scope="col">Expediente</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Sx</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td style="vertical-align:middle;"><i class="fas fa-folder-open"></i> {{ $patient->patient_code }}</td>
                            <td style="vertical-align:middle;">{{ ucwords($patient->name1 .' '. $patient->name2) }}</td>
                            <td style="vertical-align:middle;">{{ ucwords($patient->surname1. ' ' .$patient->surname2) }}</td>
                            <td style="vertical-align:middle;">
                                @if(!empty($patient->email))
                                {{ $patient->email }}
                                @else
                                Sin email
                                @endif
                            </td>
                            <td style="vertical-align:middle;">
                                @if(!empty($patient->phone1 or $patient->phone2))
                                {{ $patient->phone1 }}<br>
                                {{ $patient->phone2 }}
                                @else
                                Sin Telefonos
                                @endif
                                
                            </td>
                            <td style="vertical-align:middle;">
                                @if(!empty($patient->document_type))
                                {{ __("$patient->document_type")}}<br>{{$patient->document}}
                                @else
                                Sin Documento
                                @endif 
                            </td>    
                            <td style="vertical-align:middle; color: {{ $patient->status === "active" ? "#1cc88a" : "grey" }}" data-id="{{ $patient->id }}">{{ ucwords(__($patient->status))}}</td>
                            <td style="vertical-align:middle;">
                                @if(\Carbon\Carbon::parse($patient->birth)->age === 0)
                                {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m + %d d') }}
                                @else(\Carbon\Carbon::parse($patient->date)->age < 3)
                                    {{ \Carbon\Carbon::parse($patient->birth)->age }} A +
                                    {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m m') }}
                                @endif
                            </td>
                            <td style="vertical-align:middle;">{{ __($patient->gender) }}</td>
                            <td class="text-center" style="vertical-align:middle;">
                                <form class="form-delete" id="{{ $patient->id }}"
                                    action="{{ route('patients.restore', $patient->id) }}" method="GET">
                                    {{ csrf_field() }}
                                    @can('patients.restore')
                                    <button class="btn btn-outline-warning btn-sm submit" type="button"
                                        data-id="{{ $patient->id }}"
                                        data-msj="¿Realmente quiere restaurar los datos de <b>{{ $patient->name }}</b>?"
                                        type="button"><i class="fas fa-trash-restore-alt"></i>
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="text-center text-danger">No hay pacientes registrados</div>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex table-responsive-sm" style="margin-bottom:-25px">
                    <div class="ml-auto p-2 pagination-sm">{{ $patients->links() }}</div>
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
