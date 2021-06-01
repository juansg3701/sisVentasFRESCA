{!! Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Estado:</label>
				</div>
				<div class="form-group col-sm-8">
					<select class="form-control" name="searchText5">
						@if($searchText5=="")
						<option value="">Seleccione</option>
						<option value="0">Pendiente</option>
						<option value="1">Pagado</option>
						@else
								@if($searchText5==0)
								<option value="0">Pendiente</option>
								<option value="1">Pagado</option>
								<option value="">Seleccione</option>
								@else
								<option value="1">Pagado</option>
								<option value="0">Pendiente</option>
								<option value="">Seleccione</option>
								@endif
						@endif
						
						
					</select>
			
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Fecha:</label>
				</div>
				<div class="form-group col-sm-8">
					<input  type="date" class="form-control" name="searchText6" placeholder="AAAA-MM-DD" value="{{$searchText6}}"
				>
				</div>
			</div>
			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Nombre:</label>
				</div>
				<div class="form-group col-sm-8">
					<input id="buscar2" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}"
				>
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>PLU:</label>
				</div>
				<div class="form-group col-sm-8">
						<input id="pluP"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>EAN:</label>
				</div>
				<div class="form-group col-sm-8">
						<input id="tags" type="text" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Sede:</label>
				</div>
				<div class="form-group col-sm-8">
						<input id="sed1" type="text" class="form-control" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
				</div>
			</div>

			<div class="form-row col-sm-12">
				<div class="form-group col-sm-4">
					<label>Proveedor (nombre empresa):</label>
				</div>
				<div class="form-group col-sm-8">
						<input id="pro3" type="text" class="form-control" name="searchText4" placeholder="Buscar..." value="{{$searchText4}}">
				</div>
			</div>

			<div class="form-group col-sm-12">
				<span class="input-group-btn">
					<button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
				</span>
			</div>

</div>

{{Form::close()}}