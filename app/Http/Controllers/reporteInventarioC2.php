<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventarios2FormRequest;
use DB;

class reporteInventarioC2 extends Controller
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
	 		$r=RInventarios2::findOrFail($id1);
	 		$fechaR1=$r->fechaActual;
	 		$r2=RInventarios2::findOrFail($id2);
	 		$fechaR2=$r2->fechaActual;
	 
	 		$productos=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r->fechaInicial)
	 		->where('s.fecha_registro','<=',$r->fechaFinal)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);


	 		$productos2=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r2->fechaInicial)
	 		->where('s.fecha_registro','<=',$r2->fechaFinal)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);

	 		if(auth()->user()->superusuario==0){
	 			$productos=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r->fechaInicial)
	 		->where('s.fecha_registro','<=',$r->fechaFinal)
	 		->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);


	 		$productos2=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r2->fechaInicial)
	 		->where('s.fecha_registro','<=',$r2->fechaFinal)
	 		->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);
	 		}

			$reportes=DB::table('reporteinventarios2')
	 		->orderBy('id_rInventarios','desc')->get();
		        
	 	}	 			
	 	return view("almacen.reportes.compararGI2.index",["modulos"=>$modulos, "productos"=>$productos,"searchText"=>$query,"id1"=>$id1,"id2"=>$id2,"reportes"=>$reportes,"fechaR1"=>$fechaR1,"fechaR2"=>$fechaR2, "productos2"=>$productos2]);
 		
		}


	 
}
