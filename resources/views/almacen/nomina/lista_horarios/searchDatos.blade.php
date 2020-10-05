{!! Form::open(array('url'=>'almacen/nomina/horario/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div align="center">

	<div align="center">
		<input type="hidden" class="" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
	</div><br>
	
	<div  align="center">
		<h4>Búsqueda por fechas</h4><br>
		Fecha Inicial
		<input type="date" class="" name="desde" value="{{$searchText1}}" >
		Fecha Final
		<input type="date" class="" name="hasta" value="{{$searchText2}}">
		<span class="">
			
			<a href="{{URL::action('HorarioNominaController2@create',0)}}"><button class="btn btn-success" type="submit">Descargar xls</button></a>
		</span>
	</div><br>
	
	Nombre del empleado
	<div align="center">
		<input type="text" class="" name="name" placeholder="Buscar..." value="{{$searchText0}}">
		<span class="">
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br><br>

	
</div>

{{Form::close()}}