{!! Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	Nombre:
	<div class="input-group">
		<input type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	
	PLU:
	<div class="input-group">
		<input type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	Sede:
	<div class="input-group">
		<input type="text" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	Proveedor:
	<div class="input-group">
		<input type="text" class="form-control" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}