@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario-Cargo</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cargos</h3>
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
	{!!Form::open(array('url'=>'almacen/usuario/permiso/cargo','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			<h3>Registrar Nuevo Cargo</h3>
			Nombre Cargo<input type="text" class="form-control" name="nombre">
			Descripción<input type="text" class="form-control" name="descripcion"><br>
			<input type="number"  name="horaordinaria" style="display:none">
			<input type="number"  name="horadominical" style="display:none">
			<input type="number"  name="horaextra" style="display:none">
			<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" style="display:none">
			<div align="center">
				<a href="{{URL::action('PermisoCargoController@create',0)}}">
				<button href="" class="btn btn-info">Registrar Cargo</button></a>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>	
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop

@section('tabla')
<h3>Lista de Cargos</h3>
	Nombre del cargo: 
	@include('almacen.usuario.permiso.cargo.search')	

	<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre</th>
							<th>descripcion</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($cargos as $car)
						<tr>
							<td>{{ $car->id_cargo}}</td>
							<td>{{ $car->nombre}}</td>
							<td>{{ $car->descripcion}}</td>
							<td>
								<a href="{{URL::action('PermisoCargoController@edit',$car->id_cargo)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$car->id_cargo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.usuario.permiso.cargo.modal')
						@endforeach
					</table>
				</div>
				{{$cargos->render()}}
			</div>
	</div><br>
@stop