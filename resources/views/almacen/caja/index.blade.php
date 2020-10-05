@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar Caja</h3>
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
	{!!Form::open(array('url'=>'almacen/caja','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
   
   
	<div id=formulario>
		<div align="center">

		@if(auth()->user()->superusuario==0)
		Cargo: 
		<input type="hidden" name="tipo_cargo_id_cargo" value="{{Auth::user()->tipo_cargo_id_cargo}}">
		<select name="tipo_cargo_id_cargo" class="" disabled="">
			@foreach($cargos as $car)
			@if(Auth::user()->tipo_cargo_id_cargo==$car->id_cargo)
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endif
			@endforeach

			@foreach($cargos as $car)
			@if(Auth::user()->tipo_cargo_id_cargo!=$car->id_cargo)
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endif
			@endforeach
		</select>
		@else
		<select name="tipo_cargo_id_cargo" class="">
			@foreach($cargos as $car)
			@if(Auth::user()->tipo_cargo_id_cargo==$car->id_cargo)
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endif
			@endforeach

			@foreach($cargos as $car)
			@if(Auth::user()->tipo_cargo_id_cargo!=$car->id_cargo)
			<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
			@endif
			@endforeach
		</select>
		@endif

		@if(auth()->user()->superusuario==0)
		Empleado: 
		<input type="hidden" name="empleado_id_empleado" value="{{Auth::user()->id}}">
		<select name="empleado_id_empleado" class="" disabled="">
			@foreach($usuarios as $usu)
			@if(Auth::user()->id==$usu->user_id_user)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endif
			@endforeach

			@foreach($usuarios as $usu)
			@if(Auth::user()->id!=$usu->user_id_user)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endif
			@endforeach	
		</select><br><br>
		@else
		<select name="empleado_id_empleado" class="">
			@foreach($usuarios as $usu)
			@if(Auth::user()->id==$usu->user_id_user)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endif
			@endforeach

			@foreach($usuarios as $usu)
			@if(Auth::user()->id!=$usu->user_id_user)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endif
			@endforeach	
		</select><br><br>
		@endif
		
		@if(auth()->user()->superusuario==0)
		Sede: 
		<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
		<select name="sede_id_sede" class="" disabled="">

				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede ==$s->id_sede)
				<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach

				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede !=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach
		</select>
		@else
		Sede: 
		<select name="sede_id_sede" class="" disabled="true">

				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede ==$s->id_sede)
				<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach

				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede !=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach
		</select>
		@endif

		
		Fecha: <input type="datetime-local" class="" name="fecha"  value="<?php echo date("Y/m/d H:i:s"); ?>" readonly ><br><br>
		
		</div>
		 
		<div class="form-group">
		<!--Id<input type="text" class="form-control" name="id">-->
		Base Monetaria<input type="text" class="form-control" name="base_monetaria">
		
		Periodo de tiempo<br>
		<select name="p_tiempo_id_tiempo" class="form-control">
			@foreach($periodos as $per)
			<option value="{{$per->id_tiempo}}">{{$per->periodo_tiempo}}</option>
			@endforeach
		</select>
			
		<?php 
		$ingresoEfectivo=0;
		$ingresoElectronico=0;
		$egresoEfectivo=0;
		$egresoElectronico=0;
		?>
		@foreach($cuentas as $c)

		@if(Auth::user()->sede_id_sede ==$c->sede_id_sede && Auth::user()->superusuario==0)
		<?php 
		$ingresoEfectivo=$ingresoEfectivo+$c->iefectivo;
		$ingresoElectronico=$ingresoElectronico+$c->ielectronico;
		$egresoEfectivo=$egresoEfectivo+$c->efectivo;
		$egresoElectronico=$egresoElectronico+$c->electronico;
		?>
		@endif
		@endforeach


			Ingresos Efectivo<input type="text" class="form-control" name="ingresos_efectivo" value="{{$ingresoEfectivo}}">
			Egresos Efectivo<input type="text" class="form-control" name="egresos_efectivo" value="{{$egresoEfectivo}}">
			Ingresos Electrónico<input type="text" class="form-control" name="ingresos_electronicos" value="{{$ingresoElectronico}}">
			Egresos Electrónico<input type="text" class="form-control" name="egresos_electronicos" value="{{$egresoElectronico}}">
			
			<!--Periodo Tiempo<input type="text" class="form-control" name="p_tiempo_id_tiempo">-->
		</div>


		Dinero: <input type="text" class="" name="dinero_disponible">
		Ventas: <input type="text" class="" name="ventas" value="{{$ventasFac[0]->total}}"><br><br>	
			<div align="center">
				<button class="btn btn-info" type="submit" >Guardar Caja</button>
				<a href="{{url('almacen/caja')}}" class="btn btn-danger">Volver</a>
			</div><br>
		</div>
	</div>
{!!Form::close()!!}	
</body>

@stop
