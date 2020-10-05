<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
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

	 			$productos=DB::table('producto as p')
	 			->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 			->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo')
	 			->where('p.fecha_registro','>=',"01/01/2019")
	 			->where('p.fecha_registro','<=',"12/12/2020")
	 			->orderBy('p.id_producto', 'desc')
	 			->paginate(10);

	 			$fechaAño=date("Y");
	 			$fechaMes=date("m");
	 			$fechaDia=date("d");
	 			$fechaMesA=date('m', strtotime('-1 month'));
					
				$fecha_actual = date("Y-m");			
				$fecha1=date("Y-m",strtotime($fecha_actual."- 1 month")); 
				$fecha2=date("Y-m",strtotime($fecha_actual."- 2 month")); 
				$fecha3=date("Y-m",strtotime($fecha_actual."- 3 month")); 


	 			$tp=DB::table('detalle_banco')
				->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
				->where('fecha','LIKE','%'.$fechaAño.'-'.$fechaMes.'%')
	 			->orderBy('id_Dbanco', 'desc')->get();

	 			$tpD=DB::table('detalle_banco')
				->select(DB::raw('sum(ingreso_efectivo) as ief'),DB::raw('sum(egreso_efectivo) as Eef'),DB::raw('sum(ingreso_electronico) as iel'),DB::raw('sum(egreso_electronico) as Eel'))
				->where('fecha','LIKE','%'.$fechaAño.'-'.$fechaMes.'-'.$fechaDia.'%')
	 			->orderBy('id_Dbanco', 'desc')->get();

	 			$tp1=DB::table('detalle_banco')
				->select(DB::raw('sum(ingreso_efectivo+ingreso_electronico) as ief'))
				->where('fecha','LIKE','%'.$fecha1.'%')
	 			->orderBy('id_Dbanco', 'desc')->get();

	 			$tp2=DB::table('detalle_banco')
				->select(DB::raw('sum(ingreso_efectivo+ingreso_electronico) as ief'))
				->where('fecha','LIKE','%'.$fecha2.'%')
	 			->orderBy('id_Dbanco', 'desc')->get();

	 			$tp3=DB::table('detalle_banco')
				->select(DB::raw('sum(ingreso_efectivo+ingreso_electronico) as ief'))
				->where('fecha','LIKE','%'.$fecha3.'%')
	 			->orderBy('id_Dbanco', 'desc')->get();

	 			$carteraPago=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','0')
	 			->where('fecha','LIKE','%'.$fecha1.'%')
	 			->orderBy('id_cartera', 'desc')->get();

	 			$carteraPago1=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','0')
	 			->where('fecha','LIKE','%'.$fecha2.'%')
	 			->orderBy('id_cartera', 'desc')->get();

	 			$carteraPago2=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','0')
	 			->where('fecha','LIKE','%'.$fecha3.'%')
	 			->orderBy('id_cartera', 'desc')->get();

	 			$carteraCobro=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','1')
	 			->where('fecha','LIKE','%'.$fecha1.'%')
	 			->orderBy('id_cartera', 'desc')->get();

	 			$carteraCobro1=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','1')
	 			->where('fecha','LIKE','%'.$fecha2.'%')
	 			->orderBy('id_cartera', 'desc')->get();

	 			$carteraCobro2=DB::table('cartera')
	 			->select(DB::raw('sum(total) as total'))			
	 			->where('atraso','=','1')
	 			->where('fecha','LIKE','%'.$fecha3.'%')
	 			->orderBy('id_cartera', 'desc')->get();
	 			

	 			return view('almacen.dashboard.index2',["clientes"=>$clientes,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2, "modulos"=>$modulos, "productos"=>$productos,"tp"=>$tp,"tp2"=>$tp2,"tp1"=>$tp1,"tp3"=>$tp3,"tpD"=>$tpD, "carteraPago"=>$carteraPago,"carteraPago1"=>$carteraPago1,"carteraPago2"=>$carteraPago2,"carteraCobro"=>$carteraCobro, "carteraCobro1"=>$carteraCobro1, "carteraCobro2"=>$carteraCobro2]);
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
