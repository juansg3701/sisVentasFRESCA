@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Movimientos Realizados</h3>
		</div>
	</div>


	<div id=formulario>
		
		<div class="form-group" align="center">
			@include('almacen.inventario.movimiento-sede.search')
			<a href="{{URL::action('MovimientoSedeController@create',0)}}"><button class="btn btn-info"> Realizar movimiento</button></a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>
</body>


@stop
@section('tabla')
<div class="container">
<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>USUARIO</th>
							<th>PRODUCTO</th>
							<th>SEDE LOCAL</th>
							<th>SEDE SALIDA</th>
							<th>ESTADO MOVIMIENTO</th>
							<th>FECHA</th>
						</thead>
						@foreach($movimientos as $mv)
						<tr>
							<td name="id_mstock">{{ $mv->id_mstock}}</td>
							<td name="id_empleado">{{ $mv->id_empleado}}</td>
							<td name="stock_id_stock">{{$mv->stock_id_stock}} ({{$mv->nombre_proveedor}})</td>
							<td name="sede_id_sede">{{ $mv->sede_id_sede}}</td>
							<td name="sede_id_sede2">{{ $mv->sede_id_sede2}}</td>
							<td name="t_movimiento_id_tmovimiento">{{ $mv->t_movimiento_id_tmovimiento}}</td>
							<td name="fecha">{{ $mv->fecha}}</td>
							<td>

								
								<a href="{{URL::action('MovimientoSedeController@show',$mv->id_mstock)}}"><button class="btn btn-info">Realizado</button></a>
								@if($mv->mov==2)
								<a href="{{URL::action('MovimientoSedeController@edit',$mv->id_mstock)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$mv->id_mstock}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@else
								<a href="{{URL::action('MovimientoSedeController@edit',$mv->id_mstock)}}"><button class="btn btn-info" disabled="true">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$mv->id_mstock}}" data-toggle="modal" ><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif
								
							</td>
						</tr>
						@include('almacen.inventario.movimiento-sede.modal')
						@include('almacen.inventario.movimiento-sede.realizados')
						@endforeach

					</table>
				</div>
				{{$movimientos->render()}}
		
			</div><br>
			</div>
@stop