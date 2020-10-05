<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $productos;
$prodSed = $mysqli->query($consulta);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);


    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'INVENTARIO: PRODUCTOS PROVEEDOR', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(8,5,'ID',1,0,"C",true);
    $pdf->Cell(25,5,'NOMBRE',1,0,"C",true);
    $pdf->Cell(20,5,'PLU',1,0,"C",true);
    $pdf->Cell(20,5,'EAN',1,0,"C",true);
    $pdf->Cell(20,5,'SEDE',1,0,"C",true);
    $pdf->Cell(20,5,'PROVEEDOR',1,0,"C",true);
    $pdf->Cell(20,5,'CANTIDAD',1,0,"C",true);
    $pdf->Cell(20,5,'DISPONIB.',1,0,"C",true);
    $pdf->Cell(20,5,'FECHA REG.',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);


    while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(8,5,$row['id_stock'],1,0,'C',0);
        $pdf->Cell(25,5,$row['nombre'],1,0,'C',0);
        $pdf->Cell(20,5,$row['plu'],1,0,'C',0);
        $pdf->Cell(20,5,$row['ean'],1,0,'C',0);
        $pdf->Cell(20,5,$row['nombre_sede'],1,0,'C',0);
        $pdf->Cell(20,5,$row['nombre_proveedor'],1,0,'C',0);
        $pdf->Cell(20,5,$row['cantidad'],1,0,'C',0);
        $pdf->Cell(20,5,$row['disponibilidad'],1,0,'C',0);
        $pdf->Cell(20,5,$row['fecha_registro'],1,1,'C',0);
       
    }



$pdf->Output('D','ReporteIPP.pdf','UTF-8');
?>
