<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_INVENTARIO.xls');

	require_once('conexion2.php');
	$conn=new Conexion2();
	$link = $conn->conectarse();

	$query="SELECT * FROM factura";
	$result=mysqli_query($link, $query);


?>

<table border="1">

	<?php
		if ($valor==3) {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: MENSUAL'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
		    	<td><?php echo 'Inicio: '.$fecha_letra_inicial; ?></td>
				<td><?php echo 'Fin: '.$fecha_letra_final; ?></td>
				<td><?php echo 'Total ventas: '.$total_stock_mensuales; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>FECHA</th>
					<th>NO. PRODUCTOS</th>
					<th>PAGO TOTAL</th>
				</thead>
			</tr>		
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo $st->fecha_registro.'-'.$st->fecha_year; ?></td>
						<td><?php echo $st->cantidad_rep; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}
	?>


	<?php
		if ($valor==2) {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: SEMANAL'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
		    	<td><?php echo 'Inicio: '.$desde; ?></td>
				<td><?php echo 'Fin: '.$hasta; ?></td>
				<td><?php echo 'Total ventas: '.$total_stock_semanales; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>FECHA</th>
					<th>NO. PRODUCTOS</th>
					<th>PAGO TOTAL</th>
				</thead>
			</tr>		
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo 'Semana del: '.$st->fecha_registro.'-'.$st->year; ?></td>
						<td><?php echo $st->cantidad_rep; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}
	?>


	<?php
		if ($valor==1) {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: DIARIO'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
				<td><?php echo 'Fecha: '.$fecha_d; ?></td>
				<td><?php echo 'Total compras: '.$total_stock; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>FECHA</th>
					<th>NO. PRODUCTOS</th>
					<th>PAGO TOTAL</th>
				</thead>
			</tr>		
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo $st->fecha_registro; ?></td>
						<td><?php echo $st->cantidad_rep; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}
	?>



	<?php

		if ($valor=='m') {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: MENSUAL DETALLADO'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
		    	<td><?php echo 'Mes: '.$año; ?></td>
				<td><?php echo 'Total ventas: '.$total_ventas; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>TOTAL</th>
				</thead>
			</tr>
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo $st->producto; ?></td>
						<td><?php echo $st->cantidad; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}

	?>


	<?php

		if ($valor=='s') {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: SEMANAL DETALLADO'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
		    	<td><?php echo 'Fecha: '.$desde; ?></td>
				<td><?php echo 'Total comprado: '.$total_inventario_diario; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>TOTAL</th>
				</thead>
			</tr>
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo $st->producto; ?></td>
						<td><?php echo $st->cantidad; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}

	?>

	<?php

		if ($valor=='d') {
			?>

			<tr>
		    	<td colspan="3"><?php echo 'REPORTE DE VENTAS: DIARIO DETALLADO'; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3"><?php echo 'Fecha de generacion: '.date('m-d-Y h:i:s a', time()); ?></td>
		    </tr>
		    <tr>
		    	<td><?php echo 'Fecha: '.$desde; ?></td>
				<td><?php echo 'Total comprado: '.$total_inventario_diario; ?></td>
		    </tr>

			<tr style="background-color:WHITE; height:100px">
				<thead>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>TOTAL</th>
				</thead>
			</tr>
			<?php
			foreach ($stock as $st) {
		        ?>
				<tr>
						<td><?php echo $st->producto; ?></td>
						<td><?php echo $st->cantidad; ?></td>
						<td><?php echo $st->total; ?></td>
				</tr>	
				<?php
	    	}
    	}

	?>


	

</table>
