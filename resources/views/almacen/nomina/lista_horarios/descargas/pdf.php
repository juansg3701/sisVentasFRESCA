<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=horarios_nomina.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();


	$query="SELECT n.id, n.fecha, n.horaentrada, n.horasalida, n.jornada, e.nombre, n.no_horas, n.pago_sem, n.hora_total, n.pago_total FROM nomina as n, empleado as e WHERE n.empleado_id_empleado=e.id_empleado and n.fecha>='$desde' and n.fecha<='$hasta' and e.id_empleado='$nombre'";

	$result=mysqli_query($link, $query);

	if ($nombre=='Todos los empleados') {
	    $query="SELECT n.id, n.fecha, n.horaentrada, n.horasalida, n.jornada, e.nombre, n.no_horas, n.pago_sem, n.hora_total, n.pago_total FROM nomina as n, empleado as e WHERE n.empleado_id_empleado=e.id_empleado and n.fecha>='$desde' and n.fecha<='$hasta'";
	}
	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
					<th>Id</th>
					<th>Fecha</th>
					<th>Hora Entrada</th>
					<th>Hora salida</th>
					<th>Jornada</th>
					<th>Empleado</th>
					<th>No. Horas</th>
					<th>Pago Semanal</th>
					<th>Hora Total</th>
					<th>Pago Total</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['horaentrada']; ?></td>
					<td><?php echo $row['horasalida']; ?></td>
					<td><?php echo $row['jornada']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['no_horas']; ?></td>
					<td><?php echo $row['pago_sem']; ?></td>
					<td><?php echo $row['hora_total']; ?></td>
					<td><?php echo $row['pago_total']; ?></td>
				</tr>	
			<?php
		}

	?>
</table>