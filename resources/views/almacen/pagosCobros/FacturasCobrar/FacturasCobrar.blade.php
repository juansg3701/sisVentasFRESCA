@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Pagos y cobros</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Facturas por cobrar</h3>
		</div>
	</div>


	<div id=formulario>
		<div class="form-group">
			{!! Form::open(array('url'=>'almacen/pagosCobros/FacturasCobrar','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
			Nombre:

			<input id="cli1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		
			<br>
			
			<br>
{{Form::close()}}
<div align="center">
				<a href="{{URL::action('facturasCobrarController@create')}}"><button class="btn btn-info">Registrar cartera</button></a>
				<a href="{{URL::action('facturacionListaVentas@show',0)}}" class="btn btn-warning">Lista de ventas</a>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>

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
							<th>Id</th>
							<th>Id Factura</th>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Direccion</th>
							<th>Correo</th>
							<th colspan="2">CUOTAS:<br>FALTAN-TOTAL </th>
							<th>Fecha</th>
							<th>Saldo final</th>
							<th>Retraso de pago</th>
							<th>Opciones</th>
						</thead>
						@foreach($clientes as $cli)
						<tr>
							<td>{{ $cli->id}}</td>
							<td>{{ $cli->nofactura}}</td>
							<td>{{ $cli->nombre}}</td>
							<td>{{ $cli->telefono}}</td>
							<td>{{ $cli->direccion}}</td>
							<td>{{ $cli->correo}}</td>
							<td>{{ $cli->cuotasRestantes}}</td>
							<td>{{ $cli->cuotasTotales}}</td>
							<td>{{ $cli->fecha}}</td>
							<td>{{ $cli->valortotal}}</td>
							<td>
								@if($cli->atraso=='0')
								<input type="color" value="#ff0000"  disabled="true">
								@endif
								@if($cli->atraso=='1')
								<input type="color" value="#008f39"  disabled="true">
								@endif

							</td>

							<td>
								<a href="{{URL::action('facturasCobrarController@edit',$cli->id)}}"><button class="btn btn-info">Abonar</button></a>
								

								<a href="" data-target="#modal-delete-{{$cli->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.pagosCobros.FacturasCobrar.modal')
						@endforeach
					</table>
				</div>
			</div><br>
			</div>
@stop