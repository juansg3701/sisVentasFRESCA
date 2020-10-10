@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal del módulo de sedes-->		
<head>
<title>Proveedores</title>
<!--importar ajax para el manejo de algunos campos del formulario-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Dashboard</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li><a href="#">Dashboard</a></li>
								<li><a href="#">Table</a></li>
								<li class="active">Data table</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">MÓDULO DE SEDES</h2>
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
													<!--Incluir la ventana modal de búsqueda y carga de excel-->	
													@include('almacen.sede.search')
													<div align="center">
														<!--Enlaces y botones para llamar las funciones de registro, descarga de excel y la ventana modal para carga de excel-->
														<a href="{{URL::action('SedeController@create',0)}}"><button class="btn btn-info">Registrar Sede</button></a>	
														<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
													</div>
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
		</div><!-- .animated -->
	</div><!-- .content -->
</body>
@endsection

@section('tabla')
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">SEDES REGISTRADAS</h3>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>ID</th>
								<th>NOMBRE</th>
								<th>CIUDAD</th>
								<th>DESCRIPCIÓN</th>
								<th>DIRECCIÓN</th>
								<th>TELÉFONO</th>
								<th>OPCIONES</th>
							</thead>
							@foreach($sedes as $sed)
							<tr>
								<td>{{ $sed->id_sede}}</td>
								<td>{{ $sed->nombre_sede}}</td>
								<td>{{ $sed->ciudad}}</td>
								<td>{{ $sed->descripcion}}</td>
								<td>{{ $sed->direccion}}</td>
								<td>{{ $sed->telefono}}</td>
								<td>		
									<div class="table-data-feature">
										<a href="{{URL::action('SedeController@edit',$sed->id_sede)}}"><button type="button" class="btn btn-outline-primary btn-sm">Editar</button></a>
										@if(isset($sed->id_sede))
										@include('almacen.sede.modal')
											<a href="" data-target="#modal-delete-{{$sed->id_sede}}" data-toggle="modal"><button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button></a>
										@endif
									</div>
								</td>
							</tr>
							@endforeach
						</table>
					</div>
				{{$sedes->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@include('almacen.sede.mod')
