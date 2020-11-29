@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Caja-Registros</title>
</head>

<body>
	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Caja</h1>
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
							<h2 class="pb-2 display-5">M&OacuteDULO DE CAJA</h2>
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
														@include('almacen.caja.search')
														<div class="form-group">
															<div align="center">
															<a href="{{URL::action('CajaController@create',0)}}"><button class="btn btn-info">Nuevo registro de caja</button></a>
															<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
															</div>
														
														</div>
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
						<h3 class="pb-2 display-5">REGISTROS DE CAJA</h3>
					</div>

					<div class="card-body">
			
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
							<th>Id</th>
							<th>Base</th>
							<th>Ingreso Efectivo</th>
							<th>Ingreso Electrónico</th>
							<th>Egreso Efectivo</th>
							<th>Egreso Electrónico</th>
							<th>Ventas</th>
							<th>Fecha</th>
							<th>Empleado</th>
							<th>Sede</th>
							<th>Opciones</th>
						</thead>
						@foreach($cajas as $caj)
						@if($caj->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $caj->id_caja}}</td>
							<td>{{ $caj->base_monetaria}}</td>
							<td>{{ $caj->ingresos_efectivo}}</td>
							<td>{{ $caj->ingresos_electronicos}}</td>
							<td>{{ $caj->egresos_efectivo}}</td>
							<td>{{ $caj->egresos_electronicos}}</td>
							<td>{{ $caj->ventas}}</td>
							<td>{{ $caj->fecha}}</td>
							<td>{{ $caj->empleado}}</td>
							<td>{{ $caj->sede}}</td>
							<td>
								<a href="{{URL::action('CajaController@edit',$caj->id_caja)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$caj->id_caja}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.caja.modal')
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $caj->id_caja}}</td>
							<td>{{ $caj->base_monetaria}}</td>
							<td>{{ $caj->ingresos_efectivo}}</td>
							<td>{{ $caj->ingresos_electronicos}}</td>
							<td>{{ $caj->egresos_efectivo}}</td>
							<td>{{ $caj->egresos_electronicos}}</td>
							<td>{{ $caj->ventas}}</td>
							<td>{{ $caj->fecha}}</td>
							<td>{{ $caj->empleado}}</td>
							<td>{{ $caj->sede}}</td>
							<td>
								<a href="{{URL::action('CajaController@edit',$caj->id_caja)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$caj->id_caja}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.caja.modal')
						@endif

						@endforeach
						</table>
					
					</div>
				{{$cajas->render()}}
				</div>
			</div>
		</div>
	</div>
</div>


@stop