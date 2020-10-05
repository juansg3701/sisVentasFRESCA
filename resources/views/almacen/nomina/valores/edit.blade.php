@extends ('layouts.admin')
@section ('contenido')
<body>
	<div class="row">
		<div align="center">
			<h3>Valores por Hora de Empleado</h3>
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
	
	
    {!!Form::model($cargo,['method'=>'PATCH','route'=>['almacen.nomina.valores.update',$cargo->id_cargo]])!!}
    
	{{Form::token()}}
	<div id=formulario>
		<div class="form-group">

			Nombre:<input type="text" class="form-control" value="{{$cargo->nombre}}" name="nombre" readonly="readonly">
			Descripción:<input type="text" class="form-control" value="{{$cargo->descripcion}}" name="descripcion" readonly="readonly">
			Valor de Hora Ordinaria<input type="number" class="form-control" name="horaordinaria" value="{{$cargo->horaordinaria}}" >
			Valor de Hora Dominical<input type="number" class="form-control" name="horadominical" value="{{$cargo->horadominical}}">
			Valor de Hora Extraordinaria<input type="number" class="form-control" name="horaextra" value="{{$cargo->horaextra}}"><br>
			Valor de Hora Extradominical<input type="number" class="form-control" name="horaextdom" value="{{$cargo->horaextdom}}"><br>
			Fecha<input type="datetime" class="form-control" name="fecha" value="<?php echo date("Y/m/d"); ?>" readonly><br>
			<div align="center">
			<button class="btn btn-info">Asignar Valores</button>
			<a href="{{url('almacen/nomina/valores')}}" class="btn btn-danger">Volver</a>
			
			</div>
		</div>
	</div>
	{!!Form::close()!!}	
</body>

@stop