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

class reportesVentas extends Controller
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

	 			$reportes=RVentas::orderBy('id_rVentas', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			

	 			return view('almacen.reportes.ventas.ventas',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
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

	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RVentas;
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

	 	public function edit($id){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$r=RVentas::findOrFail($id);
	 		

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
	 			}
	 			 			
	 		return view("almacen.reportes.ventas.grafica",["modulos"=>$modulos,"NoPagoE"=>$NoPagoE,"NoPagoD"=>$NoPagoD,"NoPagoP"=>$NoPagoP,"id"=>$id,"ventas"=>$ventas,"r"=>$r]);
	 	}

	 	public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(ClienteFormRequest $request, $id){

	 	}

	 	public function destroy($id){
	 		$reporte=RVentas::findOrFail($id);
	 		$reporte->delete();

	 		return back()->with('msj','Reporte eliminado');
	 	}


	 	public function downloadExcelReport($id){
			$i=RVentas::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;

			return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 

	 	public function downloadPDFReport($id){
			$i=RVentas::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;

		 	$productos="SELECT f.id_factura, f.pago_total, f.noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha FROM factura as f, tipo_pago as tp, cliente as c, empleado as e WHERE f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.fecha>='$desde' and f.fecha<='$hasta' ORDER BY f.id_factura DESC";

			return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "productos"=>$productos]);
	 	}
	 
}
