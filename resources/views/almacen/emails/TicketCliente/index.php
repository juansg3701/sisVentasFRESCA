<?php
require('fpdf/fpdf.php');
require 'cn.php';



$pdf = new FPDF($orientation='P',$unit='mm', array(80,350));
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);
$pdf->Cell(40,10,'Ticket de Pago/Abono - Cliente',0,1);



$pdf->Output('D','archivo.pdf','UTF-8');
?>