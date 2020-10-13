<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/cliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Nombre:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Documento:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Telefono:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli3" type="text" class="form-control" name="searchText2" placeholder="Buscar..." >
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