<div class="row">
	<div class="col-md-3 s_up">
		<input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
		{{ form::label('image', 'Logo de la Clínica') }}
		{{ Form::file('image',['class' => 'dropify', 'value'=>""])}}
		@if ($errors->has('image'))
	    <small class="text-danger">{{ $errors->first('image') }}</small>
	   	@endif
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-sm-6 s_up">
			    {{ form::label('name', 'Nombre') }}
			   	{{ form::text('name', null, ['class' => 'form-control','placeholder' => 'Nombre de la clínica']) }}
			  	@if ($errors->has('name'))
			  	<small class="text-danger">{{ $errors->first('name') }}</small>
			  	@endif
			</div>
			<div class="col-sm-6 s_up">
			   	{{ form::label('phone', 'Teléfono') }}
		        {{ form::number('phone', null, ['class' => 'form-control','placeholder' => 'Numero de telefónico']) }}
		        @if ($errors->has('phone'))
		        <small class="text-danger">{{ $errors->first('phone') }}</small>
		        @endif
			</div>
			<div class="col-sm-6 s_up">
			  	{{ form::label('web', 'Web') }}
			  	{{ form::text('web', null, ['class' => 'form-control','placeholder' => 'Sitio Web de la clínica']) }}
			   	@if ($errors->has('web'))
			 	<small class="text-danger">{{ $errors->first('web') }}</small>
			   	@endif
			</div>
			<div class="col-sm-6 s_up">
			  	{{ form::label('address', 'Dirección') }}
			  	{{ form::textarea('address', null, ['class' => 'form-control','placeholder' => 'Dirección de la clínica','rows' => 2]) }}
			   	@if ($errors->has('address'))
			   	<small class="text-danger">{{ $errors->first('address') }}</small>
			   	@endif
			</div>
		</div>
	</div>
</div>
<br>
<div class="form-group row">
	<div class="col-sm-12 s_up">
	   	<a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
	   	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
	</div>
</div>
