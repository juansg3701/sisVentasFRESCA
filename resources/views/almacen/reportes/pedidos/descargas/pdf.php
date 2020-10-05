<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=pedidos_cliente.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT tc.id_remision,tc.noproductos,tc.fecha_solicitud,tc.fecha_entrega,tc.pago_inicial,tc.porcentaje_venta,tc.pago_total, e.nombre as empleado, c.nombre as cliente, p.nombre as tipo_pago FROM t_p_cliente as tc, empleado as e, cliente as c, tipo_pago as p WHERE tc.empleado_id_empleado=e.id_empleado and tc.cliente_id_cliente=c.id_cliente and tc.tipo_pago_id_tpago=p.id_tpago and tc.fecha_solicitud>='$desde' and tc.fecha_solicitud<='$hasta'";


	$result=mysqli_query($link, $query);

?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
			<th>Remisión</th>
			<th>No. Productos</th>
			<th>Fecha de Solicitud</th>
			<th>Fecha de entrega</th>
			<th>Cliente</th>
			<th>Empleado</th>
			<th>Metodo de Pago</th>
			<th>Total</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_remision']; ?></td>
					<td><?php echo $row['noproductos']; ?></td>
					<td><?php echo $row['fecha_solicitud']; ?></td>
					<td><?php echo $row['fecha_entrega']; ?></td>
					<td><?php echo $row['cliente']; ?></td>
					<td><?php echo $row['empleado']; ?></td>
					<td><?php echo $row['tipo_pago']; ?></td>
					<td><?php echo $row['pago_total']; ?></td>
					
					
				</tr>	
			<?php
		}

	?>
</table>
