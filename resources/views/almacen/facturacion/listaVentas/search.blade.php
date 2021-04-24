{!! Form::open(array('url'=>'almacen/facturacion/Factura','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<div>Tipos:</div>
				</div>
				<div class="form-group col-sm-8">
					<select name="searchText" value="{{$searchText}}" class="form-control">
						<option value="1">Realizadas</option>	
						<option value="2">Anuladas</option>	
						<option value="3">Pendientes</option>	
						<option value="4">Web</option>	
						
					</select>
				</div>
			</div>

		<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>ID:</label>
				</div>
				<div class="form-group col-sm-8">
					<input type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
				</div>
		</div>

		<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label> Nombre cliente:</label>
				</div>
				<div class="form-group col-sm-8">
					<input type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
				</div>
		</div>

		<div class="form-group col-sm-12">
				<span class="input-group-btn">
					<button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
				</span>
			</div>


</div>


{{Form::close()}}