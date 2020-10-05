@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar corte</h3>
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


{!!Form::model($cortes,['method'=>'PATCH','route'=>['almacen.inventario.corte-sede.cortes',$cortes->id_corte]])!!}

    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Número de Productos<input type="text" class="form-control" name="noproductos" value="{{$cortes->noproductos}}">
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
				<button class="btn btn-danger">Regresar</button><br><br>
			</div>
		</div>
	</div>
{!!Form::close()!!}	
</body>

@stop