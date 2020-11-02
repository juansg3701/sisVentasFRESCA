<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Proveedor.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();
	$query="SELECT * FROM proveedor";
	$result=mysqli_query($link, $query);
?>
<!--Definir los campos de la tabla proveedor a mostrar en el archivo excel-->
<table border="1">
	<tr style="">
		<thead>
			
			<th>NOMBRE EMPRESA</th>
			<th>NOMBRE CONTACTO</th>
			<th>DIRECCION</th>
			<th>TELEFONO</th>
			<th>CORREO</th>
			<th>NO. DOCUMENTO</th>
			<th>DIGITO NIT</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['nombre_empresa']; ?></td>
				<td><?php echo $row['nombre_proveedor']; ?></td>
				<td><?php echo $row['direccion']; ?></td>
				<td><?php echo $row['telefono']; ?></td>
				<td><?php echo $row['correo']; ?></td>
				<td><?php echo $row['documento']; ?></td>
				<td><?php echo $row['verificacion_nit']; ?></td>
			</tr>	
			<?php
		}
	?>
</table>