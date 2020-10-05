<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\AbonoPC;
use sisVentas\PedidoCliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use DB;

class facturasCobrarTController extends Controller
{
	public function __construct(){
		
	} 

	public function edit($idc){
			$idc=$idc;
			$id=$idc;

		 	$datos="SELECT c.id_cartera,c.cuotas_restantes,dc.valor_restante,c.cuotas_totales,c.fecha,tp.nombre FROM tipo_pago as tp,cartera as c, detalle_cartera as dc where dc.id_cartera=c.id_cartera and dc.id_dCartera=$idc and dc.tipo_pago=tp.id_tpago";

		 	$nomEmpleado="SELECT * FROM detalle_cartera as dc, empleado as e where dc.id_dCartera=$idc and dc.empleado_id_empleado=e.id_empleado";

		 	$nomCliente="SELECT * FROM detalle_cartera as dc, cliente as c,cartera as ca where dc.id_dCartera=$idc and dc.id_cartera=ca.id_cartera and ca.cliente_id_cliente=c.id_cliente and ca.id_cartera=dc.id_cartera";

		 	$productos="SELECT dc.id_dCartera,dc.valor_total,dc.valor_abono,dc.fecha,dc.valor_restante FROM  detalle_cartera as dc where dc.id_dCartera=$idc";


		 	$impuestos="SELECT df.id_detallef,i.nombre, i.valor  FROM detalle_factura as df, impuestos as i where df.factura_id_factura=$id and i.id_impuestos=df.impuestos_id_impuestos ORDER BY df.id_detallef";

		 	$descuentos="SELECT df.id_detallef,d.nombre, d.porcentaje  FROM detalle_factura as df, descuentos as d where df.factura_id_factura=$id and d.id_descuento=df.descuentos_id_descuento ORDER BY df.id_detallef";


		
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		return view('almacen.pagosCobros.TicketCartera.index',["id"=>$id,"modulos"=>$modulos,"datos"=>$datos, "productos"=>$productos, "nomEmpleado"=>$nomEmpleado, "nomCliente"=>$nomCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos]);
 	}

 	public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function index(Request $request){}


}