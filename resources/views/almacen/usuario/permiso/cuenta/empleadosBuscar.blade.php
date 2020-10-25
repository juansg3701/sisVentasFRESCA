{!! Form::open(array('url'=>'almacen/nomina/empleado','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Nombre:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cu1" type="text" class="form-control" name="searchText" placeholder="Buscar..." >
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Sede:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cu2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Cargo:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cu3" type="text" class="form-control" name="searchText2" placeholder="Buscar..." >
				</div>
			</div>
			<div class="form-group col-sm-12">
				<span class="input-group-btn">
					<button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
				</span>
			</div>
		</div>
	</div>
</div>



{{Form::close()}}