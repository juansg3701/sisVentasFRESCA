<?php
require('fpdf/fpdf.php');
require 'cn.php';
require 'cn2.php';


$consulta = $productos;
$prodSed = $mysqli->query($consulta);

$consulta2 = $productos2;
$prodSed2 = $mysqli2->query($consulta2);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);


    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'INVENTARIO: PRODUCTOS SEDE', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(8,5,'ID',1,0,"C",true);
    $pdf->Cell(25,5,'FECHA',1,0,"C",true);
    $pdf->Cell(20,5,'NO.FACTURA',1,0,"C",true);
    $pdf->Cell(20,5,'PRODUCTO',1,0,"C",true);
    $pdf->Cell(20,5,'CANTIDAD',1,0,"C",true);
    $pdf->Cell(20,5,'PAGO TOTAL',1,1,"C",true);

    $pdf->SetTextColor(0,0,1);

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
                $pdf->Cell(8,5,$row['id_stock'],1,0,'C',0);
                $pdf->Cell(25,5,$row['fecha_registro'],1,0,'C',0);
                $pdf->Cell(20,5,$row['noFactura'],1,0,'C',0);
                $pdf->Cell(20,5,$vector_nombre[$i],1,0,'C',0);
                $pdf->Cell(20,5,$row['cantidad'],1,0,'C',0);
                $pdf->Cell(20,5,$row['total'],1,1,'C',0);
               
            } 
        }
    }

    $pdf->Output('D','RP_Inventario.pdf','UTF-8');

?>
