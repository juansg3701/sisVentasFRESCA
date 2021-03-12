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

    $sql = "SELECT * FROM producto";
  


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
                
                $excedente= ($x_costo_compra*0.10)+$x_costo_compra;

                $query="SELECT * FROM producto WHERE id_producto = \"$x_id_producto\"";
                $result=mysqli_query($link, $query);
                
                $count=0; 
                while($rows=mysqli_fetch_assoc($result)){
                    $count++;
                } 

                $empleado = "SELECT * FROM empleado WHERE user_id_user=\"$empleado\"";
                $result2=mysqli_query($link2, $empleado);

                
                if($result2){
                    while($rows=mysqli_fetch_assoc($result2)){
                         $id=$rows['id_empleado'];
                    }
                }

                $consulta_imp = "SELECT id_impuestos FROM impuestos WHERE valor_impuesto=\"$x_impuestos_id_impuestos\"";
                $consulta_cat = "SELECT id_categoria FROM categoria_productos WHERE nombre=\"$x_categoria_id_categoria\"";
                $consulta_des = "SELECT id_descuento FROM descuento WHERE valor_descuento=\"$x_descuento_id_descuento\"";

                $consulta_ean = "SELECT * FROM producto WHERE ean = \"$x_ean\"";
                $result_ean=mysqli_query($link, $consulta_ean);
                $count_ean=0; 
                while($rows=mysqli_fetch_assoc($result_ean)){
                    $count_ean++;
                    $ean=$rows['ean'];
                }

                $consulta_plu = "SELECT * FROM producto WHERE plu = \"$x_plu\"";
                $result_plu=mysqli_query($link, $consulta_plu);
                $count_plu=0; 
                while($rows=mysqli_fetch_assoc($result_plu)){
                    $count_plu++;
                    $plu=$rows['ean'];
                }


                $result_imp=mysqli_query($link, $consulta_imp);
                $result_cat=mysqli_query($link, $consulta_cat);
                $result_des=mysqli_query($link, $consulta_des);

                $count_imp=0; 
                while($rows=mysqli_fetch_assoc($result_imp)){
                    $count_imp++;  
                    $impuesto_i=$rows['id_impuestos'];
                } 

                $count_cat=0; 
                while($rows=mysqli_fetch_assoc($result_cat)){
                    $count_cat++;  
                    $categoria_i=$rows['id_categoria'];
                }

                $count_des=0; 
                while($rows=mysqli_fetch_assoc($result_des)){
                    $count_des++;  
                    $descuento_i=$rows['id_descuento'];
                }


                if(($x_id_producto!="" || $x_plu!="" || $x_ean!="" || $x_nombre!="" || $x_categoria_id_categoria!="" || $x_unidad_de_medida!="" && $x_impuestos_id_impuestos!="" || $x_descuento_id_descuento!="" || $x_stock_minimo!="" || $x_precio_1!="" || $x_precio_2!="" || $x_precio_3!="" || $x_precio_4!="" || $x_costo_compra!="" || $x_punto_venta_id_punto_venta!="") && ($x_id_producto==0 || $x_plu==0 || $x_ean==0 || $x_nombre==0 || $x_categoria_id_categoria==0 || $x_unidad_de_medida==0 || $x_impuestos_id_impuestos==0 || $x_descuento_id_descuento==0 || $x_stock_minimo==0 || $x_precio_1==0 || $x_precio_2==0 || $x_precio_3==0 || $x_precio_4==0 || $x_costo_compra==0 || $x_punto_venta_id_punto_venta==0)){

                    if(($excedente<=$x_precio_1 || $x_precio_1==0) && ($excedente<=$x_precio_2 || $x_precio_2==0) && ($excedente<=$x_precio_3 || $x_precio_3==0) && ($excedente<=$x_precio_4 || $x_precio_4==0)){
       
                        if ($count==0){

                            if($count_imp!=0 && $count_cat!=0 && $count_des!=0){

                                if ($count_ean==0 && $count_plu==0){
                                    $sql = "insert into producto (id_producto, plu, ean, nombre, categoria_id_categoria, unidad_de_medida, impuestos_id_impuestos, descuento_id_descuento, stock_minimo, imagen, precio_1, precio_2, precio_3, precio_4, costo_compra, punto_venta_id_punto_venta, empleado_id_empleado, fecha_registro) value";

                                    $sql .= " (\"$x_id_producto\",\"$x_plu\",\"$x_ean\",\"$x_nombre\",\"$categoria_i\",\"$x_unidad_de_medida\",\"$impuesto_i\",\"$descuento_i\",\"$x_stock_minimo\",\"$x_imagen\",\"$x_precio_1\",\"$x_precio_2\",\"$x_precio_3\",\"$x_precio_4\",\"$x_costo_compra\",\"$x_punto_venta_id_punto_venta\",\"$id\",\"$fecha_actual\")";
                                    
                                }else{
                                    echo '<script language="javascript">alert("EAN y PLU deben ser valores únicos, no se guardará el registro con el id: '.$x_id_producto.'");</script>';
                                }

                            }else{
                                echo '<script language="javascript">alert("Los datos ingresados en categoría, impuesto o descuento son incorrectos.  Error en el registro con el id: '.$x_id_producto.'");</script>';
                            }  

                        }else{

                            if($count_imp!=0 && $count_cat!=0 && $count_des!=0){

                                if ($count_ean!=0  && $count_plu!=0 ) {
                                    $sql = "UPDATE producto SET nombre=\"$x_nombre\", categoria_id_categoria=\"$categoria_i\", unidad_de_medida=\"$x_unidad_de_medida\", impuestos_id_impuestos=\"$impuesto_i\", descuento_id_descuento=\"$descuento_i\", stock_minimo=\"$x_stock_minimo\", precio_1=\"$x_precio_1\", precio_2=\"$x_precio_2\", precio_3=\"$x_precio_3\", precio_4=\"$x_precio_4\", costo_compra=\"$x_costo_compra\", punto_venta_id_punto_venta=\"$x_punto_venta_id_punto_venta\", empleado_id_empleado=\"$id\", fecha_registro=\"$fecha_actual\" WHERE id_producto = \"$x_id_producto\"";
                                }else{
                                    echo '<script language="javascript">alert("Hay registros con el ID repetido, no se guardarán cambios en el registro con el id: '.$x_id_producto.' y nombre: '.$x_nombre.'");</script>';
                                }

                            }else{
                                echo '<script language="javascript">alert("Los datos ingresados en categoría, impuesto o descuento son incorrectos.  Error en el registro con el id: '.$x_id_producto.'");</script>';
                            }   
                        }

                        $con->query($sql);

                    }else{
                        echo '<script language="javascript">alert("Por favor valide correctamente los valores especificados en los campos de  precio. Existen errores en los registros, por lo tanto no se insertarán/actualizarán. Error en el registro con el id: '.$x_id_producto.'");</script>';
                    }
                
                }else{}

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