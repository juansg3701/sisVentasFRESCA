@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row" align="center">
		<h3>HORARIOS REGISTRADOS</h3><br>
		<h4>¡Se ha eliminado el registro con éxito!</h3><br>
		@include('almacen.nomina.lista_horarios.search4')
	</div>
</body>
@stop