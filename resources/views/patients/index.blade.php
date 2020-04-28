@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alerta alert-info alert-dismissible d-flex flex-ro">
    <i class="fas fa-fw fa-info-circle mr-3 mt-1"></i>
    <p>{{ $message }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row">
    <div class="col-md-4">
        <h1 class="h3 mb-3 text-gray-800"><i class="fas fa-fw fa-users"></i> {{ 'Pacientes' }}</h1>
    </div>
    <div class="col-md-4 text-center">
        <div class="btn-group mb-3 btn-group">
            <a href="{{ route('export') }}" class="btn btn-outline-success btn-sm">Excel</a>
            <a href="{{ route('pdf') }}" class="btn btn-outline-danger btn-sm">PDF</a>
            <a href="{{ route('patients.trash') }}"class="btn btn-outline-secondary btn-sm">{{ 'Papelera' }}</a>
            <a href="{{ route('patients.create') }}" class="btn btn-outline-primary btn-sm">{{ __('New') }}</a>
        </div>
    </div>
    <div class="col-md-4">
        <form method="GET" action="{{ route('patients.index') }}">
            <div class="input-group mb-3 input-group-sm">
                <input type="text" class="form-control" name="name" placeholder="{{ __('Search') }}"
                aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" id="button-addon2"><i
                    class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-hover table-responsive-lg small" id="table" style="width:100%">
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
            <td style="vertical-align:middle;"><a href="#" class="show text-decoration-none" data-id="{{ $patient->id }}"><i class="fas fa-folder-open"></i> {{ $patient->patient_code }}</a></td>
            <td style="vertical-align:middle;">{{ ucwords($patient->name1 .' '. $patient->name2) }}</td>
            <td style="vertical-align:middle;">{{ ucwords($patient->surname1. ' ' .$patient->surname2) }}</td>
            <td style="vertical-align:middle;">
                @if(!empty($patient->email))
                <a class="text-decoration-none" href="mailto:{{ $patient->email }}">{{ $patient->email }}
                </a>
                @else
                <span class="font-weight-bold">Sin email</span>
                @endif
            </td>
            <td style="vertical-align:middle;">
                @if(!empty($patient->phone1 or $patient->phone2))
                <a class="text-decoration-none" href="tel:{{ $patient->phone1 }}">{{ $patient->phone1 }}</a><br>
                <a class="text-decoration-none" href="tel:{{ $patient->phone2 }}">{{ $patient->phone2 }}</a>
                @else
                <span class="font-weight-bold">Sin Telefonos</span>
                @endif
                
            </td>
            <td style="vertical-align:middle;">
                @if(!empty($patient->document_type))
                {{ __("$patient->document_type")}}<br>{{$patient->document}}
                @else
                <span class="font-weight-bold">Sin Documento</span>
                @endif
            </td>
            <td class="font-weight-bold" style="vertical-align:middle; color: {{ $patient->status === "active" ? "#1cc88a" : "grey" }}" data-id="{{ $patient->id }}">{{ ucwords(__($patient->status))}}</td>
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
                    action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    @can('patients.edit')
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('patients.edit', $patient->id) }}"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('patients.destroy')
                        <button class="btn btn-outline-danger btn-sm submit" type="button"
                        data-id="{{ $patient->id }}"
                        data-msj="¿Realmente quiere eliminar los datos de <b>{{ $patient->name1 .' '. $patient->surname1 }}</b>?"
                        type="button"><i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    @endcan
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

@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
<style>
    #table{
        background-color: #FFFFFF;
    }
.show{
color:orange;
}
.show:hover{
color:red;
}
#abc.custom-file-label,
#abc.custom-file-label::after {
height: auto;
padding-top: 0;
padding-bottom: 0;
}
.btn-file {
position: relative;
overflow: hidden;
}
.btn-file input[type=file] {
position: absolute;
top: 0;
right: 0;
min-width: 100%;
min-height: 100%;
font-size: 100px;
text-align: right;
filter: alpha(opacity=0);
opacity: 0;
outline: none;
cursor: inherit;
display: block;
}
</style>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
<script type="text/javascript">
var URLSHOW = '{{URL::to('patients ')}}/';
$(document).ready(function() {
    $('#table').DataTable({
        responsive: true,
        "paging": false,
        "info": false,
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
                    action: function() {
                        document.getElementById(id).submit()
                    }
                },
                no: {
                    btnClass: 'btn-blue',
                    action: function() {}
                },
            }
        });
    });
});
</script>
@endsection