<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Empresa:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="pro1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Contacto:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="pro1" type="text" class="form-control" name="searchText4" placeholder="Buscar..." value="{{$searchText4}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Documento:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="pro2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>NIT:</label>
				</div>
				<div class="form-group col-sm-6">
					<input type="number" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}" min="0">
				</div>
				<div class="form-group col-sm-2">
					<input type="number" class="form-control" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}" min="0" max="9">
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