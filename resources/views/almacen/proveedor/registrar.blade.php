@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor-Registrar</title>
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

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Proveedor</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Proveedor</li>
								<li class="active">Registrar Proveedor</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Llamado al método POST para registrar los datos en la ruta indicada por medio del controlador-->
	<br><br>{!!Form::open(array('url'=>'almacen/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}<br><br><br>

    <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR PROVEEDOR</h3>
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
										<div>Nombre Empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_empresa">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Contacto Empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_proveedor">
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
										<input type="number" class="form-control" name="telefono">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>No. Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="documento" min="0">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-6">
										<input type="number" class="form-control" name="nit" placeholder="- - - - - - -" min="0">
									</div>
									<div class="form-group col-sm-2">		
										<input type="number"  class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="" class="form-control" disabled="true">
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->user_id_user)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
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
										<select name="sede_id_sede" class="form-control" disabled="true">
											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede ==$s->id_sede)
											<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
											<input type="hidden" name="sede_id_sede" value="{{$s->id_sede}}">
											@endif
											@endforeach
										</select><br>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/proveedor')}}" class="btn btn-danger">Regresar</a>
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