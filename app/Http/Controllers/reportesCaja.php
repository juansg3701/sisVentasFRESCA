<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RCaja;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RCajaFormRequest;
use DB;

class reportesCaja extends Controller
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
	 			
	 			$reportes=DB::table('reportecaja')
	 			->orderBy('id_rcaja','desc')->get();

	 			return view('almacen.reportes.caja.caja.caja',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}

	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RCaja::findOrFail($id);

	 		$productos=DB::table('caja as k')
	 		->join('empleado as u','k.empleado_id_empleado','=','u.id_empleado')
	 		->join('sede as s','k.sede_id_sede','=','s.id_sede')
	 		->join('p_tiempo as p','k.p_tiempo_id_tiempo','=','p.id_tiempo')
	 		->select('k.id_caja','k.base_monetaria','k.ingresos_efectivo','k.ingresos_electronicos', 'k.egresos_efectivo', 'k.egresos_electronicos', 'k.ventas', 'k.fecha','u.nombre as empleado','s.nombre_sede as sede', 'p.periodo_tiempo as p_tiempo')
	 		->where('k.fecha','>=',$r->fechaInicial)
	 		->where('k.fecha','<=',$r->fechaFinal)
	 		->orderBy('k.id_caja', 'desc')
	 		->paginate(10);


	 		$tp=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r->fechaInicial)
	 		->where('caja.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();

	 		if(auth()->user()->superusuario==0){

	 			$productos=DB::table('caja as k')
	 		->join('empleado as u','k.empleado_id_empleado','=','u.id_empleado')
	 		->join('sede as s','k.sede_id_sede','=','s.id_sede')
	 		->join('p_tiempo as p','k.p_tiempo_id_tiempo','=','p.id_tiempo')
	 		->select('k.id_caja','k.base_monetaria','k.ingresos_efectivo','k.ingresos_electronicos', 'k.egresos_efectivo', 'k.egresos_electronicos', 'k.ventas', 'k.fecha','u.nombre as empleado','s.nombre_sede as sede', 'p.periodo_tiempo as p_tiempo')
	 		->where('k.fecha','>=',$r->fechaInicial)
	 		->where('k.fecha','<=',$r->fechaFinal)
			->where('k.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('k.id_caja', 'desc')
	 		->paginate(10);

			$tp=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r->fechaInicial)
			->where('caja.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->where('caja.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();	 			
	 		}
		 			
	 		return view("almacen.reportes.caja.caja.grafica",["modulos"=>$modulos, "productos"=>$productos, "tp"=>$tp]);
	 	}

	 	public function store(RCajaFormRequest $request){
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RCaja;
	 		$reporte->fechaInicial=$fechaInicialR;
	 		$reporte->fechaFinal=$fechaFinalR;
	 		$reporte->fechaActual=$request->get('fechaActual');
	 		$reporte->save();

	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 	}

	 	public function destroy($id){
	 		$reporte = RCaja::findOrFail($id);
	 		$reporte->delete();

	 		return back()->with('msj','Reporte eliminado');
	 	}
 
}