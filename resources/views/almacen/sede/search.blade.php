<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="container">
	<div class="form-group">
		
		<div class="form-row">
			<div class="form-group col-sm-3">
				<label>Nombre:</label>
			</div>
			<div class="form-group col-sm-7">
				<input id="sed1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
			</div>
			<div class="form-group col-sm-2">
				<span class="input-group-btn">
					<button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
				</span>
			</div>
		</div>

	</div>
</div>
{{Form::close()}}