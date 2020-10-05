<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=proveedor.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT * FROM proveedor";
	$result=mysqli_query($link, $query);
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
					<th>Id</th>
					<th>Nombre Empresa</th>
					<th>Contacto</th>
					<th>Dirección</th>
					<th>Correo</th>
					<th>Teléfono</th>
					<th>No. Documento</th>
					<th>Dígito de verificación NIT</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_proveedor']; ?></td>
					<td><?php echo $row['nombre_empresa']; ?></td>
					<td><?php echo $row['nombre_proveedor']; ?></td>
					<td><?php echo $row['direccion']; ?></td>
					<td><?php echo $row['correo']; ?></td>
					<td><?php echo $row['telefono']; ?></td>
					<td><?php echo $row['documento']; ?></td>
					<td><?php echo $row['verificacion_nit']; ?></td>
				</tr>	
			<?php
		}

	?>
</table>