{!! Form::open(array('url'=>'almacen/pedidosDevoluciones/devolucionIgual','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

	EAN:
	<br>
		<input id="tags" type="text" class="form-control" name="searchText4" placeholder="Buscar..." >
	
		</br>
	Nombre:
		<br>
		<input id="buscar2" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	

</div>

{{Form::close()}}