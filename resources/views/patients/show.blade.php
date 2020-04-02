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
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ $patient->name1.' '.$patient->name2.' '.$patient->surname1.' '.$patient->surname2 }}
                        </h2>
                        <span class="small"><i class="fas fa-calendar-day"></i>
                            {{ date('d-m-Y', strtotime($patient->birth)) }} &nbsp; <i class="fas fa-birthday-cake"> </i>
                            @if(\Carbon\Carbon::parse($patient->birth)->age === 0)
                            {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m meses y %d días') }}
                            @else(\Carbon\Carbon::parse($patient->date)->age < 3)
                                {{ \Carbon\Carbon::parse($patient->birth)->age }} Años y
                                {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m meses') }}
                                @endif </span> <span class="float-md-right small">
                                @if($patient->city_town)<i class="fas fa-map-marked-alt"></i>
                                {{ $patient->city_town }}&nbsp; @endif
                                @if($patient->phone1) <a class="show text-decoration-none"
                                    href="tel:{{ $patient->phone1 }}"><i class="fas fa-mobile-alt"></i>
                                    {{ $patient->phone1 }}</a>&nbsp; @endif
                                @if($patient->phone2) <a class="show text-decoration-none"
                                    href="tel:{{ $patient->phone2 }}"><i class="fas fa-phone"></i>
                                    {{ $patient->phone2 }}</a>&nbsp; @endif
                                @if($patient->email) <a class="show text-decoration-none"
                                    href="mailto:{{ $patient->email }}"><i class="fas fa-envelope"></i>
                                    {{ $patient->email }}</a>&nbsp; @endif
                        </span>
                        <br><br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true"><i class="fas fa-history"></i>
                                    Historial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false"><i class="fas fa-prescription"></i>
                                    Recetas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false"><i
                                        class="fas fa-file-medical-alt"></i> Examenes Clínicos</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @include('patients.partials.history')
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @include('patients.partials.prescriptions')
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                @include('patients.partials.exams')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card-body text-center">
                        <span class="float-left big">Expediente:</span> <span class="float-right big">
                            #{{ $patient->patient_code }}</span>
                        <br>
                        <hr>
                        <button class="btn btn-outline-primary btn-sm " type="button"><i class="fas fa-print"></i>
                            Imprimir Expediente
                        </button>
                        <hr>
                        <button class="btn btn-outline-danger btn-sm " type="button"><i class="fas fa-user-md"></i>
                            Nueva Consulta
                        </button>
                        <hr>
                        <button class="btn btn-outline-dark btn-sm " type="button"><i class="fas fa-calendar-plus"></i>
                            Nueva Cita
                        </button>
                        <hr>
                        <span class="float-left big2 text-primary"><i class="fas fa-calendar-check"></i> Proxima
                            Cita:</span> <span class="float-right big2 text-primary">No hay citas</span><br>
                        <hr>
                        <span class="float-left big2"><i class="fas fa-user-md"></i> Consultas:</span> <span
                            class="float-right big2">5</span>
                        <br>
                        <hr>
                    </div>
                    <div class="col-xl-12">
                        <a href="#" class="text-decoration-none">
                            <div class="card bg-primary text-light text-center">
                                <div class="card-body">
                                    <i style="font-size: 50px" class="fas fa-book-medical"></i>
                                </div>
                                <div class="card-footer bg-primary">
                                    <span style="font-size: 20px">Historial Clínico</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a href="#" class="text-decoration-none">
                            <div class="card bg-success text-light text-center">
                                <div class="card-body">
                                    <i style="font-size: 50px" class="fas fa-share-square"></i>
                                </div>
                                <div class="card-footer bg-success">
                                    <span style="font-size: 20px">Referencias Médicas</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a href="#" class="text-decoration-none">
                            <div class="card bg-warning text-light text-center">
                                <div class="card-body">
                                    <i style="font-size: 50px" class="fas fa-chart-line"></i>
                                </div>
                                <div class="card-footer bg-warning">
                                    <span style="font-size: 20px">Mediciones</span>
                                </div>
                            </div>
                        </a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    .big {
        font-size: 24px;
    }

    .big2 {
        font-size: 20px;
    }
</style>
@endsection

@section('js')

@endsection
