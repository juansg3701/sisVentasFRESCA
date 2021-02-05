<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\RComparar;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RComparacionFormRequest;
use DB;

class reportesComparacion extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 				$query=trim($request->get('searchText'));
	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$reportes=RComparar::orderBy('id_rComparar', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			

	 			return view('almacen.reportes.comparacionVI.comparacion',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
	 		}
	 	}



	 	public function store(RPedidosFormRequest $request){
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RComparar;
	 		$reporte->fechaInicial=$request->get('fechaInicial');
	 		$reporte->fechaFinal=$request->get('fechaFinal');
	 		$reporte->fechaActual=$request->get('fechaActual');

	 		$nop="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";
	 		$reporte->noProductos=$nop;
	 		$reporte->total=$request->get('total');
	 		$reporte->save();

	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 	}


	 	public function destroy($id){
	 		$reporte = RPedidos::findOrFail($id);
	 		$reporte->delete();

	 		return back()->with('msj','Reporte eliminado');
	 	}

	 	public function edit($id){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$r=RComparar::findOrFail($id);
	 		

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


	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(50);

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventasI=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			if(auth()->user()->superusuario==0){

	 			$NoPagoE=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoD=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoP=DB::table('factura as f')
	 			->join('empleado as em','f.empleado_id_empleado','=','em.id_empleado')
	 			->join('sede as sed','em.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(pago_total) as numero'))
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->orderBy('f.id_factura', 'desc')->get();


	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(50);

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$ventasI=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto')
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			}

	 			$fechaR1=$r->fechaInicial;
	 			$fechaR2=$r->fechaFinal;

	 			 			
	 		return view("almacen.reportes.comparacionVI.grafica",["modulos"=>$modulos,"NoPagoE"=>$NoPagoE,"NoPagoD"=>$NoPagoD,"NoPagoP"=>$NoPagoP,"id"=>$id,"ventas"=>$ventas,"r"=>$r,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado,"ventasI"=>$ventasI,"fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2]);
	 	}

	 
}


	 

