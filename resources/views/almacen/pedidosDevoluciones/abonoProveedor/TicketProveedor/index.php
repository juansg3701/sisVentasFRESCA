<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $abonos;
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
$pdf->Cell(40,10,'Ticket de Pago/Abono - Proveedor',0,1);

while($row = $resultadoNomEmp->fetch_assoc()){
    $pdf->Cell(30,5,'Pago registrado por:',0,0);
    $pdf->Cell(30,5,$row['nombre'],0,1,'C',0);
}

while($row = $resultadoNomCli->fetch_assoc()){
    $pdf->Cell(30,5,'Proveedor:',0,0);
    $pdf->Cell(30,5,$row['nombre_proveedor'],0,1,'C',0);
    $pdf->Cell(30,5,'Documento/NIT:',0,0);
    $pdf->Cell(18,5,$row['documento'],0,0,'C',0);
    $pdf->Cell(3,5,'-',0,0);
    $pdf->Cell(2,5,$row['verificacion_nit'],0,1,'C',0);
    $pdf->Cell(30,5,'Solicitud del pedido:',0,0); 
    $pdf->Cell(30,5,$row['fecha_solicitud'],0,1,'C',0);
 
}


$pdf->Cell(15, 15, 'Detalle del pedido:', 0,1);

while($row = $resultado->fetch_assoc()){

	$pdf->Cell(30,5,'No. Remision:',0,0);
    $pdf->Cell(30,5,$row['tp_aproveedor_id_rproveedor'],0,1,'C',0);
   	$pdf->Cell(30,5,'Tipo de Pago:',0,0);
    $pdf->Cell(30,5,$row['nombre'],0,1,'C',0);
    $pdf->Cell(30,5,'Fecha de Pago:',0,0);
    $pdf->Cell(30,5,$row['fecha'],0,1,'C',0);
    $pdf->Cell(30,5,'Deuda Total:',0,0);
    $pdf->Cell(30,5,$row['total'],0,1,'C',0);
	$pdf->Cell(30,5,'Abono:',0,0);
    $pdf->Cell(30,5,$row['abono'],0,1,'C',0);
    $pdf->Cell(30,5,'Deuda Restante:',0,0);
    $pdf->Cell(30,5,$row['restante'],0,1,'C',0);
}


$pdf->Cell(35, 20, 'Lista de productos:', 0,1);
$pdf->Cell(12, 2, 'Id',0);
$pdf->Cell(12, 2, 'Producto',0,0,'R');
$pdf->Cell(12, 2, 'Cant.',0,0,'R');
$pdf->Cell(12, 2, 'Precio',0,0,'R');
$pdf->Cell(12, 2, 'Total',0,1,'R');
$pdf->Cell(1,1,'---------------------------------------------------------------',0,1);

while($row = $resultado2->fetch_assoc()){
    
    $pdf->Cell(12,7,$row['id_dpproveedor'],0,0,'L',0);
  	$pdf->Cell(12,7,$row['nombre'],0,0,'C',0);
  	$pdf->Cell(12,7,$row['cantidad'],0,0,'C',0);
    $pdf->Cell(12,7,$row['precio_venta'],0,0,'C',0);
    $pdf->Cell(12,7,$row['total'],0,1,'C',0);
   
}

$pdf->Cell(5, 10, 'Impuestos:', 0,1);
$pdf->Cell(15, 2, 'Id',0);
$pdf->Cell(15, 2, 'Nombre',0,0,'R');
$pdf->Cell(15, 2, 'Valor(%)',0,1,'R');

$pdf->Cell(1,1,'---------------------------------------------------------------',0,1);
while($row = $resImp->fetch_assoc()){
    $pdf->Cell(15,7,$row['id_dpproveedor'],0,0,'L',0);
    $pdf->Cell(15,7,$row['nombre'],0,0,'C',0);
    $pdf->Cell(15,7,$row['valor'],0,1,'C',0);
}
$pdf->Cell(5, 10, 'Descuentos:', 0,1);
$pdf->Cell(15, 2, 'Id',0);
$pdf->Cell(15, 2, 'Nombre',0,0,'R');
$pdf->Cell(15, 2, 'Valor(%)',0,1,'R');
$pdf->Cell(1,1,'---------------------------------------------------------------',0,1);
while($row = $resDes->fetch_assoc()){
    $pdf->Cell(15,7,$row['id_dpproveedor'],0,0,'L',0);
    $pdf->Cell(15,7,$row['nombre'],0,0,'C',0);
    $pdf->Cell(15,7,$row['porcentaje'],0,1,'C',0);
    
}


$pdf->Output();
?>
