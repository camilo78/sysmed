@extends('layouts.app')
@section('content')
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
    <table class="table table-hover dt-responsive small" id="dtPluginExample" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Sx</th>
            <th scope="col">Documento</th>
            <th scope="col">Edad</th>
            <th scope="col">Teléfonos</th>
            <th scope="col">Email</th>
            <th scope="col">Estado</th>
            <th scope="col">Expediente</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
       
        </tbody>
    </table>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/>
    <style>
        .show {
            color: orange;
        }

        .show:hover {
            color: red;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            var URLSHOW = '{{URL::to('patients')}}/';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
            var f = new Date();
            var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
            var tableTitle = 'Pacientes';
            var tableSubTitle = 'Total de pacientes al ' + fecha;
            var tableBS4 = $('#dtPluginExample').DataTable({
                drawCallback: function () {
                    $('#dtPluginExample_paginate ul.pagination').addClass("pagination-sm");
                    $('button.btn').removeClass("btn-secondary");

                },
                "processing": true,
                "serverSide": true,
                stateSave: true,
                language: {
                    search: '',
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "_MENU_",
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
                ajax: "{{ route('patients.index') }}",
                "columns": [
                    {data: "name", name: "name"},
                    {data: "gender", name: "gender"},
                    {data: "document", name: "document"},
                    {data: "age", name: "age"},
                    {data: "phone", name: "phone"},
                    {data: "email", name: "email"},
                    {data: "status", name: "status"},
                    {data: "patient_code", name: "patient_code"},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ],

                responsive: true,
                dom: "<'row rio'<'col-sm-12 text-center col-md-4'B><'col-sm-12 col-md-2'l><'col-sm-12 col-md-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row small'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: {
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            className: 'btn-primary btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: tableTitle,
                            messageTop: tableSubTitle,
                            titleAttr: 'Exportar Excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            className: 'btn-primary btn-sm',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: tableTitle,
                            messageTop: tableSubTitle,
                            titleAttr: 'Exportar PDF'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            className: 'btn-primary btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: tableTitle,
                            messageTop: tableSubTitle,
                            titleAttr: 'Imprimir Tabla'
                        },
                        {
                            text: '<i class="fas fa-plus-circle"></i>',
                            titleAttr: 'Nuevo paciente',
                            className: 'btn-primary btn-sm',
                            init: (api, node, config) => $(node).removeClass('btn-secondary'),
                            action: function (e, dt, node, config) {
                                window.location.href = '{{ route('patients.create') }}';
                                return false;
                            }
                        },
                        {
                            text: '<i class="fas fa-trash-alt"></i>',
                            className: 'btn-info btn-sm',
                            titleAttr : 'Papelera de pacientes',
                            init: (api, node, config) => $(node).removeClass('btn-secondary'),
                            action: function (e, dt, node, config) {
                                window.location.href = '{{ route('patients.trash') }}';
                                return false;
                            }
                        }
                        
                    ],

                },

            });
            
              
         
// Add a row for the Title & Subtitle in front of the first row of the wrapper
            var divTitle = ''
                + '<div class="col-sm-12 col-md-3">'
                + '<h5> <i class="fas fa-users"></i>  ' + tableTitle + '</h5>'
                + '</div>';
            $(divTitle).prependTo('.rio');
            $("input.form-control.form-control-sm ").attr('placeholder', 'Buscar...');

            $('tfoot tr th:eq(1)').addClass("text-left");
            $('tfoot tr th:eq(6)').addClass("text-right");

            $("#dtPluginExample").on("click", ".submit", function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var msj = $(this).attr('data-msj');
                $.confirm({
                    title: '!Confirme esta acción!',
                    content: msj,
                    type: 'red',
                    icon: 'fas fa-fw fa-exclamation-circle',
                    theme: 'modern',
                    backgroundDismiss: 'no',
                    escapeKey: 'no',
                    buttons: {
                        si: {
                            btnClass: 'btn-red',
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
