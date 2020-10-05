@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cortes</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
{!!Form::open(array('url'=>'almacen/inventario/corte-sede/cortes','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Número de Productos<input type="text" class="form-control" name="noproductos">
			Fecha<input type="date" class="form-control" name="fecha">
			Periodo de Tiempo<br>
			<select name="p_tiempo_id_tiempo" class="form-control">
				@foreach($tiempo as $t)
				<option value="{{$t->id_tiempo}}">{{$t->periodo_tiempo}}</option>
				@endforeach
			</select>
			
			Valor Total<input type="text" class="form-control" name="valor_total"><br>
			<div align="center">
			<button class="btn btn-info" type="submit">Guardar Corte</button>
			<a href="{{url('almacen/inventario/corte-sede/cortes')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
{!!Form::close()!!}	
</body>


@stop
