<h3>
    <i class="fa fa-fw fa-stethoscope"></i>
    Detalle Consulta
</h3>
<div class="row">
    <div class="card border-info col-md-12 bg-gray-100">
        <div class="row mt-2 mb-2">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
            <div class="mt-1 mb-2 col-md-3">
                {{ form::label('date-hour', 'Fecha Hora') }} <span class="text-danger">*</span>
                {{ Form::date('date-hour', null, ['class' => 'form-control form-control-sm','id'=>'date-hour','required'],'Y-m-d') }}
                @if ($errors->has('date-hour'))
                    <small class="text-danger">{{ $errors->first('date-hour') }}</small>
                @endif
            </div>
            <div class="mt-1 mb-2 col-md-3">
                {{ form::label('setting_id', 'Clínica') }} <span class="text-danger">*</span>
                <select class="form-control form-control-sm setting_id selectpicker border show-tick" data-style="btn-white" title="Seleccione Clínica" id="setting_id"
                        name="setting_id" required>
                    @foreach($settings as $setting)
                        <option value="{{ $setting->id }}">{{ $setting->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-1 mb-2 col-md-6">
                {{ form::label('patient_id', 'Paciente') }} <span class="text-danger">*</span>
                <select class="form-control form-control-sm patient_id border selectpicker show-tick" data-style="btn-white" data-live-search="true"
                        title="Selecciona un Paciente"
                        id="patient_id" name="patient_id">
                    @foreach($patients as $patient)
                        <option
                            value="{{ $patient->id }}">{{ $patient->surname1 }} {{ $patient->surname2 }} {{ $patient->name1 }} {{ $patient->name2 }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-1 mb-2 col-md-12">
                <div class="row justify-content-end dentro">
                </div>
            </div>

            <div class="col-md-12">
                <hr class="mt-0">
            </div>
            <div class="mt-1 mb-2 col-md-2 d-none" id="seguro">
                <label>Seguro <span class="d-md-none d-lg-inline">Médico</span></label>
                {!! Form::select('insurace',['no' => 'No','yes'=>'Si'],null, ['class'=>'form-control form-control-sm myselect', "id"=>"myselect", "onchange='mostrar_control()'",'required']) !!}
                @if ($errors->has('insurace'))
                    <small class="text-danger">{{ $errors->first('insurace') }}</small>
                @endif
            </div>
            <div class="mt-1 mb-2 col-md-4 d-none" id="aseguradora">
                {{ form::label('company', 'Compañía') }}
                {{ form::text('company', null, ['class' => 'form-control form-control-sm','id'=>'company','placeholder'=>'Compañía Aseguradora']) }}
                @if ($errors->has('company'))
                    <small class="text-danger">{{ $errors->first('company') }}</small>
                @endif
            </div>
            <div class="mt-1 mb-2 col-md-3 d-none" id="aseguradora">
                {{ form::label('policy', 'Poliza') }}
                {{ form::text('policy', null, ['class' => 'form-control form-control-sm','id'=>'policy','placeholder'=>'Número...']) }}
                @if ($errors->has('policy'))
                    <small class="text-danger">{{ $errors->first('policy') }}</small>
                @endif
            </div>
            <div class="mt-1 mb-2 col-md-3 d-none" id="aseguradora" >
                {{ form::label('relation', 'Relación') }}
                {!! Form::select('relation',['Asegurado Principal' => 'Asegurado Principal','Cónyugue' => 'Cónyugue','Hijo(a)'=>'Hijo(a)','Empleado'=>'Empleado'],null, ['class'=>'form-control form-control-sm']) !!}
                @if ($errors->has('relation'))
                    <small class="text-danger">{{ $errors->first('relation') }}</small>
                @endif
            </div>
        </div>
    </div>
</div>


