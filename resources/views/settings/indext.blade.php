@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-hover small" id="dtPluginExample" style="width:100%">
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
                <td><img width="100"
                         src="{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}">
                <td style="vertical-align : middle;">{{ $setting->name }}</td>
                <td style="vertical-align : middle;">{{ $setting->phone }}</td>
                <td style="vertical-align : middle;">{{ $setting->web }}</td>
                <td style="vertical-align : middle;">{{ $setting->address }}</td>
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
        @endforelse
        </tbody>
    </table>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.css"/>
@endsection
@section('js')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        var URLSHOW = '{{URL::to('settings')}}/';
        $(document).ready(function () {
            var tableTitle = 'Configuraciones';
            var tableBS4 = $('#dtPluginExample').DataTable({
                drawCallback: function () {
                    $('#dtPluginExample_paginate ul.pagination').addClass("pagination-sm");
                    $('button.btn').removeClass("btn-secondary");

                },
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
                            text: 'Nuevo',
                            className: 'btn-primary',
                            init: (api, node, config) => $(node).removeClass('btn-secondary'),
                            action: function (e, dt, node, config) {
                                window.location.href = '{{ route('settings.create') }}';
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

            $("#dtPluginExample").on("click", ".show", function (e) {
                var id = $(this).attr('data-id')
                window.location.href = URLSHOW + id;
                return false;
            });
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
