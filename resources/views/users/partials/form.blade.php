<div class="form-group row">
    <div class="col-sm-3">
        {{ form::label('name', 'Nombre del usuario') }}
        {{ form::text('name', null, ['class' => 'form-control','placeholder' => 'Nombre completo del usuario']) }}
        @if ($errors->has('name'))
        <small class="text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
    <div class="col-sm-3">
        {{ form::label('email', 'Email') }}
        {{ form::text('email', null, ['class' => 'form-control','placeholder' => 'Correo Electrónico']) }}
        @if ($errors->has('email'))
        <small class="text-danger">{{ $errors->first('email') }}</small>
        @endif
    </div>
    <div class="col-sm-3">
        {{ form::label('date', 'Fecha de Nacimiento') }}
        {{ Form::date('date', null, ['class' => 'form-control'],'Y-m-d') }}
        @if ($errors->has('date'))
        <small class="text-danger">{{ $errors->first('date') }}</small>
        @endif
    </div>
    <div class="col-sm-3">
        {{ form::label('address', 'Dirección') }}
        {{ form::textarea('address', null, ['class' => 'form-control','placeholder' => 'Dirección exacta del usuario','rows' => 1]) }}
        @if ($errors->has('address'))
        <small class="text-danger">{{ $errors->first('address') }}</small>
        @endif
    </div>

@if (Route::currentRouteName() == 'users.create')

    <div class="col-sm-3">
        {{ form::label('password', 'Contraseña') }}
        {{ form::password('password', ['class' => 'form-control','placeholder' => 'Contraseña']) }}
        @if ($errors->has('password'))
        <small class="text-danger">{{ $errors->first('password') }}</small>
        @endif
    </div>
    <div class="col-sm-3">
        {{ form::label('password_confirm', 'Confirme la Contraseña') }}
        {{ form::password('password_confirm', ['class' => 'form-control','placeholder' => 'Contraseña']) }}
        @if ($errors->has('password_confirm'))
        <small class="text-danger">{{ $errors->first('password_confirm') }}</small>
        @endif
    </div>

@endif

    <div class="col-sm-3">
        {{ form::label('phone', 'Teléfono') }}
        {{ form::number('phone', null, ['class' => 'form-control','placeholder' => 'Numero de telefónico']) }}
        @if ($errors->has('phone'))
        <small class="text-danger">{{ $errors->first('phone') }}</small>
        @endif
    </div>
</div>
<hr>
<h2 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-user-tag"></i> {{ 'Lista de Roles' }}</h2>
<div class="form-group row">
    <div class="col-sm-12">
        <ul class="list-unstyled">
            @foreach($roles as $role)
            <li>
                <label>
                    {{ form::checkbox('roles[]', $role->id, null) }}
                    {{ $role->name }}
                    <em>({{ $role->description ?: 'N/A' }})</em>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Regresar</a>
        {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
</div>
