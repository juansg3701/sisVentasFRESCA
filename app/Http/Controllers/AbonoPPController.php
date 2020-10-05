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

class AbonoPPController extends Controller
{
	public function __construct(){
	} 


	public function index(Request $request){

		$query=trim($request->get('searchText'));
		$query2=trim($request->get('searchText2'));
	 	$query3=trim($request->get('searchText3'));
	 	$query4=trim($request->get('searchText4'));
	 	$usuarios=DB::table('empleado')->get();
	 	$proveedores=DB::table('proveedor')->get();
	 	$tipoPagos=DB::table('tipo_pago')->get();
	 
	 	$pedidosProveedor=DB::table('tp_aproveedor as tc')
	 	->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 	->join('proveedor as c','tc.proveedor_id_proveedor','=','c.id_proveedor')
	 	->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 	->select('tc.id_rproveedor','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre_empresa as proveedor', 'p.nombre as tipo_pago')
	 	->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 	->where('tc.fecha_entrega','LIKE', '%'.$query2.'%')
	 	->where('tc.id_rproveedor','LIKE', '%'.$query3.'%')
	 	->where('c.nombre_empresa','LIKE', '%'.$query4.'%')
	 	->orderBy('tc.id_rproveedor', 'desc')
	 	->paginate(10);

	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
	 	->orderBy('id_cargo', 'desc')->get();

	 	return view('almacen.facturacion.listaPedidosProveedores.listaPedidos',["tipoPagos"=>$tipoPagos, "usuarios"=>$usuarios, "searchText"=>$query, "searchText2"=>$query2, "searchText3"=>$query3, "searchText4"=>$query4, "modulos"=>$modulos, "pedidosProveedor"=>$pedidosProveedor]);
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
	 	->select('apc.id_abono','tc.id_rproveedor as tp_aproveedor_id_rproveedor','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'p.nombre as tipo_pago','apc.facturaPaga as facturaPaga','apc.tipo_pago_id_tpago as tipo_pago_id_tpago')
	 	->where('apc.tp_aproveedor_id_rproveedor','=',$id)
		->orderBy('apc.tp_aproveedor_id_rproveedor', 'desc')
	 	->paginate(10);


	 	$totales=DB::table('tp_aproveedor')
	 	->select('pago_total')
	 	->where('id_rproveedor','=',$id)
	 	->get();

	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 	$abProveedor=DB::table('tap_proveedor')->get();

	 	$tipoPago=DB::table('tipo_pago')->get();
	 	$facturas=DB::table('tap_proveedor')->get();

	 	return view('almacen.pedidosDevoluciones.abonoProveedor.abonoProveedor',["id"=>$id,"abonosProveedor"=>$abonosProveedor, "tipoPagos"=>$tipoPagos, "proveedores"=>$proveedores, "usuarios"=>$usuarios, "modulos"=>$modulos,"totales"=>$totales, "abProveedor"=>$abProveedor, "tipoPago"=>$tipoPago,"facturas"=>$facturas]);

 	}


	 public function store(AbonoPPFormRequest $request){
		$abonopc = new AbonoPP;
		$valorAbono=$request->get('abono');
		$idPedido=$request->get('tp_aproveedor_id_rproveedor');

		
		$saldoActual= PedidoProveedor::findOrFail($idPedido);
		$totalActual=$saldoActual->pago_total;


		if($totalActual>=$valorAbono){
			
		$pedidoProveedor = new PedidoProveedor;
		$id_rproveedor=$idPedido;
	 	$abonopc->tp_aproveedor_id_rproveedor =$id_rproveedor;

	 	$abonopc->abono=$valorAbono;
	
	 	$abonopc->total=$request->get('total');
	 	$abonopc->fecha=$request->get('fecha');
	 	$abonopc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 	$abonopc->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');


	 	$id=$pedidoProveedor->id_rproveedor;

	 	$res=$abonopc->total-$abonopc->abono;
	 	
	 	$abonopc->restante=$res;
	 	$abonopc->facturaPaga=0;
	 	$abonopc->save();

	 	$pc = PedidoProveedor::findOrFail($id_rproveedor);
	 	$pc->pago_total=$res;
	 	$pc->update();	

		return back()->with('msj','Abono guardado');

		}else{
			return back()->with('errormsj','¡Ingrese un abono menor o igual al restante!');
		}
		
	 }

	public function destroy($idf){
	 	$abonopp = AbonoPP::findOrFail($idf);
	 	$abonopp->delete();

		$id=$abonopp->tp_aproveedor_id_rproveedor;
	 	$res=$abonopp->abono;
		$abonopp->delete();
	 	
	 	$pc = PedidoProveedor::findOrFail($id);
	 	$anteriorT=$pc->pago_total;
	 	$pc->pago_total=$anteriorT+$res;
	 	$pc->update();

	 	return back()->with('msj','Abono eliminado');
	}


	public function show(Request $request){
	}

}