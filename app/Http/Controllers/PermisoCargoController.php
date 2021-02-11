<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cargo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CargoFormRequest;
use DB;

class PermisoCargoController extends Controller
{
	public function __construct(){
			$this->middleware('auth');	

			 	} 

			 	//Función para redireccionar a la vista de cargos, donde se registran y muestran

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$cargos=DB::table('tipo_cargo as tp')
	 			->join('empleado as e','tp.empleado_id_empleado','=','e.id_empleado')
	 			->select('tp.id_cargo as id_cargo','tp.nombre as nombre','tp.descripcion as descripcion','tp.fecha as fecha','e.nombre as empleado')
	 			->where('tp.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('tp.id_cargo', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$modulosP=DB::table('tipo_cargo')
	 			->orderBy('id_cargo', 'desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			
	 			return view('almacen.usuario.permiso.cargo.index',["cargos"=>$cargos,"searchText"=>$query, "modulos"=>$modulos, "modulosP"=>$modulosP,"usuarios"=>$usuarios]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.usuario.permiso.cargo.index",["modulos"=>$modulos]);
	 	}

	 	//Método para guardar los cargos en la base de datos
	 	public function store(CargoFormRequest $request){
	 		$cargo = new Cargo;
	 		$cargo->nombre=$request->get('nombre');
	 		$cargo->descripcion=$request->get('descripcion');
	 		$cargo->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$cargo->fecha=$request->get('fecha');
			 		
	 		$cargo->save();

	 		return back()->with('msj','Cargo creado');
	 		
	 	}

	 	public function show($id){
	 		return view("almacen.usuario.permiso.cargo.show",["cargo"=>Cargo::findOrFail($id)]);
	 	}

	 	//Método para redirigir a la pantalla donde se editan los datos de los cargos
	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.usuario.permiso.cargo.edit",["cargo"=>Cargo::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 	//Método para actualizar los cargos en la base de datos
	 	public function update(CargoFormRequest $request, $id){
	 		$cargo = Cargo::findOrFail($id);
	 		
	 		$cargo->nombre=$request->get('nombre');
	 		$cargo->descripcion=$request->get('descripcion');
	 		$cargo->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$cargo->fecha=$request->get('fecha');
	 		$cargo->update();
	 		return back()->with('msj','Cargo editado');
	 	}

	 	//Método para eliminar los cargos en la base de datos, primero se valida si se relacionan con otras tablas para ser eliminados tambien de allí
	 	public function destroy($id){
	 		$id=$id;

	 		$existe=DB::table('empleado')
	 		->where('tipo_cargo_id_cargo','=',$id)
	 		->orderBy('id_empleado', 'desc')->get();


	 		if(count($existe)==0){
	 			$cargo=Cargo::findOrFail($id);
		 		$cargo->delete();
		 		return back()->with('msj','Cargo eliminado');
	 		}else{
	 			return back()->with('errormsj','¡Cargo usado en empleados!');
	 		}


	 		
	 	}

	 
}
