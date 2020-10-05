<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorSedeFormRequest;
use DB;

class DevIgualController extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	 	public function index(Request $request){
	 		if ($request) {
	 		
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
	 			$query4=trim($request->get('searchText4'));

	 			$productos=DB::table('stock as s')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 			->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.sede_id_sede as sede_id_sede')
	 			->where('p.nombre','LIKE', '%'.$query0.'%')
	 			->where('p.plu','LIKE', '%'.$query1.'%')
	 			->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
	 			->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
	 			->where('p.ean','LIKE', '%'.$query4.'%')
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(10);

	 			

				$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();
	 			 			

	 			return view('almacen.pedidosDevoluciones.devolucionIgual.index',["productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3, "searchText4"=>$query4, "modulos"=>$modulos,"eanP"=>$eanP]);
	 		}
	 	}
	 	


	 	public function create(Request $request){
	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();
	 			$query=trim($request->get('searchText'));

	 			$productosEAN=DB::table('producto')
	 			->where('ean','=',$query)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			

	 		return view("almacen.inventario.proveedor-sede.registrar",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "productosEAN"=>$productosEAN,"searchText"=>$query]);
	 	}

	 	public function store(ProveedorSedeFormRequest $request){
	 		$ps = new ProveedorSede;
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->sede_id_sede=$request->get('sede_id_sede');
	 		$ps->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$ps->disponibilidad=$request->get('disponibilidad');
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->save();

	 				return back()->with('msj','Devolución exitosa');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.proveedor-sede.show",["productos"=>ProveedorSede::findOrFail($id)]);
	 	}

	 	public function edit($id){
	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 		return view("almacen.pedidosDevoluciones.devolucionIgual.edit",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto,"stock"=>ProveedorSede::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 	public function update(ProveedorSedeFormRequest $request, $id){
	 		$ps = ProveedorSede::findOrFail($id);
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->sede_id_sede=$request->get('sede_id_sede');
	 		$ps->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$ps->disponibilidad=$request->get('disponibilidad');
	 		$devolver=$request->get('devolver');
	 		$operacion = $ps->cantidad=$request->get('cantidad')+$devolver;
	 		$ps->cantidad=$operacion;
	 		$ps->update();
	 		return Redirect::to('almacen/pedidosDevoluciones/devolucionIgual')->with('msj','Devolución exitosa');
	 	}

	 	public function destroy($id){
	 		$ps=ProveedorSede::findOrFail($id);
	 		$ps->delete();
	 		return Redirect::to('almacen/inventario/proveedor-sede');
	 	}
}