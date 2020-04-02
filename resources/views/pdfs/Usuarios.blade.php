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
	text-align: center;
	line-height:5px
}
table {     
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 12px;    
    width: 100%; 
    text-align: left;   
    border-collapse: collapse; 
}

th {     
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
	<h1>Reporte de Usuarios Sysmed </h1>
	<p>Para el <span>{{ $date }}</span></p>
<table class="table table-hover table-responsive-sm small">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="show" data-id="{{ $user->id }}">{{ $user->name }}</td>
                            <td class="show" data-id="{{ $user->id }}">{{ $user->email }}</td>
                            <td class="show" data-id="{{ $user->id }}">{{ $user->phone }}</td>
                            <td class="show" data-id="{{ $user->id }}">
                                @if(\Carbon\Carbon::parse($user->date)->age === 0)
                                {{ \Carbon\Carbon::parse($user->date)->diff(\Carbon\Carbon::now())->format('%m meses %d días') }}
                                @elseif(\Carbon\Carbon::parse($user->date)->age < 3)
                                    {{ \Carbon\Carbon::parse($user->date)->age }} año
                                    {{ \Carbon\Carbon::parse($user->date)->diff(\Carbon\Carbon::now())->format('%m meses') }}
                                @elseif(\Carbon\Carbon::parse($user->date)->age === 1)
                                    {{ \Carbon\Carbon::parse($user->date)->age }} año
                                @else
                                    {{ \Carbon\Carbon::parse($user->date)->age }} años
                                @endif
                            </td>
                            <td class="show" data-id="{{ $user->id }}">{{ !empty($user->roles()->first()->name) ? $user->roles()->first()->name: 'S/R' }}</td>
                           
                        </tr>
                        @empty
                        <div class="text-center text-danger">No hay coincidencias para esa busqueda</div>
                        @endforelse
                    </tbody>
                </table>
                <p class="footer">Copyright © Emprende en la Web 2019</p>
</body>
</html>