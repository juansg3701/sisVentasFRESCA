<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RVentas;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RVentasFormRequest;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;

class reportesVentasPDF extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function edit($id){
		$i=RVentas::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;
		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT f.id_factura, f.pago_total, f.noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha FROM factura as f, tipo_pago as tp, cliente as c, empleado as e WHERE f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.fecha>='$desde' and f.fecha<='$hasta'";

		return view('almacen.reportes.ventas.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



}
