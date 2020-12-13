<?php
include "database.php";
include "class.upload.php";

    require_once('conexion.php');
    $conn=new Conexion();
    $link = $conn->conectarse();

    require('conexion2.php');
    $conn2=new Conexion2();
    $link2 = $conn2->conectarse();

    $empleado= $_POST['empleado'];
    $fecha_actual= $_POST['fecha_actual'];
  


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

                
            for ($row = 2; $row <= $highestRow; $row++){

                $x_id_producto = $sheet->getCell("A".$row)->getValue();
                $x_plu = $sheet->getCell("B".$row)->getValue();
                $x_ean = $sheet->getCell("C".$row)->getValue();
                $x_nombre = $sheet->getCell("D".$row)->getValue();
                $x_categoria_id_categoria = $sheet->getCell("E".$row)->getValue();
                $x_unidad_de_medida = $sheet->getCell("F".$row)->getValue();
                $x_impuestos_id_impuestos = $sheet->getCell("G".$row)->getValue();
                $x_descuento_id_descuento = $sheet->getCell("H".$row)->getValue();
                $x_stock_minimo = $sheet->getCell("I".$row)->getValue();   
                $x_precio_1 = $sheet->getCell("J".$row)->getValue();
                $x_precio_2 = $sheet->getCell("K".$row)->getValue();
                $x_precio_3 = $sheet->getCell("L".$row)->getValue();
                $x_precio_4 = $sheet->getCell("M".$row)->getValue();
                $x_costo_compra = $sheet->getCell("N".$row)->getValue();
                $x_punto_venta_id_punto_venta = $sheet->getCell("O".$row)->getValue();
                $x_imagen = "";
                

                $query="SELECT * FROM producto WHERE id_producto = \"$x_id_producto\"";
                $result=mysqli_query($link, $query);
                
                $count=0; 
                while($rows=mysqli_fetch_assoc($result)){
                    $count++;
                    echo "nombre: ".$rows['nombre'];
                } 

                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result2=mysqli_query($link2, $empleado);

                if($result2){
                    while($rows=mysqli_fetch_assoc($result2)){
                         $id=$rows['id_empleado'];
                    }
                }


                if ($count==0) {
                    # code...
                    $sql = "insert into producto (id_producto, plu, ean, nombre, categoria_id_categoria, unidad_de_medida, impuestos_id_impuestos, descuento_id_descuento, stock_minimo, imagen, precio_1, precio_2, precio_3, precio_4, costo_compra, punto_venta_id_punto_venta, empleado_id_empleado, fecha_registro) value";

                   
                    $sql .= " (\"$x_id_producto\",\"$x_plu\",\"$x_ean\",\"$x_nombre\",\"$x_categoria_id_categoria\",\"$x_unidad_de_medida\",\"$x_impuestos_id_impuestos\",\"$x_descuento_id_descuento\",\"$x_stock_minimo\",\"$x_imagen\",\"$x_precio_1\",\"$x_precio_2\",\"$x_precio_3\",\"$x_precio_4\",\"$x_costo_compra\",\"$x_punto_venta_id_punto_venta\",\"$id\",\"$fecha_actual\")";

                }else{

                    $sql = "UPDATE producto SET plu=\"$x_plu\", ean=\"$x_ean\", nombre=\"$x_nombre\", categoria_id_categoria=\"$x_categoria_id_categoria\", unidad_de_medida=\"$x_unidad_de_medida\", impuestos_id_impuestos=\"$x_impuestos_id_impuestos\", descuento_id_descuento=\"$x_descuento_id_descuento\", stock_minimo=\"$x_stock_minimo\", precio_1=\"$x_precio_1\", precio_2=\"$x_precio_2\", precio_3=\"$x_precio_3\", precio_4=\"$x_precio_4\", costo_compra=\"$x_costo_compra\", punto_venta_id_punto_venta=\"$x_punto_venta_id_punto_venta\", empleado_id_empleado=\"$id\", fecha_registro=\"$fecha_actual\" WHERE id_producto = \"$x_id_producto\"";
                }

                $con->query($sql);
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