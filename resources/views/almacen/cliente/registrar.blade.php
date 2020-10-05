
@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar Cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/cliente','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre">
			Dirección<input type="text" class="form-control" name="direccion">
			Correo<input type="email" class="form-control" name="correo">
			Teléfono<input type="text" class="form-control" name="telefono">
			Nombre Empresa<input type="text" class="form-control" name="nombre_empresa">
			Cartera<br>
			<select name="cartera_activa" class="form-control">
				<option value="1">Activa</option>
				<option value="0">Inactiva</option>
			</select>	
			<div>
				<script type="text/javascript">
				$( function() {
	    		$("#id_tipo_documento").change( function() {
	       	 	if ($(this).val() === "1") {
	            $("#id_cedula").prop("disabled", false);
	             $("#id_falso").prop("disabled", false);
	        	} else {
	            $("#id_cedula").prop("disabled", true);
	            $("#id_falso").prop("disabled", true);
	        	}
	        	if ($(this).val() === "2") {
	            $("#id_nit").prop("disabled", false);
	            $("#id_digito").prop("disabled", false);
	        	} else {
	            $("#id_nit").prop("disabled", true);
	            $("#id_digito").prop("disabled", true);
	        	}
	    		});
				});
				</script>
				Documento<br>
				<select id='id_tipo_documento' name="tipo_documento" class="form-control">
					<option value="1" selected>Cédula</option>
					<option value="2">NIT</option>
				</select><br>
				<div align="center">
				Cédula:
				<input id='id_cedula' type="number" class="" style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - -" size="30" maxlength="30" enabled>
				<input id='id_falso' type="number" name="verificacion_nit" placeholder="------"  size="11" maxlength="11" style="display:none">
				NIT:
				<input id='id_nit' type="number" class="" style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - -" size="30" maxlength="30" required pattern=""  disabled>-
				<input id='id_digito' type="number"class=""style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required disabled><br><br>
				</div>
			</div>

			<br>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar Cliente</button>
			<a href="{{url('almacen/cliente')}}" class="btn btn-danger">Volver</a>
		</div>
		</div>
	</div>
{!!Form::close()!!}		
</body>

@stop