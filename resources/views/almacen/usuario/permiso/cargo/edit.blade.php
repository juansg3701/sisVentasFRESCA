@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cargo</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Cargo: {{$cargo->nombre}}</h3>
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

	{!!Form::model($cargo,['method'=>'PATCH','route'=>['almacen.usuario.permiso.cargo.update',$cargo->id_cargo]])!!}
    {{Form::token()}}

	<div id=formulario>
		Nombre:<input type="text" class="form-control" value="{{$cargo->nombre}}" name="nombre">
		Descripción:<input type="text" class="form-control" value="{{$cargo->descripcion}}" name="descripcion">
		<input type="number" class="form-control" name="horaordinaria" value="{{$cargo->horaordinaria}}" style="display:none">
		<input type="number" class="form-control" name="horadominical" value="{{$cargo->horadominical}}" style="display:none">
		<input type="number" class="form-control" name="horaextra" value="{{$cargo->horaextra}}" style="display:none">
		<input type="datetime" class="form-control" name="fecha" value="{{$cargo->fecha}}" style="display:none">
		<br>
		<div align="center">
			
		<button class="btn btn-info" type="submit">Registrar</button>
		<a href="{{url('almacen/usuario/permiso/cargo')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>
	
{!!Form::close()!!}		
</body>

@stop