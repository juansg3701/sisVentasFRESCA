@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar cuenta bancaria</h3>
		</div>
	</div>


	<div id=formulario>
		Id: <input type="text" class="form-control" name="id">
		Nombre banco:<input type="text" class="form-control" name="nombreBanco">
		Intereses:<input type="text" class="form-control" name="Intereses">
		No. Cuenta:<input type="text" class="form-control" name="NoCuenta">
		Tipo de cuenta: 
		<select name="Cargo" class="form-control">
				<option>Seleccione tipo</option>
			</select>	
			<br>
			<div align="center">
			<button class="btn btn-info">Registrar</button>
			<button class="btn btn-info">Regresar</button>
			</div>
		</div>
	</div>

</body>

@stop