<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\Rpc2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\Rpc2FormRequest;
use DB;

class reportesPC2Comparar extends Controller
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
	 		$r=Rpc2::findOrFail($id1);
	 		$fechaR1=$r->fechaActual;
	 		$r2=Rpc2::findOrFail($id2);
	 		$fechaR2=$r2->fechaActual;

		    $atrasados=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
		    ->get();

		    $pagos=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
		    ->get();

		    $atrasados2=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r2->fechaInicial)
	 		->where('ct.fecha','<=',$r2->fechaFinal)
		    ->get();

		    $pagos2=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r2->fechaInicial)
	 		->where('ct.fecha','<=',$r2->fechaFinal)
		    ->get();

		    if(auth()->user()->superusuario==0){
			$atrasados=DB::table('cartera as ct')
			->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();

		    $pagos=DB::table('cartera as ct')
		    ->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();

		    $atrasados2=DB::table('cartera as ct')
		    ->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r2->fechaInicial)
	 		->where('ct.fecha','<=',$r2->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();

		    $pagos2=DB::table('cartera as ct')
		    ->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r2->fechaInicial)
	 		->where('ct.fecha','<=',$r2->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();		    	
		    }

		    $reportes=DB::table('reportepc2')
	 		->orderBy('id_rpc','desc')->get();

	 		return view("almacen.reportes.pagosCobros.compararGPC2.index",["modulos"=>$modulos,  "atrasados"=>$atrasados, "pagos"=>$pagos, "atrasados2"=>$atrasados2, "pagos2"=>$pagos2, "fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes]);
	 		}
	 	}

	 
}
