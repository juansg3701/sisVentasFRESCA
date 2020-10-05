{!! Form::open(array('url'=>'almacen/nomina/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div align="center">

	<div align="center">
		<input type="hidden" class="" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
	</div><br>
	
	<div  align="center">
		<h4>Búsqueda por fechas</h4><br>
		Fecha Inicial
		<input type="date" class="" name="searchText1" value="<?php echo date("Y-m-d"); ?>" >
		Fecha Final
		<input type="date" class="" name="searchText2" value="<?php echo date("Y-m-d"); ?>">
		<span class="">
			
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br>
	
	Nombre del empleado
	<div align="center">
		<input type="text" class="" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
		<span class="">
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br><br>
</div>

{{Form::close()}}