@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturas Por Pagar</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Pedido Cliente: {{$pedidoCliente->cliente_id_cliente}}</h3>
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

	{!!Form::model($pedidoCliente,['method'=>'PATCH','route'=>['almacen.facturacion.listaPedidosClientes.update',$pedidoCliente->id_remision]])!!}
    {{Form::token()}}

	<div id=formulario>
		
		
		Fecha de solicitud:<input type="datetime" class="form-control" name="fecha_solicitud" value="{{$pedidoCliente->fecha_solicitud}}" readonly="">
		Fecha de entrega:<input type="date" class="form-control" name="fecha_entrega" value="{{$pedidoCliente->fecha_entrega}}">
		No. de productos:<input type="text" class="form-control" name="noproductos" value="{{$pedidoCliente->noproductos}}">
		

		Metodo de pago:
		<select name="tipo_pago_id_tpago" class="form-control" value="{{$pedidoCliente->tipo_pago_id_tpago}}">
			@foreach($tipoPagos as $tp)
			<option value="{{$tp->id_tpago}}">{{$tp->nombre}}</option>
			@endforeach
		</select>

		Pago inicial:<input type="text" class="form-control" name="pago_inicial" value="{{$pedidoCliente->pago_inicial}}">
		Porcentaje de venta:<input type="text" class="form-control" name="porcentaje_venta" value="{{$pedidoCliente->porcentaje_venta}}">
		Cliente:
		<select name="cliente_id_cliente" class="form-control" value="{{$pedidoCliente->cliente_id_cliente}}">
			@foreach($clientes as $cli)
			<option value="{{$cli->id_cliente}}">{{$cli->nombre}}</option>
			@endforeach
		</select>
		Empleado:
		<select name="empleado_id_empleado" class="form-control" value="{{$pedidoCliente->empleado_id_empleado}}">
			@foreach($usuarios as $usu)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endforeach
		</select>
		Pago total:<input type="text" class="form-control" name="pago_total" value="{{$pedidoCliente->pago_total}}">
		
		<br>
		<button class="btn btn-info" type="submit">Registrar</button>
		<a href="{{url('almacen/facturacion/listaPedidosClientes')}}" class="btn btn-danger">Volver</a>
	</div>
	
{!!Form::close()!!}		
</body>

@stop