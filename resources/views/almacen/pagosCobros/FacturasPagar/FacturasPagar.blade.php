@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Pagos y cobros</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>


<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Facturas por pagar</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			{!! Form::open(array('url'=>'almacen/pagosCobros/FacturasPagar','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
			Nombre:
			<input id="fac1" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
	
		</br>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>

			
			<br>
			Banco:

			<div class="input-group">

				<select name="searchText1" value="{{$searchText1}}" class="form-control">
				<option >Todos los bancos</option>	
				@foreach($bancos as $ban)
				<option >{{$ban->nombre_banco}}</option>
				@endforeach
			</select>

				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
			</div>
			<br>
			
			<br>
{{Form::close()}}
			<div align="center">
			<a href="{{URL::action('FacturasPagarController@show',0)}}">
			<button href="" class="btn btn-info">Registrar factura </button></a>
			<a href="{{URL::action('BancoController@index',0)}}">
			<button href="" class="btn btn-info">Agregar cuenta </button></a>
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
							<th>ID</th>
							<th>NOMBRE FACTURA</th>
							<th>DESCRIPCIÓN</th>
							<th>FECHA DE PAGO</th>
							<th>BANCO</th>
							<th colspan="2">CUOTAS:<br>FALTAN-TOTAL </th>
							<th>EMPLEADO</th>
							<th>No. CUENTA</th>
							<th>INTERESES</th>
							<th>SALDO FINAL</th>
							<th>OPCIONES</th>

						</thead>
						@foreach($facturasPagar as $fp)
						<tr>
							<td>{{ $fp->id_ctaspagar}}</td>
							<td>{{ $fp->nombrepago}}</td>
							<td>{{ $fp->descripcion}}</td>
							<td>{{ $fp->fecha}}</td>
							<td>{{ $fp->bancos}}</td>
							<td>{{ $fp->cuotas_restantes}}</td>
							<td>{{ $fp->cuotas_totales}}</td>
							<td>{{ $fp->nombreE}}</td>
							<td>{{ $fp->nocuenta}}</td>
							<td>{{ $fp->intereses}}</td>
							<td>{{ $fp->total}}</td>
							<td>
								<a href="{{URL::action('FacturasPagarController@edit',$fp->id_ctaspagar)}}"><button class="btn btn-info">Abonar</button></a>		
								<a href="" data-target="#modal-delete-{{$fp->id_ctaspagar}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.pagosCobros.FacturasPagar.modal')
						@endforeach
					</table>
				</div>
				{{$facturasPagar->render()}}
			
			</div><br>
			</div>
@stop