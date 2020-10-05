@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar Empleado Sin Cuenta</h3>
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


	{!!Form::open(array('url'=>'almacen/nomina/empleado','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
	<div id=formulario>
		Cargo<br>
		<select name="tipo_cargo_id_cargo" class="form-control">
			@foreach($cargos as $car)
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endforeach
		</select>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre">
			
			Sede<br>
			<select name="sede_id_sede" class="form-control">
				@foreach($sedes as $sed)
				<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
				@endforeach
			</select>
			Código<input type="text" class="form-control" name="codigo"><br>
			
			<div align="center">
				<a href="usuario/iniciar/sesionIniciada"><button class="btn btn-info" type="submit">Registrar Usuario</button></a>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>	
			<input type="email" name="correo" style="visibility:hidden">
			<input type="password"  name="contrasena" style="visibility:hidden">
		</div>
	</div>
	{!!Form::close()!!}	
</body>

@stop

@section('tabla')
<h3>Lista de Empleados Sin Cuenta</h3><br>
	Nombre del empleado:
	@include('almacen.nomina.empleado.search')<br>
	<div class="row">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre Empleado</th>		
							<th>Cargo</th>
							<th>Sede</th>
							<th>Código</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($usuarios as $usu)
						@if($usu->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $usu->id_empleado}}</td>
							<td>{{ $usu->nombre}}</td>
							
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>{{ $usu->codigo}}</td>
							<td>
								<a href="{{URL::action('EmpleadoController@edit',$usu->id_empleado)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$usu->id_empleado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $usu->id_empleado}}</td>
							<td>{{ $usu->nombre}}</td>
							
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>{{ $usu->codigo}}</td>
							<td>
								<a href="{{URL::action('EmpleadoController@edit',$usu->id_empleado)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$usu->id_empleado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@endif
						
						@include('almacen.nomina.empleado.modal')
						@endforeach
					</table>
				</div>
				{{$usuarios->render()}}
			</div>
	</div><br>
@stop