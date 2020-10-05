<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=inventario_prodProv.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();



	$query="SELECT s.id_stock,p.nombre,p.plu,p.ean,s.fecha_registro,sed.nombre_sede,pd.nombre_proveedor,s.cantidad,s.disponibilidad FROM stock as s, producto as p, sede as sed, proveedor as pd WHERE s.producto_id_producto=p.id_producto and s.sede_id_sede=sed.id_sede and s.proveedor_id_proveedor=pd.id_proveedor and s.fecha_registro>='$desde' and s.fecha_registro<='$hasta'";

	 			$productos=DB::table('stock as s')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 			->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad')
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(10);


	$result=mysqli_query($link, $query);


	
?>

<table border="1">
	<tr style="background-color:red;">
		<thead>
			  <th>ID</th>
              <th>NOMBRE</th>
              <th>PLU</th>
              <th>EAN</th>
              <th>SEDE</th>
              <th>PROVEEDOR</th>
              <th>CANTIDAD</th>
              <th>DISPONIBILIDAD</th>
              <th>FECHA REGISTRO</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['id_stock']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['plu']; ?></td>
					<td><?php echo $row['ean']; ?></td>
					<td><?php echo $row['nombre_sede']; ?></td>
					<td><?php echo $row['nombre_proveedor']; ?></td>
					<td><?php echo $row['cantidad']; ?></td>
					<td><?php echo $row['disponibilidad']; ?></td>
					<td><?php echo $row['fecha_registro']; ?></td>

				</tr>	
			<?php
		}

	?>
</table>


