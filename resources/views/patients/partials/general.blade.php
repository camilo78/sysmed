<div class="col-sm-12" style="padding-bottom: 15px">
	<div class="row">
	    <div class="col-sm-3 s_up">
	    	<input type="hidden" value="{{ $now->format('Y-m-d') }}" name="now">
	        {{ form::label('birth', 'Fecha de Nacimiento') }} <span class="text-danger">*</span>
	        {{ Form::date('birth', null, ['class' => 'form-control','id'=>'birth','required'],'Y-m-d') }}
	        @if ($errors->has('birth'))
	        <small class="text-danger">{{ $errors->first('birth') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-3 s_up">
	        {{ form::label('age', 'Edad') }}
	        {{ form::text('age', null, ['class' => 'form-control','id'=>'age', "readonly"]) }}
	        @if ($errors->has('age'))
	        <small class="text-danger">{{ $errors->first('age') }}</small>
	        @endif
	    </div>
	    <input type="hidden" id="id" value="{{ $id }}">
	    <div class="col-sm-3 s_up">
	        {{ form::label('patient_code', 'Código de Paciente') }}
	        {{ form::text('patient_code', null, ['class' => 'form-control',"id"=>"patient_code", "readonly"]) }}
	        @if ($errors->has('patient_code'))
	        <small class="text-danger">{{ $errors->first('patient_code') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-3 s_up">
	        {{ form::label('document_type', 'Tipo de Documento') }}
		    {!! Form::select('document_type',['No document'=>__('Sin documento'),'ID number' => __('ID number'),'Passport'=>__('Passport')],null, ['class'=>'form-control']) !!}
		    @if ($errors->has('document_type'))
		        <small class="text-danger">{{ $errors->first('document_type') }}</small>
		     @endif
    	</div>
    	<div class="col-sm-3 s_up">
	        {{ form::label('document', 'No. de Documento') }}
	        {{ form::text('document', null, ['class' => 'form-control','id'=>'document']) }}
	        @if ($errors->has('document'))
	        <small class="text-danger">{{ $errors->first('document') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-6 s_up">
	        {{ form::label('name_relation', 'Nombre de padre, madre o encargado') }}
	        {{ form::text('name_relation', null, ['class' => 'form-control','id'=>'name_relation']) }}
	        @if ($errors->has('name_relation'))
	        <small class="text-danger">{{ $errors->first('name_relation') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-3 s_up">
	        {{ form::label('kinship', 'Parentezco ') }}
	        {!! Form::select('kinship',[
	        	'No responsible'=>__('Sin responsable'),
	        	'Spouse'=>__('Spouse'),
	        	'Mother'=>__('Mother'),
	        	'Father' => __('Father'),
	        	'Partner'=>__('Partner'),
	        	'Son or Daughter'=>__('Son or Daughter'),
	        	'Aunt or Uncle'=>__('Aunt or Uncle'),
	        	'Cousin'=>__('Cousin'),
	        	'Other'=>__('Other')],null, ['class'=>'form-control','id'=>'kinship']) !!}
	        @if ($errors->has('kinship'))
	        <small class="text-danger">{{ $errors->first('kinship') }}</small>
	        @endif
    	</div>
    	<div class="col-sm-12 s_up">
	        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
	        {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
	    </div>
 	</div>

</div>
