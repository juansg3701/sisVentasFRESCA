<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use sisVentas\Descuentos;
use sisVentas\Impuesto;
use sisVentas\ProductoSede;
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
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));

	 			if($query==""){
	 				$query=1;
	 			}

	 		switch ($query) {
	 			case 1:
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.anulacion','=',0)
 			->where('f.facturapaga','=',1)
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);

 			if(auth()->user()->superusuario==0){
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.anulacion','=',0)
 			->where('f.facturapaga','=',1)
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->where('f.sede_id_sede','=',auth()->user()->sede_id_sede)
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);	
	 		}

	 				break;

	 			case 2:
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.anulacion','=',1 )
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);



 			if(auth()->user()->superusuario==0){
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')

 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.anulacion','=',1 )
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->where('f.sede_id_sede','=',auth()->user()->sede_id_sede)
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);
	 		}

	 				break;
	 			case 3:
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 		//	->join('empleado as em','f.empleado_id_domiciliario','=','em.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 		//	->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','em.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 				->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','e.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 		
 			//->where('f.empleado_id_domiciliario','!=',0 )
 			->where('f.facturapaga','=',0 )
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);

 			if(auth()->user()->superusuario==0){
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			//->join('empleado as em','f.empleado_id_domiciliario','=','em.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 		//	->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','em.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 				->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','e.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			//->where('f.empleado_id_domiciliario','!=',0 )
 			->where('f.facturapaga','=',0 )
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->where('f.sede_id_sede','=',auth()->user()->sede_id_sede)
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);
	 		}

	 				break;
	 			case 4:
	 				$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.id_factura_web','!=',0)
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);

 			if(auth()->user()->superusuario==0){
	 			$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.id_factura_web','!=',0)
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->where('f.sede_id_sede','=',auth()->user()->sede_id_sede)
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);
	 		}


	 				break;	
	 			default:
	 			
	 		$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('empleado as em','f.empleado_id_domiciliario','=','em.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','em.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);

 			if(auth()->user()->superusuario==0){
	 		$facturas=DB::table('factura as f')
 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
 			->join('empleado as em','f.empleado_id_domiciliario','=','em.id_empleado')
 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
 			->join('sede as s','f.sede_id_sede','=','s.id_sede')
 			->select('f.id_factura','f.id_factura_web','f.pago_total','f.noproductos','f.fecha','f.facturapaga','tp.nombre as nombre_pago','e.nombre as nombre_empleado','em.nombre as nombre_domiciliario','c.nombre as nombre_cliente','s.nombre_sede as nombre_sede','f.anulacion','f.referencia_pago','f.tipo_web')
 			->where('f.id_factura','LIKE', '%'.$query0.'%')
 			->where('c.nombre','LIKE', '%'.$query1.'%')
 			->where('f.sede_id_sede','=',auth()->user()->sede_id_sede)
 			->orderBy('f.id_factura', 'desc')
 			->paginate(10);
	 		}
	 				break;
	 		}
			
			$productos=DB::table('detalle_factura as df')
			->join('empleado as e','df.empleado_id_empleado','=','e.id_empleado')
			->join('stock as s','df.stock_id_stock','=','s.id_stock')
			->select('df.id_detallef','df.cantidad','df.precio_venta','df.total_descuento','df.total_impuesto','df.total','df.factura_id_factura','s.producto_id_producto as stock_id_stock','df.descuento_id_descuento','df.impuesto_id_impuestos','df.fecha','e.nombre as nombre_empleado')
	 		->orderBy('df.id_detallef', 'desc')->get(); 
		
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 		$notas=DB::table('nota_credito')->get();

	 		$descuentos = Descuentos::get();
	 		$pro = ProductoSede::get();
	 		$impuestos = Impuesto::get();

	 		foreach ($productos as $key => $value) {
	 	

	 			foreach ($pro as $keyp => $valuep) {
	 				if($productos[$key]->stock_id_stock==$pro[$keyp]->id_producto){
	 					$productos[$key]->stock_id_stock=$pro[$keyp]->nombre;
	 				}
	 			}
	 		}
	 		return view('almacen.facturacion.listaVentas.listaVentas',["modulos"=>$modulos,"facturas"=>$facturas,"searchText"=>$query, "searchText0"=>$query0,"searchText1"=>$query1,"productos"=>$productos,"notas"=>$notas]);
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