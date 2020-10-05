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

class AbonoTCController extends Controller
{
	public function __construct(){
		
	} 

	public function edit($id){
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

 	public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function index(Request $request){}


}