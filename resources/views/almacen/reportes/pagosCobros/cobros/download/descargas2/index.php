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
    $pdf->Cell(15, 15, 'PAGOS-COBROS: COBROS', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(8,5,'ID',1,0,"C",true);
    $pdf->Cell(15,5,'C. TOT.',1,0,"C",true);
    $pdf->Cell(15,5,'C. RES.',1,0,"C",true);
    $pdf->Cell(35,5,'CLIENTE.',1,0,"C",true);
    $pdf->Cell(50,5,'CORREO',1,0,"C",true);
    $pdf->Cell(20,5,'TOTAL',1,0,"C",true);
    $pdf->Cell(20,5,'FECHA',1,0,"C",true);
    $pdf->Cell(20,5,'NO. FACTURA',1,0,"C",true);
    $pdf->Cell(10,5,'ESTADO',1,1,"C",true);

    $pdf->SetTextColor(0,0,1);


    while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(8,5,$row['id'],1,0,'C',0);
        $pdf->Cell(15,5,$row['cuotasTotales'],1,0,'C',0);
        $pdf->Cell(15,5,$row['cuotasRestantes'],1,0,'C',0);
        $pdf->Cell(35,5,$row['nombre'],1,0,'C',0);
        $pdf->Cell(50,5,$row['correo'],1,0,'C',0);
        $pdf->Cell(20,5,$row['valortotal'],1,0,'C',0);
        $pdf->Cell(20,5,$row['fecha'],1,0,'C',0);
        $pdf->Cell(20,5,$row['nofactura'],1,0,'C',0);
        if($row['cuotasRestantes']!="0"){
            $pdf->Cell(10,5,"Atrasado",1,1,'C',0);
        }
        else{
             $pdf->Cell(10,5,"Pago",1,1,'C',0);
        }
    }

$pdf->Output('D','ReporteIPS.pdf','UTF-8');
?>
