<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RBancos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RBancosFormRequest;
use DB;

class reportesBancosComparar extends Controller
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
	 		$r=RBancos::findOrFail($id1);
	 		$fechaR1=$r->fechaActual;
	 		$r2=RBancos::findOrFail($id2);
	 		$fechaR2=$r2->fechaActual;

		    $tp=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r->fechaFinal)
	 		->orderBy('id_Dbanco', 'desc')->get();

	 		$tp2=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r2->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r2->fechaFinal)
	 		->orderBy('id_Dbanco', 'desc')->get();

	 		if(auth()->user()->superusuario==0){
	 			$tp=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r->fechaFinal)
			->where('detalle_banco.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('id_Dbanco', 'desc')->get();

	 		$tp2=DB::table('detalle_banco')
			->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
			->where('detalle_banco.fecha','>=',$r2->fechaInicial)
	 		->where('detalle_banco.fecha','<=',$r2->fechaFinal)
			->where('detalle_banco.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('id_Dbanco', 'desc')->get();
	 		}

		    $reportes=DB::table('reportebancos')
	 		->orderBy('id_rbancos','desc')->get();

	 		return view("almacen.reportes.bancos.compararGB.index",["modulos"=>$modulos, "fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"tp"=>$tp,"tp2"=>$tp2]);
	 		}
	 	}

	 
}
