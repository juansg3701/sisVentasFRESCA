<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Usuario;
use sisVentas\User;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\NominaUsuFormRequest;
use DB;

class EmpleadoController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	} 

		//Redirige para ver todos los empleados con todos los campos
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));

	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','u.sede_id_sede as sede_id_sede','u.tipo_cargo_id_cargo as tipo_cargo_id_cargo','u.user_id_user as user_id_user','u.telefono as telefono','u.documento as documento','u.direccion as direccion')
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);

	 			if($query2!=""){
		 			$nombreCargo=DB::table('tipo_cargo')
		 			->where('nombre','LIKE','%'.$query2.'%')
		 			->get();



	    			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','u.sede_id_sede as sede_id_sede','u.tipo_cargo_id_cargo as tipo_cargo_id_cargo','u.user_id_user as user_id_user','u.telefono as telefono','u.documento as documento','u.direccion as direccion')
	 			->where('u.tipo_cargo_id_cargo','LIKE', '%'.$nombreCargo[0]->id_cargo.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);
	 			}
	 			if($query1!=""){
	 				$nombreSede=DB::table('sede')
		 			->where('nombre_sede','LIKE','%'.$query1.'%')
		 			->get();

		 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','u.sede_id_sede as sede_id_sede','u.tipo_cargo_id_cargo as tipo_cargo_id_cargo','u.user_id_user as user_id_user','u.telefono as telefono','u.documento as documento','u.direccion as direccion')
	 			->where('u.sede_id_sede','LIKE', '%'.$nombreSede[0]->id_sede.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);
	 			}


	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$usersP=User::get();

	 			return view('almacen.usuario.permiso.cuenta.empleados',["cargos"=>$cargos,"sedes"=>$sedes,"usuarios"=>$usuarios,"searchText"=>$query, "searchText1"=>$query1, "searchText2"=>$query2, "modulos"=>$modulos]);
	 		}
	 	}
	 		
	 	

	 	public function store(NominaUsuFormRequest $request){
	 		$codigoR=$request->get('codigo');

	 		$CodigoRegis=DB::table('empleado')
	 		->where('codigo','=',$codigoR)
	 		->orderBy('id_empleado','desc')->get();

	 		
	 			if(count($CodigoRegis)==0){
	 				$usuario = new Usuario;
			 		$usuario->nombre=$request->get('nombre');
			 		$usuario->correo=$request->get('correo');	
			 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
			 		$usuario->sede_id_sede=$request->get('sede_id_sede');
			 		$usuario->codigo=$codigoR;
			 		$usuario->contrasena2=$request->get('contrasena2');
			 		$usuario->save();

	 			return back()->with('msj','Empleado guardado');
	 			}else{
	 				return back()->with('errormsj','¡Código ya registrado!');
	 			}

	 		

	 	}

	 	//redirige para editar el empleado
	 	public function edit($id){
	 		$id=$id;
	 		$cargos=DB::table('tipo_cargo')->get();
	 		$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$idEmpleado=DB::table('empleado')
	 			->select('id_empleado as id')
	 			->where('user_id_user','=',$id)
	 			->orderBy('id_empleado', 'desc')->get();
	 			
	 		return view("almacen/usuario/permiso/cuenta.empleadoEditar",["cargos"=>$cargos,"sedes"=>$sedes,"usuario"=>Usuario::findOrFail($idEmpleado[0]->id), "modulos"=>$modulos]);
	 	}
	 	
	 	//Actualizacion de datos en las cuentas
	 	public function update(NominaUsuFormRequest $request, $id){
	 		$id=$id;
	 		$correoR=$request->get('correo');
	 		$codigoR=$request->get('codigo');

	 		$nombreR=$request->get('nombre');
	 		$cargoR=$request->get('tipo_cargo_id_cargo');
	 		$sedeR=$request->get('sede_id_sede');

	 		$CorreoRegis=DB::table('empleado')
	 		->where('correo','=',$correoR)
	 		->where('id_empleado','!=',$id)
	 		->orderBy('id_empleado','desc')->get();

	 		$CodigoRegis=DB::table('empleado')
	 		->where('codigo','=',$codigoR)
	 		->where('id_empleado','!=',$id)
	 		->orderBy('id_empleado','desc')->get();

	 		if(count($CorreoRegis)==0){
	 			if(count($CodigoRegis)==0){

	 					if($correoR=="" && $contrasenaR==""){

				 		$usuario = Usuario::findOrFail($id);
				 		$usuario->nombre=$nombreR;
				 		$usuario->correo=$correoR;
				 		$usuario->tipo_cargo_id_cargo=$cargoR;
				 		$usuario->sede_id_sede=$sedeR;
				 		$usuario->codigo=$codigoR;
				 		$usuario->update();

				 		return back()->with('msj','Empleado actualizado');
				 		}else{

				 			$empleadoR=DB::table('empleado')
				 			->select("user_id_user as user_id")
					 		->where('id_empleado','=',$id)
					 		->orderBy('id_empleado','desc')->get();

				 		

					 		$usuarioR=User::where('id','=',$empleadoR[0]->user_id)
			    			->paginate(10);

				 			if(count($usuarioR)==0){
				 			$us = new User;
							$us->name=$nombreR;
							$us->email=$correoR;
							$us->tipo_cargo_id_cargo=$cargoR;
							$us->sede_id_sede=$sedeR;
							$us->save();

							$usuario = Usuario::findOrFail($id);
					 		$usuario->nombre=$nombreR;
					 		$usuario->correo=$correoR;
					 		$usuario->tipo_cargo_id_cargo=$cargoR;
					 		$usuario->sede_id_sede=$sedeR;
					 		$usuario->codigo=$codigoR;
					 		$usuario->user_id_user=$us->id;
					 		$usuario->update();
				 			}else{
				 			

							$usuario = Usuario::findOrFail($id);
					 		$usuario->nombre=$nombreR;
					 		$usuario->correo=$correoR;
					 		$usuario->tipo_cargo_id_cargo=$cargoR;
					 		$usuario->sede_id_sede=$sedeR;
					 		$usuario->codigo=$codigoR;
					 		

					 		$us = User::findOrFail($usuario->user_id_user);
							$us->name=$nombreR;
							$us->email=$correoR;
							$us->tipo_cargo_id_cargo=$cargoR;
							$us->sede_id_sede=$sedeR;
							$us->update();

							$usuario->user_id_user=$us->id;
					 		$usuario->update();
				 			}

				 			
				 		return back()->with('msj', 'Cuenta actualizada');
				 		}

	 			}else{
	 				return back()->with('errormsj','¡Código ya registrado!');
	 				}
	 		}else{
	 				return back()->with('errormsj','¡Correo ya registrado!');
	 			}	

	 	}

	 	public function destroy($id){
	 		$usuario=Usuario::findOrFail($id);
	 		$usuario->delete();
	 		return Redirect::to('almacen/nomina/empleado');
	 	}
	 	public function show(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','s.id_sede as sede_id_sede')
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$empleadoP=DB::table('empleado')->get();

	 			return view("almacen.nomina.empleado.lista.index",["cargos"=>$cargos,"sedes"=>$sedes,"usuarios"=>$usuarios, "searchText"=>$query, "modulos"=>$modulos,"empleadoP"=>$empleadoP]);
	 	}
	 	}
		 
}