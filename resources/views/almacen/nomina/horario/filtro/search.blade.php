{!! Form::open(array('url'=>'almacen/nomina/horario/filtro','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div><script language="javascript" src="js/jquery-1.2.6.min.js"></script>
</div>
<div align="center">
	Nombre del empleado
	<div align="center">
		<input type="text" class="" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
		<span class="">
			<button type="submit" class="">Buscar</button>
		</span>
	</div><br>

	
	<div  align="center">
		<h4>Búsqueda por fechas</h4><br>
		Fecha Inicial
		<input type="date" class="" name="searchText1" value="{{$searchText1}}" >
		Fecha Final
		<input type="date" class="" name="searchText2" value="2020-01-20" >
		<span class="">
		<script language="javascript">
		function recargar(){   
		       /// Aqui podemos enviarle alguna variable a nuestro script PHP
		    var variable_post="Mi texto recargado";
		       /// Invocamos a nuestro script PHP
		    $.post("tiempo.blade.php", {variable: variable_post }, function(data){
		       /// Ponemos la respuesta de nuestro script en el DIV recargado
		    $("#recargado").html(data);
		    });        
		}
		</script>
			<button type="submit" type="submit" onclick="javascript:recargar();" class="">Buscar</button>
		</span>
	</div><br><br>
	
</div>

{{Form::close()}}