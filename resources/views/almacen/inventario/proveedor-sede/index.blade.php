@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>


<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de Productos del Proveedor</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			@include('almacen.inventario.proveedor-sede.search')
			<br>
			<div align="center">
				
			<a href="{{url('almacen/inventario/ean')}}"><button class="btn btn-info">Registrar Productos</button></a>
			<a href="{{url('almacen/inventario/categoriaTransformado')}}"><button class="btn btn-info">Categoría Transformado</button></a>
			<button class="btn btn-success">Cargar xls</button>
			<button class="btn btn-success">Descargar xls</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			<br><br>
			</div>
		</div>
	</div>
</body>

@stop
@section('tabla')
<div class="container">
<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>SEDE</th>
							<th>PROVEEDOR</th>
							<th>CANTIDAD</th>
							<th>DISPONIBILIDAD</th>
							<th>OPCIONES</th>
						</thead>
					@foreach($productos as $ps)
					@foreach($productosBuscar as $pb)
					@if($pb->id_producto==$ps->producto_id_producto)
					@if($ps->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $ps->id_stock}}</td>
							<td>{{ $pb->nombre}}</td>
							<td>{{ $pb->plu}}</td>
							<td>{{ $pb->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>
							@if($ps->disponibilidad=='1')
							<td>Disponible</td>
							@endif
							@if($ps->disponibilidad=='0')
							<td>No disponible</td>
							@endif

							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_stock}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.inventario.proveedor-sede.modal')
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $ps->id_stock}}</td>
							<td>{{ $pb->nombre}}</td>
							<td>{{ $pb->plu}}</td>
							<td>{{ $pb->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>
							@if($ps->disponibilidad=='1')
							<td>Disponible</td>
							@endif
							@if($ps->disponibilidad=='0')
							<td>No disponible</td>
							@endif

							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_stock}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@endif
						@endif
						@endforeach
						@endforeach


					</table>
				</div>

			</div><br>
			</div>
@stop