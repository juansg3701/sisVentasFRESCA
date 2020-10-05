@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturas Por Pagar</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Pedido Almacen-Proveedor: {{$pedidoProveedor->proveedor_id_proovedor}}</h3>
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

	{!!Form::model($pedidoProveedor,['method'=>'PATCH','route'=>['almacen.facturacion.listaPedidosProveedores.update',$pedidoProveedor->id_rproveedor]])!!}
    {{Form::token()}}

	<div id=formulario>
		
		No.Remisión: <input type="text" class="form-control" name="noRemision">
		Fecha de solicitud:<input type="date" class="form-control" name="fecha_solicitud" value="{{$pedidoProveedor->fecha_solicitud}}">
		Fecha de entrega:<input type="date" class="form-control" name="fecha_entrega" value="{{$pedidoProveedor->fecha_entrega}}">
		No. de productos:<input type="text" class="form-control" name="noproductos" value="{{$pedidoProveedor->noproductos}}">
		Metodo de pago:	<input type="text" select name="tipo_pago_id_tpago" class="form-control" value="{{$pedidoProveedor->tipo_pago_id_tpago}}">	
		Pago inicial:<input type="text" class="form-control" name="pago_inicial" value="{{$pedidoProveedor->pago_inicial}}">
		Porcentaje de venta:<input type="text" class="form-control" name="porcentaje_venta" value="{{$pedidoProveedor->porcentaje_venta}}">
		Id Proveedor:<input type="text" class="form-control" name="proveedor_id_proveedor" value="{{$pedidoProveedor->proveedor_id_proveedor}}">
		Id empleado:<input type="text" class="form-control" name="empleado_id_empleado" value="{{$pedidoProveedor->empleado_id_empleado}}">
		Pago total:<input type="text" class="form-control" name="pago_total" value="{{$pedidoProveedor->pago_total}}">
		
	
		<br>
		<button class="btn btn-info" type="submit">Registrar</button>
		<a href="{{url('almacen/facturacion/listaPedidosProveedores')}}" class="btn btn-danger">Volver</a>
	</div>
	
{!!Form::close()!!}		
</body>

@stop