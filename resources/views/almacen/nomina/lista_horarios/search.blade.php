{!! Form::open(array('url'=>'almacen/nomina/horario/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div align="center">

	<div align="center">
		<input type="hidden" class="" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
	</div><br>
	
	<div  align="center">
		<h4>Búsqueda por fechas</h4><br>
		Fecha Inicial
		<input type="date" class="" name="searchText1" value="{{$searchText1}}" >
		Fecha Final
		<input type="date" class="" name="searchText2" value="{{$searchText2}}">
		<span class="">
			
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br>
	
	<div class="col-md-4"></div>
	<div align="center" class="col-md-4">
		
	Nombre del empleado
			<br>
		<input id="em1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">	
			</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		
		
	</div>
	<div align="center" class="col-md-6"></div><br><br>
</div>



{{Form::close()}}

