<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_Ventas.xls');

	require_once('conexion2.php');
	$conn=new Conexion2();
	$link = $conn->conectarse();


	$query="SELECT * FROM factura";

	$result=mysqli_query($link, $query);

?>

<table border="1">
	<tr style="background-color:WHITE; height:100px">
		<thead>
			<th>Producto</th>
			<th>Compra total</th>
			<th>Venta total</th>
			<th>Utilidad mensual</th>
			<th>Margen bruto</th>
			<th>Mes</th>
			<th>A&ntilde;o</th>
		</thead>
	</tr>


	<?php
			foreach ($productos as $pro) {
		        ?>
				<tr>
						<td><?php echo $pro->nombre; ?></td>
						<td><?php echo $pro->precio_1; ?></td>
						<td><?php echo $pro->precio_2; ?></td>
						<td><?php echo $pro->precio_3; ?></td>
						<td><?php echo $pro->precio_4; ?>%</td>
						<td><?php echo $mes; ?></td>
						<td><?php echo $year; ?></td>
				
				<?php

	    	}
	?>



</table>
