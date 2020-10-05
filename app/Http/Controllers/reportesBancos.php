<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RBancos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RBancosFormRequest;
use DB;

class reportesBancos extends Controller
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
	 			
	 			$reportes=DB::table('reportebancos')
	 			->orderBy('id_rbancos','desc')->get();

	 			return view('almacen.reportes.bancos.bancos.bancos',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}

	 	public function show($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RBancos::findOrFail($id);

	 		$productos=DB::table('detalle_banco as db')
	  		->join('bancos as b','db.banco_idBanco','=','b.id_banco')	
	  		->join('sede as s','db.sede_id_sede','=','s.id_sede')
	 		->select('db.id_Dbanco','db.fecha','db.ingreso_efectivo','db.egreso_efectivo','b.nombre_banco as banco','db.ingreso_electronico','db.egreso_electronico','s.nombre_sede as sede')
	 		->where('db.fecha','>=',$r->fechaInicial)
	 		->where('db.fecha','<=',$r->fechaFinal)
	 		->orderBy('db.id_Dbanco', 'desc')
	 		->paginate(100);

	 		$tp=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_Dbanco', 'desc')->get();

	 		if(auth()->user()->superusuario==0){
	 			$productos=DB::table('detalle_banco as db')
	  		->join('bancos as b','db.banco_idBanco','=','b.id_banco')	
	  		->join('sede as s','db.sede_id_sede','=','s.id_sede')
	 		->select('db.id_Dbanco','db.fecha','db.ingreso_efectivo','db.egreso_efectivo','b.nombre_banco as banco','db.ingreso_electronico','db.egreso_electronico','s.nombre_sede as sede')
	 		->where('db.fecha','>=',$r->fechaInicial)
	 		->where('db.fecha','<=',$r->fechaFinal)
			->where('db.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('db.id_Dbanco', 'desc')
	 		->paginate(100);

	 		$tp=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r->fechaFinal)
			->where('detalle_banco.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('id_Dbanco', 'desc')->get();
	 		}
 			
	 		return view("almacen.reportes.bancos.bancos.grafica",["modulos"=>$modulos, "productos"=>$productos,"tp"=>$tp]);
	 	}

	 	public function store(RBancosFormRequest $request){

	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RBancos;
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
	 		$reporte = RBancos::findOrFail($id);
	 		$reporte->delete();

	 		return back()->with('msj','Reporte eliminado');
	 	}
 
}