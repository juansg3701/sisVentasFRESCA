<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=inventario_prodSede.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT p.id_producto,p.nombre,p.plu,p.ean, p.fecha_registro,c.nombre as categoria_id_categoria,p.unidad_de_medida,p.precio,i.nombre as impuestos_id_impuestos,p.stock_minimo FROM producto as p, categoria as c, impuestos as i WHERE p.categoria_id_categoria=c.id_categoria and p.impuestos_id_impuestos=i.id_impuestos and p.fecha_registro>='$desde' and p.fecha_registro<='$hasta'";

	$result=mysqli_query($link, $query);
	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
			<th>ID</th>
            <th>NOMBRE</th>
            <th>PLU</th>
            <th>EAN</th>
            <th>CATEGORIA</th>
            <th>UNIDAD MEDIDA</th>
            <th>PRECIO</th>
            <th>IMPUESTO</th>
            <th>STOCK MINIMO</th>
            <th>FECHA REGISTRO</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_producto']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['plu']; ?></td>
					<td><?php echo $row['ean']; ?></td>
					<td><?php echo $row['categoria_id_categoria']; ?></td>
					<td><?php echo $row['unidad_de_medida']; ?></td>
					<td><?php echo $row['precio']; ?></td>
					<td><?php echo $row['impuestos_id_impuestos']; ?></td>
					<td><?php echo $row['stock_minimo']; ?></td>
					<td><?php echo $row['fecha_registro']; ?></td>		
				</tr>	
			<?php
		}
	?>
</table>