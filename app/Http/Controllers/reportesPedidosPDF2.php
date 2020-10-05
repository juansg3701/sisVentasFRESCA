<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RPedidos2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidos2FormRequest;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;

class reportesPedidosPDF2 extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function edit($id){
		$i=RPedidos2::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT tc.id_rproveedor,tc.noproductos,tc.fecha_solicitud,tc.fecha_entrega,tc.pago_inicial,tc.porcentaje_venta,tc.pago_total, e.nombre as empleado, c.nombre_empresa as proveedor, p.nombre as tipo_pago FROM tp_aproveedor as tc, empleado as e, proveedor as c, tipo_pago as p WHERE tc.empleado_id_empleado=e.id_empleado and tc.proveedor_id_proveedor=c.id_proveedor and tc.tipo_pago_id_tpago=p.id_tpago and tc.fecha_solicitud>='$desde' and tc.fecha_solicitud<='$hasta'";

		return view('almacen.reportes.pedidos2.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



}
