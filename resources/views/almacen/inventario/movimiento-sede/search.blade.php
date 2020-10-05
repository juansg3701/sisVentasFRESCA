{!! Form::open(array('url'=>'almacen/inventario/movimiento-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

	<div class="input-group">
		Fecha <!--Inicio-->
		<input type="date" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
		<br>

		<!--! Fecha final
		<input type="date" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
		-->
		<br>
		<div class="form-group" align="center">
			<br>
		<span class="input-group-btn" >
			
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	</div>
</div>


{{Form::close()}}