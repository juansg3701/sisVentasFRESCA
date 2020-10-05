@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuarios</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Usuario: {{$usuario->nombre}}</h3>
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

	{!!Form::model($usuario,['method'=>'PATCH','route'=>['almacen.nomina.empleado.update',$usuario->id_empleado]])!!}
    {{Form::token()}}

	<div id=formulario>

		<div align="center">
		@if($usuario->correo=="")
		<input type="radio" name="rad" value="M" onclick="deshabilitar()" checked> Registro Normal &nbsp&nbsp&nbsp
		<input type="radio" name="rad" value="F" onclick="habilitar()"> Registrar Como Cuenta
		@else
		<input type="hidden" name="rad" value="M" onclick="deshabilitar()" > &nbsp&nbsp&nbsp
		<input type="hidden" name="rad" value="F" onclick="habilitar()" checked>
		@endif

		 
		</div>
		<br>

		Nombre:<input type="text" class="form-control" value="{{$usuario->nombre}}" name="nombre">
		Cargo<br>
		<select name="tipo_cargo_id_cargo" class="form-control">
			@foreach($cargos as $car)
				@if($car->id_cargo==$usuario->id_cargo)
				<option value="{{$car->id_cargo}}" selected>{{$car->nombre}}</option>
				@else
				<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
				@endif
			@endforeach
		</select>
		Sede<br>
		<select name="sede_id_sede" class="form-control">
			@foreach($sedes as $sed)
			@if($sed->id_sede==$usuario->id_sede)
			<option value="{{$sed->id_sede}}" selected>{{$sed->nombre_sede}}</option>
			@else
			<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
			@endif
			@endforeach
		</select>	
		Codigo<input type="text" class="form-control" name="codigo" value="{{$usuario->codigo}}">
		
		<script type="text/javascript">
				function habilitar() {
	            $("#id_correo").prop("disabled", false);
	            $("#id_contrasena").prop("disabled", false);
	        	} 
	        	function deshabilitar() {
	            $("#id_correo").prop("disabled", true);
	            $("#id_contrasena").prop("disabled", true);
	        	}
		</script>
		
		
		
		@if($usuario->contrasena=="")
		Correo<input id="id_correo" type="text" class="form-control" name="correo" value="{{$usuario->correo}}" disabled required>
		Contraseña<input id="id_contrasena" type="password" class="form-control" name="contrasena" value="{{$usuario->contrasena}}" disabled required>
		@else
		Correo<input id="id_correo" type="text" class="form-control" name="correo" value="{{$usuario->correo}}"  required>
		<input id="id_contrasena" type="hidden" class="form-control" name="contrasena" value="{{$usuario->contrasena}}"  required>
		@endif
		
		<br>
		<br>
		<div align="center">
			
		<button class="btn btn-info" type="submit">Guardar</button>
		
		<a href="{{url('almacen/usuario/permiso/cuenta')}}" class="btn btn-danger">Volver</a>
		</div>
</body>
</div>
	
{!!Form::close()!!}		

		

@stop