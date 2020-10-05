<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-pagarC-{{$apc->id_abono}}">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
						<head>
				
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
			</head>
			<body>
				<div class="row">		
			<h3>Métodos de pago</h3>
				</div>

				<?php
				$a="";
				?>

		{!!Form::model($a,['method'=>'PATCH','route'=>['almacen.pedidosDevoluciones.pagoEfectivoP.update',$apc->id_abono]])!!}
	 {{Form::token()}}
	 <div class="col-md-12">
		 <div id=formulario>
		<div class="form-group">

				Fecha<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i"); ?>">	
				<br>
				<div class="col-md-6">
					<h4>Pago efectivo o datafono</h4>
			
			Tipo de pago: 
			<select name="tipo_pago" class="form-control">

				@foreach($tipoPago as $tp)
				@if($tp->id_tpago==1 || $tp->id_tpago==2)
				<option value="{{$tp->id_tpago}}">{{$tp->nombre}}</option>
				@endif
				@endforeach
			</select><br>
			<?php $pago=0?>
			@foreach($facturas as $f)
					@if($f->id_abono==$apc->id_abono)
					<?php $pago=$f->abono?>
					@endif
			@endforeach
			
				<input type="hidden" name="ingreso" value="<?php echo $pago?>">
				<input type="hidden" name="id_factura" value="{{$apc->id_abono}}">		

			<button class="btn btn-info" type="submit">Continuar</button>
			<hr>
				</div>
		
		</div></div>
	 {!!Form::close()!!}
		
	 		<div class="col-md-6">
	 			<h4>Pasarela de pago</h4>
				<a href="{{URL::action('pagoPClienteController@show',$apc->id_abono)}}"><button class="btn btn-info">Continuar</button></a>	
	 		</div>
				 </div>
					
					<h3>Pago total: <?php echo $pago?></h3>
				
			</body>
		</div>	
		</div>
	</div>

</div>