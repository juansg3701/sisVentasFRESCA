<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=rep_FP.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT cp.id_ctaspagar, cp.fecha, cp.nombrepago, cp.descripcion, b.nombre_banco as bancos, cp.total, cp.cuotas_totales, e.nombre as nombreE, cp.cuotas_restantes, b.NoCuenta as nocuenta, b.intereses as intereses FROM ctas_a_pagar as cp, bancos as b,empleado as e WHERE cp.bancos_id_banco=b.id_banco and cp.empleado_id_empleado=e.id_empleado and cp.fecha>='$desde' and cp.fecha<='$hasta'";

	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
              <th>ID</th>
              <th>CUOTAS TOTALES</th>
              <th>CUOTAS RESTANTES</th>
              <th>NOMBRE FACTURA</th>
              <th>DESCRIPCION</th>
              <th>BANCO</th>
              <th>NO. CUENTA</th>
              <th>INTERESES</th>
              <th>EMPLEADO</th>
              <th>SALDO FINAL</th>
              <th>ESTADO</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_ctaspagar']; ?></td>
					<td><?php echo $row['cuotas_totales']; ?></td>
					<td><?php echo $row['cuotas_restantes']; ?></td>
					<td><?php echo $row['nombrepago']; ?></td>
					<td><?php echo $row['descripcion']; ?></td>
					<td><?php echo $row['bancos']; ?></td>
					<td><?php echo $row['nocuenta']; ?></td>
					<td><?php echo $row['intereses']; ?></td>
					<td><?php echo $row['nombreE']; ?></td>
					<td><?php echo $row['total']; ?></td>	
					<?php 
					if ($row['cuotas_restantes']!=0) {?>
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