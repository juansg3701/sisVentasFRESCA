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
	 
		 	$productos=DB::table('producto as p')
		 	->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
		 	->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
		 	->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo')
		 	->where('p.fecha_registro','>=',$r->fechaInicial)
		 	->where('p.fecha_registro','<=',$r->fechaFinal)
		 	->orderBy('p.id_producto', 'desc')
		 	->paginate(10);

			$productos2=DB::table('producto as p')
		 	->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
		 	->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
		 	->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo')
		 	->where('p.fecha_registro','>=',$r2->fechaInicial)
		 	->where('p.fecha_registro','<=',$r2->fechaFinal)
		 	->orderBy('p.id_producto', 'desc')
		 	->paginate(10);

			$reportes=DB::table('reporteinventarios')
	 		->orderBy('id_rInventarios','desc')->get();
		        
	 	}	 			
	 	return view("almacen.reportes.compararGI1.index",["modulos"=>$modulos, "productos"=>$productos,"searchText"=>$query,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2, "productos2"=>$productos2]);
 		
		}


	 
}
