<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use DB;

class FacturaController extends Controller
{
	public function __construct(){
		
	} 

	public function index(Request $request){
	 		if ($request) {

	 			$query=trim($request->get('searchText'));

			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('empleado as em','f.empleado_id_domiciliario','=','em.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','em.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);
		 
		
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		return view('almacen.facturacion.listaVentas.listaVentas',["modulos"=>$modulos,"facturas"=>$facturas,"searchText"=>$query]);
	 	}
 	}

 	public function create(Request $request){
	}

 	public function store(AbonoPCFormRequest $request){

 	}
 	
 	public function edit($id){
 		
 	
 	}

 	public function show($id){


	}

	private function formHeadXML(){
		
	}


}