<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Productos.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();
	$query="SELECT id_producto, plu, ean, nombre, categoria_id_categoria, unidad_de_medida, impuestos_id_impuestos, descuento_id_descuento, stock_minimo, necesita_peso, imagen, precio_1, precio_2, precio_3, precio_4, costo_compra, punto_venta_id_punto_venta FROM producto ORDER BY id_producto DESC";
	$result=mysqli_query($link, $query);
?>
<!--Definir los campos de la tabla proveedor a mostrar en el archivo excel-->
<table border="1">
	<tr style="background-color:LIGHTSTEELBLUE; height:100px">
		<thead>
			<th>ID</th>
			<th>PLU</th>
			<th>EAN</th>
			<th>NOMBRE</th>
			<th>CATEGORIA</th>
			<th>UNIDAD MEDIDA</th>
			<th>IMPUESTO</th>
			<th>DESCUENTO</th>
			<th>STOCK MINIMO</th>
			<th>¿NECESITA PESO?</th>
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
				<td><?php echo $row['id_producto']; ?></td>
				<td><?php echo $row['plu']; ?></td>
				<td><?php echo $row['ean']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['categoria_id_categoria']; ?></td>
				<td><?php echo $row['unidad_de_medida']; ?></td>
				<td><?php echo $row['impuestos_id_impuestos']; ?></td>
				<td><?php echo $row['descuento_id_descuento']; ?></td>
				<td><?php echo $row['stock_minimo']; ?></td>
				<td><?php echo $row['necesita_peso']; ?></td>
				<td><?php echo $row['imagen']; ?></td>
				<td><?php echo $row['precio_1']; ?></td>
				<td><?php echo $row['precio_2']; ?></td>
				<td><?php echo $row['precio_3']; ?></td>
				<td><?php echo $row['precio_4']; ?></td>
				<td><?php echo $row['costo_compra']; ?></td>
				<td><?php echo $row['punto_venta_id_punto_venta']; ?></td>


			</tr>	
			<?php
		}
	?>
</table>