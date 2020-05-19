@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pacientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$patients->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <hr style="margin-top: -10px">
            <div class="text-center" style="margin-top: -10px">
                <a class="text-decoration-none small" href="{{route('patients.index')}}">Ir a Pacientes</a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Consultas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <hr style="margin-top: -10px">
            <div class="text-center" style="margin-top: -10px">
                <a class="text-decoration-none small" href="{{route('consultations.create')}}">Nueva Consuta</a>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Citas Pendientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <hr style="margin-top: -10px">
            <div class="text-center" style="margin-top: -10px">
                <a class="text-decoration-none small" href="{{route('events.index')}}">Ir a Calendario</a>
            </div>
        </div>
    </div>

</div>

@endsection

@section('css')

@endsection

@section('js')

@endsection
