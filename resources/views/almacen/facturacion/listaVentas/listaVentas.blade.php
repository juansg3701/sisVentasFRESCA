@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de ventas</h3>
			
		</div>
	</div>


	<div id=formulario>
		<div class="form-group" align="center">
			@include('almacen.facturacion.listaVentas.search')
		
			</div>
	</div>
	<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-danger">Volver</a>
</body>
@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>id</th>
							<th>Fecha</th>
							<th>Metodo de pago</th>
							<th>No.Productos</th>
							<th>Cliente</th>
							<th>Empleado</th>
							<th>Pago total</th>
							<th>Pago factura</th>
							<th>Lugar</th>
							<th>Opciones</th>
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->fecha}}</td>
							<td>{{ $f->tipo_pago_id_tpago}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->cliente_id_cliente}}</td>
							<td>{{ $f->empleado_id_empleado}}</td>
							<td>{{ $f->pago_total}}</td>

							@if($f->facturaPaga=='0')
							<td>No realizado</td>
							@endif

							@if($f->facturaPaga=='1')
							<td>Realizado</td>
							@endif
							
							
							@if($f->tiendaodomicilio=='0')
							<td>Tienda</td>
							@endif
							@if($f->tiendaodomicilio=='1')
							<td>Domicilio</td>
							@endif
								<td>

								<a href="{{URL::action('facturacionListaVentas@edit',$f->id_factura)}}"><button class="btn btn-info">Productos/Pagos</button></a>
								@if($f->facturaPaga=='0')
								<a href="{{URL::action('FacturaController@edit',$f->id_factura)}}" target="_blank"><button href="" class="btn btn-warning" >Ver Factura</button></a>
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@else
								<a href="{{URL::action('FacturaController@edit',$f->id_factura)}}" target="_blank"><button href="" class="btn btn-warning" >Ver Factura</button></a>
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif
							</td>
						</tr>
							@include('almacen.facturacion.listaVentas.modal')
							@include('almacen.facturacion.listaVentas.datafono')
						@endforeach
					</table>
				</div>
				
			</div>
			</div><br>
			
@stop