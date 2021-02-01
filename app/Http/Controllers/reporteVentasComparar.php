<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\RVentas;
use sisVentas\Factura;
use sisVentas\ProductosFactura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RVentasFormRequest;
use DB;

class reporteVentasComparar extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$id1=trim($request->get('id1'));
	 			$id2=trim($request->get('id2'));
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$r=RVentas::findOrFail($id1);
	 			$fechaR1=$r->fechaActual;
	 			$r2=RVentas::findOrFail($id2);
	 			$fechaR2=$r2->fechaActual;

	 			$NoPagoE=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();


	 			$NoPagoE2=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD2=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP2=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();


	 			if(auth()->user()->superusuario==0){
	 				$NoPagoE=DB::table('factura as f')
	 				->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoE2=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD2=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP2=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r2->fechaInicial)
	 			->where('f.fecha','<=',$r2->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			}

	 			

	 		$reportes=RVentas::orderBy('id_rVentas','desc')->get(); 			
	 		return view("almacen.reportes.compararG.index",["modulos"=>$modulos,"NoPagoE"=>$NoPagoE,"NoPagoD"=>$NoPagoD,"NoPagoP"=>$NoPagoP,"NoPagoE2"=>$NoPagoE2,"NoPagoD2"=>$NoPagoD2,"NoPagoP2"=>$NoPagoP2, "searchText"=>$query,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2]);
	 		}
	 	}


	 	public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.cliente.registrar",["modulos"=>$modulos]);
	 		
	 	}

	 	public function store(RVentasFormRequest $request){
	 		$reporte = new RVentas;
	 		$reporte->fechaInicial=$request->get('fechaInicial');
	 		$reporte->fechaFinal=$request->get('fechaFinal');
	 		$reporte->fechaActual=$request->get('fechaActual');

	 		$nop="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";
	 		$reporte->noProductos=$nop;
	 		$reporte->total=$request->get('total');
	 		$reporte->save();
	 		return Redirect::to('almacen/reportes/compararGraficas');
	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$reporte=RVentas::findOrFail($id)->get();
	 			foreach ($reporte as $r) {
	 				# code...
	 			
	 			$grafican=DB::table('factura as f')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('pr.nombre as nombrep')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$graficac=DB::table('factura as f')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('df.cantidad as cantidad')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoE=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoC=DB::table('factura as f')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',4)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			if(auth()->user()->superusuario==0){
				$grafican=DB::table('factura as f')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select('pr.nombre as nombrep')
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$graficac=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('df.cantidad as cantidad')
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoE=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoC=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',4)
	 			->orderBy('f.id_factura', 'desc')->get();	 				
	 			}


	 		}	 			
	 		return view("almacen.reportes.ventas.grafica",["modulos"=>$modulos,"grafican"=>$grafican,"graficac"=>$graficac,"NoPagoE"=>$NoPagoE,"NoPagoD"=>$NoPagoD,"NoPagoP"=>$NoPagoP,"NoPagoC"=>$NoPagoC]);
	 	}
	 		public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(ClienteFormRequest $request, $id){
	 		$cliente = Cliente::findOrFail($id);
	 		$cliente->nombre=$request->get('nombre');
	 		$cliente->direccion=$request->get('direccion');
	 		$cliente->telefono=$request->get('telefono');
	 		$cliente->correo=$request->get('correo');
	 		$cliente->documento=$request->get('documento');
	 		$cliente->verificacion_nit=$request->get('verificacion_nit');
	 		$cliente->nombre_empresa=$request->get('nombre_empresa');
	 		$cliente->cartera_activa=$request->get('cartera_activa');
	 		$cliente->update();
	 		return Redirect::to('almacen/cliente');
	 	}

	 	public function destroy($id){
	 		$reporte=RVentas::findOrFail($id);
	 		$reporte->delete();
	 		return Redirect::to('almacen/reportes/ventas');
	 	}
	 
}
