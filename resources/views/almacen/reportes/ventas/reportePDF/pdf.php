<?php
require('fpdf/fpdf.php');
require 'cn.php';

/*$consulta = $productos;
$prodSed = $mysqli->query($consulta);*/

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);

    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'REPORTE DE VENTAS', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(60,5,'FECHA',1,0,"C",true);
    $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
    $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);

    
    $pdf->SetTextColor(0,0,1);

    /*while($row = $prodSed->fetch_assoc()){
        $pdf->Cell(20,5,$row['id_factura'],1,0,'C',0);
        $pdf->Cell(50,5,$row['fecha'],1,0,'C',0);
        $pdf->Cell(40,5,$row['noproductos'],1,0,'C',0);
        $pdf->Cell(40,5,$row['pago_total'],1,0,'C',0);
        $pdf->Cell(40,5,$row['tipo_pago_id_tpago'],1,1,'C',0);
    }*/

    if ($valor==2) {

        foreach ($productos as $pro) {
            //$pdf->Cell(20,5,$pro->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,'Semana No: '.$pro->fecha,1,0,'C',0);
            $pdf->Cell(60,5,$pro->noproductos,1,0,'C',0);
            $pdf->Cell(60,5,$pro->pago_total,1,1,'C',0);
        }
        
    }

    if ($valor==3) {

        foreach ($productos as $pro) {
            //$pdf->Cell(20,5,$pro->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,$pro->fecha.'-'.$pro->fecha_year,1,0,'C',0);
            $pdf->Cell(60,5,$pro->noproductos,1,0,'C',0);
            $pdf->Cell(60,5,$pro->pago_total,1,1,'C',0);
        }
        
    }


    $pdf->Output('D','RP_Ventas.pdf','UTF-8');

?>
