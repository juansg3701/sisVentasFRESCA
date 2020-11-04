<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Productos.xls');
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
			<th>ID</th>
			<th>NOMBRE</th>
			<th>PLU</th>
			<th>EAN</th>
			<th>CATEGORIA</th>
			<th>UNIDAD MEDIDA</th>
			<th>IMPUESTO</th>
			<th>DESCUENTO</th>
			<th>STOCK MÍNIMO</th>
			<th>PESO</th>
			<th>IMAGEN</th>
			<th>PRECIO 1</th>
			<th>PRECIO 2</th>
			<th>PRECIO 3</th>
			<th>PRECIO 4</th>
			<th>COSTO COMPRA</th>
			<th>PUNTO_VENTA</th>
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