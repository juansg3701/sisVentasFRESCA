@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Horario de Empleado</h3>
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

	{!!Form::open(array('url'=>'almacen/nomina/horario','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario><br>
		<div class="form-group">
			<input type="hidden" class="form-control" name="id" disabled>
			Nombre del empleado<br>
			<select name="empleado_id_empleado" class="form-control">
				@foreach($usuarios as $usu)
				<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
				@endforeach
			</select>
			Fecha<input type="datetime" class="form-control" name="fecha" value="<?php echo date("Y/m/d");?>">
			Hora de entrada<input type="time" class="form-control" name="horaentrada" value="<?php echo date("H:i"); ?>">
			Hora de salida<input type="time" class="form-control" name="horasalida" value="<?php echo date("H:i"); ?>">
			</form>
			<br>	
			Seleccione Jornada<br>
			<div align="center">
			<input type="radio" name="jornada" value="Ordinaria"> Ordinaria &nbsp&nbsp&nbsp
			<input type="radio" name="jornada" value="Extraordinaria"> Extraordinaria &nbsp&nbsp&nbsp
			<input type="radio" name="jornada" value="Dominical"> Dominical &nbsp&nbsp&nbsp
			<input type="radio" name="jornada" value="Extradominical"> Extradominical<br>
			</div><br>
			<div align="center">
			
			<button class="btn btn-info">Guardar Registro</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			<br><br>
			@include('almacen.nomina.horario.search3')
			</div>
		</div>
	</div>
	{!!Form::close()!!}	

</body>
@stop

