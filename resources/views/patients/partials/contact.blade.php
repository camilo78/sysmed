<div class="col-sm-12" style="padding-bottom: 15px">
	<div class="row">
    	<div class="col-sm-3 s_up">
	        {{ form::label('phone1', 'Teléfono N° 1') }}
	        {{ form::text('phone1', null, ['class' => 'form-control','id'=>'phone1']) }}
	        @if ($errors->has('phone1'))
	        <small class="text-danger">{{ $errors->first('phone1') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-3 s_up">
	        {{ form::label('phone2', 'Teléfono N° 2') }}
	        {{ form::text('phone2', null, ['class' => 'form-control','id'=>'phone2']) }}
	        @if ($errors->has('phone2'))
	        <small class="text-danger">{{ $errors->first('phone2') }}</small>
	        @endif
	    </div>
	     <div class="col-sm-3 s_up">
	        {{ form::label('email', 'Correo Electrónico') }}
	        {{ form::email('email', null, ['class' => 'form-control','id'=>'email']) }}
	        @if ($errors->has('email'))
	        <small class="text-danger">{{ $errors->first('email') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-3 s_up">
	        {{ form::label('city_town', 'Ciudad o Municipio') }}
	        {{ form::text('city_town', null, ['class' => 'form-control','id'=>'city_town']) }}
	        @if ($errors->has('city_town'))
	        <small class="text-danger">{{ $errors->first('city_town') }}</small>
	        @endif
	    </div>
	    <div class="col-sm-6 s_up">
	        {{ form::label('address', 'Dirección') }}
	        {{ form::textarea('address', null, ['class' => 'form-control','id'=>'address','rows'=>'1']) }}
	        @if ($errors->has('address'))
	        <small class="text-danger">{{ $errors->first('address') }}</small>
	        @endif
	    </div>
    	<div class="col-sm-12 s_up">
	        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
	        {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
	    </div>
 	</div>
</div>
