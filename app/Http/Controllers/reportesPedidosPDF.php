<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RPedidos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidosFormRequest;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;

class reportesPedidosPDF extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function edit($id){
		$i=RPedidos::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT tc.id_remision,tc.noproductos,tc.fecha_solicitud,tc.fecha_entrega,tc.pago_inicial,tc.porcentaje_venta,tc.pago_total, e.nombre as empleado, c.nombre as cliente, p.nombre as tipo_pago FROM t_p_cliente as tc, empleado as e, cliente as c, tipo_pago as p WHERE tc.empleado_id_empleado=e.id_empleado and tc.cliente_id_cliente=c.id_cliente and tc.tipo_pago_id_tpago=p.id_tpago and tc.fecha_solicitud>='$desde' and tc.fecha_solicitud<='$hasta'";

		return view('almacen.reportes.pedidos.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



}
