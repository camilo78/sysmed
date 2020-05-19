<div class="row mt-4">
    <div class="card border-warning col-md-12 bg-gray-100">
        <div class="row mt-2 mb-2">
            <div class="mt-1 mb-2 col-md-6 pr-md-0">
                <h5 class="card-title"><i class="fas fa-fw fa-thermometer"></i> Mediciones y Signos Vitales</h5>
                <div class="row" style="margin-top: -7px">
                    <div class="col-md-4 mt-2">
                        {{ form::label('height', 'Estatura') }}
                        <div class="row">
                            <div class="col-6 pr-0">
                                {!! Form::number('height', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                                @if ($errors->has('height'))
                                    <small class="text-danger">{{ $errors->first('height') }}</small>
                                @endif
                            </div>
                            <div class="col-6 pl-0">
                                {!! Form::select('height_unit',['cms.' => 'cms.','pulg.' => 'pulg.'],null, ['class'=>'form-control form-control-sm']) !!}
                                @if ($errors->has('height_unit'))
                                    <small class="text-danger">{{ $errors->first('height_unit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        {{ form::label('weight', 'Peso') }}
                        <div class="row">
                            <div class="col-6 pr-0">
                                {!! Form::number('weight', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                                @if ($errors->has('weight'))
                                    <small class="text-danger">{{ $errors->first('weight') }}</small>
                                @endif
                            </div>
                            <div class="col-6 pl-0">
                                {!! Form::select('weight_unit',['libras.' => 'libras.','kgs.' => 'kgs.','gramos.' => 'gramos.'],null, ['class'=>'form-control form-control-sm']) !!}
                                @if ($errors->has('weight_unit'))
                                    <small class="text-danger">{{ $errors->first('weight_unit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        {{ form::label('temp', 'Temp. (°C)') }}
                        <div class="row">
                            <div class="col-6 pr-0">
                                {!! Form::number('temp', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                                @if ($errors->has('temp'))
                                    <small class="text-danger">{{ $errors->first('temp') }}</small>
                                @endif
                            </div>
                            <div class="col-6 pl-0">
                                {!! Form::select('temp_unit',['Oral' => 'Oral','Axilar' => 'Axilar','Rectal' => 'Rectal','Frontal' => 'Frontal'],null, ['class'=>'form-control form-control-sm']) !!}
                                @if ($errors->has('temp_unit'))
                                    <small class="text-danger">{{ $errors->first('temp_unit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label><span class="d-md-none d-lg-inline">C.Craneal</span> (CC)</label>
                        <div class="row">
                            <div class="col-6 pr-0">
                                {!! Form::number('cranial', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                                @if ($errors->has('cranial'))
                                    <small class="text-danger">{{ $errors->first('cranial') }}</small>
                                @endif
                            </div>
                            <div class="col-6 pl-0">
                                {!! Form::select('cranial_unit',['cms.' => 'cms.','pulg.' => 'pulg.'],null, ['class'=>'form-control form-control-sm']) !!}
                                @if ($errors->has('cranial_unit'))
                                    <small class="text-danger">{{ $errors->first('cranial_unit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label><span class="d-md-none d-lg-inline">D. Cintura</span> (DC)</label>
                        <div class="row">
                            <div class="col-6 pr-0">
                                {!! Form::number('waist', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                                @if ($errors->has('waist'))
                                    <small class="text-danger">{{ $errors->first('waist') }}</small>
                                @endif
                            </div>
                            <div class="col-6 pl-0">
                                {!! Form::select('waist_unit',['cms.' => 'cms.','pulg.' => 'pulg.'],null, ['class'=>'form-control form-control-sm']) !!}
                                @if ($errors->has('waist_unit'))
                                    <small class="text-danger">{{ $errors->first('waist_unit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <label><span class="d-md-none d-lg-inline">Presión Arterial</span> (PA)</label>
                        {{ form::text('pressure', null, ['class' => 'form-control form-control-sm','id'=>'pressure','placeholder'=>'###/##']) }}
                        @if ($errors->has('pressure'))
                            <small class="text-danger">{{ $errors->first('pressure') }}</small>
                        @endif
                    </div>
                    <div class="col-md-4 mt-2">
                        <label><span class="d-md-none d-lg-inline">Frec. Cardiaca</span> (FC)</label>
                        {!! Form::number('cardiac', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                        @if ($errors->has('cardiac'))
                            <small class="text-danger">{{ $errors->first('cardiac') }}</small>
                        @endif
                    </div>
                    <div class="col-md-4 mt-2">
                        <label><span class="d-md-none d-lg-inline">Frec. Respiratoria</span> (FR)</label>
                        {!! Form::number('breathing', '0.00', [ 'class' => 'text-center form-control form-control-sm']) !!}
                        @if ($errors->has('breathing'))
                            <small class="text-danger">{{ $errors->first('breathing') }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-1 mb-2 col-md-6">
                <h5 class="card-title">Observaciones</h5>
                {{ form::textarea('measurements_note', null, ['class' => 'form-control','id'=>'address','rows'=>'8']) }}
                @if ($errors->has('measurements_note'))
                    <small class="text-danger">{{ $errors->first('measurements_note') }}</small>
                @endif
            </div>
            <div class="col-sm-12 mt-2">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
                {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
            </div>
        </div>
    </div>
</div>
