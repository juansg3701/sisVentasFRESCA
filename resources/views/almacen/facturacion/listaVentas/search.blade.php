{!! Form::open(array('url'=>'almacen/facturacion/listaVentas/cortes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

	<div class="input-group">
		Fecha <!--Inicio-->
		<input type="date" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<br>

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