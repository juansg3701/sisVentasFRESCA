@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Clientes</title>
</head>


<body>
	<!--Panel superior-->
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

	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">MÓDULO DE CLIENTES</h2>
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
													@include('almacen.cliente.search')
													<div align="center">
														<a href="{{URL::action('ClienteController@create',0)}}"><button class="btn btn-info">Registrar Cliente</button></a>
														<!--<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-warning">Ventas</a>-->
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
		</div>
	</div>

</body>
@endsection



@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">CLIENTES REGISTRADOS</h3>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>CONTACTO</th>
								<th>EMPRESA</th>
								<th>DIRECCIÓN</th>
								<th>TELÉFONO</th>
								<th>CORREO</th>
								<th>NO. DOCUMENTO</th>
								<th>DÍGITO NIT</th>
								<th>OPCIONES</th>
							</thead>
							@foreach($clientes as $cli)
							<tr>
								<td>{{ $cli->nombre}}</td>
								<td>{{ $cli->nombre_empresa}}</td>
								<td>{{ $cli->direccion}}</td>
								<td>{{ $cli->telefono}}</td>
								<td>{{ $cli->correo}}</td>
								<td>{{ $cli->documento}}</td>
								<td>{{ $cli->verificacion_nit}}</td>
								<td>
									<!--Botones editar y eliminar de la tabla-->
									<a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
									<a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
								</td>
							</tr>
							@include('almacen.cliente.modal')
							@endforeach
						</table>
					</div>
				{{$clientes->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


