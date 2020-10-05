@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Producto-Impuestos</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Impuestos</h3>
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
	{!!Form::open(array('url'=>'almacen/inventario/producto-sede/impuestoProducto','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			<h3>Registrar Nuevo Impuesto</h3>
			Nombre<input type="text" class="form-control" name="nombre">
			valor<input type="text" class="form-control" name="valor"><br>
			<div align="center">
				<a href="{{URL::action('ImpuestoProducto@create',0)}}">
				<button href="" class="btn btn-info" type="submit">Registrar impuesto</button></a>
				<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Volver</a>
			</div>	
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop

@section('tabla')
<h3>Lista de impuestos</h3>
	Nombre del impuesto: 
	@include('almacen.inventario.producto-sede.impuestoProducto.search')	
	<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre</th>
							<th>Valor</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($impuestos as $im)
						<tr>
							<td>{{ $im->id_impuestos}}</td>
							<td>{{ $im->nombre}}</td>
							<td>{{ $im->valor}}</td>
							<td>
								<a href="{{URL::action('ImpuestoProducto@edit',$im->id_impuestos)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$im->id_impuestos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.inventario.producto-sede.impuestoProducto.modal')
						@endforeach
					</table>
				</div>
				{{$impuestos->render()}}
			</div>
	</div><br>
@stop