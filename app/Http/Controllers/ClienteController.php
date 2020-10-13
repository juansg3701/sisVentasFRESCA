<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$clientes=DB::table('cliente')
	 			->where('nombre','LIKE', '%'.$query0.'%')
	 			->where('documento','LIKE', '%'.$query1.'%')
	 			->where('telefono','LIKE', '%'.$query2.'%')
	 			->orderBy('nombre', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			return view('almacen.cliente.index',["clientes"=>$clientes,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2, "modulos"=>$modulos,"clientesP"=>$clientesP]);
	 		}
	 	}
	 	public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.cliente.registrar",["modulos"=>$modulos]);
	 		
	 	}

	 	public function store(ClienteFormRequest $request){
	 		$documentoR=$request->get('documento');
	 		$correoR=$request->get('correo');

	 		$DocumenRegis=DB::table('cliente')
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();

	 		$CorreoRegis=DB::table('cliente')
	 		->where('correo','=',$correoR)
	 		->orderBy('id_cliente','desc')->get();

	 		if(count($DocumenRegis)==0){
	 			if(count($CorreoRegis)==0){
	 				$cliente = new Cliente;
			 		$cliente->nombre=$request->get('nombre');
			 		$cliente->direccion=$request->get('direccion');
			 		$cliente->telefono=$request->get('telefono');
			 		$cliente->correo=$correoR;
			 		$cliente->documento=$documentoR;
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		//$cliente->cartera_activa=$request->get('cartera_activa');
			 		$cliente->save();	


				 		return back()->with('msj','Cliente guardado');

	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}

	 		}else{
	 			return back()->with('errormsj','¡Documento ya registrado!');
	 		}
	
	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			
	 		return view("almacen.cliente.edit",["cliente"=>Cliente::findOrFail($id), "modulos"=>$modulos]);
	 	}
	 		public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(ClienteFormRequest $request, $id){
	 		$id=$id;
	 		$documentoR=$request->get('documento');
	 		$correoR=$request->get('correo');

	 		$DocumenRegis=DB::table('cliente')
	 		->where('id_cliente','!=',$id)
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();

	 		$CorreoRegis=DB::table('cliente')
	 		->where('id_cliente','!=',$id)
	 		->where('correo','=',$correoR)
	 		->orderBy('id_cliente','desc')->get();

	 		if(count($DocumenRegis)==0){
	 			if(count($CorreoRegis)==0){
	 				$cliente = Cliente::findOrFail($id);
			 		$cliente->nombre=$request->get('nombre');
			 		$cliente->direccion=$request->get('direccion');
			 		$cliente->telefono=$request->get('telefono');
			 		$cliente->correo=$correoR;
			 		$cliente->documento=$documentoR;
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		$cliente->cartera_activa=$request->get('cartera_activa');
			 		$cliente->update();
			 		return back()->with('msj','Cliente actualizado');

	 			}else{
	 				return back()->with('errormsj','Correo ya registrado!');
	 			}

	 		}else{
	 			return back()->with('errormsj','¡Documento ya registrado!');
	 		}

	 	}

	 	public function destroy($id){
	 	$id=$id;

	 		$existe=DB::table('factura')
	 		->where('cliente_id_cliente','=',$id)
	 		->orderBy('id_factura', 'desc')->get();

	 		$existeC=DB::table('cartera')
	 		->where('cliente_id_cliente','=',$id)
	 		->orderBy('id_cartera', 'desc')->get();

	 		if(count($existe)==0 && count($existeC)==0){
	 			$cliente=Cliente::findOrFail($id);
		 		$cliente->delete();
		 		return back()->with('msj','Cliente eliminado');
	 		}else{
	 				return back()->with('errormsj','¡Cliente relacionado con factura o cartera!');
	 			}

	 		
	 	}
}
