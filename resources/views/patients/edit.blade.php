@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-user"></i> Editar Paciente</h1>
        </div>
        <div class="col-md-12 mx-auto">
            {!! Form::model($patient, ['route' => ['patients.update',$patient->id],
            'method' => 'PUT']) !!}
            @include('patients.partials.form')
            {!! Form::close() !!}
        </div>
    </div>
    <span class="text-danger">*</span> <span class="small text-danger">Campos Obligatorios</span>

@endsection
@section('css')
@endsection
@section('js')
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

        $(document).ready(function () {
            var x = $('#birth').val();
            age = calcularEdad(x);
            $("#age").val(age);
        });
        $('#birth').focusout(function () {
            var x = $(this).val();
            age = calcularEdad(x);
            $("#age").val(age);
        });
        $('#surname1').focusout(function () {
            surname1 = $("#surname1").val();
            name1 = $("#name1").val();
            id = $("#id").val() +{{ auth()->id() }};
            if (surname1 == 0 || name1 == 0) {
            } else {
                codigo = name1.charAt(0) + surname1.charAt(0) + id.padStart(6, 0);
                $("#patient_code").val(codigo.toUpperCase());
            }
        });
        $('#name1').focusout(function () {
            surname1 = $("#surname1").val();
            name1 = $("#name1").val();
            id = $("#id").val() +{{ auth()->id() }};
            if (surname1 == 0 || name1 == 0) {
            } else {
                codigo = name1.charAt(0) + surname1.charAt(0) + id.padStart(6, 0);
                $("#patient_code").val(codigo.toUpperCase());
            }
        });
        $('#name_relation').focusout(function () {
            name_relation = $("#name_relation").val();
            if (name_relation == 0) {
                $("#kinship").attr("required", false);
            } else {
                $("#kinship").attr("required", true);
            }
        });
    </script>
@endsection
