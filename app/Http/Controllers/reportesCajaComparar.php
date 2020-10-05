<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RCaja;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RCajaFormRequest;
use DB;

class reportesCajaComparar extends Controller
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
	 		$r=RCaja::findOrFail($id1);
	 		$fechaR1=$r->fechaActual;
	 		$r2=RCaja::findOrFail($id2);
	 		$fechaR2=$r2->fechaActual;

	 		$tp=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r->fechaInicial)
	 		->where('caja.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();

	 		$tp2=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r2->fechaInicial)
	 		->where('caja.fecha','<=',$r2->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();

	 		if(auth()->user()->superusuario==0){
			$tp=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r->fechaInicial)
			->where('caja.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->where('caja.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();

	 		$tp2=DB::table('caja')
			->select(DB::raw('sum(ingresos_efectivo) as ief'),DB::raw('sum(egresos_efectivo) as Eef'),DB::raw('sum(ingresos_electronicos) as iel'),DB::raw('sum(egresos_electronicos) as Eel'), DB::raw('sum(base_monetaria) as bm'))
			->where('caja.fecha','>=',$r2->fechaInicial)
			->where('caja.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->where('caja.fecha','<=',$r2->fechaFinal)
	 		->orderBy('id_caja', 'desc')->get();	 			
	 		}

		    $reportes=DB::table('reportecaja')
	 		->orderBy('id_rcaja','desc')->get();

	 		return view("almacen.reportes.caja.compararGC.index",["modulos"=>$modulos, "fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"tp"=>$tp,"tp2"=>$tp2]);
	 		}
	 	}

	 
}
