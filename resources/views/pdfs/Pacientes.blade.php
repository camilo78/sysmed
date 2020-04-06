<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
<style type="text/css">
	/* Curso CSS estilos aprenderaprogramar.com*/
body {
	font-family: Arial, Helvetica, sans-serif;
	color: #669; 
}
h1{
	font-size: 24px;
	font-weight: 700;
	text-align: center;
	line-height:5px
	text-transform: uppercase;
}
p{
	line-height:5px
}
table {     
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 11px;    
    width: 100%; 
    text-align: left;   
    border-collapse: collapse; 
}

th {     
    text-align: left;
	font-size: 13px;     
	font-weight: normal;     
	padding: 8px;     
	background: #b9c9fe;
    border-top: 4px solid #aabcfe;    
    border-bottom: 1px solid #fff; 
    color: #039; 
}

td {    
	padding: 8px;     
	background: #e8edff;     
	border-bottom: 1px solid #fff;
    color: #669;   
    border-top: 1px solid transparent; 
 }

 .footer{
 	font-size: xx-small;
 	margin-top: 5px;
 	color: #669;  
 	float: right;
 }

</style>
    </head>
<body>
    <div style="margin-top: -20px; padding-bottom: 10px">
        @forelse($settings as $setting)
        <img class="img-fluid" style="float:left; width: 90px; margin-right: 20px"  src="{{ $setting->image == 'noimage.jpg' ? asset('/img/noimage.jpg'):  asset('storage/'.$setting->image) }}">
        <h3>{{ $setting->name }}</h3>
        @empty
        @endforelse
    	<h4 style="margin-top: -12px;">Reporte de Pacientes</h4>
    	<p style="margin-top: -10px; font-size: 14px">Para el {{ $date }}</p>
    </div>
<table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Expediente</th>
                            <th>Nombre</th>
                            <th>Sx</th>
                            <th>Edad</th>
                            <th>Documento</th>
                            <th>Estado</th>
                            <th>Encargado</th>
                            <th>Teléfonos</th>
                            <th>Email</th>
                            <th>País</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                        <tr>
                            <td class="show" >{{ $patient->patient_code }}</td>
                            <td class="show" >{{ $patient->name1 .' '. $patient->name2 .' '. $patient->surname1.' '. $patient->surname2 }}
                            @if($patient->married_name)
                            {{ ' de '.$patient->married_name }}
                            @endif

                            </td>
                            <td class="show" >{{ $patient->gender }}</td>
                            <td class="show" >
                                 @if(\Carbon\Carbon::parse($patient->birth)->age === 0)
                                {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m meses %d días') }}
                                @elseif(\Carbon\Carbon::parse($patient->birth)->age < 3)
                                    {{ \Carbon\Carbon::parse($patient->birth)->age }} año
                                    {{ \Carbon\Carbon::parse($patient->birth)->diff(\Carbon\Carbon::now())->format('%m meses') }}
                                @elseif(\Carbon\Carbon::parse($patient->birth)->age === 1)
                                    {{ \Carbon\Carbon::parse($patient->birth)->age }} año
                                @else
                                    {{ \Carbon\Carbon::parse($patient->birth)->age }} años
                                @endif
                            </td>
                            <td class="show" >{{ __($patient->document_type) .' '.$patient->document }}</td>
                            <td class="show" >{{ __($patient->status) }}</td>
                            <td class="show" >
                                @if($patient->name_relation)
                                {{ $patient->name_relation .' ('. __($patient->kinship).')' }}
                                @endif
                            </td>
                            <td class="show" >{{ $patient->phone1 .' '. $patient->phone2 }}</td> 
                            <td class="show" >{{ $patient->email }}</td>
                            <td class="show" >{{ $patient->country }}</td>
                            <td class="show" >{{ $patient->city_town }}</td>
                            <td class="show" >{{ $patient->address }}</td>
                        </tr>
                        @empty
                        <div class="text-center text-danger">No hay coincidencias para esa busqueda</div>
                        @endforelse
                    </tbody>
                </table>
                <p class="footer">Copyright © Emprende en la Web 2019</p>
</body>
</html>