@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Empleados</h3>
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

	<div id=formulario>
		<div class="form-group">
			Nombre del empleado:
			@include('almacen.nomina.empleado.lista.search')<br>
		</div>
	</div>
	
</body>

@stop

@section('tabla')
<h3>Lista de empleados</h3><br>
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre Empleado</th>
							<th>Cargo</th>
							<th>Sede</th>
							<th>Código</th>
							<th>Correo</th>	
						</thead>
						@foreach($usuarios as $usu)
						@if($usu->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $usu->id_empleado}}</td>
							<td>{{ $usu->nombre}}</td>
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>{{ $usu->codigo}}</td>
							<td>{{ $usu->correo}}</td>
						</tr>
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $usu->id_empleado}}</td>
							<td>{{ $usu->nombre}}</td>
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>{{ $usu->codigo}}</td>
							<td>{{ $usu->correo}}</td>
						</tr>
						@endif
						@include('almacen.nomina.empleado.modal')
						@endforeach
					</table>
				</div>
				{{$usuarios->render()}}
			</div>
	</div><br>
@stop