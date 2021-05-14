<?php
require('fpdf/fpdf.php');
require 'cn.php';

/*$consulta = $ventas;
$vendSed = $mysqli->query($consulta);*/

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);

$pdf->Image('images/logocf.png',10,3,60);
$pdf->Ln(15); 

    /*$pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(60,5,'FECHA',1,0,"C",true);
    $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
    $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);

    
    $pdf->SetTextColor(0,0,1);*/

    /*while($row = $vendSed->fetch_assoc()){
        $pdf->Cell(20,5,$row['id_factura'],1,0,'C',0);
        $pdf->Cell(50,5,$row['fecha'],1,0,'C',0);
        $pdf->Cell(40,5,$row['noproductos'],1,0,'C',0);
        $pdf->Cell(40,5,$row['pago_total'],1,0,'C',0);
        $pdf->Cell(40,5,$row['tipo_pago_id_tpago'],1,1,'C',0);
    }*/


    if ($valor==1) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(47,5,'FECHA',1,0,"C",true);
        $pdf->Cell(47,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(47,5,'PAGO TOTAL',1,0,"C",true);
        $pdf->Cell(47,5,'METODO DE PAGO',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(47,5,$ven->fecha,1,0,'C',0);
            $pdf->Cell(47,5,$ven->noproductos,1,0,'C',0);
            $pdf->Cell(47,5,$ven->pago_total,1,0,'C',0);
            $pdf->Cell(47,5,$ven->tipo_pago_id_tpago,1,1,'C',0);
        } 
    }

    if ($valor==2) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'FECHA',1,0,"C",true);
        $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,'Semana No: '.$ven->fecha.' - '.$ven->year,1,0,'C',0);
            $pdf->Cell(60,5,$ven->noproductos,1,0,'C',0);
            $pdf->Cell(60,5,$ven->pago_total,1,1,'C',0);
        }
        
    }

    if ($valor==3) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'FECHA',1,0,"C",true);
        $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,$ven->fecha.'-'.$ven->fecha_year,1,0,'C',0);
            $pdf->Cell(60,5,$ven->noproductos,1,0,'C',0);
            $pdf->Cell(60,5,$ven->pago_total,1,1,'C',0);
        }
        
    }

    if ($valor=='m') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(60,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(60,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,$ven->producto,1,0,'C',0);
            $pdf->Cell(60,5,$ven->cantidad,1,0,'C',0);
            $pdf->Cell(60,5,$ven->total,1,1,'C',0);
        }
        
    }

     if ($valor=='s') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(60,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(60,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,$ven->producto,1,0,'C',0);
            $pdf->Cell(60,5,$ven->cantidad,1,0,'C',0);
            $pdf->Cell(60,5,$ven->total,1,1,'C',0);
        }
        
    }


     if ($valor=='d') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE VENTAS : '.$tipo, 0,1);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(60,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(60,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($ventas as $ven) {
            //$pdf->Cell(20,5,$ven->id_factura,1,0,'C',0);
            $pdf->Cell(60,5,$ven->producto,1,0,'C',0);
            $pdf->Cell(60,5,$ven->cantidad,1,0,'C',0);
            $pdf->Cell(60,5,$ven->total,1,1,'C',0);
        }
        
    }


    $pdf->Output('D','RP_VENTAS_'.$tipo.'.pdf','UTF-8');

?>
