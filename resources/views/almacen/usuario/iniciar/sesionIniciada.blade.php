@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			
			<input type="text" class="form-control" name="query" value="{{$query}}">
	
			
		</div>
	</div><br>
</body>

@stop