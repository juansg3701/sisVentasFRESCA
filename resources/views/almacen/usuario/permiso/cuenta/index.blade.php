@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario-Cuentas</title>
</head>

<body>
	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Cuentas</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li><a href="#">Permisos de administrador</a></li>
								<li class="active">Cuentas</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">MÓDULO DE CUENTAS</h2>
						</div><br>
						<div class="row" align="center">	
							<div class="col-sm-3" align="center"></div>
								<div class="col-sm-6" align="center">
									<div class="card" align="center">
										<div class="card-header" align="center">
											<strong></strong>
										</div>
										<div class="card-body card-block" align="center">
											<div id=formulario>
												<div class="form-group">
													<!--Incluir la ventana modal de búsqueda-->	
													@include('almacen.usuario.permiso.cuenta.search')
													<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<div class="col-sm-3" align="center"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
@stop

@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">LISTA DE CUENTAS</h3>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
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
								@foreach($modulosP as $mp)
								@if($mp->id_cargo==$usu->tipo_cargo_id_cargo)
								<td>{{ $mp->nombre}}</td>
								@endif
								@endforeach

								@foreach($sedesP as $sp)
								@if($sp->id_sede==$usu->sede_id_sede)
								<td>{{ $sp->nombre_sede}}</td>
								@endif
								@endforeach
								<td>
									<a href="{{URL::action('UsersController@edit',$usu->id)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
									
								</td>	
							</tr>
							@include('almacen.usuario.permiso.cuenta.modal')
							@endif

							@if(auth()->user()->superusuario==1)
							<tr>
								<td>{{ $usu->id}}</td>
								<td>{{ $usu->name}}</td>
								<td>{{ $usu->email}}</td>
								@foreach($cargos as $mp)
								@if($mp->id_cargo==$usu->tipo_cargo_id_cargo)
								<td>{{ $mp->nombre}}</td>
								@endif
								@endforeach

								@foreach($sedes as $sp)
								@if($sp->id_sede==$usu->sede_id_sede)
								<td>{{ $sp->nombre_sede}}</td>
								@endif
								@endforeach
								
								<td>
									<a href="{{URL::action('UsersController@edit',$usu->id)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
									
								</td>	
							</tr>
							@endif
							@endforeach
						</table>
					</div>
					{{$usuarios->render()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop