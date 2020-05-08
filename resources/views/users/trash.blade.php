@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-hover table-responsive-lg small" id="dtPluginExample" width="100%">
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
        @endforelse
        </tbody>
    </table>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

    <script type="text/javascript">
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
    </script>
@endsection
