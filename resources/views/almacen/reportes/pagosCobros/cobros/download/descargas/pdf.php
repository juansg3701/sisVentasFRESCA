<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=ReportePCC.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT ct.id_cartera as id, cl.nombre as nombre , cl.telefono as telefono , cl.direccion as direccion , cl.correo as correo, ct.total as valortotal, ct.cuotas_totales as cuotasTotales, ct.cuotas_restantes as cuotasRestantes, ct.fecha as fecha, ct.atraso as atraso, ct.factura_id_factura as nofactura FROM cartera as ct, cliente as cl WHERE ct.cliente_id_cliente=cl.id_cliente and ct.fecha>='$desde' and ct.fecha<='$hasta'";

	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
			  <th>ID</th>
              <th>CUOTAS TOTALES</th>
              <th>CUOTAS RESTANTES</th>
              <th>CLIENTE</th>
              <th>CORREO CL.</th>
              <th>TOTAL</th>
              <th>FECHA</th>
              <th>FACTURA</th>
              <th>ESTADO</th>

		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['cuotasTotales']; ?></td>
					<td><?php echo $row['cuotasRestantes']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['correo']; ?></td>
					<td><?php echo $row['valortotal']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['nofactura']; ?></td>
					<?php 
					if ($row['cuotasRestantes']!=0) {?>
					    <td>Atrasado</td>
					<?php }else{?>
						<td>Pago</td>
					<?php }
					;?>	
				</tr>	
			<?php
		}
	?>
</table>