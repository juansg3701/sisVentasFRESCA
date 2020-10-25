@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuarios</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Empleados</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li><a href="#">Empleado</a></li>
								<li class="active"><a href="#">Editar empleado</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{!!Form::model($usuario,['method'=>'PATCH','route'=>['almacen.nomina.empleado.update',$usuario->id_empleado]])!!}
    {{Form::token()}}

     <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR CUENTA</h3>
			</div><br>

			<div class="col-sm-12" align="center">
				Editar datos de: {{$usuario->nombre}}
			</div><br>

			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div>
			                <div class="card-body card-block" align="center">
			                	<div align="center">
								@if($usuario->correo=="")
								<input type="radio" name="rad" value="M" onclick="deshabilitar()" checked> Registro Normal &nbsp&nbsp&nbsp
								<input type="radio" name="rad" value="F" onclick="habilitar()"> Registrar Como Cuenta
								@else
								<input type="hidden" name="rad" value="M" onclick="deshabilitar()" > &nbsp&nbsp&nbsp
								<input type="hidden" name="rad" value="F" onclick="habilitar()" checked>
								@endif
								</div>


								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre" value="{{$usuario->nombre}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cargo:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="tipo_cargo_id_cargo" class="form-control">
											@foreach($cargos as $car)
												@if($car->id_cargo==$usuario->id_cargo)
												<option value="{{$car->id_cargo}}" selected>{{$car->nombre}}</option>
												@else
												<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
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
										<select name="sede_id_sede" class="form-control">
											@foreach($sedes as $sed)
											@if($sed->id_sede==$usuario->id_sede)
											<option value="{{$sed->id_sede}}" selected>{{$sed->nombre_sede}}</option>
											@else
											<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Código:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="codigo" value="{{$usuario->codigo}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Dirección:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="direccion" value="{{$usuario->direccion}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Telefono:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="telefono" value="{{$usuario->telefono}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="documento" value="{{$usuario->documento}}">
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="id_correo" type="text" class="form-control" name="correo" value="{{$usuario->correo}}"  disabled="true">

										<input id="id_correo" type="hidden" class="form-control" name="correo" value="{{$usuario->correo}}" >
									
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Guardar</button>
										<a href="{{url('almacen/nomina/empleado')}}" class="btn btn-danger">Volver</a>
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

		

@stop