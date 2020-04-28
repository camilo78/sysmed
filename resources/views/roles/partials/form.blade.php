<div class=" row">
    <div class="col-sm-4 s_up">
        {{ form::label('name', 'Nombre del rol') }}
        {{ form::text('name', null, ['class' => 'form-control','placeholder' => 'Nombre del rol']) }}
        @if ($errors->has('name'))
        <small class="text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
    <div class="col-sm-4 s_up">
        {{ form::label('slug', 'Url amigable') }}
        {{ form::text('slug', null, ['class' => 'form-control','placeholder' => 'Url amigable al usuario']) }}
        @if ($errors->has('slug'))
        <small class="text-danger">{{ $errors->first('slug') }}</small>
        @endif
    </div>
    <div class="col-sm-4 s_up">
        {{ form::label('description', 'Descripción') }}
        {{ form::textarea('description', null, ['class' => 'form-control','placeholder' => 'Descripción del rol','rows' => 1]) }}
        @if ($errors->has('description'))
        <small class="text-danger">{{ $errors->first('description') }}</small>
        @endif
    </div>
    
</div>
<hr>
<h2 class="h4 mb-4 text-gray-800">{{ 'Permiso Especial' }}</h2>
<div class="form-group row">
   <div class="col-sm-6 s_up">
    	<label> {{ Form::radio('special', 'all-access') }} Acceso Total</label>
    	<label> {{ Form::radio('special', 'no-access') }} Ningún Acceso</label>
  </div>
</div>  
  <hr>
  <h2 class="h4 mb-4 text-gray-800">{{ 'Lista de Permisos' }}</h2>
<div class="form-group row">
    <div class="col-sm-12 s_up">
        <ul class="list-unstyled">
            @foreach($permissions as $permission)
            <li>
                <label>
                    {{ form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                    <em>({{ $permission->description ?: 'N/A' }})</em>
                </label> 
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12 s_up">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
        {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
</div>