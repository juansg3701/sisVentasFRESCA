{!! Form::open(array('url'=>'almacen/nomina/horario/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div align="center">

	id del empleado
	<div align="center">
		<input type="text" class="" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
		<span class="">
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br>
	
	<div align="center">
		<h4>Búsqueda por fechas</h4><br>
		Fecha Inicial
		<input type="date" class="" name="searchText1" value="2020-01-01">" >
		Fecha Final
		<input type="date" class="" name="searchText2" value="<?php echo date("Y-m-d"); ?>">
		<span class="">
			
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br>
{{Form::close()}}