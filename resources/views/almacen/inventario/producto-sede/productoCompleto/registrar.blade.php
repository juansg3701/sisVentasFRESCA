@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registro de Productos de Sede</h3>
		</div>
	</div>
{!!Form::open(array('url'=>'almacen/inventario/producto-sede/productoCompleto','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre">
			PLU<input type="text" class="form-control" name="plu">
			EAN<input type="text" class="form-control" name="ean">
			Categoría<br>
			<select name="categoria_id_categoria" class="form-control">
				@foreach($categorias as $ct)
				<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
				@endforeach
			</select>	
			Unidad de Medida<br>
			<input type="text" class="form-control" name="unidad_de_medida">
			Precio<input type="text" class="form-control" name="precio">
			Impuesto<br>
			<select name="impuestos_id_impuestos" class="form-control">
				@foreach($impuestos as $im)
				<option value="{{$im->id_impuestos}}">{{$im->nombre}}</option>
				@endforeach
			</select>	
			Stock Mínimo<input type="text" class="form-control" name="stock_minimo">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button>
				<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
{!!Form::close()!!}	
</body>

@stop