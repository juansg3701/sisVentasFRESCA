{!! Form::open(array('url'=>'almacen/inventario/producto-sede/impuestoProducto','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar Impuesto</button><br><br>
		</span>
	</div>
</div>

{{Form::close()}}