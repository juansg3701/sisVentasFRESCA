{!! Form::open(array('url'=>'almacen/reportes/nomina','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div align="center">
	<input id="em1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>

</div>
{{Form::close()}}