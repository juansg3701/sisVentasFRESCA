<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $productos;
$prodSed = $mysqli->query($consulta);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',5);

    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'PAGOS-COBROS: FACTURAS POR PAGAR', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(10,5,'ID',1,0,"C",true);
    $pdf->Cell(15,5,'CUOTAS TOT.',1,0,"C",true);
    $pdf->Cell(15,5,'CUOTAS RES.',1,0,"C",true);
    $pdf->Cell(25,5,'NOMBRE FACT.',1,0,"C",true);
    $pdf->Cell(20,5,'DESCRIP.',1,0,"C",true);
    $pdf->Cell(20,5,'BANCO',1,0,"C",true);
    $pdf->Cell(20,5,'NO. CUENTA',1,0,"C",true);
    $pdf->Cell(10,5,'INTERESES',1,0,"C",true);
    $pdf->Cell(20,5,'EMPLEADO',1,0,"C",true);
    $pdf->Cell(20,5,'SALDO FINAL',1,0,"C",true);
    $pdf->Cell(10,5,'ESTADO',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);

    while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(10,5,$row['id_ctaspagar'],1,0,'C',0);
        $pdf->Cell(15,5,$row['cuotas_totales'],1,0,'C',0);
        $pdf->Cell(15,5,$row['cuotas_restantes'],1,0,'C',0);
        $pdf->Cell(25,5,$row['nombrepago'],1,0,'C',0);
        $pdf->Cell(20,5,$row['descripcion'],1,0,'C',0);
        $pdf->Cell(20,5,$row['bancos'],1,0,'C',0);
        $pdf->Cell(20,5,$row['nocuenta'],1,0,'C',0);
        $pdf->Cell(10,5,$row['intereses'],1,0,'C',0);
        $pdf->Cell(20,5,$row['nombreE'],1,0,'C',0);
        $pdf->Cell(20,5,$row['total'],1,0,'C',0);
        if($row['cuotas_restantes']!="0"){
            $pdf->Cell(10,5,"Atrasado",1,1,'C',0);
        }
        else{
             $pdf->Cell(10,5,"Pago",1,1,'C',0);
        }

    }

$pdf->Output('D','ReportePCFP.pdf','UTF-8');

?>
