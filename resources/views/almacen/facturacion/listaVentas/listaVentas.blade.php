@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturaci車n</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<!--C車digo de JQuery para mostrar/esconder los campos del atributo documento-->
	<script type="text/javascript">
		$(function() {
    		$("#btn_search").on("click", function() {
    			$("#divBuscar").prop("style", "display:hidden");
    			$("#btn_search").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:hidden");
    		});
    		$("#btn_search2").on("click", function() {
    			$("#divBuscar").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:none");
    			$("#btn_search").prop("style", "display:hidden");
    		});
		});
	</script>

	
	
</body>
@stop
@section('tabla')

<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">FACTURAS REGISTRADAS</h3>
						
						<div class="form-group col-sm-8" align="center">
							<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de b&uacute;squeda</button>
							<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de b&uacute;squeda</button>
						</div>
		
						<div id="divBuscar" class="form-group col-sm-8" align="center" style="display:none">
							<!--Incluir la ventana modal de b迆squeda-->	
						@include('almacen.facturacion.listaVentas.search')
						</div>
					</div>
					<div class="card-body">
			
						<table id="bootstrap-data-table" class="table table-striped table-bordered">

						@if($searchText==1)
						<p> Facturas realizadas</p>
							<thead>
							<th>ID</th>
							<th>Total</th>
							<th>#Productos</th>
							<th>Fecha</th>
							<th>Tipo pago</th>
							<th>Empleado</th>
							<th>Cliente</th>
							<th>Sede</th>
							
							<th>Opciones</th>
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->pago_total}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->fecha}}</td>							
							<td>{{ $f->nombre_pago}}</td>
							<td>{{ $f->nombre_empleado}}</td>
							<td>{{ $f->nombre_cliente}}</td>
							<td>{{ $f->nombre_sede}}</td>

								<td>
							@include('almacen.facturacion.listaVentas.modal')
							
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-primary">Ver productos</button></a>
						
							</td>
						</tr>
						
						@endforeach
					@endif

					@if($searchText==2)
					<p> Facturas anuladas</p>
							<thead>
							<th>#Factura</th>
							<th>#Nota</th>
							<th>Total</th>
							<th>Cantidad</th>
							<th>Fecha</th>
							<th>Tipo_pago</th>
							<th>Empleado</th>
							<th>Cliente</th>
							<th>Sede</th>
							
							<th>Opciones</th>
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<?php $contar=0;?>
							@foreach($notas as $n)
								@if($n->factura_id_factura==$f->id_factura)
								<?php $contar++;?>
								<td>{{ $n->id_nota}}</td>	
								@endif
							@endforeach
							@if($contar==0)
							<td>Vac&iacute;o</td>
							@endif
							
							<td>{{ $f->pago_total}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->fecha}}</td>							
							<td>{{ $f->nombre_pago}}</td>
							<td>{{ $f->nombre_empleado}}</td>
							<td>{{ $f->nombre_cliente}}</td>
							<td>{{ $f->nombre_sede}}</td>

								<td>
							@include('almacen.facturacion.listaVentas.modal')
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-primary">Ver productos</button></a>
						
							</td>
						</tr>
					
						
						@endforeach
					@endif

					@if($searchText==3)
					<p> Facturas pendientes</p>
							<thead>
							<th>ID</th>
							<th>Total</th>
							<th>#</th>
							<th>Fecha</th>
							<th>Cajero</th>
							<th>Domiciliario</th>
							<th>Cliente</th>
							<th>Sede</th>
							<th>Opciones</th>
							
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->pago_total}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->fecha}}</td>			
							<td>{{ $f->nombre_empleado}}</td>
							<td>{{ $f->nombre_domiciliario}}</td>
							<td>{{ $f->nombre_cliente}}</td>
							<td>{{ $f->nombre_sede}}</td>

								<td>
								@include('almacen.facturacion.listaVentas.modal')
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-primary">Ver productos</button></a>
						
							</td>
						</tr>
						
						
						@endforeach
					@endif

					@if($searchText==4)
					<p> Facturas web</p>
							<thead>
							<th>ID</th>
							<th>Total</th>
							<th>#Productos</th>
							<th>Fecha</th>
							<th>Tipo_pago</th>
							<th>Empleado</th>
							<th>Cliente</th>
							<th>Sede</th>
							<th>Opciones</th>
							
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->pago_total}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->fecha}}</td>	
							<td>{{ $f->nombre_pago}}</td>		
							<td>{{ $f->nombre_empleado}}</td>
							<td>{{ $f->nombre_cliente}}</td>
							<td>{{ $f->nombre_sede}}</td>

								<td>
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-primary">Ver productos</button></a>
								@include('almacen.facturacion.listaVentas.modal')
								
							</td>
						</tr>
						
						
						@endforeach
					@endif
						</table>
					
					</div>
				{{$facturas->render()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop