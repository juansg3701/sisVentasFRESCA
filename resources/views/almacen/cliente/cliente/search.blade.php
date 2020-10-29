<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/cliente/cliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
<div class="container">
	<div class="form-group">	
		<div class="form-row col-sm-12">
			
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<div>Categoría:</div>
				</div>
				<div class="form-group col-sm-8">
					<select name="searchText3" value="{{$searchText3}}" class="form-control">
						<option>Todas las categorías</option>	
						@foreach($categoria_cliente as $cat)
						<option>{{$cat->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Nombre:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Documento:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli2"  type="number" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>NIT:</label>
				</div>
				<div class="form-group col-sm-6">
					<input type="number" class="form-control" name="searchText4" placeholder="Buscar..." value="{{$searchText4}}" min="0">
				</div>
				<div class="form-group col-sm-2">
					<input type="number" class="form-control" name="searchText5" placeholder="Buscar..." value="{{$searchText5}}" min="0" max="9">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Telefono:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="cli3" type="number" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}">
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