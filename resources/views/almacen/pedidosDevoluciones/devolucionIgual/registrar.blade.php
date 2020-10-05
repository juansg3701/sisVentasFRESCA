@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->


</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registro de Productos De Proveedor</h3>
		</div>
	</div>

	{!! Form::open(array('url'=>'almacen/inventario/proveedor-sede/cortes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
				EAN:
				<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
				
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
					</div>
			{{Form::close()}}

			-------------------
		{!!Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">

			@foreach($productosEAN as $p)
			Producto automático:
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$p->id_producto}}">
			<input type="text" class="form-control" name="producto" value="{{$p->nombre}}">
			@endforeach




			Producto<br>
			<select name="producto_id_producto" class="form-control">
				@foreach($producto as $p)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endforeach
			</select>	
			Sede<br>
			<select name="sede_id_sede" class="form-control">
					@foreach($sede as $s)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				@endforeach
			</select>
			Proveedor<br>
			<select name="proveedor_id_proveedor" class="form-control">
					@foreach($proveedor as $pr)
				<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
				@endforeach
			</select>
			Disponible<br>
			<select name="disponibilidad" class="form-control">
					
				<option value="1">Disponible</option>
				<option value="0">No disponible</option>
	
			</select>
			Cantidad<br>
			<input type="text" class="form-control" name="cantidad">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button>
			<button type="reset" class="btn btn-danger">Regresar</button>
		</div>
		</div>
	</div>
{!!Form::close()!!}	
</body>

@stop