<div class="row" style="margin-top: -15px">
    <div class="col-sm-3 s_up">
        {{ form::label('name1', 'Primer Nombre') }} <span class="text-danger">*</span>
        {{ form::text('name1', null, ['class' => 'form-control','id'=>'name1','required']) }}
        @if ($errors->has('name1'))
        <small class="text-danger">{{ $errors->first('name1') }}</small>
        @endif
    </div>
    <div class="col-sm-3 s_up">
        {{ form::label('name2', 'Segundo Nombre') }}
        {{ form::text('name2', null, ['class' => 'form-control']) }}
        @if ($errors->has('name2'))
        <small class="text-danger">{{ $errors->first('name2') }}</small>
        @endif
    </div>
    <div class="col-sm-3 s_up">
        {{ form::label('surname1', 'Primer Apellído') }} <span class="text-danger">*</span>
        {{ form::text('surname1', null, ['class' => 'form-control','id'=>'surname1','required']) }}
        @if ($errors->has('surname1'))
        <small class="text-danger">{{ $errors->first('surname1') }}</small>
        @endif
    </div>
    <div class="col-sm-3 s_up">
        {{ form::label('surname2', 'Segundo Apellído') }}
        {{ form::text('surname2', null, ['class' => 'form-control']) }}
        @if ($errors->has('name2'))
        <small class="text-danger">{{ $errors->first('surname2') }}</small>
        @endif
    </div>
     <div class="col-sm-3 s_up">
        {{ form::label('gender', 'Sexo') }} <span class="text-danger">*</span>
        {!! Form::select('gender',['M' => 'Hombre','F'=>'Mujer'],null, ['class'=>'form-control myselect','placeholder'=>'Seleccione el sexo', "id"=>"myselect", "onchange='mostrar_control()'",'required']) !!}
        @if ($errors->has('gender'))
        <small class="text-danger">{{ $errors->first('gender') }}</small>
        @endif
    </div>
     <div class="col-sm-3 s_up"  style="display: none;" id="Texto">
        {{ form::label('civil', 'Estado Civil' ) }}
        {!! Form::select('civil',['S'=>'Soltera','M' => 'Casada'],null, ['class'=>'form-control myselect', "id"=>"myselect1", "onchange='mostrar_control1()'",'placeholder'=>'Seleccione estado civil']) !!}
        @if ($errors->has('civil'))
        <small class="text-danger">{{ $errors->first('civil') }}</small>
        @endif
    </div>
    <div class="col-sm-3 s_up" style="display: none" id="Texto1">
        {{ form::label('married_name', 'Apellído de Casada') }}
        {{ form::text('married_name', null, ['class' => 'form-control']) }}
        @if ($errors->has('married_name'))
        <small class="text-danger">{{ $errors->first('married_name') }}</small>
        @endif
    </div>
    <div class="col-sm-3 s_up">
        {{ form::label('status', 'Estado') }}
        {!! Form::select('status',['active' => __('Active'),'disabled'=>__('Disabled')],null, ['class'=>'form-control myselect', "id"=>"status", "onchange='mostrar_control()'"]) !!}
        @if ($errors->has('status'))
        <small class="text-danger">{{ $errors->first('status') }}</small>
        @endif
    </div>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 25px">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true"><i class="fas fa-history"></i> Datos Generales</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false"><i class="fas fa-address-book"></i> Datos de Contacto</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('patients.partials.general')
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('patients.partials.contact')
    </div>
</div>
