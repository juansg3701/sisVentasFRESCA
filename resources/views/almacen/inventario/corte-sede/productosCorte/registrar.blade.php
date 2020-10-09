@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cortes</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos</h3>
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
		<div align="center">

			<a href="{{URL::action('ProductosCorteController@create',0)}}"><button class="btn btn-info">Registrar Producto</button></a>
<br><br>
	</div>
</body>

@stop
@section('tabla')
<div class="container">
<div class="form-group">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID </th>
							<th>ID CORTE</th>
							<th>PRODUCTO</th>
							<th>PROVEEDOR</th>
							<th>CANTIDAD</th>
							<th>FECHA</th>
							<th>OPCIONES</th>
						</thead>
						
						@foreach($productos as $p)
						<tr>
							<td>{{$p->id_dcorte}}</td>
							<td>{{$p->c_inventario_id_corte}}</td>
							<td>{{$p->producto_id_producto}}</td>
							<td>{{$p->proveedor_id_proveedor}}</td>
							<td>{{$p->cantidad}}</td>
							<td>{{$p->fecha}}</td>
							
							<td>
						
								<a href="" data-target="#modal-delete-{{$p->id_dcorte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.inventario.corte-sede.productosCorte.modal')
						@endforeach
					</table>
				</div>
		
			</div><br>
			
		</div>
		</div>
@stop
