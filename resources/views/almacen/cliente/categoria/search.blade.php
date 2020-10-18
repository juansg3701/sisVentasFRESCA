{!! Form::open(array('url'=>'almacen/cliente/categoria','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-2"></div>
				<div class="form-group col-sm-2" align="center">
					<label>Nombre:</label>
				</div>
				<div class="form-group col-sm-4">
					<input id="cat1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
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