@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registro de movimientos</h3>
		</div>
	</div>
{!!Form::open(array('url'=>'almacen/inventario/movimiento-sede','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Fecha<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i:s"); ?>">

			Producto<br>
			<select name="stock_id_stock" class="form-control">
				@foreach($productos as $p)
				<option value="{{$p->id_stock}}">{{$p->nombre}} ({{$p->nombre_sede}}, {{$p->nombre_proveedor}})</option>
				@endforeach
			</select>

			@if(auth()->user()->superusuario==0)
			Sede salida:<br>
			<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
			<select name="sede_id_sede" class="form-control" disabled="">
				@foreach($sedes as $s)
				@if(Auth::user()->sede_id_sede==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
			</select>	
			@else
			Sede salida:<br>
			<select name="sede_id_sede" class="form-control">
				@foreach($sedes as $s)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endforeach
			</select>	
			@endif
			
			Sede entrada:<br>
			<select name="sede_id_sede2" class="form-control">
				@foreach($sedes as $s)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endforeach
			</select>
			<input type="hidden" name="t_movimiento_id_tmovimiento" value="2">
			Empleado:<br>
			<select name="id_empleado" class="form-control">
				@foreach($empl as $e)
				<option value="{{$e->id_empleado}}">{{$e->nombre}}</option>
				@endforeach
			</select>
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar movimiento</button>
			<a href="{{url('almacen/inventario/movimiento-sede')}}" class="btn btn-danger">Volver</a>

			</div>
		</div>
	</div>
{!!Form::close()!!}	
</body>

@stop