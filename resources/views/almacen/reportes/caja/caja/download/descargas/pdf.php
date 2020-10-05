<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=ReporteCAJ.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT k.id_caja, k.base_monetaria, k.ingresos_efectivo, k.ingresos_electronicos, k.egresos_efectivo, k.egresos_electronicos, k.ventas, k.fecha, u.nombre as empleado,s.nombre_sede as sede, p.periodo_tiempo as p_tiempo FROM caja as k, empleado as u, sede as s, p_tiempo as p WHERE k.empleado_id_empleado=u.id_empleado and k.sede_id_sede=s.id_sede and k.p_tiempo_id_tiempo=p.id_tiempo and k.fecha>='$desde' and k.fecha<='$hasta'";

	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>BASE MONETARIA</th>
              <th>ING. EFECTIVO</th>
              <th>EGR. EFECTIVO</th>
              <th>ING. ELECTRONICO</th>
              <th>EGR. ELECTRONICO</th>
              <th>SEDE</th>

		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_caja']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['base_monetaria']; ?></td>
					<td><?php echo $row['ingresos_efectivo']; ?></td>
					<td><?php echo $row['egresos_efectivo']; ?></td>
					<td><?php echo $row['ingresos_electronicos']; ?></td>
					<td><?php echo $row['egresos_electronicos']; ?></td>
					<td><?php echo $row['sede']; ?></td>
				</tr>	
			<?php
		}
	?>
</table>
