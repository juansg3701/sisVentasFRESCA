@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Información de cuentas</h3>
		</div>
	</div>


	<div id=formulario>
		<div class="form-group">
			Nombre: 
			@include('almacen.pagosCobros.Bancos.search')
			<div align="center">
			<a href="{{URL::action('BancoController@create',0)}}">
			<button href="" class="btn btn-info">Registrar cuenta</button></a>
			<a href="{{url('almacen/facturacion/cuentasBancarias')}}" class="btn btn-warning">Cuentas bancarias</a>
			<a href="{{url('almacen/pagosCobros/FacturasPagar')}}" class="btn btn-warning">Facturas por pagar</a>
			</div>
			
		</div>
	</div>
</body>
@stop
@section('tabla')
<div class="container">
<h3>Lista de cuentas</h3>
<div class="row">
				<div class="table-responsive">

					
					<table class="table table-striped table-bordered table-condensed table-hover">

						<thead>
							<th>Id</th>
							<th>Nombre</th>
							<th>Intereses</th>
							<th>No. cuenta</th>
							<th>Tipo de cuenta</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($bancos as $ban)
						<tr>
							<td>{{ $ban->id_banco}}</td>
							<td>{{ $ban->nombre_banco}}</td>
							<td>{{ $ban->intereses}}</td>
							<td>{{ $ban->NoCuenta}}</td>
							<td>{{ $ban->tipo}}</td>
							<td>
								<a href="{{URL::action('BancoController@edit',$ban->id_banco)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ban->id_banco}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
							
						</tr>
						@include('almacen.pagosCobros.Bancos.modal')
						@endforeach
					</table>
				</div>
				{{$bancos->render()}}
			</div><br>
			</div>
@stop