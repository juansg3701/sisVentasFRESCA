{!! Form::open(array('url'=>'almacen/usuario/permiso/cuenta','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">


	Nombre:
		 <br>
		<input id="cu1" type="text" class="form-control" name="searchText" placeholder="Buscar..." >
	
		</br>
	Sede:
	<br>
		<input id="cu2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
	
	</br>
	Cargo:
	<br>
		<input id="cu3" type="text" class="form-control" name="searchText2" placeholder="Buscar..." >
	
	</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>


</div>

{{Form::close()}}