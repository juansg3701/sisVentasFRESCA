<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ClienteFormRequest;
use DB;


class dashboardController extends Controller
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

	 			//PARA BD GENERAL
	 			$productos=ProductoSede::where('fecha_registro','>=',"01/01/2019")
	 			->where('fecha_registro','<=',"12/12/2020")
	 			->select('id_producto','nombre','plu','ean','c.nombre as categoria_id_categoria','unidad_de_medida','precio','i.nombre as impuestos_id_impuestos','stock_minimo')
	 			->join('categoria_productos as c','categoria_id_categoria','=','c.id_categoria')
	 			->join('impuestos as i','impuestos_id_impuestos','=','i.id_impuestos')
    			->paginate(10);

	 			$fechaAño=date("Y");
	 			$fechaMes=date("m");
	 			$fechaDia=date("d");
	 			$fechaMesA=date('m', strtotime('-1 month'));
					
				$fecha_actual = date("Y-m");			
				$fecha1=date("Y-m",strtotime($fecha_actual."- 1 month")); 
				$fecha2=date("Y-m",strtotime($fecha_actual."- 2 month")); 
				$fecha3=date("Y-m",strtotime($fecha_actual."- 3 month")); 

	 			

	 			return view('almacen.dashboard.index2',["clientes"=>$clientes,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2, "modulos"=>$modulos, "productos"=>$productos]);
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
	 		$cliente = new Cliente;
	 		$cliente->nombre=$request->get('nombre');
	 		$cliente->direccion=$request->get('direccion');
	 		$cliente->telefono=$request->get('telefono');
	 		$cliente->correo=$request->get('correo');
	 		$cliente->documento=$request->get('documento');
	 		$cliente->verificacion_nit=$request->get('verificacion_nit');
	 		$cliente->nombre_empresa=$request->get('nombre_empresa');
	 		$cliente->cartera_activa=$request->get('cartera_activa');
	 		$cliente->save();
	 		return Redirect::to('almacen/cliente');
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
	 		$cliente = Cliente::findOrFail($id);
	 		$cliente->nombre=$request->get('nombre');
	 		$cliente->direccion=$request->get('direccion');
	 		$cliente->telefono=$request->get('telefono');
	 		$cliente->correo=$request->get('correo');
	 		$cliente->documento=$request->get('documento');
	 		$cliente->verificacion_nit=$request->get('verificacion_nit');
	 		$cliente->nombre_empresa=$request->get('nombre_empresa');
	 		$cliente->cartera_activa=$request->get('cartera_activa');
	 		$cliente->update();
	 		return Redirect::to('almacen/cliente');
	 	}

	 	public function destroy($id){
	 		$cliente=Cliente::findOrFail($id);
	 		$cliente->delete();
	 		return Redirect::to('almacen/cliente');
	 	}
}
