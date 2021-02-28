<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=RP_Inventario.xls');

	require_once('conexion.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	require('conexion2.php');
    $conn2=new Conexion2();
    $link2 = $conn2->conectarse();

    require 'cn.php';

	//$query="SELECT s.id_stock, s.total, tp.nombre as categoria, s.fecha_registro, s.producto_id_producto, s.noFactura,s.cantidad, s.producto_id_producto FROM stock as s, empleado as e, categoria_producto_trans as tp, proveedor as p WHERE s.fecha_registro>='$desde' and s.fecha_registro<='$hasta' and s.transformacion_stock_id=tp.id_categoria and s.empleado_id_empleado=e.id_empleado and s.proveedor_id_proveedor=p.id_proveedor ORDER BY s.id_stock DESC";

	

	$query="SELECT p.id_producto, p.nombre as nombre_producto FROM producto as p";

	//$query2="SELECT * FROM stock";

	$query2="SELECT s.id_stock, s.total, tp.nombre as categoria, s.fecha_registro, s.producto_id_producto, s.noFactura,s.cantidad, s.producto_id_producto FROM stock as s, empleado as e, categoria_producto_trans as tp, proveedor as p WHERE s.fecha_registro>='$desde' and s.fecha_registro<='$hasta' and s.transformacion_stock_id=tp.id_categoria and s.empleado_id_empleado=e.id_empleado and s.proveedor_id_proveedor=p.id_proveedor ORDER BY s.id_stock DESC";

	$result=mysqli_query($link, $query);
	$result2=mysqli_query($link2, $query2);


	/*$prodSed = $mysqli->query($query);

	$vector_id= array();
    $vector_nombre=array();

    while($row0 = $prodSed2->fetch_assoc()){
        array_push($vector_id,$row0['id_producto']);
        array_push($vector_nombre,$row0['nombre_producto']);            
    }


    while($row = $prodSed->fetch_assoc()){
     
        $longitud = count($vector_id); 

        for($i=0; $i<$longitud; $i++){

            if ($row['producto_id_producto'] == $vector_id[$i]) {
                $pdf->Cell(15,5,$row['id_stock'],1,0,'C',0);
                $pdf->Cell(35,5,$row['fecha_registro'],1,0,'C',0);
                $pdf->Cell(35,5,$row['noFactura'],1,0,'C',0);
                $pdf->Cell(35,5,$vector_nombre[$i],1,0,'C',0);
                $pdf->Cell(35,5,$row['cantidad'],1,0,'C',0);
                $pdf->Cell(35,5,$row['total'],1,1,'C',0);
               
            }
        }
    }*/


    $prodSed = $mysqli->query($query);

	$vector_id= array();
    $vector_nombre=array();

    while($row0 = $prodSed->fetch_assoc()){
        array_push($vector_id,$row0['id_producto']);
        array_push($vector_nombre,$row0['nombre_producto']);            
    }
	
?>

<table border="1">
	<tr style="background-color:WHITE; height:100px">
		<thead>
			<th>ID</th>
            <th>FECHA</th>
            <th>NO.FACTURA</th>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>PAGO TOTAL</th>
		</thead>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result2)) {
			

			    $longitud = count($vector_id); 

        		for($i=0; $i<$longitud; $i++){

            	if ($row['producto_id_producto'] == $vector_id[$i]) {

            ?>
				<tr>
					<td><?php echo $row['id_stock']; ?></td>
					<td><?php echo $row['fecha_registro']; ?></td>
					<td><?php echo $row['noFactura']; ?></td>
					<td><?php echo $vector_nombre[$i]; ?></td>
					<td><?php echo $row['cantidad']; ?></td>
					<td><?php echo $row['total']; ?></td>

					
				</tr>	
			<?php
			
				}
	        }

		}
	?>

	<?php
		/*if ($row['producto_id_producto'] == $row2['id_producto']) {
			while ($row2=mysqli_fetch_assoc($result)) {
				?>
					<tr>
						<td><?php echo $row['nombre_producto']; ?></td>		
					</tr>	
				<?php
			}
		}*/
		
	?>
</table>