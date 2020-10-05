@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>

</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cuentas bancarias</h3>
		</div>
	</div>

		{!! Form::open(array('url'=>'almacen/facturacion/cuentasBancarias','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
			Fecha:
			<div class="input-group">
				<input type="date" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
			</div>
			<br>
			Banco:
			<div class="input-group">

				<select name="searchText1" value="{{$searchText1}}" class="form-control">
				<option value="">Todos los bancos</option>	
				@foreach($bancos as $ban)
				<option value="{{$ban->id_banco}}">{{$ban->NoCuenta}},({{$ban->nombre_banco}})</option>
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
			<a href="{{URL::action('BancoController@index',0)}}">
				<button class="btn btn-info">Ver cuentas</button></a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>


</body>
@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<?php $conteo=count($tipoCuenta)?>
					@if($conteo==1)
					@foreach($tipoCuenta as $t)
					Tipo de cuenta: {{$t->tipo}}
					<br>
					Intereses: {{$t->interes}}
					@endforeach
					@endif

					
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<tr>
							<th>Id</th>
							<th>Cuenta/Banco</th>
							<th>Fecha</th>
							<th>Sede</th>
							<th>Ingresos efectivo</th>
							<th>Egresos efectivo</th>
							<th>Ingresos electrónicos</th>
							<th>Egresos electrónicos</th>
							</tr>
							@foreach($cuentas as $c)
							
							<tr>
							<td>{{$c->id}}</td>
							<td>{{$c->cuenta}}, ({{$c->nbanco}})</td>
							<td>{{$c->fecha}}</td>
							<td>{{$c->sede}}</td>
							<td>{{$c->iefectivo}}</td>
							<td>{{$c->efectivo}}</td>
							<td>{{$c->ielectronico}}</td>
							<td>{{$c->electronico}}</td>
							</tr>

							@endforeach
						</thead>
					</table>

					<br>
					Totales

					<?php 
					$ingresoEfectivo=0;
					$ingresoElectronico=0;
					$egresoEfectivo=0;
					$egresoElectronico=0;
					?>
					@foreach($cuentas as $c)

					@if(Auth::user()->sede_id_sede ==$c->sede_id_sede && Auth::user()->superusuario==0)
					<?php 
					$ingresoEfectivo=$ingresoEfectivo+$c->iefectivo;
					$ingresoElectronico=$ingresoElectronico+$c->ielectronico;
					$egresoEfectivo=$egresoEfectivo+$c->efectivo;
					$egresoElectronico=$egresoElectronico+$c->electronico;
					?>
					@endif
					@if(Auth::user()->superusuario==1)
					<?php 
					$ingresoEfectivo=$ingresoEfectivo+$c->iefectivo;
					$ingresoElectronico=$ingresoElectronico+$c->ielectronico;
					$egresoEfectivo=$egresoEfectivo+$c->efectivo;
					$egresoElectronico=$egresoElectronico+$c->electronico;
					?>
					@endif

					@endforeach

					<br>
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<tr>
							<th>Ingresos efectivo</th>
							<th>Egresos efectivo</th>
							<th>Ingresos electrónicos</th>
							<th>Egresos electrónicos</th>
							</tr>
							
							<tr>
							<td>{{$ingresoEfectivo}}</td>
							<td>{{$egresoEfectivo}}</td>
							<td>{{$ingresoElectronico}}</td>
							<td>{{$egresoElectronico}}</td>
							</tr>

						</thead>
					</table>
				</div>
				
			</div>
			</div><br>
@stop