{!! Form::open(array('url'=>'almacen/cliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	Nombre:
		 <br>
		<input id="cli1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
	
		</br>
	Documento:
	<br>
		<input id="cli2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
	
	</br>
	Telefono:
	<br>
		<input id="cli3" type="text" class="form-control" name="searchText2" placeholder="Buscar..." >
	
	</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
</div>

{{Form::close()}}