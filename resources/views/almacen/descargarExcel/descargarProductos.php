<!--Configuración general del archivo a descargar y consulta a la base de datos para especificación de la tabla a incluir en el archivo-->
<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=Descarga_Productos.xls');
	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();
	$query="SELECT p.id_producto, p.plu, p.ean, p.nombre, c.nombre as categoria_id_categoria, p.unidad_de_medida, i.valor_impuesto as impuestos_id_impuestos, d.valor_descuento as descuento_id_descuento, p.stock_minimo, p.imagen, p.precio_1, p.precio_2, p.precio_3, p.precio_4, p.costo_compra, pv.no as punto_venta_id_punto_venta, p.empleado_id_empleado, p.fecha_registro  FROM producto as p, categoria_productos as c, impuestos as i, descuento as d, punto_venta as pv WHERE p.categoria_id_categoria=c.id_categoria and p.impuestos_id_impuestos=i.id_impuestos and p.descuento_id_descuento=d.id_descuento and p.punto_venta_id_punto_venta=pv.id_punto_venta ORDER BY id_producto DESC";
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
			
			<th>IMAGEN</th>
			<th>PRECIO 1</th>
			<th>PRECIO 2</th>
			<th>PRECIO 3</th>
			<th>PRECIO 4</th>
			<th>COSTO COMPRA</th>
			<th>PUNTO_VENTA</th>
			<th>EMPLEADO</th>
			<th>FECHA</th>

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

				<td><?php echo $row['imagen']; ?></td>
				<td><?php echo $row['precio_1']; ?></td>
				<td><?php echo $row['precio_2']; ?></td>
				<td><?php echo $row['precio_3']; ?></td>
				<td><?php echo $row['precio_4']; ?></td>
				<td><?php echo $row['costo_compra']; ?></td>
				<td><?php echo $row['punto_venta_id_punto_venta']; ?></td>
				<td><?php echo $row['empleado_id_empleado']; ?></td>
				<td><?php echo $row['fecha_registro']; ?></td>

			</tr>	
			<?php
		}
	?>
</table>