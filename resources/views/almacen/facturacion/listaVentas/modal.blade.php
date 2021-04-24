<div class="modal fade bd-example-modal-lg" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$f->id_factura}}">
	

	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<table id="bootstrap-data-table" class="table table-striped table-bordered">


							<thead>
							<th>ID</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Total</th>
							<th>Descuento</th>
							<th>Impuesto</th>
							<th>Fecha</th>
							<th>Empleado</th>
						</thead>

						@foreach($productos as $p)
							@if($p->factura_id_factura==$f->id_factura)
							
						<tr>
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
							@endif
						@endforeach
					</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			
			</div>
		</div>
	</div>

</div>