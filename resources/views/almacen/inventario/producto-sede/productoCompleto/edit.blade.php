@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Producto: {{$productos->nombre}}</h3>
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

	{!!Form::model($productos,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.productoCompleto.update',$productos->id_producto]])!!}
    {{Form::token()}}

	<div id=formulario>


		Nombre<input type="text" class="form-control" value="{{$productos->nombre}}" name="nombre" >
			PLU<input type="text" class="form-control" name="plu" value="{{$productos->plu}}">
			EAN<input type="text" class="form-control" name="ean" value="{{$productos->ean}}">
			Categoría<br>
			<select name="categoria_id_categoria" class="form-control" value="{{$productos->categoria_id_categoria}}">
				@foreach($categorias as $ct)
				<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
				@endforeach
			</select>	
			Unidad de Medida<br>
			<input type="text" class="form-control" name="unidad_de_medida" value="{{$productos->unidad_de_medida}}">
			Precio<input type="text" class="form-control" name="precio" value="{{$productos->precio}}">
			Impuesto<br>
			<select name="impuestos_id_impuestos" class="form-control" value="{{$productos->impuestos_id_impuestos}}">
				@foreach($impuestos as $im)
				<option value="{{$im->id_impuestos}}">{{$im->nombre}}</option>
				@endforeach
			</select>	
			Stock Mínimo<input type="text" class="form-control" name="stock_minimo" value="{{$productos->stock_minimo}}">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button>
				<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>
	
{!!Form::close()!!}		
</body>

@stop