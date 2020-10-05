<?php
require('fpdf/fpdf.php');
require 'cn.php';

$consulta = $facturaInfo;
$consulta3 = $productos;
$consulta2 = $agregados;
$consulta4 = $fecha;

$conPrueba = $facturaInfos;
$prueba = $mysqli->query($conPrueba);

$facturas = $mysqli->query($consulta);
$facturas2 = $mysqli->query($consulta);
$listaProductos = $mysqli->query($consulta3);
$listaAgregados = $mysqli->query($consulta2);

$fechaActual = $mysqli->query($consulta4);


//fecha para qr
$fechaQR= $fecha;
$qrFecha = $mysqli->query($fechaQR);

//total para qr
$totalQR= $facturaInfo;
$qrTotal = $mysqli->query($totalQR);

//totales impuestos y descuentos para qr
$agregadosQR= $consulta2;
$qrAgregados = $mysqli->query($agregadosQR);


$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);
$hola='hola';



$charfec='Fecha:';
while($row = $qrFecha->fetch_assoc()){
    $fec=$row['fechas'];
}

$chardoc='documento_cliente:';
$charpag='Total:';
$charno='No_Prod:';
while($row = $qrTotal->fetch_assoc()){
    
    $docCli1=$row['docCliente'];
    $docCli2=$row['digCliente'];
    $pagTot=$row['pago_total'];
    $noPro=$row['noproductos'];
}

$charimp='Total_Imp:';
$chardes='Total_Desc:';
while($row = $qrAgregados->fetch_assoc()){
    $pagImp=$row['totImpuesto'];
    $pagDes=$row['totDescuento'];
}






$pdf->Image('http://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$charfec.$fec.'/'.$chardoc.$docCli1.'-'.$docCli2.'/'.$charno.$noPro.'/'.$charimp.$pagImp.'/'.$chardes.$pagDes.'/'.$charpag.$pagTot.'\n'.'&.png',150,10,50,50);
$pdf->Cell(40,10,'FACTURA DE VENTA',0,1);
$pdf->Cell(25,5,'Fecha de emision: ',0,0);
while($row = $fechaActual->fetch_assoc()){    
    $pdf->Cell(30,5,$row['fechas'],0,1,'C',0);
}
$pdf->Cell(25,5,'Prefijo: ',0,1);
$pdf->Cell(25,5,'No. Resolucion: ',0,1);
$pdf->Cell(25,5,'Desde: ',0,1);
$pdf->Cell(25,5,'Hasta: ',0,1);

$pdf->Cell(40,10,'',0,1);


$pdf->Cell(40,5,'Datos de Emisor y Adquiriente:',0,1);
$pdf->Cell(40,10,'',0,1);



$pdf->SetFillColor(13,16,64);


while($row = $facturas2->fetch_assoc()){
    
    
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(80,5,'DATOS DEL EMISOR',1,0,"C",true);
    $pdf->Cell(30,5,'',0,0);      
    $pdf->Cell(80,5,'DATOS DEL ADQUIRIENTE',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);
    $pdf->Cell(40,5,'Razon Social/Nombre:',1,0);
    $pdf->Cell(40,5,$row['nomSede'],1,0,'C',0);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(40,5,'Razon Social/Nombre:',1,0);
    $pdf->Cell(40,5,$row['nomCliente'],1,1,'C',0);
    $pdf->Cell(40,5,'Ciudad:',1,0);
    $pdf->Cell(40,5,$row['sedeCiudad'],1,0,'C',0);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(40,5,'Documento/NIT:',1,0);
    $pdf->Cell(35,5,$row['docCliente'],1,0,'C',0);
    $pdf->Cell(5,5,$row['digCliente'],1,1,'C',0);
    $pdf->Cell(40,5,'Direccion:',1,0);
    $pdf->Cell(40,5,$row['dirSede'],1,0,'C',0);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(40,5,'Direccion:',1,0);
    $pdf->Cell(40,5,$row['dirCliente'],1,1,'C',0);
    $pdf->Cell(40,5,'Telefono:',1,0);
    $pdf->Cell(40,5,$row['telSede'],1,0,'C',0);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(40,5,'Telefono:',1,0);
    $pdf->Cell(40,5,$row['telCliente'],1,1,'C',0);
    $pdf->Cell(40,5,'Pago registrado por:',1,0);
    $pdf->Cell(40,5,$row['nomEmpleado'],1,0,'C',0);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(40,5,'Tipo de Pago:',1,0);
    $pdf->Cell(40,5,$row['nomTP'],1,1,'C',0);

}







$pdf->Cell(15, 15, 'Productos:', 0,1);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(25,5,'Nombre',1,0,"C",true);
    $pdf->Cell(25,5,'Cantidad',1,0,"C",true);
    $pdf->Cell(25,5,'Precio Unitario',1,0,"C",true);
    $pdf->Cell(25,5,'Tipo Impuesto',1,0,"C",true);
    $pdf->Cell(25,5,'Impuesto(%)',1,0,"C",true);
    $pdf->Cell(25,5,'Descuento(%)',1,0,"C",true);
    $pdf->Cell(25,5,'Total',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);


while($row = $listaProductos->fetch_assoc()){
    $pdf->Cell(25,5,$row['nombre'],1,0,'C',0);
    $pdf->Cell(25,5,$row['cantidad'],1,0,'C',0);
    $pdf->Cell(25,5,$row['precio_venta'],1,0,'C',0);
    $pdf->Cell(25,5,$row['nomImpuesto'],1,0,'C',0);
    $pdf->Cell(25,5,$row['valImpuesto'],1,0,'C',0);
    $pdf->Cell(25,5,$row['valDescuento'],1,0,'C',0);
    $pdf->Cell(25,5,$row['total'],1,1,'C',0);

}



$pdf->Cell(15, 15, 'Detalle de venta:', 0,1);


while($row = $listaAgregados->fetch_assoc()){ 
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(60,5,'TOTALES',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);
    $pdf->Cell(30,5,'Total Impuestos:',1,0);   
    $pdf->Cell(30,5,$row['totImpuesto'],1,1,'C',0);
    $pdf->Cell(30,5,'Total Descuentos:',1,0);
    $pdf->Cell(30,5,$row['totDescuento'],1,1,'C',0);
    
}

while($row = $facturas->fetch_assoc()){ 
    $pdf->Cell(30,5,'No. Productos Totales',1,0);
    $pdf->Cell(30,5,$row['noproductos'],1,1,'C',0);
    $pdf->Cell(30,5,'Fecha Pago:',1,0);
    $pdf->Cell(30,5,$row['fecha'],1,1,'C',0);
    $pdf->Cell(30,5,'Pago Total:',1,0);
    $pdf->Cell(30,5,$row['pago_total'],1,1,'C',0);
}
$pdf->Cell(40,10,'',0,1);

$pdf->Cell(190,10,'Observaciones:',1,1);


//$pdf->Output();
$pdf->Output('D','Factura.pdf','UTF-8');
?>
