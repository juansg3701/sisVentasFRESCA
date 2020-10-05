@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Pagos y cobros</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Abonos pagos</h3>
		</div>
	</div>


<div align="center" id=formulario>
	<div class="input-group"  >
	{!!Form::open(array('url'=>'almacen/pagosCobros/AbonosPagos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


		  

	<div id=formulario>
		<div class="form-group">
			<?php
			$Enable="disabled";
			?>

			  @foreach($valorrestanteT as $vr)
			@if($vr->cuotas_restantes>0)
			<?php
			$Enable="enable";
			?>	
			@endif
			@endforeach

			@foreach($bancoId as $bi)
			<input type="hidden" name="banco_idBanco" value="{{$bi->id_banco}}">
			@endforeach

			<input type="hidden" class="form-control" name="id_cuentas" value="{{$id}}">
			
			<input type="hidden" class="form-control" name="id" value="{{$id}}">
			
			Sede: 
			<select name="sede_id_sede" class="form-control">
				<?php 
				$sede=auth()->user()->sede_id_sede;
				?>		
				
				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede ==$s->id_sede)
				<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach

				@foreach($sedes as $s)
				@if( Auth::user()->sede_id_sede !=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach
			</select><br>
				
			Empleado: 
			<select name="empleado_id_empleado" class="form-control">
				<?php 
				$nombre=auth()->user()->name;
				?>		
				
				@foreach($usuarios as $usu)
				@if( Auth::user()->name ==$usu->nombre)
				<option value="{{$usu->id_empleado}}" >{{$usu->nombre}}</option>
				aa
				@endif
				@endforeach

				@foreach($usuarios as $usu)
				@if( Auth::user()->name !=$usu->nombre)
				<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
				aa
				@endif
				@endforeach
			</select><br>
		
			Tipo de pago: 
			<select name="tipo_pago" class="form-control">
				@foreach($tipoPago as $tp)
				@if($tp->id_tpago==1 || $tp->id_tpago==2)
				<option value="{{$tp->id_tpago}}">{{$tp->nombre}}</option>
				@endif
				@endforeach
			</select><br>

			Fecha de pago<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i"); ?>"><br>
			Valor abono<input type="text" class="form-control" name="valor_abono" min="1" pattern="^[0-9]+"><br>

			@foreach($valorrestanteT as $vr)
			<input type="hidden" class="form-control" name="valor_restante" value="{{$vr->total}}"><br>
			@endforeach

			<?php 
			$contador=0;
			?>

			@if(count($valortotalT)=='0')
			@foreach($valorrestanteT as $vr)
			<input type="hidden" class="form-control" name="valor_total" value="{{$vr->total}}"><br>
			@endforeach
			@endif

			@foreach($valortotalT as $vt)
			@if($contador=='0')
			<input type="hidden" class="form-control" name="valor_total" value="{{$vt->valor_total}}"><br>
			<?php 
			$contador=1;
			?>
			@endif
			@endforeach

			
			<br>
			<div align="center">
			<button class="btn btn-info" type="submit" <?php echo $Enable?>>Registrar Abono</button>
			<a href="{{url('almacen/pagosCobros/FacturasPagar')}}" class="btn btn-danger">Volver</a>

				</div>
		</div>
	</div>
{!!Form::close()!!}		
	</div>
	</div>


</body>

@stop
@section('tabla')
<div class="form-group">
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID </th>
							<th>ID CARTERA</th>
							<th>TIPO DE PAGO</th>
							<th>EMPLEADO</th>
							<th>FECHA</th>
							<th>VALOR RESTANTE</th>
							<th>VALOR ABONO</th>	
							<th>VALOR TOTAL</th>
							<th>OPCIONES</th>
							
						</thead>
						
						@foreach($abonos as $a)
						<tr>
							<td>{{$a->id}}</td>
							<td>{{$a->id_cartera}}</td>
							<td>{{$a->nombreP}}</td>
							<td>{{$a->nombreE}}</td>
							<td>{{$a->fecha}}</td>
							<td>{{$a->valorrestante}}</td>
							<td>{{$a->valorabono}}</td>
							<td>{{$a->valortotal}}</td>
							<td>
								<a href="" data-target="#modal-delete-{{$a->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

								<a href="{{URL::action('facturasCobrarTController@edit',$a->id)}}"><button class="btn btn-info">Ticket</button></a>

							</td>
						</tr>
							@include('almacen.pagosCobros.AbonosPagos.modal')
						@endforeach
					</table>
				
				</div>
				
						
			</div>
			
			</div><br>
			
		</div>
@stop



