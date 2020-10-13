
@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Registrar clientes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<!--Control de errores en los campos del formulario-->	
	<div class="container col-sm-12" align="center">
		<div class="row" align="center">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				@if (count($errors)>0)
				<div class="alert alert-danger" align="center">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>

	<!--Llamado al método POST para registrar los datos en la ruta indicada por medio del controlador-->
	{!!Form::open(array('url'=>'almacen/cliente','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR CLIENTE</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Dirección:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="direccion">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="email" class="form-control" name="correo">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Teléfono:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="telefono">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre Empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_empresa">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										<select id='id_tipo_documento' name="tipo_documento" class="form-control">
											<option value="1" selected>Cédula</option>
											<option value="2">NIT</option>
										</select><br>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Cédula:</div>
									</div>
									<div class="form-group col-sm-3">
										<input id='id_cedula' class="form-control" type="number" class="" style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - -" size="30" maxlength="30" enabled>
										<input id='id_falso' type="number" name="verificacion_nit" placeholder="------"  size="11" maxlength="11" style="display:none">
									</div>
									<div class="form-group col-sm-2">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-3">
										<input id='id_nit' type="number"  class="form-control" style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - -" size="30" maxlength="30" required pattern=""  disabled>
									</div>
									<div class="form-group col-sm-2">
										
										<input id='id_digito' type="number"  class="form-control" style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required disabled><br><br>
									</div>
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
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/cliente')}}" class="btn btn-danger">Regresar</a>
									</div>
								</div>	
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>
		</div>
	</div>		                       
{!!Form::close()!!}		
</body>
@stop