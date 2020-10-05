<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductosCorte;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductosCorteFormRequest;
use DB;

class ProductosCorteController extends Controller
{
	 public function __construct(){
			$this->middleware('auth');	

			 	}
	 	public function index(Request $request){
	 		if ($request) {
	 			$id=trim($request->get('c_inventario_id_corte'));
	 			$query=trim($request->get('searchText'));
	 			
	 			$producto=DB::table('producto')->get();
	 		
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
	 	}


	 	public function create(){
	 			$tiempo=DB::table('p_tiempo')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.inventario.corte-sede.productosCorte.registrar",["tiempo"=>$tiempo, "modulos"=>$modulos]);
	 		
	 	}


	 	public function store(ProductosCorteFormRequest $request){
	 		$ps = new ProductosCorte;
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->c_inventario_id_corte=$request->get('c_inventario_id_corte');
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->fecha=$request->get('fecha');
	 		$ps->save();

	 		$id=trim($request->get('c_inventario_id_corte'));

	 		$producto=DB::table('producto')->get();
	 		$query=trim($request->get('searchText'));
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
	 			
	 			return back()->with('msj','Producto guardado');
	 		
	 	}


	 		public function show($id){
	 		return view("almacen.inventario.corte-sede.productosCorte.show",["productos"=>ProductosCorte::findOrFail($id)]);
	 	}

	 	public function update(ProductosCorteFormRequest $request, $id){
	 		$productos = ProductosCorte::findOrFail($id);
			$productos->cantidad=$request->get('cantidad');
	 		$productos->c_inventario_id_corte=$request->get('c_inventario_id_corte');
	 		$productos->producto_id_producto=$request->get('producto_id_producto');;
	 		$productos->fecha=$request->get('fecha');
	 		$productos->update();
	 		return Redirect::to('almacen/inventario/corte-sede/productosCorte');
	 	}

	 	public function destroy($id){
	 		$productos=ProductosCorte::findOrFail($id);
	 		$id=$productos->c_inventario_id_corte;
	 		$productos->delete();

	 		return back()->with('msj','Producto eliminado');
	 	}
}