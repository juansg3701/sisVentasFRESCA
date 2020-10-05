<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\RPedidos2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RPedidos2FormRequest;
use DB;

class reportesPedidos2 extends Controller
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
	 			
	 		$reportes=DB::table('reportepedidos2')
	 		->orderBy('id_rPedidos','desc')->get();

	 		return view('almacen.reportes.pedidos2.pedidos',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos, "reportes"=>$reportes]);
	 	}
	}



	public function store(RPedidos2FormRequest $request){

		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

		$reporte = new RPedidos2;
	 	$reporte->fechaInicial=$fechaInicialR;
	 	$reporte->fechaFinal=$fechaFinalR;
	 	$reporte->fechaActual=$request->get('fechaActual');

	 	$no="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";

	 	$nop="SELECT SUM(pro.stock_minimo) FROM producto as pro";

	 	$reporte->noProductos=$nop;
		$reporte->total=$request->get('total');
 		$reporte->save();
	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	}


	public function destroy($id){
	 	$reporte = RPedidos2::findOrFail($id);
	 	$reporte->delete();
	 	return back()->with('msj','Reporte eliminado');
	 }

	 
}


	 

