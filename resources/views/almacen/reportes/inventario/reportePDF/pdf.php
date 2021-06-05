<?php
require('fpdf/fpdf.php');
require 'cn.php';
require 'cn2.php';


$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);

$pdf->Image('images/logocf.png',10,3,60);
$pdf->Ln(15); 




    if ($valor==3) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(20, 5, 'Inicio: ', 0,0);
        $pdf->Cell(20, 5, $fecha_letra_inicial, 0,1);
        $pdf->Cell(20, 5, 'Fin: ', 0,0);
        $pdf->Cell(20, 5, $fecha_letra_final, 0,1);
        $pdf->Cell(20, 5, 'Total compras: ', 0,0);
        $pdf->Cell(20, 5, $total_stock_mensuales, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'FECHA',1,0,"C",true);
        $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($stock as $st) {
            $pdf->Cell(60,5,$st->fecha_registro.'-'.$st->fecha_year,1,0,'C',0);
            $pdf->Cell(60,5,$st->cantidad_rep,1,0,'C',0);
            $pdf->Cell(60,5,$st->total,1,1,'C',0);
        }
    }



    if ($valor==2) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(20, 5, 'Inicio: ', 0,0);
        $pdf->Cell(20, 5, $desde, 0,1);
        $pdf->Cell(20, 5, 'Fin: ', 0,0);
        $pdf->Cell(20, 5, $hasta, 0,1);
        $pdf->Cell(20, 5, 'Total compras: ', 0,0);
        $pdf->Cell(20, 5, $total_stock_semanales, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'FECHA',1,0,"C",true);
        $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($stock as $st) {
            $pdf->Cell(60,5,'Semana del: '.$st->fecha_registro.'-'.$st->year,1,0,'C',0);
            $pdf->Cell(60,5,$st->cantidad_rep,1,0,'C',0);
            $pdf->Cell(60,5,$st->total,1,1,'C',0);
        }
        
    }



    if ($valor==1) {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(20, 5, 'Fecha: ', 0,0);
        $pdf->Cell(20, 5, $fecha_d, 0,1);
        $pdf->Cell(20, 5, 'Total ventas: ', 0,0);
        $pdf->Cell(20, 5, $total_stock, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(60,5,'FECHA',1,0,"C",true);
        $pdf->Cell(60,5,'NO. PRODUCTOS',1,0,"C",true);
        $pdf->Cell(60,5,'PAGO TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);


        foreach ($stock as $st) {
            $pdf->Cell(60,5,$st->fecha_registro,1,0,'C',0);
            $pdf->Cell(60,5,$st->cantidad_rep,1,0,'C',0);
            $pdf->Cell(60,5,$st->total,1,1,'C',0);
        }
    }





    if ($valor=='m') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(25, 5, 'Mes: ', 0,0);
        $pdf->Cell(20, 5, $año, 0,1);
        $pdf->Cell(25, 5, 'Total comprado: ', 0,0);
        $pdf->Cell(20, 5, $total_ventas, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(100,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(40,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(40,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($stock as $st) {
            $pdf->Cell(100,5,$st->producto,1,0,'C',0);
            $pdf->Cell(40,5,$st->cantidad,1,0,'C',0);
            $pdf->Cell(40,5,$st->total,1,1,'C',0);
        }
        
    }


    if ($valor=='s') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(25, 5, 'Semana No.: ', 0,0);
        $pdf->Cell(20, 5, $desde, 0,1);
        $pdf->Cell(25, 5, 'Total comprado: ', 0,0);
        $pdf->Cell(20, 5, $total_inventario_diario, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(100,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(40,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(40,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($stock as $st) {
            $pdf->Cell(100,5,$st->producto,1,0,'C',0);
            $pdf->Cell(40,5,$st->cantidad,1,0,'C',0);
            $pdf->Cell(40,5,$st->total,1,1,'C',0);
        }
        
    }


    if ($valor=='d') {

        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE INVENTARIO : '.$tipo, 0,1);

        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
        $pdf->Cell(25, 5, 'Fecha: ', 0,0);
        $pdf->Cell(20, 5, $desde, 0,1);
        $pdf->Cell(25, 5, 'Total comprado: ', 0,0);
        $pdf->Cell(20, 5, $total_inventario_diario, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(100,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(40,5,'CANTIDAD',1,0,"C",true);
        $pdf->Cell(40,5,'TOTAL',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($stock as $st) {
            $pdf->Cell(100,5,$st->producto,1,0,'C',0);
            $pdf->Cell(40,5,$st->cantidad,1,0,'C',0);
            $pdf->Cell(40,5,$st->total,1,1,'C',0);
        }
        
    }


    $pdf->Output('D','RP_INVENTARIO_'.$tipo.'.pdf','UTF-8');

    //$pdf->Output('D','RP_Inventario.pdf','UTF-8');

?>
