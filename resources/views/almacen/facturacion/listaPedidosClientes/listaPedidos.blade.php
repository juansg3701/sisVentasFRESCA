@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de pedidos cliente a almacen</h3>
		</div>
	</div>

	@include('almacen.facturacion.listaPedidosClientes.search')
	<div id=formulario>
		<div class="form-group">
			
			<div align="center">
			
			<a href="{{URL::action('facturacionListaPedidosClientes@show',0)}}">
			<button class="btn btn-info">Nuevo pedido</button></a>
			<a href="{{URL::action('facturacionListaPedidosClientes@show',0)}}" class="btn btn-danger">Volver</a>
			</div>
			<br>
			
		</div>
	</div>
</body>
@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Remisión</th>
							<th>No. Productos</th>
							<th>Fecha de Solicitud</th>
							<th>Fecha de entrega</th>
							<!--<th>PAGO INICIAL</th>-->
							<th>Cliente</th>
							<th>Empleado</th>
							<th>Método de Pago</th>
							<th>Total</th>
							<th>Opciones</th>
							
						</thead>

						@foreach($pedidosCliente as $pc)
						<tr>
							<td>{{$pc->id_remision}}</td>
							<td>{{$pc->noproductos}}</td>
							<td>{{$pc->fecha_solicitud}}</td>
							<td>{{$pc->fecha_entrega}}</td>
							<!--<td>{{$pc->pago_inicial}}</td>-->
							<td>{{$pc->cliente}}</td>
							<td>{{$pc->empleado}}</td>
							<td>{{$pc->tipo_pago}}</td>
							<td>{{$pc->pago_total}}</td>
							<td>
								<a href="{{URL::action('AbonoPCController@edit',$pc->id_remision)}}"><button class="btn btn-info">Abonos</button></a>
								<a href="{{URL::action('facturacionListaPedidosClientes@edit',$pc->id_remision)}}"><button class="btn btn-info">Productos</button></a>
								<a href="" data-target="#modal-delete-{{$pc->id_remision}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>

						</tr>
						@include('almacen.facturacion.listaPedidosClientes.modal')
						@endforeach

					</table>
				</div>
				{{$pedidosCliente->render()}}
			</div>
</div><br>
@stop