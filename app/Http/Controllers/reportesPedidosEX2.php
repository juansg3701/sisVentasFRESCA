<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RPedidos2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidos2FormRequest;
use DB;

class reportesPedidosEX2 extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function show($id){
			$i=RPedidos2::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;
			return view('almacen.reportes.pedidos2.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 


	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RPedidos2::findOrFail($id);

	 		$pedidosProveedor=DB::table('tp_aproveedor as tc')
	 		->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 		->join('proveedor as c','tc.proveedor_id_proveedor','=','c.id_proveedor')
	 		->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 		->select('tc.id_rproveedor','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre_empresa as proveedor', 'p.nombre as tipo_pago')
	 		->where('tc.fecha_solicitud','>=',$r->fechaInicial)
	 		->where('tc.fecha_solicitud','<=',$r->fechaFinal)
	 		->orderBy('tc.id_rproveedor', 'desc')
	 		->paginate(10);

	 		if(auth()->user()->superusuario==0){
	 			$pedidosProveedor=DB::table('tp_aproveedor as tc')
	 		->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 		->join('proveedor as c','tc.proveedor_id_proveedor','=','c.id_proveedor')
	 		->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 		->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select('tc.id_rproveedor','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre_empresa as proveedor', 'p.nombre as tipo_pago')
	 		->where('tc.fecha_solicitud','>=',$r->fechaInicial)
	 		->where('tc.fecha_solicitud','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('tc.id_rproveedor', 'desc')
	 		->paginate(10);
	 		}
	 		
	
	 			 			
	 		return view("almacen.reportes.pedidos2.grafica",["modulos"=>$modulos, "pedidosProveedor"=>$pedidosProveedor]);
	 	}


	 
}
