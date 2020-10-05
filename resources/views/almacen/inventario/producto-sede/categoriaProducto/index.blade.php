@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Producto-Categoria</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Categorias</h3>
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
	{!!Form::open(array('url'=>'almacen/inventario/producto-sede/categoriaProducto','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			<h3>Registrar Nueva categoria</h3>
			Nombre categoria<input type="text" class="form-control" name="nombre">
			Descripción<input type="text" class="form-control" name="descripcion"><br>
			<div align="center">
				<a href="{{URL::action('CategoriaProducto@create',0)}}">
				<button href="" class="btn btn-info" type="submit">Registrar categoria</button></a>
				<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Volver</a>
			</div>	
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop

@section('tabla')
<h3>Lista de Categorias</h3>
	Nombre de la categoria: 
	@include('almacen.inventario.producto-sede.categoriaProducto.search')	
	<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($categorias as $cat)
						<tr>
							<td>{{ $cat->id_categoria}}</td>
							<td>{{ $cat->nombre}}</td>
							<td>{{ $cat->descripcion}}</td>
							<td>
								<a href="{{URL::action('CategoriaProducto@edit',$cat->id_categoria)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.inventario.producto-sede.categoriaProducto.modal')
						@endforeach
					</table>
				</div>
				{{$categorias->render()}}
			</div>
	</div><br>
@stop