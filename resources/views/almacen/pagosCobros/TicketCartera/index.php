<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $datos;
$consulta2 = $productos;
$consultaNomEmp = $nomEmpleado;
$consultaNomCli = $nomCliente;
$conImp=$impuestos;
$conDes=$descuentos;

$resultado = $mysqli->query($consulta);
$resultado2 = $mysqli->query($consulta2);
$resultadoNomEmp = $mysqli->query($consultaNomEmp);
$resultadoNomCli = $mysqli->query($consultaNomCli);
$resImp = $mysqli->query($conImp);
$resDes = $mysqli->query($conDes);



$pdf = new FPDF($orientation='P',$unit='mm', array(80,350));
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);
$pdf->Cell(40,10,'Ticket de abono',0,1);

while($row = $resultadoNomEmp->fetch_assoc()){
    $pdf->Cell(30,5,'Pago registrado por:',0,0);
    $pdf->Cell(30,5,$row['nombre'],0,1,'C',0);
}
while($row = $resultadoNomCli->fetch_assoc()){
    $pdf->Cell(30,5,'Cliente:',0,0);
    $pdf->Cell(30,5,$row['nombre'],0,1,'C',0);
     $pdf->Cell(30,5,'Fecha inicial:',0,0); 
    $pdf->Cell(30,5,$row['fecha'],0,1,'C',0);
}



$pdf->Cell(15, 15, 'Detalle del ticket:', 0,1);

while($row = $resultado->fetch_assoc()){

	$pdf->Cell(30,5,'No. cartera:',0,0);
    $pdf->Cell(30,5,$row['id_cartera'],0,1,'C',0);
   	$pdf->Cell(30,5,'Cuotas restantes:',0,0);
    $pdf->Cell(30,5,$row['cuotas_restantes'],0,1,'C',0);
    $pdf->Cell(30,5,'Tipo de pago:',0,0);
    $pdf->Cell(30,5,$row['nombre'],0,1,'C',0);
    $pdf->Cell(30,5,'Total de cuotas:',0,0);
    $pdf->Cell(30,5,$row['cuotas_totales'],0,1,'C',0);
   
}


$pdf->Cell(35, 20, 'Detalle de abono:', 0,1);
$pdf->Cell(20, 2, 'Fecha',0);
$pdf->Cell(14, 2, 'Total',0);
$pdf->Cell(12, 2, 'Saldo',0,0,'R');
$pdf->Cell(15, 2, 'Abono',0,1,'R');
$pdf->Cell(1,1,'---------------------------------------------------------------',0,1);

while($row = $resultado2->fetch_assoc()){
    
  	$pdf->Cell(15,7,$row['fecha'],0,0,'L',0);
    $pdf->Cell(18,7,$row['valor_total'],0,0,'C',0);
    $pdf->Cell(15,7,$row['valor_restante'],0,0,'C',0);
    $pdf->Cell(15,7,$row['valor_abono'],0,1,'C',0);
   
}


$pdf->Output();
?>
