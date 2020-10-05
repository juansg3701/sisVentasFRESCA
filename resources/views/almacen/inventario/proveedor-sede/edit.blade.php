@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->


</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos producto</h3>
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

	{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.inventario.proveedor-sede.update',$stock->id_stock]])!!}
    {{Form::token()}}

	<div id=formulario>
Producto<br>
			<select name="producto_id_producto" class="form-control" value="{{$stock->producto_id_producto}}">
				@foreach($producto as $p)
				@if($stock->producto_id_producto==$p->id_producto)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endif
				@endforeach

				@foreach($producto as $p)
				@if($stock->producto_id_producto!=$p->id_producto)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endif
				@endforeach
			</select>	
			@if(auth()->user()->superusuario==0)
			Sede<br>

			<input type="hidden" name="sede_id_sede" value="{{$stock->sede_id_sede}}">
			<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}" disabled="">
				@foreach($sede as $s)
				@if($stock->sede_id_sede==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
				@foreach($sede as $s)
				@if($stock->sede_id_sede!=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
			</select>
			@else
			Sede<br>
			<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}">
				@foreach($sede as $s)
				@if($stock->sede_id_sede==$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
				@foreach($sede as $s)
				@if($stock->sede_id_sede!=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endif
				@endforeach
			</select>
			@endif
			
			Proveedor<br>
			<select name="proveedor_id_proveedor" class="form-control" value="{{$stock->proveedor_id_proveedor}}">
				@foreach($proveedor as $pr)
				@if($stock->proveedor_id_proveedor==$pr->id_proveedor)
				<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
				@endif
				@endforeach

				@foreach($proveedor as $pr)
				@if($stock->proveedor_id_proveedor!=$pr->id_proveedor)
				<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
				@endif
				@endforeach
			</select>
			Disponible<br>
			<select name="disponibilidad" class="form-control" value="{{$stock->disponibilidad}}">
					
				@if($stock->disponibilidad=='1')
				<option value="1">Disponible</option>
				<option value="0">No disponible</option>
				@endif
				@if($stock->disponibilidad=='0')
				<option value="0">No disponible</option>
				<option value="1">Disponible</option>
				@endif
				
	
			</select>
			Cantidad<br>
			<input type="text" class="form-control" name="cantidad" value="{{$stock->cantidad}}">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button><a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Volver</a>
			</div>
	</div>
	
{!!Form::close()!!}		
</body>

@stop