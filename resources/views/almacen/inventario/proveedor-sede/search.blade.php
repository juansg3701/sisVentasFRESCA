{!! Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	Nombre:
		 <br>
		<input id="buscar2" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
	
		</br>
	PLU:
	<br>
		<input id="pluP"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
	
	</br>
	Sede:
	<br>
		<input id="sed1" type="text" class="form-control" name="searchText2" placeholder="Buscar..." >
	
	</br>
	Proveedor:
	<br>
		<input id="pro3" type="text" class="form-control" name="searchText3" placeholder="Buscar..." >
	
	</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>



</div>

{{Form::close()}}