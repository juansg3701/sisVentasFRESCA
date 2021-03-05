@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title></title>

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
								<li class="active">Productos</li>
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
							<h2 class="pb-2 display-5">MÓDULO DE INVENTARIO</h2>
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
														@include('almacen.inventario.producto-sede.productoCompleto.cargar')
														<a href="{{URL::action('ProductoSedeController@create',0)}}"><button class="btn btn-info">Registrar producto</button></a>
														
														<a href="{{URL::action('ImpuestoProducto@index',0)}}"><button class="btn btn-info">Registrar impuesto</button></a>
													</div>
													<br>
														<div align="center">

														<a href="{{url('almacen/inventario/producto-sede/descuentos')}}">
														<button class="btn btn-info">Registrar descuento</button></a>

														<a href="{{URL::action('CategoriaProducto@index',0)}}"><button class="btn btn-info">Registrar categoria</button></a>
														
														</div>
														<br>
														<div align="center">
														<a href="" data-target="#modal-cargar" data-toggle="modal"><button class="btn btn-warning">Cargar xlsx/xls</button></a>
														<a href="{{URL::action('ProductoSedeController@downloadExcel',0)}}"><button class="btn btn-success">Descargar xls</button></a>
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
						<h3 class="pb-2 display-5">PRODUCTOS REGISTRADOS</h3>
						
						<div class="form-group col-sm-8" align="center">
							<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
							<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
						</div>
		
						<div id="divBuscar" class="form-group col-sm-8" align="center" style="display:none">
							<!--Incluir la ventana modal de búsqueda-->	
							@include('almacen.inventario.producto-sede.productoCompleto.search')
						</div>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
							<th>NOMBRE</th>
							<th>FECHA</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>CATEGOR&IacuteA</th>
							<th>UNIDAD MEDIDA</th>
							<th>IMPUESTO</th>
							<th>DESCUENTO</th>
							<th>STOCK M&IacuteNIMO</th>
							<th>IMAGEN</th>
							<th>PRECIOS</th>
							<th colspan="3">OPCIONES</th>
						</thead>
						@foreach($productos as $ps)
						<tr>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->fecha_registro}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->categoria_id_categoria}}</td>
							<td>{{ $ps->unidad_de_medida}}</td>
							<td>{{ $ps->impuestos_id_impuestos}} {{ $ps->valorI}}%</td>
							<td>{{ $ps->nombreD}} {{ $ps->valorD}}%</td>
							<td>{{ $ps->stock_minimo}}</td>
							<td>
								<label>
									<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$ps->id_producto}}" data-toggle="modal">
									<img src="{{asset('imagenes/articulos/'.$ps->imagen)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
								</label>
							</td>
							<td>
								
								<a href="" title="Registro de cambios" data-target="#modal-precios-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-outline-primary btn-sm">Precios</button></a>
								
							</td>
							<td>
								<a href="{{URL::action('ProductoSedeController@edit',$ps->id_producto)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-outline-danger btn-sm">Eliminar</button></a>
							</td>
							<td>
								<a href="" title="Registro de cambios" data-target="#modal-infoProductos-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
							</td>
						</tr>
						@include('almacen.inventario.producto-sede.productoCompleto.modal')
						@include('almacen.inventario.producto-sede.productoCompleto.modalInfoProductos')
						@include('almacen.inventario.producto-sede.productoCompleto.modalPrecios')
						@include('almacen.inventario.producto-sede.productoCompleto.modalImagen')
						@endforeach
					</table>
				</div>
				{{$productos->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    
    document.getElementById("menuToggle").click();
   

});
</script>
@stop