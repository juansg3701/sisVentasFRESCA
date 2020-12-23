@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>

	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">MÓDULO DE MOVIMIENTO ENTRE SEDES</h2>
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
												<div class="form-group" align="center">
													@include('almacen.inventario.movimiento-sede.search')
													<a href="{{URL::action('MovimientoSedeController@create',0)}}"><button class="btn btn-info"> Realizar movimiento</button></a>
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
						<h3 class="pb-2 display-5">MOVIMIENTOS REGISTRADOS</h3>
					</div>
					<div class="card-body">
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
							<th>USUARIO</th>
							<th>PRODUCTO</th>
							<th>SEDE LOCAL</th>
							<th>SEDE SALIDA</th>
							<th>CANTIDAD</th>
							<th>ESTADO MOVIMIENTO</th>
							<th>FECHA</th>
							<th colspan="3">OPCIONES</th>
						</thead>
						@foreach($movimientos as $mv)
						@foreach($producto as $pb)
				
						@if($pb->id_producto==$mv->stock_id_stock)
		
						<tr>
							<td name="id_empleado">{{ $mv->id_empleado}}</td>
							<td name="stock_id_stock">{{$pb->nombre}} ({{$mv->nombre_proveedor}})</td>
							<td name="sede_id_sede">{{ $mv->sede_id_sede}}</td>
							<td name="sede_id_sede2">{{ $mv->sede_id_sede2}}</td>
							<td >{{ $mv->cantidad}}</td>
							<td name="t_movimiento_id_tmovimiento">{{ $mv->t_movimiento_id_tmovimiento}}</td>
							<td name="fecha">{{ $mv->fecha}}</td>
							

								@if($mv->mov==2)
							<td>
								<a href="{{URL::action('MovimientoSedeController@show',$mv->id_mstock)}}"><button class="btn btn-info">Realizado</button></a>
							</td>
							<td>
								<a href="{{URL::action('MovimientoSedeController@edit',$mv->id_mstock)}}"><button class="btn btn-info">Editar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$mv->id_mstock}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
								@else
							<td>
								<a href="{{URL::action('MovimientoSedeController@show',$mv->id_mstock)}}"><button class="btn btn-info" disabled="true">Realizado</button></a>
							</td>
							<td>
								<a href="{{URL::action('MovimientoSedeController@edit',$mv->id_mstock)}}"><button class="btn btn-info" disabled="true">Editar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$mv->id_mstock}}" data-toggle="modal" ><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif
								
							</td>
						</tr>
						@include('almacen.inventario.movimiento-sede.modal')
						@include('almacen.inventario.movimiento-sede.realizados')
						@endif
						@endforeach
						@endforeach

					</table>
				</div>
				{{$movimientos->render()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop