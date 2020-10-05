<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\CorteSede;
use sisVentas\ProductosCorte;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CorteSedeFormRequest;
use DB;


class CorteSedeController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$cortes=DB::table('c_inventario as i')
	 			->join('p_tiempo as p','i.p_tiempo_id_tiempo','=','p.id_tiempo')
	 			->join('sede as s','i.sede_id_sede','=','s.id_sede')
	 			->select('i.id_corte','i.fecha as fecha','i.noproductos as noproductos','i.valor_total as valor_total','p.periodo_tiempo as p_tiempo_id_tiempo','s.nombre_sede as sede_id_sede','s.id_sede as idsede')
	 			->where('fecha','LIKE', '%'.$query.'%')
	 			->orderBy('i.id_corte', 'desc')
	 			->paginate(10);
	 			
	 			$tiempo=DB::table('p_tiempo')->get();
	 			$sede=DB::table('sede')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		

	 			return view('almacen.inventario.corte-sede.cortes.index',["cortes"=>$cortes,"searchText"=>$query,"tiempo"=>$tiempo, "sede"=>$sede,"modulos"=>$modulos]);
	 		}
	 	}
	 	
	 	public function create(){
	 			$tiempo=DB::table('p_tiempo')->get();
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.inventario.corte-sede.cortes.registrar",["tiempo"=>$tiempo,"modulos"=>$modulos]);
	 		
	 	}

	 	public function store(CorteSedeFormRequest $request){
	 		$fechaR=$request->get('fecha');
	 		$corte = new CorteSede;
	 		$corte->fecha=$fechaR;
	 		$corte->noproductos=$request->get('noproductos');
	 		$corte->valor_total=$request->get('valor_total');
	 		$corte->p_tiempo_id_tiempo=$request->get('p_tiempo_id_tiempo');
	 		$corte->sede_id_sede=$request->get('sede_id_sede');
	 		$corte->save();
	 		
	 		return back()->with('msj','Nuevo corte guardado');


	 	}

	 	public function edit($id){
	 		$id=$id;
	 		$producto=DB::table('producto')->get();

	 		$query="";
	 			$productos=DB::table('d_corte as d')
	 			->join('c_inventario as c','d.c_inventario_id_corte','=','c.id_corte')
	 			->join('producto as p','d.producto_id_producto','=','p.id_producto')
	 			->select('d.id_dcorte','d.cantidad as cantidad','p.nombre as producto_id_producto','d.c_inventario_id_corte','d.fecha as fecha')
	 			->where('d.c_inventario_id_corte','=',$id)
	 			->orderBy('d.id_dcorte', 'desc')
	 			->paginate(10);

	 			$productosEAN=DB::table('producto')
	 			->where('ean','=',$query)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
				$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();
	 		
	 			return view('almacen.inventario.corte-sede.productosCorte.index',["productos"=>$productos,"id"=>$id,"producto"=>$producto,"productosEAN"=>$productosEAN,"searchText"=>$query,"modulos"=>$modulos,"eanP"=>$eanP]);
	 	}
	 		public function show($id){
	 		return view("almacen.inventario.corte-sede.cortes.show",["cortes"=>CorteSede::findOrFail($id)]);
	 	}

	 	public function update(CorteSedeFormRequest $request, $id){
	 		$corte = CorteSede::findOrFail($id);
	 		$corte->fecha=$request->get('fecha');
	 		$corte->noproductos=$request->get('noproductos');
	 		$corte->valor_total=$request->get('valor_total');
	 		$corte->p_tiempo_id_tiempo=$request->get('p_tiempo_id_tiempo');
	 		$corte->sede_id_sede=$request->get('sede_id_sede');
	 		
	 		$corte->update();

	 		return back()->with('msj','Corte actualizado');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existe=DB::table('d_corte')
	 		->select('id_dcorte as id')
	 		->where('c_inventario_id_corte','=',$id)
	 		->orderBy('id_dcorte', 'desc')->get();

	 		if(count($existe)==0){

	 		$corte=CorteSede::findOrFail($id);
	 		$corte->delete();

	 		return back()->with('msj','Corte eliminado');

	 		}else{
	 			for ($i=0; $i <count($existe) ; $i++) { 
	 				$proCorte=ProductosCorte::findOrFail($existe[$i]->id);
	 				$proCorte->delete();

	 			}
	 		$corte=CorteSede::findOrFail($id);
	 		$corte->delete();

	 		return back()->with('msj','Corte eliminado');
	 		}
	 		
	 	}
}