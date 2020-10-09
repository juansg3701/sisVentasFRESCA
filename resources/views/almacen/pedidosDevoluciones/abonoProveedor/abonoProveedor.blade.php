@extends ('layouts.admin')
@section ('contenido')
<head>
	<title>Pedidos</title>

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos pedido proveedor</h3>
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


    {!!Form::open(array('url'=>'almacen/pedidosDevoluciones/abonoProveedor','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>

    	No. Remisión: {{$id}}
		<input type="hidden" class="form-control" name="tp_aproveedor_id_rproveedor" value="{{$id}}"><br><br>
		<input type="hidden" class="form-control" name="" placeholder="Ingrese cantidad...">
		Abono:<input type="text" class="form-control" name="abono" placeholder="Ingrese cantidad...">
		<input type="hidden" class="form-control" name="restante" placeholder="Ingrese cantidad...">
		@foreach($totales as $EAN)
		<input type="hidden" class="form-control" name="total" placeholder="Ingrese cantidad..." value="{{$EAN->pago_total}}">
		@endforeach
		Fecha:<input type="datetime-local" class="form-control" name="fecha"  value="<?php echo date("Y/m/d H:i"); ?>"readonly>

		Empleado:
		<select name="empleado_id_empleado" class="form-control">
			@foreach($usuarios as $usu)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endforeach
		</select>	

		<input type="hidden" name="tipo_pago_id_tpago" value="1">
		<br>
	
		<div align="center">
			<button class="btn btn-info">Registrar</button>
			<a href="{{url('almacen/facturacion/listaPedidosProveedores')}}" class="btn btn-danger">Volver</a>
		</div>
		
	</div>
	{!!Form::close()!!}
</body>

@stop
@section('tabla')
<div class="container">
	<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Remisión</th>
							<th>Id</th>
							<th>Deuda Total</th>
							<th>Abono</th>
							<th>Deuda Restante</th>
							<th>Fecha</th>
							<th>Empleado</th>
							<th>Tipo Pago</th>
							<th>Opciones</th>
						</thead>

						@foreach($abonosProveedor as $apc)
						<tr>
							<td>{{$apc->tp_aproveedor_id_rproveedor}}</td>
							<td>{{$apc->id_abono}}</td>
							<td>{{$apc->total}}</td>
							<td>{{$apc->abono}}</td>
							<td>{{$apc->restante}}</td>
							
							<td>{{$apc->fecha}}</td>
							<td>{{$apc->empleado}}</td>
							<td>{{$apc->tipo_pago}}</td>
							<td>
								@if($apc->facturaPaga=='0')
								<a href="" data-target="#modal-delete-{{$apc->id_abono}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@else
								<a href="" data-target="#modal-delete-{{$apc->id_abono}}" data-toggle="modal"><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif

								
								
							</td>
							<td>

							@if($apc->tipo_pago_id_tpago=='1'  && $apc->facturaPaga=='0')
							<a href="" data-target="#modal-pagarC-{{$apc->id_abono}}" data-toggle="modal">
							<button href="" class="btn btn-info" >Pagar</button></a>
							<a href="{{URL::action('AbonoTPController@edit',$apc->id_abono)}}">
								<button href="" class="btn btn-warning" disabled="true">Ticket</button></a>
							@else
							<a href="" data-target="#modal-pagarC-{{$apc->id_abono}}" data-toggle="modal">
							<button href="" class="btn btn-info" disabled="true">Pagar</button></a>
							<a href="{{URL::action('AbonoTPController@edit',$apc->id_abono)}}">
								<button href="" class="btn btn-warning">Ticket</button></a>
							@endif


							</td>	
						</tr>
						@include('almacen.pedidosDevoluciones.pagoEfectivoP.pago')
						@include('almacen.pedidosDevoluciones.abonoProveedor.modal')
						@endforeach
					</table>
				</div>
	</div><br>
	</div>
@stop