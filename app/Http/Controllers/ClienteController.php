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
	 			$query3=trim($request->get('searchText3'));
	 			$query4=trim($request->get('searchText4'));
	 			$query5=trim($request->get('searchText5'));

	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			$categoria_cliente=DB::table('categoria_cliente')->get();


	 			if($query3=="Todas las categorías"){

		 			$clientes=DB::table('cliente as c')
		 			->join('empleado as u','c.empleado_id_empleado','=','u.id_empleado')
		 			->join('sede as s','c.sede_id_sede','=','s.id_sede')
		 			->join('categoria_cliente as cc','c.categoria_cliente_id_categoria','=','cc.id_categoria')
		 			->select('c.id_cliente','c.nombre','c.nombre_empresa','c.direccion', 'c.telefono', 'c.correo', 'c.documento','c.nit', 'c.verificacion_nit','cc.nombre as categoria_cliente_id_categoria','s.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado', 'c.fecha')
		 			->where('c.nombre','LIKE', '%'.$query0.'%')
		 			->where('c.documento','LIKE', '%'.$query1.'%')
		 			->where('c.telefono','LIKE', '%'.$query2.'%')
		 			->where('c.nit','LIKE', '%'.$query4.'%')
		 			->where('c.verificacion_nit','LIKE', '%'.$query5.'%')
		 			->orderBy('c.id_cliente', 'desc')
		 			->paginate(10);

				}else{

		 			$clientes=DB::table('cliente as c')
		 			->join('empleado as u','c.empleado_id_empleado','=','u.id_empleado')
		 			->join('sede as s','c.sede_id_sede','=','s.id_sede')
		 			->join('categoria_cliente as cc','c.categoria_cliente_id_categoria','=','cc.id_categoria')
		 			->select('c.id_cliente','c.nombre','c.nombre_empresa','c.direccion', 'c.telefono', 'c.correo', 'c.documento','c.nit', 'c.verificacion_nit','cc.nombre as categoria_cliente_id_categoria','s.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado', 'c.fecha')
		 			->where('c.nombre','LIKE', '%'.$query0.'%')
		 			->where('c.documento','LIKE', '%'.$query1.'%')
		 			->where('c.telefono','LIKE', '%'.$query2.'%')
		 			->where('cc.nombre','LIKE', '%'.$query3.'%')
		 			->where('c.nit','LIKE', '%'.$query4.'%')
		 			->where('c.verificacion_nit','LIKE', '%'.$query5.'%')
		 			->orderBy('c.id_cliente', 'desc')
		 			->paginate(10);
				}

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			return view('almacen.cliente.cliente.index',["clientes"=>$clientes,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2, "searchText3"=>$query3,"searchText4"=>$query4, "searchText5"=>$query5, "modulos"=>$modulos,"clientesP"=>$clientesP, "usuarios"=>$usuarios, "sedes"=>$sedes, "categoria_cliente"=>$categoria_cliente]);
	 		}
	 	}
	 	public function create(){

	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			$categoria_cliente=DB::table('categoria_cliente')->get();

	 			$clientes=DB::table('cliente as c')
	 			->join('empleado as u','c.empleado_id_empleado','=','u.id_empleado')
	 			->join('sede as s','c.sede_id_sede','=','s.id_sede')
	 			->join('categoria_cliente as cc','c.categoria_cliente_id_categoria','=','cc.id_categoria')
	 			->select('c.id_cliente','c.nombre','c.nombre_empresa','c.direccion', 'c.telefono', 'c.correo', 'c.documento', 'c.verificacion_nit','cc.nombre as categoria_cliente_id_categoria','s.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado')
	 			->orderBy('c.nombre', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.cliente.cliente.registrar",["modulos"=>$modulos, "usuarios"=>$usuarios, "sedes"=>$sedes, "categoria_cliente"=>$categoria_cliente]);
	 		
	 	}

	 	public function store(ClienteFormRequest $request){
	 		$documentoR=$request->get('documento');
	 		$nitR=$request->get('nit');
	 		$correoR=$request->get('correo');

	 		if($documentoR!=""){
	 			$DocumenRegis=DB::table('cliente')
	 		->where('documento','=',$documentoR)
	 		->orderBy('id_cliente','desc')->get();
	 		}else{
	 			$DocumenRegis=DB::table('cliente')
	 		->where('documento','=',"NINGUNO")
	 		->orderBy('id_cliente','desc')->get();	
	 		}
	 		

	 		$nitRegis=DB::table('cliente')
	 		->where('nit','=',$nitR)
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
			 		$cliente->nit=$request->get('nit');
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		$cliente->fecha=$request->get('fecha');
			 		$cliente->empleado_id_empleado=$request->get('empleado_id_empleado');
			 		$cliente->sede_id_sede=$request->get('sede_id_sede');
			 		$cliente->categoria_cliente_id_categoria=$request->get('categoria_cliente_id_categoria');
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

	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			$categoria_cliente=DB::table('categoria_cliente')->get();

	 			$clientes=DB::table('cliente as c')
	 			->join('empleado as u','c.empleado_id_empleado','=','u.id_empleado')
	 			->join('sede as s','c.sede_id_sede','=','s.id_sede')
	 			->join('categoria_cliente as cc','c.categoria_cliente_id_categoria','=','cc.id_categoria')
	 			->select('c.id_cliente','c.nombre','c.nombre_empresa','c.direccion', 'c.telefono', 'c.correo', 'c.documento', 'c.verificacion_nit','cc.nombre as categoria_cliente_id_categoria','s.nombre_sede as sede_id_sede', 'u.nombre as empleado_id_empleado')
	 			->orderBy('c.nombre', 'desc')
	 			->paginate(10);
	 			
	 		return view("almacen.cliente.cliente.edit",["cliente"=>Cliente::findOrFail($id), "modulos"=>$modulos, "usuarios"=>$usuarios, "sedes"=>$sedes, "categoria_cliente"=>$categoria_cliente]);
	 	}
	 		public function show($id){
	 		return view("almacen.cliente.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
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
			 		$cliente->nit=$request->get('nit');
			 		$cliente->verificacion_nit=$request->get('verificacion_nit');
			 		$cliente->nombre_empresa=$request->get('nombre_empresa');
			 		$cliente->fecha=$request->get('fecha');
			 		$cliente->empleado_id_empleado=$request->get('empleado_id_empleado');
			 		$cliente->sede_id_sede=$request->get('sede_id_sede');
			 		$cliente->categoria_cliente_id_categoria=$request->get('categoria_cliente_id_categoria');
			 		//$cliente->cartera_activa=$request->get('cartera_activa');
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
	 		$cliente=Cliente::findOrFail($id);
			$cliente->delete();
			return back()->with('msj','Cliente eliminado');

	 		/*$existe=DB::table('factura')
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
	 			}*/
	
	 	}
}
