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
<div class="container">
<div class="row">
				<div class="table-responsive">
					<table class="table table-responsive table-wrapper-scroll-y my-custom-scrollbar">
						<thead>
							<th>Id</th>
							<th>Id factura web</th>
							<th>Pago total</th>
							<th>No.Productos</th>
							<th>Fecha</th>
							<th>Factura paga</th>
							<th>Metodo de pago</th>
							<th>Empleado</th>
							<th>Empleado domicialiario</th>
							<th>Cliente</th>
							<th>Sede</th>
							<th>Anulacion</th>
							<th>Referencia de pago</th>
							<th>Tipo web</th>
							
							<th>Opciones</th>
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->id_factura_web}}</td>
							<td>{{ $f->pago_total}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->fecha}}</td>

							@if($f->facturapaga=='0')
							<td>No realizado</td>
							@endif

							@if($f->facturapaga=='1')
							<td>Realizado</td>
							@endif
							
							<td>{{ $f->nombre_pago}}</td>
							<td>{{ $f->nombre_empleado}}</td>
							<td>{{ $f->nombre_domiciliario}}</td>
							<td>{{ $f->nombre_cliente}}</td>
							<td>{{ $f->nombre_sede}}</td>
							<td>{{ $f->anulacion}}</td>
							<td>{{ $f->referencia_pago}}</td>
							<td>{{ $f->tipo_web}}</td>

							

								<td>

								<a href="{{URL::action('facturacionListaVentas@edit',$f->id_factura)}}"><button class="btn btn-info">Productos/Pagos</button></a>
								@if($f->facturapaga=='0')
								<a href="{{URL::action('FacturaController@edit',$f->id_factura)}}" target="_blank"><button href="" class="btn btn-warning" >Ver Factura</button></a>
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@else
								<a href="{{URL::action('FacturaController@edit',$f->id_factura)}}" target="_blank"><button href="" class="btn btn-warning" >Ver Factura</button></a>
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif
							</td>
						</tr>
							@include('almacen.facturacion.listaVentas.modal')
						
						@endforeach
					</table>
				</div>
				
			</div><br>
			</div>
@stop