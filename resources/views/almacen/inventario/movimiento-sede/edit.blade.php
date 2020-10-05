@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar movimiento</h3>
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

	{!!Form::model($productos,['method'=>'PATCH','route'=>['almacen.inventario.movimiento-sede.update',$movimientos->id_mstock]])!!}
    {{Form::token()}}

	<div id=formulario>

		Fecha<input type="datetime" class="form-control" name="fecha" value="{{$movimientos->fecha}}" >
			Producto<br>
			<select name="stock_id_stock" class="form-control">

				@foreach($productos as $p)
				@if($movimientos->stock_id_stock==$p->id_stock)
				<option value="{{$p->id_stock}}">{{$p->nombre}} ({{$p->nombre_sede}}, {{$p->nombre_proveedor}})</option>
				@endif
				@endforeach

				@foreach($productos as $p)
				@if($movimientos->stock_id_stock!=$p->id_stock)
				<option value="{{$p->id_stock}}">{{$p->nombre}} ({{$p->nombre_sede}}, {{$p->nombre_proveedor}})</option>
				@endif
				@endforeach

			
			</select>
			@if(auth()->user()->superusuario==0)
			Sede salida:<br>
			<select name="sede_id_sede" class="form-control" disabled="">
				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede!=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach				
			</select>
			@else
			Sede salida:<br>
			<select name="sede_id_sede" class="form-control">
				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede!=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach				
			</select>
			@endif
				
			Sede entrada:<br>
			<select name="sede_id_sede2" class="form-control">
				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede2==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach

				@foreach($sedes as $s)
				@if($movimientos->sede_id_sede2!=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
			</select>

			<input type="hidden" name="t_movimiento_id_tmovimiento" value="{{$movimientos->t_movimiento_id_tmovimiento}}">
			Empleado:<br>
			<select name="id_empleado" class="form-control">
				@foreach($empl as $e)
				@if($movimientos->id_empleado==$e->id_empleado)
				<option value="{{$e->id_empleado}}">{{$e->nombre}}</option>
				@endif
				@endforeach

				@foreach($empl as $e)
				@if($movimientos->id_empleado!=$e->id_empleado)
				<option value="{{$e->id_empleado}}">{{$e->nombre}}</option>
				@endif
				@endforeach			
			</select>
			<br>
			<div align="center">
			@if($movimientos->t_movimiento_id_tmovimiento==2)
			<button type="submit" class="btn btn-info">Registrar Producto</button>
			@else
			<button type="submit" class="btn btn-info" disabled="true">Registrar Producto</button>
			@endif
			
			<a href="{{url('almacen/inventario/movimiento-sede')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>
	
{!!Form::close()!!}		
</body>

@stop