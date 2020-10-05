@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Categorias</title>
</head>

<body>
	<div class="row">

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Categoria: {{$categoria->nombre}}</h3>
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

	{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.categoriaProducto.update',$categoria->id_categoria]])!!}
    {{Form::token()}}

	<div id=formulario align="center">
		Nombre:<input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre">
		Descripción:<input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion">
		<br>
		<button class="btn btn-info" type="submit">Registrar</button><a href="{{url('almacen/inventario/producto-sede/categoriaProducto')}}" class="btn btn-danger">Volver</a>
	</div>
	
{!!Form::close()!!}		
</body>

@stop