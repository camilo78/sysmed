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
    <table class="table table-hover table-responsive-lg small" id="dtPluginExample" width="100%">
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
                <td style="vertical-align:middle;"><i
                        class="fas fa-folder-open"></i> {{ $patient->patient_code }}</td>
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
                <td style="vertical-align:middle; color: {{ $patient->status === "active" ? "#1cc88a" : "grey" }}"
                    data-id="{{ $patient->id }}">{{ ucwords(__($patient->status))}}</td>
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
                                    data-msj="¿Realmente quiere restaurar los datos de <b>{{ $patient->name1 .' '. $patient->surname1 }}</b>?"
                                    type="button"><i class="fas fa-trash-restore-alt"></i>
                            </button>
                        @endif
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
        </tbody>
    </table>




@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/>

@endsection

@section('js')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var tableTitle = 'Pacientes Eliminados';
            var tableBS4 = $('#dtPluginExample').DataTable({
                drawCallback: function () {
                    $('#dtPluginExample_paginate ul.pagination').addClass("pagination-sm");
                    $('button.btn').removeClass("btn-secondary");

                },
                stateSave: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                responsive: true,
                dom: "<'row rio'<'col-sm-12 text-center col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row small'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: {
                    buttons: [

                        {
                            text: 'Regresar a Pacientes',
                            className: 'btn-light btn-sm',
                            init: (api, node, config) => $(node).removeClass('btn-secondary'),
                            action: function (e, dt, node, config) {
                                window.location.href = '{{ route('patients.index') }}';
                                return false;
                            }
                        }
                    ],
                }
            });
// Add a row for the Title & Subtitle in front of the first row of the wrapper
            var divTitle = ''
                + '<div class="col-sm-12 col-md-4">'
                + '<h3> <i class="fas fa-users"></i>  ' + tableTitle + '</h3>'
                + '</div>';
            $(divTitle).prependTo('.rio');

            $('tfoot tr th').removeClass("bg-warning bg-light bg-success text-left text-center text-right").addClass("bg-dark text-white").css("font-size", "0.85rem");
            $('tfoot tr th:eq(1)').addClass("text-left");
            $('tfoot tr th:eq(6)').addClass("text-right");

            $("#dtPluginExample").on("click", ".submit", function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var msj = $(this).attr('data-msj');
                $.confirm({
                    title: '!Confirme esta acción!',
                    content: msj,
                    type: 'orange',
                    icon: 'fas fa-fw fa-exclamation-circle',
                    theme: 'modern',
                    backgroundDismiss: 'no',
                    escapeKey: 'no',
                    buttons: {
                        si: {
                            btnClass: 'btn-orange',
                            action: function () {
                                document.getElementById(id).submit()
                            }
                        },
                        no: {
                            btnClass: 'btn-blue',
                            action: function () {
                            }
                        },

                    }
                });
            });
        });
    </script>
@endsection
