<?php
include "database2.php";
include "class.upload.php";


    require('conexion2.php');
    $conn2=new Conexion2();
    $link2 = $conn2->conectarse();

    $empleado= $_POST['empleado'];
    $fecha_actual= $_POST['fecha_actual'];

    $sql = "SELECT * FROM stock";

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
                $x_id_stock = $sheet->getCell("A".$row)->getValue();
                $x_ean = $sheet->getCell("B".$row)->getValue();
                $x_cantidad = $sheet->getCell("C".$row)->getValue();
                $x_sede_id_sede = $sheet->getCell("D".$row)->getValue();
                $x_proveedor_id_proveedor = $sheet->getCell("E".$row)->getValue();

                $x_disponibilidad='1';               
                $x_producto_id_producto=1;
                $x_transformacion_stock_id=6;
                $x_noFactura='0';
                $x_total=0;


                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result2=mysqli_query($link2, $empleado);

                
                if($result2){
                    while($rows=mysqli_fetch_assoc($result2)){
                         $id=$rows['id_empleado'];
                    }
                }


                $consulta_prov = "SELECT id_proveedor FROM proveedor WHERE nombre_proveedor=\"$x_proveedor_id_proveedor\"";
                $consulta_sed = "SELECT id_sede FROM sede WHERE nombre_sede=\"$x_sede_id_sede\"";


                $result_prov=mysqli_query($link2, $consulta_prov);
                $result_sed=mysqli_query($link2, $consulta_sed);

                $count_prov=0; 
                while($rows=mysqli_fetch_assoc($result_prov)){
                    $count_prov++;  
                    $proveedor_i=$rows['id_proveedor'];
                } 

                $count_sed=0; 
                while($rows=mysqli_fetch_assoc($result_sed)){
                    $count_sed++;  
                    $sede_i=$rows['id_sede'];
                }



                if($count_prov!=0 && $count_sed!=0){

                	/*$sql = "insert into stock (id_stock, disponibilidad, cantidad, fecha_registro, producto_id_producto, sede_id_sede, proveedor_id_proveedor, empleado_id_empleado, transformacion_stock_id, noFactura, total) value ";

                	$sql .= " (\"$x_id_stock\",\"$x_disponibilidad\",\"$x_cantidad\",\"$fecha_actual\",\"$x_producto_id_producto\",\"$x_sede_id_sede\",\"$x_proveedor_id_proveedor\",\"$id\",\"$x_transformacion_stock_id\",\"$x_noFactura\",\"$x_total\")";*/

                	$sql = "insert into stock (id_stock, disponibilidad, cantidad, fecha_registro, producto_id_producto, sede_id_sede, proveedor_id_proveedor, empleado_id_empleado, transformacion_stock_id, noFactura, total) value ";

                	$sql .= " (\"$x_id_stock\",\"$x_disponibilidad\",\"$x_cantidad\",\"$fecha_actual\",\"$x_producto_id_producto\",\"$sede_i\",\"$proveedor_i\",\"$id\",\"$x_transformacion_stock_id\",\"$x_noFactura\",\"$x_total\")";

                }else{
                	echo '<script language="javascript">alert("Los datos ingresados en proveedor o sede son incorrectos.  Error en el registro con el id: '.$x_id_stock.'");</script>';
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