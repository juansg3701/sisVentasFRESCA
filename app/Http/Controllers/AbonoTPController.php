<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\AbonoPP;
use sisVentas\PedidoProveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\AbonoPPFormRequest;
use sisVentas\Http\Requests\PedidoProveedorFormRequest;
use DB;
class AbonoTPController extends Controller
{
	public function __construct(){
		
	} 




	public function edit($id){

	 	$id=$id;
	 	$usuarios=DB::table('empleado')->get();
	 	$proveedores=DB::table('proveedor')->get();
	 	$tipoPagos=DB::table('tipo_pago')->get();
	 	$abonosProveedor=DB::table('tap_proveedor as apc')
	 	->join('tp_aproveedor as tc','apc.tp_aproveedor_id_rproveedor','=','tc.id_rproveedor')
	 	->join('empleado as e','apc.empleado_id_empleado','=','e.id_empleado')
	 	->join('tipo_pago as p','apc.tipo_pago_id_tpago','=','p.id_tpago')
	 	->select('apc.id_abono','tc.id_rproveedor as tp_aproveedor_id_rproveedor','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'p.nombre as tipo_pago')
	 	->where('apc.tp_aproveedor_id_rproveedor','=',$id)
		->orderBy('apc.tp_aproveedor_id_rproveedor', 'desc')
	 	->paginate(10);


	 	$abonos="SELECT * FROM tap_proveedor as ab, tipo_pago as tp where ab.id_abono=$id and ab.tipo_pago_id_tpago=id_tpago";

		$nomEmpleado="SELECT * FROM tap_proveedor as ab, empleado as e where ab.id_abono=$id and ab.empleado_id_empleado=e.id_empleado";

		$nomCliente="SELECT * FROM tap_proveedor as ab, tp_aproveedor as tpc, proveedor as c where ab.id_abono=$id and ab.tp_aproveedor_id_rproveedor=tpc.id_rproveedor and tpc.proveedor_id_proveedor=c.id_proveedor";

	 	$abonos2="SELECT * FROM tap_proveedor where id_abono=$id";


	 	$totales=DB::table('tp_aproveedor')
	 	->select('pago_total')
	 	->where('id_rproveedor','=',$id)
	 	->get();



		 	$productos="SELECT * FROM tap_proveedor as ab, producto as p, d_p_proveedor as dpc, stock as st where ab.id_abono=$id and dpc.tp_aproveedor_id_rproveedor=ab.tp_aproveedor_id_rproveedor and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock ORDER BY dpc.id_dpproveedor";

		 	

		 	$impuestos="SELECT * FROM producto as p, d_p_proveedor as dpc, tap_proveedor as ab, impuestos as i, stock as st where ab.id_abono=$id and dpc.tp_aproveedor_id_rproveedor=ab.tp_aproveedor_id_rproveedor and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock and dpc.impuestos_id_impuestos=i.id_impuestos ORDER BY dpc.id_dpproveedor";
		 	$descuentos="SELECT * FROM  tap_proveedor as ab, producto as p, d_p_proveedor as dpc, descuentos as d, stock as st where ab.id_abono=$id and dpc.tp_aproveedor_id_rproveedor=ab.tp_aproveedor_id_rproveedor and p.id_producto=st.producto_id_producto and dpc.producto_id_producto=st.id_stock and dpc.descuentos_id_descuento=d.id_descuento ORDER BY dpc.id_dpproveedor";


		 	



	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 	return view('almacen.pedidosDevoluciones.abonoProveedor.TicketProveedor.index',["id"=>$id,"abonosProveedor"=>$abonosProveedor, "tipoPagos"=>$tipoPagos, "proveedores"=>$proveedores, "usuarios"=>$usuarios, "modulos"=>$modulos,"totales"=>$totales, "abonos"=>$abonos, "productos"=>$productos, "nomEmpleado"=>$nomEmpleado, "nomCliente"=>$nomCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos]);

 	}

 	public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function index(Request $request){}


}