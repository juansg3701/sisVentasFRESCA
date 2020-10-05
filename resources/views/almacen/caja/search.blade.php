{!! Form::open(array('url'=>'almacen/caja','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

	Fecha
		<div class="input-group">
				<input type="date" class="form-control" name="searchText" value="{{$searchText}}" >
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
		</div><br>
</div>

{{Form::close()}}