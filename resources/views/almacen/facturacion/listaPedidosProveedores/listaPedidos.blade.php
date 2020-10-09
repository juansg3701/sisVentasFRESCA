@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de pedidos almacen a proveedor</h3>
		</div>
	</div>

	@include('almacen.facturacion.listaPedidosProveedores.search')
	<div id=formulario>
		<div class="form-group">
			<div align="center">
			<a href="{{URL::action('facturacionListaPedidosProveedor@show',0)}}">
			<button class="btn btn-info">Nuevo pedido</button></a>
			<a href="{{URL::action('facturacionListaPedidosProveedor@show',0)}}" class="btn btn-danger">Volver</a>
			</div>
			<br>
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
							<th>No.Remisión</th>
							<th>No.Productos</th>
							<th>Fecha de solicitud</th>
							<th>Fecha de entrega</th>
							<!--<th>Pago inicial</th>-->
							<th>Proveedor</th>
							<th>Empleado</th>
							<th>Método de pago</th>
							<th>Pago total</th>
							<th>Opciones</th>			
						</thead>

						@foreach($pedidosProveedor as $pc)
						<tr>
							<td>{{$pc->id_rproveedor}}</td>
							<td>{{$pc->noproductos}}</td>
							<td>{{$pc->fecha_solicitud}}</td>
							<td>{{$pc->fecha_entrega}}</td>
							<!--<td>{{$pc->pago_inicial}}</td>-->
							<td>{{$pc->proveedor}}</td>
							<td>{{$pc->empleado}}</td>
							<td>{{$pc->tipo_pago}}</td>
							<td>{{$pc->pago_total}}</td>
							<td>
								<a href="{{URL::action('AbonoPPController@edit',$pc->id_rproveedor)}}"><button class="btn btn-info">Abonos</button></a>
								<a href="{{URL::action('facturacionListaPedidosProveedor@edit',$pc->id_rproveedor)}}"><button class="btn btn-info">Productos</button></a>
								<a href="" data-target="#modal-delete-{{$pc->id_rproveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>

						</tr>
						@include('almacen.facturacion.listaPedidosProveedores.modal')
						@endforeach

					</table>
				</div>
				{{$pedidosProveedor->render()}}

			</div><br>
		</div>	
@stop