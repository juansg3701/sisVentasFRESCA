@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<font size=3 face="Verdana">INICIAR SESIÓN</font>
		</div>
	</div><br>
{!!Form::open(array('url'=>'almacen/usuario/iniciar','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Correo<input type="text" class="form-control" name="correo">
			Contraseña<input type="password" class="form-control" name="contraseña"><br>
			<div align="center">
				<button class="btn btn-info" type="submit">Iniciar Sesión</button>
				<a href=""><button class="btn btn-danger">Salir</button></a>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
</body>

@stop
