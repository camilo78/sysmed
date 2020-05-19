@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => 'consultations.store']) !!}
    <input type="hidden" value="{{ auth()->id() }}" name="consultation_id">
    @include('consultations.partials.general')

    @include('consultations.partials.measurement')

    {!! Form::close() !!}
@endsection

@section('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection

@section('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-es_ES.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.25.3/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.25.3/locale/es.js"></script>
    <script>
        function calcularEdad(fecha) {
// Si la fecha es correcta, calculamos la edad
            if (typeof fecha != "string" && fecha && esNumero(fecha.getTime())) {
                fecha = formatDate(fecha, "yyyy-MM-dd");
            }
            var values = fecha.split("-");
            var dia = values[2];
            var mes = values[1];
            var ano = values[0];
// cogemos los valores actuales
            var fecha_hoy = new Date();
            var ahora_ano = fecha_hoy.getYear();
            var ahora_mes = fecha_hoy.getMonth() + 1;
            var ahora_dia = fecha_hoy.getDate();
// realizamos el calculo
            var edad = (ahora_ano + 1900) - ano;
            if (ahora_mes < mes) {
                edad--;
            }
            if ((mes == ahora_mes) && (ahora_dia < dia)) {
                edad--;
            }
            if (edad > 1900) {
                edad -= 1900;
            }
// calculamos los meses
            var meses = 0;
            if (ahora_mes > mes && dia > ahora_dia)
                meses = ahora_mes - mes - 1;
            else if (ahora_mes > mes)
                meses = ahora_mes - mes
            if (ahora_mes < mes && dia < ahora_dia)
                meses = 12 - (mes - ahora_mes);
            else if (ahora_mes < mes)
                meses = 12 - (mes - ahora_mes + 1);
            if (ahora_mes == mes && dia > ahora_dia)
                meses = 11;
// calculamos los dias
            var dias = 0;
            if (ahora_dia > dia)
                dias = ahora_dia - dia;
            if (ahora_dia < dia) {
                ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
                dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
            }
            return edad + " años, " + meses + " meses y " + dias + " días";
        }

        function mostrar_control() {
            var select = document.getElementById("myselect");
            var inputText = document.getElementById("aseguradora");
            if (select.options[select.selectedIndex].value == "yes") {
                $("div#aseguradora").removeClass("d-none");
            } else {
                $("div#aseguradora").addClass("d-none");
            }
        }

        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('select.patient_id').change(function (e) {
            e.preventDefault();
            $(".dentro").empty()
            title = $(this).find(':selected').text();
            id = $(this).find(':selected').val();
            $.ajax({
                url: "{{ route('consultations.search') }}",
                data: 'id=' + id,
                type: "post",
                success: function (data) {
                    if (data) {
                        $("div#seguro").removeClass("d-none");
                    } else {
                        $("div#seguro").addClass("d-none");
                    }
                    if (data.phone1 === null) {
                        data.phone1 = 'No definido';
                        $(function () {
                            $('a.mobile').on("click", function (e) {
                                e.preventDefault();
                            });
                            $('a.mobile').addClass('text-secondary');

                        });
                    }
                    if (data.phone2 === null) {
                        $(function () {
                            $('a.phone').on("click", function (e) {
                                e.preventDefault();
                            });
                            $('a.phone').addClass('text-secondary');

                        });
                        data.phone2 = 'No definido';
                    }
                    if (data.email === null) {
                        $(function () {
                            $('a.mail').on("click", function (e) {
                                e.preventDefault();
                            });
                            $('a.mail').addClass('text-secondary');

                        });
                        data.email = 'No definido';
                    }
                    $(".dentro").append(
                        '<div class="col-md-8 col-lg-9 text-center text-md-right ">\n' +
                        '<span class="small"> <i class="fas fa-fw fa-birthday-cake"></i> ' + moment(data.birth).format('D MMMM YYYY') + '</span> | ' +
                        '<span class="small"> <i class="fas fa-fw fa-calendar-day"></i> ' + calcularEdad(data.birth) + '</span> | ' +
                        '<span class="small"> <a class="mobile text-decoration-none" href="tel:' + data.phone1 + '"> <i class="fas fa-fw fa-mobile-alt"></i> ' + data.phone1 + '</a></span> | ' +
                        '<span class="small"> <a class="phone text-decoration-none" href="tel:' + data.phone2 + '"> <i class="fas fa-fw fa-phone-alt"></i> ' + data.phone2 + '</a></span> | ' +
                        '<span class="small"> <a class="mail text-decoration-none" href="mailto:' + data.email + '"> <i class="fas fa-fw fa-envelope"></i> ' + data.email + '</a></span>' +
                        '</div> ' +
                        '<div class="col-md-4 col-lg-3 text-right">\n' +
                        '                        <div class="btn-group btn-block" role="group" aria-label="Basic example">\n' +
                        '                            <a href="/patients/'+ data.id +'/edit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom"\n' +
                        '                                    title="Editar información del paciente"><i class="far fa-edit"></i></a>\n' +
                        '                            <a href="/patients/'+ data.id +'" class="btn btn-warning btn-sm" data-toggle="tooltip"\n' +
                        '                                    data-placement="bottom" title="Historia clínica del Paciente"><i\n' +
                        '                                    class="far fa-folder"></i></a>\n' +
                        '                            <a href="#" class="btn btn-success btn-sm" data-toggle="tooltip"\n' +
                        '                                    data-placement="bottom" title="Referencias Médicas"><i\n' +
                        '                                    class="far fa-arrow-alt-circle-right"></i></a>\n' +
                        '                            <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip"\n' +
                        '                                    data-placement="bottom" title="Estadistica de Mediciones"><i\n' +
                        '                                    class="far fa-chart-bar"></i></a>\n' +
                        '                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="tooltip"\n' +
                        '                                    data-placement="bottom" title="Imágenes"><i class="fas fa-camera"></i></a>\n' +
                        '                        </div>\n' +
                        '                    </div>'
                    );
                }
            });

        });
    </script>
@endsection
