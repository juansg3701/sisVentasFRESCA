@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Clientes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<!--Código de JQuery para mostrar/esconder los campos del atributo documento-->
	<script type="text/javascript">
		$(function() {
    		$("#btn_search").on("click", function() {
    			$("#divBuscar").prop("style", "display:hidden");
    			$("#btn_search").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:hidden");
    		});
    		$("#btn_search2").on("click", function() {
    			$("#divBuscar").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:none");
    			$("#btn_search").prop("style", "display:hidden");
    		});
		});
	</script>

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Cliente</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inicio</li>
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
							<h2 class="pb-2 display-5">M&Oacute;DULO DE CLIENTES</h2>
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

													<div align="center">
														<a href="{{URL::action('ClienteController@create',0)}}"><button class="btn btn-info">Registrar Cliente</button></a>
														<a href="{{URL::action('CategoriaClienteController@index',0)}}"><button class="btn btn-info">Categor&iacute;a Cliente</button></a>
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
						
						<div class="form-group col-sm-8" align="center">
							<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
							<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
						</div>
		
						<div id="divBuscar" class="form-group col-sm-8" align="center" style="display:none">
							<!--Incluir la ventana modal de búsqueda-->	
							@include('almacen.cliente.cliente.search')
						</div>
					</div>

					<div class="card-body">
			
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>CONTACTO</th>
								<th>EMPRESA</th>
								<th>CATEGOR&Iacute;A</th>
								<th>DIRECCIÓN</th>
								<th>TEL&Eacute;FONO</th>
								<th>CORREO</th>
								<th>NO. DOCUMENTO</th>
								<th colspan="2">NIT</th>
								<th colspan="3">OPCIONES</th>
							</thead>
							@foreach($clientes as $cli)
							<tr>
								<td>{{ $cli->nombre}}</td>
								<td>{{ $cli->nombre_empresa}}</td>
								<td>{{ $cli->categoria_cliente_id_categoria}}</td>
								<td>{{ $cli->direccion}}</td>
								<td>{{ $cli->telefono}}</td>
								<td>{{ $cli->correo}}</td>
								<td>{{ $cli->documento}}</td>
								<td>{{ $cli->nit}}</td>
								<td>{{ $cli->verificacion_nit}}</td>

								<td>
									<a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
								</td>
								<td>
									<a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
								</td>
								<td>
									<a href="" title="Registro de cambios" data-target="#modal-infoCliente-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
								</td>
							</tr>
							@include('almacen.cliente.cliente.modal')
							@include('almacen.cliente.cliente.modalInfoCliente')
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

