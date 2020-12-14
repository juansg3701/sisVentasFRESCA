{!! Form::open(array('url'=>'almacen/inventario/movimiento-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->

<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-2"></div>
				<div class="form-group col-sm-2" align="center">
					<label>Fecha:</label>
				</div>
				<div class="form-group col-sm-4">
					<input type="date" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
				</div>
				<div class="form-group col-sm-2" align="center">
				 	<span class="input-group-btn">
						<button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
					</span>
				</div>
				<div class="form-group col-sm-2"></div>
			</div>

		</div>
	</div>
</div>


{{Form::close()}}