@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-8">
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

                @if($patient->phone1) <a class="show text-decoration-none"
                                         href="tel:{{ $patient->phone1 }}"><i class="fas fa-mobile-alt"></i>
                                {{ $patient->phone1 }}</a>&nbsp;
                @else
                    <i class="fas fa-mobile-alt"></i> Sin Teléfono &nbsp;
                @endif
                @if($patient->phone2) <a class="show text-decoration-none"
                                         href="tel:{{ $patient->phone2 }}"><i class="fas fa-phone"></i>
                                {{ $patient->phone2 }}</a>&nbsp;
                @else
                    <i class="fas fa-phone"></i> Sin Teléfono &nbsp;
                @endif
                @if($patient->email) <a class="show text-decoration-none"
                                        href="mailto:{{ $patient->email }}"><i class="fas fa-envelope"></i>
                                {{ $patient->email }}</a>&nbsp;
                @else
                    <i class="fas fa-envelope"></i> Sin email &nbsp;
                @endif
                        </span>
            <br><br>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item item">
                    <a class="nav-link active item" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true"><i class="fas fa-history"></i>
                        Historial</a>
                </li>
                <li class="nav-item item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false"><i class="fas fa-prescription"></i>
                        Recetas</a>
                </li>
                <li class="nav-item item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false"><i
                            class="fas fa-file-medical-alt"></i> Examenes</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" style="background: #FAFAFA !important" id="home" role="tabpanel"
                     aria-labelledby="home-tab">
                    @include('patients.partials.history')
                </div>
                <div class="tab-pane fade" id="profile" style="background: #FAFAFA !important" role="tabpanel"
                     aria-labelledby="profile-tab">
                    @include('patients.partials.prescriptions')
                </div>
                <div class="tab-pane fade" id="contact" style="background: #FAFAFA !important" role="tabpanel"
                     aria-labelledby="contact-tab">
                    @include('patients.partials.exams')
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-body text-center">
                <span class="float-left big2"><i class="fas fa-clipboard"></i> Expediente:</span> <span
                    class="float-right big2 text-warning">
                            #{{ $patient->patient_code }}</span>
                <br>
                <hr>
                <button class="btn btn-outline-primary btn-sm "><i class="fas fa-print"></i>
                    Imprimir Expediente
                </button>
                <hr>
                <a class="btn btn-outline-danger btn-sm "><i class="fas fa-user-md"></i>
                    Nueva Consulta
                </a>
                <hr>
                <a class="btn btn-outline-dark btn-sm " href="/events"><i class="fas fa-calendar-plus"></i>
                    Nueva Cita
                </a>
                <hr>
                <div class="text-left big2" style="margin-bottom: 5px"><i class="fas fa-calendar-check"></i> Proximas
                    Citas:
                </div>
                @forelse($dates as $date)
                    <div class="d-flex m-3 text-left" style="margin-bottom: -15px">
                        <div>
                            <div class="icon-circle" style="background-color: {{$date->color}}">
                                <i class="fas fa-calendar text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"
                                 style="margin-left: 10px">{{Carbon\Carbon::parse($date->start)->formatLocalized('%d %B %Y %H:%M')}}</div>
                            <div class="text-muted"
                                 style="margin-left: 10px">{{$date->description}} {{$date->patient_id}}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No hay citas</p>
                @endforelse
                <hr>
                <span class="float-left big2"><i class="fas fa-user-md"></i> Consultas:</span>
                <span class="float-right big2">5</span>
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


@endsection

@section('css')
    <style>
        .nav-link.active {
            background: #FAFAFA !important;
            border-radius: 0px;

        }

        .item {
            background: #E6E6E6;
        }

        .nav-link:hover {
            border-radius: 0px;
        }

        .big {
            font-size: 24px;
        }

        .big2 {
            font-size: 20px;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }

        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

        @media (max-width: 576px) {
            .item {
                width: 100%;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        var items = $(".list-wrapper .list-item");
        var numItems = items.length;
        var perPage = 5;

        items.slice(perPage).hide();
        if (items.length > 5) {
            $('#pagination-container').pagination({
                items: numItems,
                itemsOnPage: perPage,
                prevText: "&laquo;",
                nextText: "&raquo;",
                onPageClick: function (pageNumber) {
                    var showFrom = perPage * (pageNumber - 1);
                    var showTo = showFrom + perPage;
                    items.hide().slice(showFrom, showTo).show();
                }
            });
        }

    </script>
@endsection
