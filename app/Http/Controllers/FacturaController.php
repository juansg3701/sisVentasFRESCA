<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use DB;
use Carbon\Carbon;

class FacturaController extends Controller
{
	public function __construct(){
		
	} 

	public function index($id){
			$id=$id;
		 	$usuarios=DB::table('empleado')->get();
		 	$clientes=DB::table('cliente')->get();
		 	$tipoPagos=DB::table('tipo_pago')->get();
		 	$abonosCliente=DB::table('t_ab_p_cliente as apc')
		 	->join('t_p_cliente as tc','apc.t_p_cliente_id_remision','=','tc.id_remision')
		 	->join('empleado as e','apc.empleado_id_empleado','=','e.id_empleado')
		 	->join('tipo_pago as p','apc.tipo_pago_id_tpago','=','p.id_tpago')
		 	->select('apc.id_abono','tc.id_remision as t_p_cliente_id_remision','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'p.nombre as tipo_pago')
		 	->where('apc.id_abono','=',$id)
			->orderBy('apc.t_p_cliente_id_remision', 'desc')
		 	->paginate(10);

		 	$var=DB::table('t_ab_p_cliente as apc')
		 	->select('apc.id_abono')
		 	->paginate(10);

		 	$abonos="SELECT * FROM t_ab_p_cliente as ab, tipo_pago as tp where ab.id_abono=$id and ab.tipo_pago_id_tpago=id_tpago";

		 	$nomEmpleado="SELECT * FROM t_ab_p_cliente as ab, empleado as e where ab.id_abono=$id and ab.empleado_id_empleado=e.id_empleado";

		 	$nomCliente="SELECT * FROM t_ab_p_cliente as ab, t_p_cliente as tpc, cliente as c where ab.id_abono=$id and ab.t_p_cliente_id_remision=tpc.id_remision and tpc.cliente_id_cliente=c.id_cliente";

		 	$abonos2="SELECT * FROM t_ab_p_cliente where id_abono=$id";
		 	
		 	$totales=DB::table('t_p_cliente')
		 	->select('pago_total')
		 	->where('id_remision','=',$id)
		 	->get();

		 	
		 	$productos="SELECT * FROM t_ab_p_cliente as ab, producto as p, d_p_cliente as dpc, stock as st where ab.id_abono=$id and dpc.t_p_cliente_id_remision=ab.t_p_cliente_id_remision and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock ORDER BY dpc.id_dpcliente";

		 	$impuestos="SELECT * FROM producto as p, d_p_cliente as dpc, t_ab_p_cliente as ab, impuestos as i, stock as st where ab.id_abono=$id and  dpc.t_p_cliente_id_remision=ab.t_p_cliente_id_remision and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock and dpc.impuestos_id_impuestos=i.id_impuestos ORDER BY dpc.id_dpcliente";

		 	$descuentos="SELECT * FROM  t_ab_p_cliente as ab, producto as p, d_p_cliente as dpc, descuentos as d, stock as st where ab.id_abono=$id and  dpc.t_p_cliente_id_remision=ab.t_p_cliente_id_remision and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock and dpc.descuentos_id_descuento=d.id_descuento ORDER BY dpc.id_dpcliente";

		 	$productos2="SELECT * FROM d_p_cliente as a, t_ab_p_cliente as b where b.id_abono=$id and a.t_p_cliente_id_remision=b.t_p_cliente_id_remision";
		
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		return view('almacen.pedidosDevoluciones.abonoCliente.TicketCliente.index',["id"=>$id,"abonosCliente"=>$abonosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "modulos"=>$modulos,"totales"=>$totales,"abonos"=>$abonos, "productos"=>$productos, "nomEmpleado"=>$nomEmpleado, "nomCliente"=>$nomCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos]);
 	}

 	/*public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}*/

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function edit($id){
 		$id=$id;
	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
		->orderBy('id_cargo', 'desc')->get();

	 	$facturas=DB::table('factura as f')
	 	->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 	->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 	->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 	->select('f.id_factura as id_factura','e.nombre as empleado_id_empleado','tp.nombre as tipo_pago_id_tpago','c.nombre as cliente_id_cliente', 'f.fecha as fecha','f.pago_total as pago_total','f.noproductos as noproductos','f.tiendaodomicilio as tiendaodomicilio',
	 			'f.facturaPaga as facturaPaga')	
	 	->orderBy('f.id_factura', 'desc')
	 	->paginate(10);

	 	$facturaInfo="SELECT fac.id_factura, fac.noproductos, fac.fecha, emp.nombre as nomEmpleado, cli.nombre as nomCliente, tp.nombre as nomTP, fac.pago_total, sed.nombre_sede as nomSede, sed.ciudad as sedeCiudad, sed.direccion as dirSede, sed.telefono as telSede, cli.direccion as dirCliente, cli.telefono as telCliente, cli.documento as docCliente, cli.verificacion_nit as digCliente FROM factura fac, empleado emp, cliente cli, tipo_pago tp, sede sed WHERE fac.id_factura=$id and fac.empleado_id_empleado=emp.id_empleado and fac.cliente_id_cliente=cli.id_cliente and fac.tipo_pago_id_tpago=tp.id_tpago and emp.sede_id_sede=sed.id_sede";



	 	//$facturaInfo="SELECT fac.id_factura, fac.noproductos, fac.fecha, emp.nombre as nomEmpleado, cli.nombre as nomCliente, tp.nombre as nomTP, fac.pago_total FROM factura fac, empleado emp, cliente cli, tipo_pago tp WHERE fac.id_factura=$id and fac.empleado_id_empleado=emp.id_empleado and fac.cliente_id_cliente=cli.id_cliente and fac.tipo_pago_id_tpago=tp.id_tpago";
	 	

	 	$productos="SELECT pro.nombre, df.cantidad, df.total, df.precio_venta, imp.nombre as nomImpuesto, imp.valor as valImpuesto, des.porcentaje as valDescuento FROM producto as pro, factura as fac, detalle_factura as df, stock as stk, impuestos imp, descuentos des WHERE fac.id_factura=$id and fac.id_factura=df.factura_id_factura and stk.id_stock=df.producto_id_producto and stk.producto_id_producto=pro.id_producto and df.impuestos_id_impuestos=imp.id_impuestos and df.descuentos_id_descuento=des.id_descuento";

	 	$agregados="SELECT SUM(df.total_impuesto) as totImpuesto, SUM(df.total_descuento) as totDescuento FROM producto as pro, factura as fac, detalle_factura as df, stock as stk, impuestos imp, descuentos des WHERE fac.id_factura=$id and fac.id_factura=df.factura_id_factura and stk.id_stock=df.producto_id_producto and stk.producto_id_producto=pro.id_producto and df.impuestos_id_impuestos=imp.id_impuestos and df.descuentos_id_descuento=des.id_descuento";

	 	$fecha="SELECT CURDATE() as fechas";

	 	$abonos="SELECT * FROM t_ab_p_cliente as ab, tipo_pago as tp where ab.id_abono=$id and ab.tipo_pago_id_tpago=id_tpago";

	 	 	$facturaInfos="SELECT cli.documento as doc FROM factura fac, empleado emp, cliente cli, tipo_pago tp, sede sed WHERE fac.id_factura=$id and fac.empleado_id_empleado=emp.id_empleado and fac.cliente_id_cliente=cli.id_cliente and fac.tipo_pago_id_tpago=tp.id_tpago and emp.sede_id_sede=sed.id_sede";

	 	return view('almacen.facturacion.listaVentas.Factura.index', ["modulos"=>$modulos, "facturas"=>$facturas, "facturaInfo"=>$facturaInfo, "productos"=>$productos, "agregados"=>$agregados, "fecha"=>$fecha, "facturaInfos"=>$facturaInfos]);
 	
 	}

 	public function show($id){


 		$factura=Factura::findOrFail($id);

 		
	 	$noResolucion='P-18760000001';
	 	$inicioFecha='P-2019-01-19';
	 	$finFecha='P-2030-01-19';
	 	$Prefix='P-SEPT';
	 	$desde='P-990000000';
	 	$hasta='P-995000000';
	 	$CompanyNIT='P-800197268';
	 	$idSoftware='P-56f2ae4e-9812-4fad-9255-08fcfcd5ccb0';
	 	$pin='P-12345';
	 	$codigoSeguridadSoftware= hash('sha384',$idSoftware.$pin);
	 	$nitDian='P-800197268';
	 	

		$idPersonalizar='P-10';
		$idPerfilEjecucion='P-2';
		$id=$Prefix.$desde;
		
		
		$IssueDate= $factura->fecha;//Revisar los formatos de fecha y hora
		$IssueTime= $factura->fecha."-05:00";
		$InvoiceTypeCode= "01";
		$LineCountNumeric= $factura->noproductos;

		$InvoicePeriodStartDate = Carbon::now()->startOfMonth()->toDateTimeString();
	 	$InvoicePeriodEndDate =  Carbon::now()->endOfMonth()->toDateTimeString();

	 	$IndustryClasificationCode= '5440';

	 	$CompanyName= 'P-Nombre de la empresa';
	 	$CompanyPostCode= 'P-Código postal';
	 	$CompanyCity= 'P-Nombre de la ciudad';
	 	$CompanyDepto= 'P-Nombre departamento';
	 	$CompanyDeptoCode= 'P-Código departamento';

	 	$CompanyAddress= 'P-Av. #97 - 13';
	 	$TaxLevelCode= 'P- O-99;0-15;... ';
	 	$CityCode='P-11001';
	 	$TaxSchemeID='P-01';
	 	$TaxSchemeName='P-IVA';
	 	$AdditionalAccountID='P-1'; //Revisar clientes bd jurídico o natural
	 	$CustomerName='P- OPTICAS GMO COLOMBIA S A S';
	 	$CustomerCityCode='P- 11001';
	 	$CustomerCity='P- Bogotá, D.c.';
	 	$CustomerDepto='P- Bogotá';
	 	$CustomerDeptoCode='P- 11';
	 	$CustomerAddress='P- CARRERA 8 No 20-14/40';
	 	$CustomerNIT='P- 900108281';
	 	$CustomerIdCode='P- 31';
	 	$PaymentMeansID='P- 1'; //Método de pago, 1 crédico, 2 contado
		$PaymentMeansCode='P- 41';//Código de método de pago
		$agregados="SELECT SUM(df.total_impuesto) as totImpuesto, SUM(df.total_descuento) as totDescuento FROM producto as pro, factura as fac, detalle_factura as df, stock as stk, impuestos imp, descuentos des WHERE fac.id_factura=$id and fac.id_factura=df.factura_id_factura and stk.id_stock=df.producto_id_producto and stk.producto_id_producto=pro.id_producto and df.impuestos_id_impuestos=imp.id_impuestos and df.descuentos_id_descuento=des.id_descuento";

		$TaxableAmount= 'P- 12600.06'; //Valor impuesto - BD total de impuestos 
		$TaxAmount= 'P- 2394.01'; //Total valor de impuestos- BD 
		$percent= 'P- 19.00';

		$LineExtensionAmount='P- 12600,06'; //Valor total productos
		$AllowanceTotalAmount='P- 33,613'; // Valor total descuentos
		$TaxExclusiveAmount='P- 12787,56'; //Valor Neto productos, antes de aplicar impuesto
		$TaxInclusiveAmount='P- 15024,07'; //Total
		$PayableAmount='P- 15024,07'; //Pago total

		$LineID='P- 1'; //Consecutivo
		$LineQty= 'P- 1.000000'; //Cantidad de productos
		$AllowanceChargeID='P -1'; // Consecutivo cantidad de descuentos de producto
		$ChargeIndicator='P- false'; // False: Descuento, True: Cargo
		$LineBaseAmount='P- 18900.00'; //Valor del producto antes del descuento * cantidad
		$AllowancePercentage='P- 33.33'; // Porcentaje del descuento
		$LineAllowanceAmount='P- 6299.94'; // Valor total $ del descuento
		$LineTotal='P- 12600.06'; //Total-descuento
		$LineTax='P- 2394.01'; //Valor en $ del impuesto
		$LineTaxPercentage='P- 19.00'; //Porcentaje del impuesto
		$LineItemName='P- AV OASYS -2.25 (8.4) LENTE DE CONTATO'; //Nombre del producto

		$ClTec="P- Clave Técnica DIAN"; //Clave técnica - Portal DIAN 


		$codImp1='01';
		$valImp1=$TaxAmount;
		$codImp2='04';
		$valImp2=0.00;
		$codImp3='03';
		$valImp3=0.00;
		$cufe=$id.$IssueDate.$IssueTime.$LineExtensionAmount.$codImp1.$valImp1.$codImp2.$valImp2.$codImp3.$valImp3.$PayableAmount.$CompanyNIT.$CustomerNIT.$ClTec.$idPerfilEjecucion; //Revisar formato en pesos en LineExtensionAmount decimales...
		$UUID= hash('sha384',$cufe);

		$qrCode="P-NroFactura=$id
				NitFacturador=$CompanyNIT
				NitAdquiriente=$CustomerNIT
				FechaFactura=$IssueDate
				ValorTotalFactura=$PayableAmount
				CUFE=$UUID
				URL=https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentKey=$UUID";//URL de prueba, hay que cambiarlo cuando sea ambiente de producción

	 	return view('almacen.facturacion.ventasProductos.descargas.pdf',[ 
	 		"noResolucion"=>$noResolucion, 
	 		"inicioFecha"=>$inicioFecha, 
	 		"finFecha"=>$finFecha,
	 		"Prefix"=>$Prefix,
	 		"desde"=>$desde, 
	 		"hasta"=>$hasta,
	 		"CompanyNIT"=>$CompanyNIT,
	 		"idSoftware"=>$idSoftware,
	 		"pin"=>$pin,
	 		"codigoSeguridadSoftware"=>$codigoSeguridadSoftware,
	 		"nitDian"=>$nitDian,
	 		"qrCode"=>$qrCode,
	 		"idPersonalizar"=>$idPersonalizar,
	 		"idPerfilEjecucion"=>$idPerfilEjecucion,
	 		"id"=>$id,
	 		"UUID"=>$UUID, //Código CUFE
	 		//Revisar fechas y horas
	 		"IssueDate"=>$IssueDate, //Fecha creacion factura
	 		"IssueTime"=>$IssueTime, //Hora creacion factura
	 		"InvoiceTypeCode"=>$InvoiceTypeCode, //Tipo de factura
	 		"LineCountNumeric"=>$LineCountNumeric, //Número de lineas-productos de la factura
	 		"InvoicePeriodStartDate"=>$InvoicePeriodStartDate,  //Primer día del mes actual
	 		"InvoicePeriodEndDate"=>$InvoicePeriodEndDate,  //último día del mes actual
	 		"IndustryClasificationCode"=>$IndustryClasificationCode,  //Código RUT
	 		"CompanyName"=>$CompanyName,
	 		"CompanyPostCode"=>$CompanyPostCode,
	 		"CompanyCity"=>$CompanyCity,
	 		"CompanyDepto"=>$CompanyDepto,
	 		"CompanyDeptoCode"=>$CompanyDeptoCode,
	 		"CityCode"=>$CityCode,
	 		"CompanyAddress"=>$CompanyAddress, //Dirección de empresa
	 		"TaxLevelCode"=>$TaxLevelCode, //Código responsabilidad tributaria
	 		"TaxSchemeID"=>$TaxSchemeID, //Identificador del tributo
	 		"TaxSchemeName"=>$TaxSchemeName, //Nombre del tributo
	 		"AdditionalAccountID"=>$AdditionalAccountID, //Identificador de tipo de persona
	 		"CustomerName"=>$CustomerName,
	 		"CustomerCityCode"=>$CustomerCityCode,
	 		"CustomerCity"=>$CustomerCity,
	 		"CustomerDepto"=>$CustomerDepto,
	 		"CustomerDeptoCode"=>$CustomerDeptoCode,
	 		"CustomerAddress"=>$CustomerAddress,
	 		"CustomerNIT"=>$CustomerNIT,
	 		"CustomerIdCode"=>$CustomerIdCode,  //Codigo nit o cédula, tipo de documento
	 		"PaymentMeansID"=>$PaymentMeansID,
	 		"PaymentMeansCode"=>$PaymentMeansCode, 
	 		"TaxableAmount"=>$TaxableAmount,
	 		"TaxAmount"=>$TaxAmount,
	 		"percent"=>$percent,
	 		"LineExtensionAmount"=>$LineExtensionAmount,
	 		"AllowanceTotalAmount"=>$AllowanceTotalAmount,
	 		"TaxExclusiveAmount"=>$TaxExclusiveAmount,
	 		"TaxInclusiveAmount"=>$TaxInclusiveAmount,
	 		"LineID"=>$LineID,
	 		"LineQty"=>$LineQty,
	 		"AllowanceChargeID"=>$AllowanceChargeID,
	 		"ChargeIndicator"=>$ChargeIndicator,
	 		"LineBaseAmount"=>$LineBaseAmount,
	 		"AllowancePercentage"=>$AllowancePercentage,
	 		"LineAllowanceAmount"=>$LineAllowanceAmount,
	 		"LineTotal"=>$LineTotal,
	 		"LineTax"=>$LineTax,
	 		"LineTaxPercentage"=>$LineTaxPercentage,
			"LineItemName"=>$LineItemName,
			"PayableAmount"=>$PayableAmount


	 	]);
	 	
	}

	private function formHeadXML(){
		
	}


}