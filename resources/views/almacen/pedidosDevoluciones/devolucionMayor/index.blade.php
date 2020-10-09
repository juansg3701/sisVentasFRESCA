@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Devolucion Mayor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>


<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Devolución de productos</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			@include('almacen.pedidosDevoluciones.devolucionMayor.search')
			<br>
			<div align="center">

			<a href="{{URL::action('facturacionListaVentas@index',0)}}">
			<button class="btn btn-info">Registrar venta por monto excedente</button></a>
			<a href="{{url('almacen/pedidosDevoluciones/devoluciones')}}" class="btn btn-danger">Volver</a>
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
							<th>ID</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>SEDE</th>
							<th>PROVEEDOR</th>
							<th>CANTIDAD</th>
							
							<th>OPCIONES</th>
						</thead>
					@foreach($productos as $ps)
					@if($ps->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
					<tr>
							<td>{{ $ps->id_stock}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>

							<td>
								<a href="{{URL::action('DevMayorController@edit',$ps->id_stock)}}"><button class="btn btn-info">Devolución</button></a>
							</td>
						</tr>
					@endif
					@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $ps->id_stock}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->nombre_sede}}</td>
							<td>{{ $ps->nombre_proveedor}}</td>
							<td>{{ $ps->cantidad}}</td>

							<td>
								<a href="{{URL::action('DevMayorController@edit',$ps->id_stock)}}"><button class="btn btn-info">Devolución</button></a>
							</td>
						</tr>
						@endif
						@include('almacen.inventario.proveedor-sede.modal')
						@endforeach

					</table>
				</div>
			
			</div><br>
			</div>
@stop