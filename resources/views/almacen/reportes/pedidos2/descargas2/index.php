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
    $pdf->Cell(15, 15, 'PEDIDOS: PEDIDO-PROVEEDOR', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(15,5,'Remision',1,0,"C",true);
    $pdf->Cell(22,5,'No. Productos',1,0,"C",true);
    $pdf->Cell(30,5,'Fecha de Solicitud',1,0,"C",true);
    $pdf->Cell(30,5,'Fecha de entrega',1,0,"C",true);
    $pdf->Cell(22,5,'Proveedor',1,0,"C",true);
    $pdf->Cell(22,5,'Empleado',1,0,"C",true);
    $pdf->Cell(22,5,'Metodo de Pago',1,0,"C",true);
    $pdf->Cell(22,5,'Total',1,1,"C",true);
    
    $pdf->SetTextColor(0,0,1);

    while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(15,5,$row['id_rproveedor'],1,0,'C',0);
        $pdf->Cell(22,5,$row['noproductos'],1,0,'C',0);
        $pdf->Cell(30,5,$row['fecha_solicitud'],1,0,'C',0);
        $pdf->Cell(30,5,$row['fecha_entrega'],1,0,'C',0);
        $pdf->Cell(22,5,$row['proveedor'],1,0,'C',0);
        $pdf->Cell(22,5,$row['empleado'],1,0,'C',0);
        $pdf->Cell(22,5,$row['tipo_pago'],1,0,'C',0);
        $pdf->Cell(22,5,$row['pago_total'],1,1,'C',0);
    }

$pdf->Output('D','ReportePPP.pdf','UTF-8');
?>
