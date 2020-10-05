<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Usuario;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsuarioFormRequest;
use DB;

class PermisoCuentaController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	}
	 	public function index(Request $request){
	 		

	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo')
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->where('s.nombre_sede','LIKE', '%'.$query1.'%')
	 			->where('c.nombre','LIKE', '%'.$query2.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.usuario.permiso.cuenta.index',["cargos"=>$cargos,"sedes"=>$sedes,"usuarios"=>$usuarios,"searchText"=>$query,"searchText1"=>$query,"searchText2"=>$query2, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function create(){ 		

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.usuario.registrar.index",["modulos"=>$modulos]);
	 	}

	 	public function store(UsuarioFormRequest $request){
	 		$usuario = new Usuario;
	 		$usuario->nombre=$request->get('nombre');
	 		$usuario->correo=$request->get('correo');
	 		$usuario->contrasena=$request->get('contrasena');
	 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
	 		$usuario->sede_id_sede=$request->get('sede_id_sede');
	 		$usuario->codigo=$request->get('codigo');
	 		$usuario->save();
	 		return Redirect::to("almacen/usuario/permiso/cuenta");
	 	}

	 	/*public function show($id){
	 		return view("almacen.sede.show",["sede"=>Sede::findOrFail($id)]);
	 	}*/

	 	public function edit($id){
	 		$cargos=DB::table('tipo_cargo')->get();
	 		$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen/usuario/permiso/cuenta.edit",["cargos"=>$cargos,"sedes"=>$sedes,"usuario"=>Usuario::findOrFail($id), "modulos"=>$modulos]);
	 	}
	 	
	 	public function update(UsuarioFormRequest $request, $id){
	 		$usuario = Usuario::findOrFail($id);
	 		//$sede->id_sede=$request->get('id_sede');
	 		$usuario->nombre=$request->get('nombre');
	 		$usuario->correo=$request->get('correo');
	 		$usuario->contrasena=$request->get('contrasena');
	 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
	 		$usuario->sede_id_sede=$request->get('sede_id_sede');
	 		$usuario->codigo=$request->get('codigo');
	 		$usuario->update();
	 		return Redirect::to('almacen/usuario/permiso/cuenta');
	 	}

	 	public function destroy($id){
	 		$usuario=Usuario::findOrFail($id);
	 		$usuario->delete();
	 		return Redirect::to('almacen/usuario/permiso/cuenta');
	 	}
	 
}
