<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $productos;
$prodSed = $mysqli->query($consulta);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',6);


    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'REPORTES DE BANCOS', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(8,5,'ID',1,0,"C",true);
    $pdf->Cell(15,5,'FECHA.',1,0,"C",true);
    $pdf->Cell(25,5,'BANCO',1,0,"C",true);
    $pdf->Cell(30,5,'ING. EFECTIVO',1,0,"C",true);
    $pdf->Cell(30,5,'EGR. EFECTIVO',1,0,"C",true);
    $pdf->Cell(30,5,'ING. ELECTRONICO',1,0,"C",true);
    $pdf->Cell(30,5,'EGR. ELECTRONICO',1,0,"C",true);   
    $pdf->Cell(25,5,'SEDE',1,1,"C",true);

    $pdf->SetTextColor(0,0,1);


    while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(8,5,$row['id_Dbanco'],1,0,'C',0);
        $pdf->Cell(15,5,$row['fecha'],1,0,'C',0);
        $pdf->Cell(25,5,$row['banco'],1,0,'C',0);
        $pdf->Cell(30,5,$row['ingreso_efectivo'],1,0,'C',0);
        $pdf->Cell(30,5,$row['egreso_efectivo'],1,0,'C',0);
        $pdf->Cell(30,5,$row['ingreso_electronico'],1,0,'C',0);
        $pdf->Cell(30,5,$row['egreso_electronico'],1,0,'C',0);
        $pdf->Cell(25,5,$row['sede'],1,1,'C',0);

    }


$pdf->Output('D','ReporteBAN.pdf','UTF-8');
?>
