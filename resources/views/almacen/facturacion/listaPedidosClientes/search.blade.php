{!! Form::open(array('url'=>'almacen/facturacion/listaPedidosClientes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">

		Fecha de solicitud
		<div class="input-group">
				<input type="date" class="form-control" name="searchText" value="{{$searchText}}" >
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
		</div><br>
		Fecha de entrega
		<div class="input-group">
				<input type="date" class="form-control" name="searchText2" value="{{$searchText2}}" >
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
		</div><br>

		<div align="center">
		Número de remisión:
		<br>
		<input id="ped1" type="text" class="form-control" name="searchText3" placeholder="Buscar..." >
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		</div>
		<br>
		<div align="center">
		Cliente:
		<br>
		<input id="cli1" type="text" class="form-control" name="searchText4" placeholder="Buscar..." >
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		</div>
		<br>

		
		
		
</div>

{{Form::close()}}