<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\User;
use sisVentas\Usuario;
use sisVentas\PuntoVenta;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsersFormRequest;
use DB;

class UsersController extends Controller
{
 
    public function _contruct(){
    	$this->middleware('auth');
    }

    //Redirecciona para mostrar las cuentas creadas
public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));

	 			$usuarios=User::where('name','LIKE', '%'.$query.'%')
	 			->orderBy('id', 'desc')
    			->paginate(10);

	 			if($query2!=""){
		 			$nombreCargo=DB::table('tipo_cargo')
		 			->where('nombre','LIKE','%'.$query2.'%')
		 			->get();

		 			$usuarios=User::where('name','LIKE', '%'.$query.'%')
					->where('tipo_cargo_id_cargo','LIKE', '%'.$nombreCargo[0]->id_cargo.'%')
	    			->paginate(10);
	 			}
	 			if($query1!=""){
	 				$nombreSede=DB::table('sede')
		 			->where('nombre_sede','LIKE','%'.$query1.'%')
		 			->get();
		 			$usuarios=User::where('name','LIKE', '%'.$query.'%')
					->where('sede_id_sede','LIKE', '%'.$nombreSede[0]->id_sede.'%')
	    			->paginate(10);
	 			}


	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$usersP=User::get();
	 			$punto_venta=PuntoVenta::get();

	 			return view('almacen.usuario.permiso.cuenta.index',["cargos"=>$cargos,"sedes"=>$sedes,"usuarios"=>$usuarios,"searchText"=>$query, "searchText1"=>$query1, "searchText2"=>$query2, "modulos"=>$modulos,"punto_venta"=>$punto_venta]);
	 		}
	 	}

	 	public function create(){ 

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 		return view("almacen.usuario.registrar.index",["modulos"=>$modulos]);	
	 	}

	 	public function store(UsersFormRequest $request){
	 		$usuario = new User;
	 		$usuario->name=$request->get('name');
	 		$usuario->email=$request->get('email');
	 		$usuario->password=bcrypt($request->get('password'));
	 		$usuario->tipo_cargo_id_cargo=$request->get('tipo_cargo_id_cargo');
	 		$usuario->sede_id_sede=$request->get('sede_id_sede');
	 		$usuario->save();
   	
			return Redirect::to('almacen/usuario/registrar');
	 		
	 	}

	 	//redirige a la pantalla para editar la cuenta
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
	 			$punto_venta=PuntoVenta::get();
	 			
	 		return view("almacen/usuario/permiso/cuenta.edit",["cargos"=>$cargos,"sedes"=>$sedes,"usuario"=>Usuario::findOrFail($idEmpleado[0]->id), "modulos"=>$modulos,"punto_venta"=>$punto_venta]);
	 	}

	 	public function update(NominaUsuFormRequest $request, $id){
	 		$id=$id;
	 		$correoR=$request->get('correo');
	 		$contrasenaR=$request->get('contrasena');
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
				 		$usuario->contrasena=$contrasenaR;
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
							$us->password=bcrypt($contrasenaR);
							$us->tipo_cargo_id_cargo=$cargoR;
							$us->sede_id_sede=$sedeR;
							$us->save();

							$usuario = Usuario::findOrFail($id);
					 		$usuario->nombre=$nombreR;
					 		$usuario->correo=$correoR;
					 		$usuario->contrasena=bcrypt($contrasenaR);
					 		$usuario->tipo_cargo_id_cargo=$cargoR;
					 		$usuario->sede_id_sede=$sedeR;
					 		$usuario->codigo=$codigoR;
					 		$usuario->user_id_user=$us->id;
					 		$usuario->update();
				 			}else{
				 			

							$usuario = Usuario::findOrFail($id);
					 		$usuario->nombre=$nombreR;
					 		$usuario->correo=$correoR;
					 		$usuario->contrasena=$contrasenaR;
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
	 		$id=$id;
	 		$user1=User::findOrFail($id);
	 		$usuario=Usuario::findOrFail($user1->id);
	 		$usuario->delete();
	 		$user1->delete();

	 		return back()->with('msj','Cuenta eliminada');

	 	}


	 	public function show($id){
	 		return view("almacen.usuario.registrar.index.show",["usuario"=>Usuario::findOrFail($id)]);
	 	}

}
