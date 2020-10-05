{!! Form::open(array('url'=>'almacen/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
		Nombre:
		<br>
			<input id="pro1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
	
		</br>
		Documento:
		<br>
			<input id="pro2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
		</br>

		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>

</div>

{{Form::close()}}