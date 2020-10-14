<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\CargoModulo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CargoModuloFormRequest;
use DB;

class PermisoUsuarioController extends Controller
{

	  public function __construct(){
			$this->middleware('auth');	

			 	}
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));

	 			$cargos=DB::table('tipo_cargo')->get();

	 			$ModulosGenerales=DB::table('cargo_modulo as cm')
	 			->join('tipo_cargo as c','cm.id_cargo','=','c.id_cargo')
	 			->select('c.nombre as nombre','cm.id_modulo as id_modulo','c.id_cargo as id_cargo')
	 			->where('cm.id_cargo','LIKE', '%'.$query.'%')
	 			->orderBy('cm.id_modulo', 'asc')
	 			->get();

	 			$mod=DB::table('modulos')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.usuario.permiso.usuario.index',["cargos"=>$cargos,"searchText"=>$query, "modulos"=>$modulos,"ModulosGenerales"=>$ModulosGenerales,"mod"=>$mod]);
	 		}
	 	}

		public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.usuario.permiso.usuario.registrar", ["modulos"=>$modulos]);
	 		
	 	}

	 	public function store(CargoModuloFormRequest $request){
	 		
	 		$existe=false;
	 		$idcargo=$request->get('id_cargo');
	 		$modulosC=DB::table('cargo_modulo')->get();
	 		$idmodulo=$request->get('id_modulo');	
	 		foreach ($modulosC as $mc) {
	 			if($idcargo==$mc->id_cargo && $idmodulo==$mc->id_modulo){
	 			$existe=true;
	 			}	 		
	 		}
	 		 

	 		if($existe==false){
	 		$cm = new CargoModulo;
	 		$cm->id_cargo=$idcargo;
	 		$cm->id_modulo=$idmodulo; 		
	 		$cm->save();
	 		return back()->with('msj','Permiso guardado');
	 		}
	 		else{
	 			return back()->with('errormsj','¡Error al guardar, permiso ya registrado!');
	 		}

			

	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.usuario.permiso.usuario.edit",["cliente"=>CargoModulo::findOrFail($id), "modulos"=>$modulos]);
	 	}
	 		public function show($id){
	 		return view("almacen.usuario.permiso.usuario.show",["cliente"=>CargoModulo::findOrFail($id)]);
	 	}

	 	public function update(Request $request, $id){
	 		$cargo=$request->get('id_cargo');
	 		$modulo=$request->get('id_modulo');

	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargo)
	 		->where('id_modulo','=',$modulo)
	 		->orderBy('id_cargo', 'desc')->get();

	 		if(count($modulos)>0){
		 		foreach ($modulos as $m) {
		 			$mo = CargoModulo::findOrFail($m->id_cargoModulo);
		 			$mo->delete();
		 		}

	 		return back()->with('msj','Permiso eliminado');
	 		}
	 		else{
	 			return back()->with('errormsj','¡Error al eliminar, el permiso no existe!');
	 		}
	 	}

	 	public function destroy($id){
	 		$cm=CargoModulo::findOrFail($id);
	 		$cm->delete();
	 		return Redirect::to('almacen/usuario/permiso/usuario');
	 	}

}
