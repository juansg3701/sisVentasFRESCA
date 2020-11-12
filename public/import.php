<?php
include "database.php";
include "class.upload.php";

if(isset($_FILES["name"])){
    $up = new Upload($_FILES["name"]);
    if($up->uploaded){
        $up->Process("./uploads/");
        if($up->processed){
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php';
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();



                <td><?php echo $row['id_producto']; ?></td>
                <td><?php echo $row['plu']; ?></td>
                <td><?php echo $row['ean']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['categoria_id_categoria']; ?></td>
                <td><?php echo $row['unidad_de_medida']; ?></td>
                <td><?php echo $row['impuestos_id_impuestos']; ?></td>
                <td><?php echo $row['descuento_id_descuento']; ?></td>
                <td><?php echo $row['stock_minimo']; ?></td>

                <td>
                    <?php

                        if ($row['necesita_peso'] == 1) {
                            echo "Si";
                        }else {
                            echo "No";
                        }
                    ?>
                </td>
                <td><?php echo $row['imagen']; ?></td>
                <td><?php echo $row['precio_1']; ?></td>
                <td><?php echo $row['precio_2']; ?></td>
                <td><?php echo $row['precio_3']; ?></td>
                <td><?php echo $row['precio_4']; ?></td>
                <td><?php echo $row['costo_compra']; ?></td>
                <td><?php echo $row['punto_venta_id_punto_venta']; ?></td>
                <td><?php echo $row['empleado_id_empleado']; ?></td>
                <td><?php echo $row['fecha_registro']; ?></td>



                
            for ($row = 2; $row <= $highestRow; $row++){
                $x_nombre_empresa = $sheet->getCell("A".$row)->getValue();
                $x_nombre_proveedor = $sheet->getCell("B".$row)->getValue();
                $x_direccion = $sheet->getCell("C".$row)->getValue();
                $x_telefono = $sheet->getCell("D".$row)->getValue();
                $x_correo = $sheet->getCell("E".$row)->getValue();
                $x_documento = $sheet->getCell("F".$row)->getValue();
                $x_verificacion_nit = $sheet->getCell("G".$row)->getValue();

                if ($x_nombre_empresa!='' && 
                    $x_nombre_proveedor!='' &&
                    $x_direccion!='' &&
                    $x_telefono!='' &&
                    $x_correo!='' &&
                    $x_documento!='' ) {
                    # code...
                
                
                $sql = "insert into proveedor (nombre_empresa, nombre_proveedor, direccion,  telefono, correo, documento, verificacion_nit) value ";
                $sql .= " (\"$x_nombre_empresa\",\"$x_nombre_proveedor\",\"$x_direccion\",\"$x_telefono\",\"$x_correo\",\"$x_documento\",\"$x_verificacion_nit\")";
               $con->query($sql);
               }else{

               }
            }
        unlink($archivo);
        }   
}
}
echo "<script>
window.location = './index.php';
</script>
";
?>