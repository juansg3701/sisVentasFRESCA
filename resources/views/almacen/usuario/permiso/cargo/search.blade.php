{!! Form::open(array('url'=>'almacen/usuario/permiso/cargo','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
		<br>
			<input id="car1"  type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		</br>

		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>


</div>


{{Form::close()}}