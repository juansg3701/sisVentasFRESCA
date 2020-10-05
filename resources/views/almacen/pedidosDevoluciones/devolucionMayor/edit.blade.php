@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->


</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Devolución de Producto</h3>
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

	{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.pedidosDevoluciones.devolucionMayor.update',$stock->id_stock]])!!}
    {{Form::token()}}

	<div id=formulario>

			<select name="producto_id_producto" class="form-control" value="{{$stock->producto_id_producto}}"  style="visibility:hidden">
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

			<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}" style="display:none">
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

			<select name="proveedor_id_proveedor" class="form-control" value="{{$stock->proveedor_id_proveedor}}" style="display:none">
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

			<select name="disponibilidad" class="form-control" value="{{$stock->disponibilidad}}" style="display:none">
					
				@if($stock->disponibilidad=='1')
				<option value="1">Disponible</option>
				<option value="0">No disponible</option>
				@endif
				@if($stock->disponibilidad=='0')
				<option value="0">No disponible</option>
				<option value="1">Disponible</option>
				@endif
			</select>

			<input type="hidden" class="form-control" name="cantidad" value="{{$stock->cantidad}}">

			Cantidad a devolver:<br>
			<input type="text" class="form-control" name="devolver" value="0">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Devolver</button>
			<a href="{{url('almacen/pedidosDevoluciones/devolucionMayor')}}" class="btn btn-danger">Volver</a>
			</div>
	</div>
	
{!!Form::close()!!}		
</body>

@stop