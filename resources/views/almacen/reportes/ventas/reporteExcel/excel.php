<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_VENTAS.xls');

	require_once('conexion2.php');
	$conn=new Conexion2();
	$link = $conn->conectarse();

	//$query="SELECT f.id_factura, f.pago_total, f.noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha FROM factura as f, tipo_pago as tp, cliente as c, empleado as e WHERE f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.fecha>='$desde' and f.fecha<='$hasta' ORDER BY f.id_factura DESC";

	//$query="SELECT f.id_factura, sum(f.pago_total) as pago_total, f.noproductos as noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha as fecha, f.fecha as fecha_year FROM factura as f, tipo_pago as tp, cliente as c, empleado as e, sede as sed WHERE DATE(f.fecha)>='$desde' and DATE(f.fecha)<='$hasta' and f.facturapaga=1 and f.anulacion=0 and f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.sede_id_sede=sed.id_sede";

	$query="SELECT * FROM factura";

	$result=mysqli_query($link, $query);

	//$query=$ventas;
	
	//$result=mysqli_query($link, $ventas);

?>

<table border="1">
	<tr style="background-color:WHITE; height:100px">
		<thead>
			<th>FECHA</th>
			<th>NO. PRODUCTOS</th>
			<th>PAGO TOTAL</th>
		</thead>
	</tr>


	<?php

		if ($valor==3) {

			foreach ($ventas as $ven) {
		        ?>
				<tr>
						<td><?php echo $ven->fecha.'-'.$ven->fecha_year; ?></td>
						<td><?php echo $ven->noproductos; ?></td>
						<td><?php echo $ven->pago_total; ?></td>
				</tr>	
				<?php

	    	}
    	}

	?>


	<?php

		if ($valor==2) {

		foreach ($ventas as $ven) {
	        ?>
			<tr>
					<td><?php echo 'Semana No. '.$ven->fecha.' - '.$ven->year; ?></td>
					<td><?php echo $ven->noproductos; ?></td>
					<td><?php echo $ven->pago_total; ?></td>
			</tr>	
			<?php

    	}
    	}

	?>


	<?php

		if ($valor==1) {

		foreach ($ventas as $ven) {
	        ?>
			<tr>
					<td><?php echo $ven->fecha; ?></td>
					<td><?php echo $ven->noproductos; ?></td>
					<td><?php echo $ven->pago_total; ?></td>
			</tr>	
			<?php

    	}
    	}

	?>

	<!--<?php
		/*while ($row=mysqli_fetch_assoc($result)) {
			?>
			<tr>
					<td><?php echo $row['id_factura']; ?></td>
					
			</tr>	
			<?php
		}*/
	?>-->

</table>
