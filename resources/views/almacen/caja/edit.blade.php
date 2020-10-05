@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Caja: {{$caja->id_caja}}</h3>
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
	{!!Form::model($caja,['method'=>'PATCH','route'=>['almacen.caja.update',$caja->id_caja]])!!}
    {{Form::token()}}

	<div id=formulario>

		<div align="center">
		Cargo: 
		<select name="tipo_cargo_id_cargo" class="">
			@foreach($cargos as $car)
			
			@if($car->id_cargo==$caja->tipo_cargo_id_cargo)
			<option value="{{$car->id_cargo}}" selected>{{$car->nombre}}</option>
			@else
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endif
			@endforeach
		</select>
		Empleado: 
		<select name="empleado_id_empleado" class="">
			@foreach($usuarios as $usu)
			@if($usu->id_empleado==$caja->empleado_id_empleado)
			<option value="{{$usu->id_empleado}}" selected>{{$usu->nombre}}</option>
			@else
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endif
			@endforeach
		</select><br><br>
		Sede: 
		<select name="sede_id_sede" class="">
			@foreach($sedes as $sed)
			@if($sed->id_sede==$caja->sede_id_sede)
			<option value="{{$sed->id_sede}}" selected>{{$sed->nombre_sede}}</option>
			@else
			<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
			@endif
			@endforeach
		</select>
		Fecha: <input type="datetime" class="" name="fecha"  value="{{$caja->fecha}}" readonly ><br><br>
		
		</div>


		<div class="form-group">
			

			<!--Id<input type="text" class="form-control" name="id">-->
			Base<input type="text" class="form-control" name="base_monetaria" value="{{$caja->base_monetaria}}">
			
			Periodo de tiempo<br>
			<select name="p_tiempo_id_tiempo" class="form-control">
				@foreach($periodos as $per)
				@if($per->id_tiempo==$caja->p_tiempo_id_tiempo)
				<option value="{{$per->id_tiempo}}" selected>{{$per->periodo_tiempo}}</option>
				@else
				<option value="{{$per->id_tiempo}}">{{$per->periodo_tiempo}}</option>
				@endif
				@endforeach
			</select>
			

			<div class="form-group">
			

			Ingresos Efectivo<input type="text" class="form-control" name="ingresos_efectivo" value="{{$caja->ingresos_efectivo}}">
			Egresos Efectivo<input type="text" class="form-control" name="egresos_efectivo" value="{{$caja->egresos_efectivo}}">
			Ingresos Electrónico<input type="text" class="form-control" name="ingresos_electronicos" value="{{$caja->ingresos_electronicos}}">
			Egresos Electrónico<input type="text" class="form-control" name="egresos_electronicos" value="{{$caja->egresos_electronicos}}">
			
			</div><br>

			Dinero: <input type="text" class="" name="dinero_disponible" value="">
			Ventas: <input type="text" class="" name="ventas" value="{{$caja->ventas}}"><br><br>	
			<div align="center">
				
				<button class="btn btn-info" type="submit">Registrar</button>
				<a href="{{url('almacen/caja')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>

	</div>
{!!Form::close()!!}		
</body>

@stop