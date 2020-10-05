@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario-Cuentas</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cuentas de Usuario</h3>
		</div>
	</div>
	<div id=formulario>
		<div class="form-group">
			
			@include('almacen.usuario.permiso.cuenta.search')
			<div align="center">
				
		<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>

		</div>
	</div>
</body>
@stop

@section('tabla')
<h3>Lista de Cuentas de Usuario</h3><br>
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre</th>
							<th>Correo</th>
							
							<th>Cargo</th>
							<th>Sede</th>
							<th>OPCIONES</th>
						</thead>

						@foreach($usuarios as $usu)
						@if($usu->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $usu->id}}</td>
							<td>{{ $usu->name}}</td>
							<td>{{ $usu->email}}</td>
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>
								<a href="{{URL::action('UsersController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
								
							</td>	
						</tr>
						@include('almacen.usuario.permiso.cuenta.modal')
						@endif

						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $usu->id}}</td>
							<td>{{ $usu->name}}</td>
							<td>{{ $usu->email}}</td>
							<td>{{ $usu->tipo_cargo}}</td>
							<td>{{ $usu->sede}}</td>
							<td>
								<a href="{{URL::action('UsersController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
								
							</td>	
						</tr>
						@endif
						@endforeach
					</table>
				</div>
				{{$usuarios->render()}}
			</div>
	</div><br>
@stop