@extends ('layouts.admin')
@section ('contenido')
	<head>
</head>
@stop
@section('tabla')

<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">DETALLE FACTURA</h3>
					</div>
					<div class="card-body">
			
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>Id factura</th>
								<th>ID</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Total</th>
								<th>Desc.</th>
								<th>Imp.</th>
								<th>Fecha</th>
								<th>Empleado</th>
							</thead>

							@foreach($productos as $p)
						
							<tr>
								<td>{{ $p->factura_id_factura}}</td>
								<td>{{ $p->id_detallef}}</td>
								<td>{{ $p->stock_id_stock}}</td>
								<td>{{ $p->cantidad}}</td>
								<td>{{ $p->precio_venta}}</td>
								<td>{{ $p->total}}</td>
								<td>{{ $p->descuento_id_descuento}}</td>
								<td>{{ $p->impuesto_id_impuestos}}</td>
								<td>{{ $p->fecha}}</td>
								<td>{{ $p->nombre_empleado}}</td>

							</tr>
							@endforeach
						</table>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
