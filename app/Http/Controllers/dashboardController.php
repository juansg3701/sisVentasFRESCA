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

	 			$fechaAno=date("Y");
	 			$fechaMes=date("m");
	 			$fechaDia=date("d");
	 			$fechaMesA=date('m', strtotime('-1 month'));
					
				$fecha_actual = date("Y-m");			
				$fecha1=date("Y-m",strtotime($fecha_actual."- 1 month")); 
				$fecha2=date("Y-m",strtotime($fecha_actual."- 2 month")); 
				$fecha3=date("Y-m",strtotime($fecha_actual."- 3 month")); 

	 			$fecha_dia = date("Y-m-d");

	 			//reporte ventas del dia

	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->get();

	 			$total_ventas=DB::table('factura as f')
	 			->select(DB::raw('sum(f.pago_total) as pago_total'))
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'desc')
	 			->get();

	 				if(auth()->user()->superusuario==0){
	 				$ventas=DB::table('factura as f')
		 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
		 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
		 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
		 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->orderBy('f.id_factura', 'asc')
		 			->get();

		 			$total_ventas=DB::table('factura as f')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select(DB::raw('sum(f.pago_total) as pago_total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->orderBy('f.id_factura', 'desc')
		 			->get();
		 			}

		 		//metodos de pago 52 en total

		 		$numeroSemanaActual = date("W"); 
		 		$semana_inicial=0;
		 		$semana_final=0;
			 		if($numeroSemanaActual>3){
			 			$semana_inicial=intval($numeroSemanaActual)-3;
			 			$semana_final=intval($numeroSemanaActual);
			 		}else{
			 			$semana_inicial=1;
			 			$semana_final=3;
			 		}

		 		$NoPagoEfectivo=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoTcredito=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoTdebito=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoLinkPago=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',5)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->orderBy('f.id_factura', 'desc')->get();

	 			if(auth()->user()->superusuario==0){
	 			$NoPagoEfectivo=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',1)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoTcredito=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',2)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoTdebito=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',3)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$NoPagoLinkPago=DB::table('factura as f')
	 			->select(DB::raw('count(*) as numero'))
	 			->where('f.tipo_pago_id_tpago','=',5)
	 			->where('f.fecha','LIKE', '%'.$fecha_dia.'%')
	 			->where('f.sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('f.id_factura', 'desc')->get();
	 			}

	 			$stock_semanal=DB::table('stock as s')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('WEEK(s.fecha_registro) as fecha_registro'))
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'>=',$semana_inicial)
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'<=',$semana_final)
	 			->where(DB::raw('YEAR(s.fecha_registro)'),'=',$fechaAno)
	 			->where('s.pago_pendiente','=',1)
	 			->orderBy(DB::raw('WEEK(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('WEEK(s.fecha_registro)'))
	 			->get();

	 			if(auth()->user()->superusuario==0){

	 			$stock_semanal=DB::table('stock as s')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select(DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('WEEK(s.fecha_registro) as fecha_registro'))
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'>=',$semana_inicial)
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'<=',$semana_final)
	 			->where(DB::raw('YEAR(s.fecha_registro)'),'=',$fechaAno)
	 			->where('s.pago_pendiente','=',1)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy(DB::raw('WEEK(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('WEEK(s.fecha_registro)'))
	 			->get();
	 			
	 			}




	 			return view('almacen.dashboard.index2',["clientes"=>$clientes,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2, "modulos"=>$modulos, "productos"=>$productos,"ventas"=>$ventas,"total_ventas"=>$total_ventas,"NoPagoEfectivo"=>$NoPagoEfectivo,"NoPagoTcredito"=>$NoPagoTcredito,"NoPagoTdebito"=>$NoPagoTdebito,"NoPagoLinkPago"=>$NoPagoLinkPago,"stock_semanal"=>$stock_semanal]);
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
