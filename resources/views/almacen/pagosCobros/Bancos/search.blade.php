{!! Form::open(array('url'=>'almacen/pagosCobros/Bancos','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

	<input id="ban1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>

</div>

{{Form::close()}}