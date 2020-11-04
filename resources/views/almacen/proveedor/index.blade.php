@extends ('layouts.admin')
@section ('contenido')
		
<head>
	<title>Proveedor</title>
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
							<h1>Proveedor</h1>
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
							<h2 class="pb-2 display-5">MÓDULO DE PROVEEDORES</h2>
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
														<a href="{{URL::action('ProveedorController@create',0)}}"><button class="btn btn-info">Registrar Proveedor</button></a>	
														<a href="{{URL::action('AcercaDeController@create',0)}}"><button class="btn btn-success">Descargar xls</button></a>
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
@stop

@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">PROVEEDORES REGISTRADOS</h3>
						<div class="form-group col-sm-8" align="center">
							<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
							<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
						</div>
						<div id="divBuscar" class="form-group col-sm-8" align="center" style="display:none">
							<!--Incluir la ventana modal de búsqueda-->	
							@include('almacen.proveedor.search')
						</div>
					</div>

					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>EMPRESA</th>
								<th>CONTACTO</th>
								<th>DIRECCIÓN</th>
								<th>TELÉFONO</th>
								<th>CORREO</th>
								<th>NO. DOCUMENTO</th>
								<th colspan="2">NIT</th>
								<th colspan="3">OPCIONES</th>
							</thead>
							@foreach($proveedores as $pro)
							<tr>
								<td>{{ $pro->nombre_empresa}}</td>
								<td>{{ $pro->nombre_proveedor}}</td>
								<td>{{ $pro->direccion}}</td>
								<td>{{ $pro->telefono}}</td>
								<td>{{ $pro->correo}}</td>
								<td>{{ $pro->documento}}</td>
								<td>{{ $pro->nit}}</td>
								<td>{{ $pro->verificacion_nit}}</td>
								<td>
									<a href="{{URL::action('ProveedorController@edit',$pro->id_proveedor)}}"><button class=" btn-outline-primary btn-sm">Editar</button></a>
								</td>
								<td>
									<a href="" data-target="#modal-delete-{{$pro->id_proveedor}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
								</td>
								<td>
									<a href="" title="Registro de cambios" data-target="#modal-infoProveedor-{{$pro->id_proveedor}}" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
								</td>
							</tr>
							@include('almacen.proveedor.modal')
							@include('almacen.proveedor.modalInfoProveedor')
							@endforeach
						</table>
					
					</div>
				{{$proveedores->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

