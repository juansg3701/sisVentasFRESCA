@extends ('layouts.admin')
@section ('contenido')
<head>
	<title>Pedidos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos pedido cliente</h3>
		</div>
	</div>


	<div id=formulario>
		<div class="form-group">
			Nombre: 
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
			</div><br>
			<div align="center">
			<a href="{{URL::action('productoPedidoCliente@create',0)}}">
			<button href="" class="btn btn-info">Añadir producto </button></a>
			<button class="btn btn-info">Eliminar </button>
			<button class="btn btn-info">Editar </button>
			<button class="btn btn-info">Regresar </button>
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
							<th>Id</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio unitario</th>
							<th>Impuesto</th>
							<th>Descuento</th>
							<th>Total</th>
							<th>Opciones</th>
						</thead>

						@foreach($detalleCliente as $pc)
						<tr>
							<td>{{$pc->id_dpcliente}}</td>
							<td>{{$pc->cantidad}}</td>
							<td>{{$pc->precio_venta}}</td>
							<td>{{$pc->t_p_cliente_id_remision}}</td>
							<td>{{$pc->producto_id_producto}}</td>
							<td>{{$pc->descuentos_id_descuento}}</td>
							<td>{{$pc->impuestos_id_impuestos}}</td>
							<td>
								
							</td>

						</tr>
						@endforeach
					</table>
				</div>
			</div><br>
			</div>
@stop