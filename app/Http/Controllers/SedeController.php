<?php

namespace sisVentas\Http\Controllers;
use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\SedeFormRequest;
use DB;

class SedeController extends Controller
{
	//Constructor
  	public function __construct(){
		$this->middleware('auth');	
	}

	//Función de inicial, retorna vista al módulo principal de sedes
 	public function index(Request $request){
 		if ($request) {
 			$query=trim($request->get('searchText'));
 			$sedes=DB::table('sede')
 			->where('nombre_sede','LIKE', '%'.$query.'%')
 			->orderBy('id_sede', 'desc')
 			->paginate(7);
 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
 			$modulos=DB::table('cargo_modulo')
 			->where('id_cargo','=',$cargoUsuario)
 			->orderBy('id_cargo', 'desc')->get();
 			$sedesP=DB::table('sede')->get();
 			return view('almacen.sede.index',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"sedesP"=>$sedesP]);
 		}
 	}

 	// Función que retorna una vista al registro de sedes
 	public function create(){
 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
 		$modulos=DB::table('cargo_modulo')
 		->where('id_cargo','=',$cargoUsuario)
 		->orderBy('id_cargo', 'desc')->get();
 		return view("almacen.sede.registrar", ["modulos"=>$modulos]);
 	}

 	// Función para registrar datos del formulario de registro de sedes a la BD
 	public function store(SedeFormRequest $request){
 		$sede = new Sede;
 		$sede->nombre_sede=$request->get('nombre_sede');
 		$sede->ciudad=$request->get('ciudad');
 		$sede->descripcion=$request->get('descripcion');
 		$sede->direccion=$request->get('direccion');
 		$sede->telefono=$request->get('telefono');
 		$sede->save();
 		return back()->with('msj','Sede guardada');
 	}

 	public function show($id){
 		return view("almacen.sede.show",["sede"=>Sede::findOrFail($id)]);
 	}

 	// Función que retorna una vista al formulario de edición de sedes
 	public function edit($id){
 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
 		$modulos=DB::table('cargo_modulo')
 		->where('id_cargo','=',$cargoUsuario)
 		->orderBy('id_cargo', 'desc')->get();
 			
 		return view("almacen.sede.edit",["sede"=>Sede::findOrFail($id), "modulos"=>$modulos]);
 	}

 	//Función para actualizar los datos en la BD que han sido editados en el formulario de edición de sedes
 	public function update(SedeFormRequest $request, $id){
 		$sede = Sede::findOrFail($id);
 		$sede->nombre_sede=$request->get('nombre_sede');
 		$sede->ciudad=$request->get('ciudad');
 		$sede->descripcion=$request->get('descripcion');
 		$sede->direccion=$request->get('direccion');
 		$sede->telefono=$request->get('telefono');
 		$sede->update();
 		return back()->with('msj','Sede actualizada');
 	}

 	//Función para eliminar el registro especificado en el módulo de sedes
 	public function destroy($id){
 		$id=$id;
 		$existeC=DB::table('caja')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_caja', 'desc')->get();
 		$existeCI=DB::table('c_inventario')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_corte', 'desc')->get();
 		$existeD=DB::table('descuentos')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_descuento', 'desc')->get();
 		$existeDB=DB::table('detalle_banco')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_Dbanco', 'desc')->get();
 		$existeE=DB::table('empleado')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_empleado', 'desc')->get();
 		$existeM=DB::table('m_stock')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_mstock', 'desc')->get();
 		$existeS=DB::table('stock')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id_stock', 'desc')->get();
 		$existeU=DB::table('users')
 		->where('sede_id_sede','=',$id)
 		->orderBy('id', 'desc')->get();
 		if(count($existeC)==0 && count($existeCI)==0 && count($existeD)==0 && count($existeDB)==0 && count($existeE)==0 && count($existeM)==0 && count($existeS)==0 && count($existeU)==0){
	 		$sede=Sede::findOrFail($id);
	 		$sede->delete();
 			return back()->with('msj','Sede eliminada');
 		}else{
 			return back()->with('errormsj','¡Sede relacionada!');	 			
 		}	
 	}
}
