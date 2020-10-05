<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RPedidos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidosFormRequest;
use DB;

class reportesPedidosEX extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function show($id){
			$i=RPedidos::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;
			return view('almacen.reportes.pedidos.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 


	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RPedidos::findOrFail($id);

	 		$pedidosCliente=DB::table('t_p_cliente as tc')
	 		->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 		->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 		->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 		->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 		->where('tc.fecha_solicitud','>=',$r->fechaInicial)
	 		->where('tc.fecha_solicitud','<=',$r->fechaFinal)
	 		->orderBy('tc.id_remision', 'desc')
	 		->paginate(10);

	 		if(auth()->user()->superusuario==0){
	 			$pedidosCliente=DB::table('t_p_cliente as tc')
	 		->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 		->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 		->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 		->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 		->where('tc.fecha_solicitud','>=',$r->fechaInicial)
	 		->where('tc.fecha_solicitud','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('tc.id_remision', 'desc')
	 		->paginate(10);
	 		}
	 		
	 		return view("almacen.reportes.pedidos.grafica",["modulos"=>$modulos,"pedidosCliente"=>$pedidosCliente]);
	 	}







	 
}
