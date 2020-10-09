@extends ('layouts.admin')
@section ('contenido')
	
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
    
</head>


<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de Clientes</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			@include('almacen.cliente.search')
		
			<div align="center">
				

			<a href="{{URL::action('ClienteController@create',0)}}"><button class="btn btn-info">Registrar Cliente</button></a>
			<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-warning">Ventas</a>
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
							<th>Nombre</th>
							<th>Nombre empresa</th>
							<th>Dirección</th>
							<th>Correo</th>
							<th>Teléfono</th>
							<th>No. Documento</th>
							<th>Dígito de identificación NIT</th>
							<th>Cartera Activa</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($clientes as $cli)
						<tr>
							<td>{{ $cli->id_cliente}}</td>
							<td>{{ $cli->nombre}}</td>
							<td>{{ $cli->nombre_empresa}}</td>
							<td>{{ $cli->direccion}}</td>
							<td>{{ $cli->correo}}</td>
							<td>{{ $cli->telefono}}</td>
							<td>{{ $cli->documento}}</td>
							<td>{{ $cli->verificacion_nit}}</td>
							@if($cli->cartera_activa=='1')
							<td>Activa</td>
							@endif
							@if($cli->cartera_activa=='0')
							<td>Inactiva</td>
							@endif
							<td>
								<a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.cliente.modal')
						@endforeach
					</table>
				</div>
				{{$clientes->render()}}
			
			</div><br>
	</div>


@stop