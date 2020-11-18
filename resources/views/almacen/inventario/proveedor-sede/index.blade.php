@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
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
							<h1>Inventario</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inventario</li>
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
							<h2 class="pb-2 display-5">M&OacuteDULO DE INVENTARIO</h2>
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
														
													<a href="{{url('almacen/inventario/ean')}}"><button class="btn btn-info">Registrar productos</button></a>
													<a href="{{url('almacen/inventario/categoriaTransformado')}}"><button class="btn btn-info">Categor&iacutea transformaci&oacuten</button></a>
													</div>
													<br>
													<div align="center">
													<button class="btn btn-success">Cargar xls</button>
													<button class="btn btn-success">Descargar xls</button>
													<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
													
				
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
						<h3 class="pb-2 display-5">INVENTARIO REGISTRADO</h3>
						
						<div class="form-group col-sm-8" align="center">
							<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
							<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
						</div>
		
						<div id="divBuscar" class="form-group col-sm-8" align="center" style="display:none">
							<!--Incluir la ventana modal de búsqueda-->	
							@include('almacen.inventario.proveedor-sede.search')
						</div>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
						<thead>
							<th>IMAGEN</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>SEDE</th>
							<th>PROVEEDOR</th>
							<th>CANTIDAD</th>
							<th>UNIDAD DE MEDIDA</th>
							<th>TRANSFORMACI&OacuteN</th>
							<th>DISPONIBILIDAD</th>
							<th colspan="4">OPCIONES</th>
						</thead>
					@foreach($productos as $ps)
					@foreach($productosBuscar as $pb)
					@if($pb->id_producto==$ps->producto_id_producto)
					@if($ps->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>
							<label>
									<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$pb->id_producto}}" data-toggle="modal">
									<img src="{{asset('imagenes/articulos/'.$pb->imagen)}}" alt="{{ $pb->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
								</label>
							</td>
							<td>{{ $pb->nombre}}</td>
							<td>{{ $pb->plu}}</td>
							<td>{{ $pb->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>
							<td>{{ $pb->unidad_de_medida}}</td>
							<td>{{ $ps->nombreCategoria}}</td>
							@if($ps->disponibilidad=='1')
							<td>Disponible</td>
							@endif
							@if($ps->disponibilidad=='0')
							<td>No disponible</td>
							@endif

							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
							</td>
							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-outline-info btn-sm">Transformar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$ps->id_stock}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
							</td>
							<td>
								<a href="" title="Registro de cambios" data-target="#modal-infoProductos" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
							</td>
						</tr>
						@include('almacen.inventario.proveedor-sede.modalInfoProductos')
						@include('almacen.inventario.proveedor-sede.modal')
						@include('almacen.inventario.proveedor-sede.modalImagen')
						
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>
							<label>
									<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$pb->id_producto}}" data-toggle="modal">
									<img src="{{asset('imagenes/articulos/'.$pb->imagen)}}" alt="{{ $pb->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
								</label>
							</td>
							<td>{{ $pb->nombre}}</td>
							<td>{{ $pb->plu}}</td>
							<td>{{ $pb->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>
							<td>{{ $pb->unidad_de_medida}}</td>
							<td>{{ $ps->nombreCategoria}}</td>
							@if($ps->disponibilidad=='1')
							<td>Disponible</td>
							@endif
							@if($ps->disponibilidad=='0')
							<td>No disponible</td>
							@endif

							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
							</td>
							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-outline-info btn-sm">Transformar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$ps->id_stock}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
							</td>
							<td>
								<a href="" title="Registro de cambios" data-target="#modal-infoProductos" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
							</td>
						</tr>
						@include('almacen.inventario.proveedor-sede.modalInfoProductos')
						@include('almacen.inventario.proveedor-sede.modal')
						@include('almacen.inventario.proveedor-sede.modalImagen')
						@endif
						@endif
						@endforeach
						@endforeach


					</table>
				</div>
				{{$productos->render()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop