@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Devoluciones Iguales</title>
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
			@include('almacen.pedidosDevoluciones.devolucionIgual.search')
			<br>
			<div align="center">
			</div>
		</div>
	</div>

			<a href="{{url('almacen/pedidosDevoluciones/devoluciones')}}" class="btn btn-danger">Volver</a>
</body>

@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
								<a href="{{URL::action('DevIgualController@edit',$ps->id_stock)}}"><button class="btn btn-info">Devolución</button></a>
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
								<a href="{{URL::action('DevIgualController@edit',$ps->id_stock)}}"><button class="btn btn-info">Devolución</button></a>
							</td>
						</tr>
						@include('almacen.inventario.proveedor-sede.modal')
						@endif
						@endforeach

					</table>
				</div>
			</div>
			</div><br>
@stop