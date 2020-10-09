@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Caja-Registros</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registros de Caja</h3>
		</div>
	</div>

	<div id=formulario>
		@include('almacen.caja.search')
		<div class="form-group">
			<div align="center">
			<a href="{{URL::action('CajaController@create',0)}}"><button class="btn btn-info">Nuevo Registro de Caja</button></a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
		
		</div>
	</div>
</body>
@stop

@section('tabla')
<div class="container">
<h3>Registros de Caja</h3><br>
	<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
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
							<th>Periodo</th>
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
							<td>{{ $caj->p_tiempo}}</td>
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
							<td>{{ $caj->p_tiempo}}</td>
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
	</div><br>
	</div>
@stop