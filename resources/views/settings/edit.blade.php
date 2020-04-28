@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
{{-- @include('flash::message') --}}
<div class="row">
    <div class="col-md-12 ">
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-edit"></i> Editar Clínica</h1>
    </div>
    <div class="col-md-12 mx-auto">
        {!! Form::model($setting, ['route' => ['settings.update',$setting->id],
        'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        @include('settings.partials.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.dropify').dropify({
messages: {
'default': 'Arrastra y suelta un archivo aquí o haz clic',
'replace': 'Arrastra y suelta o haz clic para reemplazar',
'remove':  'Eliminar',
'error':   'Vaya, algo malo sucedió.'
},
defaultFile: '{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}',
});
});
</script>
@endsection