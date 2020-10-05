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