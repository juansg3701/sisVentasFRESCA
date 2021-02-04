<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=rep_mPago.xls');

	require_once('conexion2.php');
	$conn=new Conexion2();
	$link = $conn->conectarse();

	$query="SELECT f.id_factura, f.pago_total, f.noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha FROM factura as f, tipo_pago as tp, cliente as c, empleado as e WHERE f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.fecha>='$desde' and f.fecha<='$hasta'";



	$result=mysqli_query($link, $query);

?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
			<th>Id</th>
			<th>Fecha</th>
			<th>No. Productos</th>
			<th>Pago Total</th>
			<th>Metodo de pago</th>
		</thead>
	</tr>

	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
			<tr>
					<td><?php echo $row['id_factura']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['noproductos']; ?></td>
					<td><?php echo $row['pago_total']; ?></td>
					<td><?php echo $row['tipo_pago_id_tpago']; ?></td>
			</tr>	
			<?php
		}
	?>

</table>
