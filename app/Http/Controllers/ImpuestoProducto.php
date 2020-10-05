<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Impuesto;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ImpuestoFormRequest;
use DB;

class ImpuestoProducto extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$impuestos=DB::table('impuestos')
	 			->where('nombre','LIKE', '%'.$query.'%')
	 			->orderBy('id_impuestos', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$impuP=DB::table('impuestos')->get();
	 			
	 			return view('almacen.inventario.producto-sede.impuestoProducto.index',["impuestos"=>$impuestos,"searchText"=>$query, "modulos"=>$modulos,"impuP"=>$impuP]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.impuestoProducto.index",["modulos"=>$modulos]);
	 	}

	 	public function store(ImpuestoFormRequest $request){
	 		$impuesto = new Impuesto;
	 		$impuesto->nombre=$request->get('nombre');
	 		$impuesto->valor=$request->get('valor');
	 		$impuesto->save();

	 		return back()->with('msj','Impuesto guardado');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.impuestoProducto.show",["impuestos"=>Impuesto::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.impuestoProducto.edit",["impuestos"=>Impuesto::findOrFail($id),"modulos"=>$modulos]);
	 	}

	 	public function update(ImpuestoFormRequest $request, $id){
	 		$impuesto = Impuesto::findOrFail($id);
	 		
	 		$impuesto->nombre=$request->get('nombre');
	 		$impuesto->valor=$request->get('valor');
	 		$impuesto->update();

	 		return back()->with('msj','Impuesto actualizado');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeD=DB::table('detalle_factura')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_detallef', 'desc')->get();

	 		$existeP=DB::table('producto')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_producto', 'desc')->get();

	 		$existePC=DB::table('d_p_cliente')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_dpcliente', 'desc')->get();

	 		$existePP=DB::table('d_p_proveedor')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_dpproveedor', 'desc')->get();


	 		if(count($existeD)==0 && count($existeP)==0 && count($existePC)==0 && count($existePP)==0){
	 			
	 		$impuesto=Impuesto::findOrFail($id);
	 		$impuesto->delete();

	 		return back()->with('msj','Impuesto eliminado');
	 		}else{
	 			return back()->with('errormsj','¡Impuesto relacionado!');
	 		}

	 		
	 	}

	 
}
