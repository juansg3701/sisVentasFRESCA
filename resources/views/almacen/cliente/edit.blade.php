@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar cliente</title>
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

	<!--Código de JQuery para mostrar/esconder los campos del atributo documento-->
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

	{!!Form::model($cliente,['method'=>'PATCH','route'=>['almacen.cliente.update',$cliente->id_cliente]])!!}
    {{Form::token()}}

    <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR CLIENTE</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre" value="{{$cliente->nombre}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Dirección:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="direccion" value="{{$cliente->direccion}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="correo" value="{{$cliente->correo}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Teléfono:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="telefono" value="{{$cliente->telefono}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre Empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_empresa" value="{{$cliente->nombre_empresa}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Categoría:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="categoria_cliente_id_categoria" class="form-control">
											@foreach($categoria_cliente as $car)
												@if($car->id_categoria==$cliente->categoria_cliente_id_categoria)
												<option value="{{$car->id_categoria}}" selected>{{$car->nombre}}</option>
												@else
												<option value="{{$car->id_categoria}}">{{$car->nombre}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>



								@if($cliente->verificacion_nit=="")
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
										<input id='id_cedula' class="form-control" type="number" class="" name="documento" placeholder="- - - - - - -" min="0" value="{{$cliente->documento}}" enabled>
										<input id='id_falso' type="number" name="verificacion_nit" placeholder="------" style="display:none">
									</div>
									<div class="form-group col-sm-2">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-3">
										<input id='id_nit' type="number"  class="form-control" name="documento" placeholder="- - - - - - -" min="0" required disabled>
									</div>
									<div class="form-group col-sm-2">
										<input id='id_digito' type="number" class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9" required disabled><br><br>
									</div>	
								</div>
								@else
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										<select id='id_tipo_documento' name="tipo_documento" class="form-control">
											<option value="1">Cédula</option>
											<option value="2" selected>NIT</option>
										</select><br>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Cédula:</div>
									</div>
									<div class="form-group col-sm-3">
										<input id='id_cedula' class="form-control" type="number" name="documento" placeholder="- - - - - - -" min="0" disabled>
										<input id='id_falso' type="number" name="verificacion_nit" placeholder="------" style="display:none">
									</div>
									<div class="form-group col-sm-2">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-3">
										<input id='id_nit' type="number" class="form-control" name="documento" placeholder="- - - - - - -" min="0" value="{{$cliente->documento}}" required enabled>
									</div>
									<div class="form-group col-sm-2">
										<input id='id_digito' type="number"  class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9" value="{{$cliente->verificacion_nit}}" required enabled><br><br>
									</div>	
								</div>
								@endif

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="hidden" name="empleado_id_empleado" value="{{Auth::user()->id}}">

										<select name="empleado_id_empleado" class="form-control" readonly>
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->users_id)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											@endif
											@endforeach

											@foreach($usuarios as $usu)
											@if(Auth::user()->id!=$usu->users_id)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											@endif
											@endforeach	
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="hidden" name="sede_id_sede" value="{{Auth::user()->id}}">

										<select name="sede_id_sede" class="form-control" readonly>
											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede ==$s->id_sede)
											<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
											aa
											@endif
											@endforeach

											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede!=$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											aa
											@endif
											@endforeach
										</select><br>
									</div>
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