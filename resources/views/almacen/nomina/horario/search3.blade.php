{!! Form::open(array('url'=>'almacen/nomina/horario/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
	
	<input type="hidden" class="" name="searchText1" value="<?php echo date("Y-m-d"); ?>" >
	<input type="hidden" class="" name="searchText2" value="<?php echo date("Y-m-d"); ?>">
	<button type="submit" class="btn btn-info"><i>&nbsp&nbsp Ver Horarios Registrados</i></button>
	 


{{Form::close()}}