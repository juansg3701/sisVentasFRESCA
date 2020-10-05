@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Pedidos</title>
   
</head>


<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Pago de de la compra: {{$id}}</h3>
				
				<?php
				$Enable="enable";
				?>		
			
				<br>
				<br>

				<div align="center">
				@foreach($facturasPagos as $f)

				<?php 
								  $api_key="4Vj8eK4rloUd272L48hsrarnUA";
								//$api_key="70Uqr3qWLpK4MT710BsDV2ld9c";
								  $monto=round($f->abono,0); 
								  $mercid="508029";
								  //$mercid="833866";
								  $referenceCode='F'.$f->id_abono.$f->empleado_id_empleado.rand(1000,5000);
								$signature=md5($api_key."~".$mercid."~".$referenceCode."~".$monto."~COP");
								  ?>
								<form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" align="center">
								  <input name="merchantId"    type="hidden"  value="<?php echo $mercid ?>"   >
								  <input name="accountId"     type="hidden"  value="512321" >
								  <input name="description"   type="hidden"  value="TestPAYU"  >
								  <input name="referenceCode" type="hidden"  value="<?php echo $referenceCode ?>" >
								  <input name="amount"        type="hidden"  value="<?php echo $monto ?>"   >
								  <input name="tax"           type="hidden"  value="0"  >
								  <input name="taxReturnBase" type="hidden"  value="0" >
								  <input name="currency"      type="hidden"  value="COP" >
								  <input name="signature"     type="hidden"  value="<?php echo $signature ?>"  >
								  <input name="test"          type="hidden"  value="1" >
								    <input name="buyerEmail"    type="hidden"  value="juangomez3701@gmail.com" >
								  <input name="responseUrl"    type="hidden"  value="{{URL::action('estado@show',$id)}}" >
								  <!--  http://localhost:8082/Edicion/12%20dic/Proyecto%20Unido/union/public/almacen/facturacion/estadoVenta  -->
								  <input name="confirmationUrl"    type="hidden"  value="{{URL::action('estado@show',$id)}}" >
								  <input name="Submit"   class="btn btn-info"     type="submit"  value="Pagar" <?php echo $Enable?>>
								  </form>
				@endforeach
				
			</div>
			<br>
			<div align="center">

			<a href="{{url('almacen/pedidosDevoluciones/abonoCliente')}}" class="btn btn-danger">Volver</a>
			</div>
	

		</div>
	</div>


	
</body>
@stop
