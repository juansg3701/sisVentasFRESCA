@extends ('layouts.admin')
@section ('contenido')
	
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div align="center">
			<h3>Valores por Hora de Empleado</h3>
			</div>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>

			</div>
			@endif
			<div >
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/usuario/permiso/cargo','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Cargo</th>
							<th>Hora Ordinaria</th>
							<th>Hora Dominical</th>
							<th>Hora Extraordinaria</th>
							<th>Hora Extradominical</th>
							<th>FECHA</th>
							
							<th></th>
						</thead>
						@foreach($cargos as $val)
						<tr>
						<td>{{ $val->id_cargo}}</td>
						<td>{{ $val->nombre}}</td>
						<td>{{ $val->horaordinaria}}</td>
						<td>{{ $val->horadominical}}</td>
						<td>{{ $val->horaextra}}</td>
						<td>{{ $val->horaextdom}}</td>
						<td>{{ $val->fecha}}</td>
						<td>
						<a href="{{URL::action('ValoresNominaController@edit',$val->id_cargo)}}"><button class="btn btn-info">Modificar Valores</button></a>
						<td>
						</tr>
				
						@endforeach
					</table>
				</div>
				{{$cargos->render()}}
			</div>
		</div><br>
@stop