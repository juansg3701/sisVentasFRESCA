<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reporteInventarioC1 extends Controller
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
	 			$r=RInventarios::findOrFail($id1);
	 			$fechaR1=$r->fechaActual;
	 			$r2=RInventarios::findOrFail($id2);
	 			$fechaR2=$r2->fechaActual;

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

	 			$Transformado2=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r2->fechaInicial)
	 			->where('s.fecha_registro','<=',$r2->fechaFinal)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado2=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r2->fechaInicial)
	 			->where('s.fecha_registro','<=',$r2->fechaFinal)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			if(auth()->user()->superusuario==0){

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

	 			$Transformado2=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r2->fechaInicial)
	 			->where('s.fecha_registro','<=',$r2->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado2=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r2->fechaInicial)
	 			->where('s.fecha_registro','<=',$r2->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			
	 			}


	 		$reportes=RInventarios::get(); 

	 		return view("almacen.reportes.compararGI1.index",["modulos"=>$modulos, "searchText"=>$query,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado, "Transformado2"=>$Transformado2,"NoTransformado2"=>$NoTransformado2]);
	 		}
		}


	 
}
