<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\User;
use sisVentas\Usuario;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsersFormRequest;
use DB;

class RegistrarController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	}
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo')
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.usuario.registrar.index',["cargos"=>$cargos,"sedes"=>$sedes, "usuarios"=>$usuarios,"searchText"=>$query, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function create(){ 

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 				
	 		return view("almacen.usuario.iniciar.sesionIniciada", ["modulos"=>$modulos]);	
	 	}

	 	public function store(UsersFormRequest $request){

	 		$nombreR=$request->get('name');
	 		$correoR=$request->get('email');
	 		$contrasenaR=bcrypt($request->get('password'));
	 		$cargoR=$request->get('tipo_cargo_id_cargo');
	 		$sedeR=$request->get('sede_id_sede');
	 		$codigoR=$request->get('codigo');

	 		$CorreoRegis=DB::table('empleado')
	 		->where('correo','=',$correoR)
	 		->orderBy('id_empleado','desc')->get();

	 		$CodigoRegis=DB::table('empleado')
	 		->where('codigo','=',$codigoR)
	 		->orderBy('id_empleado','desc')->get();

	 		if(count($CorreoRegis)==0){
	 			if(count($CodigoRegis)==0){
	 				$usuario = new User;
			 		$usuario->name=$nombreR;
			 		$usuario->email=$correoR;
			 		$usuario->password=$contrasenaR;
			 		$usuario->tipo_cargo_id_cargo=$cargoR;
			 		$usuario->sede_id_sede=$sedeR;
			 		$usuario->save();

			 		$empleadoU= new Usuario;
			 		$empleadoU->nombre=$nombreR;
			 		$empleadoU->user_id_user=$usuario->id;
			 		$empleadoU->correo=$correoR;
			 		$empleadoU->contrasena=$contrasenaR;	
			 		$empleadoU->tipo_cargo_id_cargo=$cargoR;
			 		$empleadoU->sede_id_sede=$sedeR;
			 		$empleadoU->codigo=$codigoR;
			 		$empleadoU->contrasena2=$contrasenaR;
			 		$empleadoU->save();
   	
					return back()->with('msj','Usuario guardado');
	 			}else{
	 				return back()->with('errormsj','¡Código ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡Correo ya registrado!');
	 		}
	 		
	 		
	 	}


	
	 	public function update(UsersFormRequest $request, $id){
	 		$usuario = User::findOrFail($id);
	 		$usuario->name=$request->get('name');
	 		$usuario->email=$request->get('email');
	 		$usuario->password=bcrypt($request->get('password'));
	 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
	 		$usuario->sede_id_sede=$request->get('sede_id_sede');
	 		$usuario->update();
   	
			return Redirect::to('almacen/usuario/registrar');
	 		
	 	}

	 	
	 	public function show($id){
	 		return view("almacen.usuario.registrar.index.show",["usuario"=>Usuario::findOrFail($id)]);
	 	}


	 
}
