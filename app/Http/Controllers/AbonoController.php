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

class AbonoController extends Controller
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

		 	$abonos="SELECT * FROM t_ab_p_cliente where id_abono=$id";

		 	$totales=DB::table('t_p_cliente')
		 	->select('pago_total')
		 	->where('id_remision','=',$id)
		 	->get();

			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		return view('almacen.pedidosDevoluciones.abonoCliente.AbonoRecibo.index',["id"=>$id,"abonosCliente"=>$abonosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "modulos"=>$modulos,"totales"=>$totales,"abonos"=>$abonos]);
 	}

 	public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function index(Request $request){}


}