<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=ReporteCAJ.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT db.id_Dbanco,db.fecha,db.ingreso_efectivo,db.egreso_efectivo,b.nombre_banco as banco,db.ingreso_electronico,db.egreso_electronico,s.nombre_sede as sede FROM detalle_banco as db, bancos as b, sede as s WHERE db.banco_idBanco=b.id_banco and db.sede_id_sede=s.id_sede and db.fecha>='$desde' and db.fecha<='$hasta'";

	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>BANCO</th>
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
					<td><?php echo $row['id_Dbanco']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['banco']; ?></td>
					<td><?php echo $row['ingreso_efectivo']; ?></td>
					<td><?php echo $row['egreso_efectivo']; ?></td>
					<td><?php echo $row['ingreso_electronico']; ?></td>
					<td><?php echo $row['egreso_electronico']; ?></td>
					<td><?php echo $row['sede']; ?></td>
				</tr>	
			<?php
		}
	?>
</table>
