<?php
include "database2.php";
include "class.upload.php";

	


    require_once('conexion.php');
    $conn=new Conexion();
    $link = $conn->conectarse();

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


 
            $ultimo="SELECT MAX(id_stock) AS id_max FROM stock";
            $rs = mysqli_query($link2, $ultimo);

            while($rows=mysqli_fetch_assoc($rs)){
               $id_max=$rows['id_max'];          
            } 

            for ($row = 2; $row <= $highestRow; $row++){

                $id_max++;
                $x_id_stock = $id_max;

                //echo $x_id_stock;
                //$x_id_stock = $sheet->getCell("A".$row)->getValue();
                $x_nombre = $sheet->getCell("A".$row)->getValue();
                $x_ean = $sheet->getCell("B".$row)->getValue();
                $x_cantidad = $sheet->getCell("C".$row)->getValue();
                $x_sede_id_sede = $sheet->getCell("D".$row)->getValue();
                $x_proveedor_id_proveedor = $sheet->getCell("E".$row)->getValue();

                //$x_costo_compra = 1000;
                $x_cantidad_rep=$sheet->getCell("C".$row)->getValue();
                $x_disponibilidad='1';               
                //$x_producto_id_producto=1;
                $x_transformacion_stock_id=6;
                $x_noFactura='0';


                $x_pago_pendiente=$sheet->getCell("F".$row)->getValue();
               



                //$x_id_stock=$id_max + 1;

                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result2=mysqli_query($link2, $empleado);


                $stock="SELECT * FROM stock WHERE id_stock = \"$x_id_stock\"";
                $result_stock=mysqli_query($link2, $stock);
                
                $count_stock=0; 
                while($rows=mysqli_fetch_assoc($result_stock)){
                    $count_stock++;
                    $id_stock=$rows['id_stock'];
                         
                } 

                
                $producto="SELECT * FROM producto WHERE ean = \"$x_ean\"";
                $result_producto=mysqli_query($link, $producto);
                
                $count_producto=0; 
                while($rows=mysqli_fetch_assoc($result_producto)){
                    $count_producto++;
                    $id_producto=$rows['id_producto'];
                    $costo_compra=$rows['costo_compra'];
                } 

                $x_producto_id_producto=$id_producto;
                $x_costo_compra = $costo_compra;

                $x_total=$x_cantidad*$costo_compra;


                if($result2){
                    while($rows=mysqli_fetch_assoc($result2)){
                         $id=$rows['id_empleado'];
                    }
                }


                $consulta_prov = "SELECT id_proveedor FROM proveedor WHERE nombre_empresa=\"$x_proveedor_id_proveedor\"";
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

               

                if (($x_ean!="" && $x_cantidad!="" && $x_sede_id_sede!="" && $x_proveedor_id_proveedor!="" && $x_pago_pendiente!="")){

                    if($count_prov!=0 && $count_sed!=0){

                        if ($x_pago_pendiente=="s") {
                            //$x_pago_pendiente=0;
                            $sql = "insert into stock (id_stock, disponibilidad, cantidad, fecha_registro, producto_id_producto, sede_id_sede, proveedor_id_proveedor, empleado_id_empleado, transformacion_stock_id, noFactura, total, costo_compra, cantidad_rep, pago_pendiente) value ";

                            $sql .= " (\"$x_id_stock\",\"$x_disponibilidad\",\"$x_cantidad\",\"$fecha_actual\",\"$x_producto_id_producto\",\"$sede_i\",\"$proveedor_i\",\"$id\",\"$x_transformacion_stock_id\",\"$x_noFactura\",\"$x_total\",\"$x_costo_compra\",\"$x_cantidad_rep\",0 )";


                        }
                        if ($x_pago_pendiente=="n") {
                            //$x_pago_pendiente=1;

                            $sql = "insert into stock (id_stock, disponibilidad, cantidad, fecha_registro, producto_id_producto, sede_id_sede, proveedor_id_proveedor, empleado_id_empleado, transformacion_stock_id, noFactura, total, costo_compra, cantidad_rep, pago_pendiente) value ";

                            $sql .= " (\"$x_id_stock\",\"$x_disponibilidad\",\"$x_cantidad\",\"$fecha_actual\",\"$x_producto_id_producto\",\"$sede_i\",\"$proveedor_i\",\"$id\",\"$x_transformacion_stock_id\",\"$x_noFactura\",\"$x_total\",\"$x_costo_compra\",\"$x_cantidad_rep\",1 )";
                        }


                        
                        /*$sql = "insert into stock (id_stock, disponibilidad, cantidad, fecha_registro, producto_id_producto, sede_id_sede, proveedor_id_proveedor, empleado_id_empleado, transformacion_stock_id, noFactura, total, costo_compra, cantidad_rep, pago_pendiente) value ";

                        $sql .= " (\"$x_id_stock\",\"$x_disponibilidad\",\"$x_cantidad\",\"$fecha_actual\",\"$x_producto_id_producto\",\"$sede_i\",\"$proveedor_i\",\"$id\",\"$x_transformacion_stock_id\",\"$x_noFactura\",\"$x_total\",\"$x_costo_compra\",\"$x_cantidad_rep\",\"$x_pago_pendiente\" )";*/

                    }else{
                        echo '<script language="javascript">alert("Los datos ingresados en proveedor o sede son incorrectos.  Error en el registro con nombre: '.$x_nombre.'");</script>';
                    }
                   
                }else{}



                


             



                

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