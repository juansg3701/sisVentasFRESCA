<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Caja;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CajaFormRequest;
use DB;

class CajaController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		
	 		if ($request){
	 			$query=trim($request->get('searchText'));
	 			$periodos=DB::table('p_tiempo')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$cajas=DB::table('caja as k')
	 			->join('empleado as u','k.empleado_id_empleado','=','u.id_empleado')
	 			->join('sede as s','k.sede_id_sede','=','s.id_sede')
	 			->select('k.id_caja','k.base_monetaria','k.ingresos_efectivo','k.ingresos_electronicos', 'k.egresos_efectivo', 'k.egresos_electronicos', 'k.ventas', 'k.fecha','u.nombre as empleado','s.nombre_sede as sede','k.sede_id_sede as sede_id_sede')
	 			
	 			->where('k.fecha','LIKE', '%'.$query.'%')
	 			->orderBy('k.id_caja', 'desc')
	 			->paginate(10);

	 			
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			return view('almacen.caja.registro',["periodos"=>$periodos, "usuarios"=>$usuarios,"sedes"=>$sedes,"cargos"=>$cargos,"cajas"=>$cajas,"searchText"=>$query, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function create(Request $request){ 
	 		if ($request) {
	 			
	 			$usuarios=DB::table('empleado')->get();
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();
	 			$cajas=DB::table('caja')
	 			->orderBy('id_caja', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			 $fechaActual=date('Y-m-d');

	 			$cuentas=DB::table('detalle_banco as db')
	 			->join('bancos as b','db.banco_idBanco','=','b.id_banco')
	 			->join('tipo_cuenta as tc','b.tipo_cuenta_id_tcuenta','=','tc.id_tcuenta')
	 			->select('db.ingreso_efectivo as iefectivo','db.egreso_efectivo as efectivo','db.ingreso_electronico as ielectronico','db.egreso_electronico as electronico','db.sede_id_sede as sede_id_sede')
	 			->where('db.fecha','LIKE', '%'.$fechaActual.'%')
	 			->orderBy('db.id_Dbanco', 'desc')->get();

	 			$ventasFac=DB::table('factura')
	 			->select(DB::raw('sum(pago_total) as total'))
	 			->where('fecha','LIKE', '%'.$fechaActual.'%')
	 			->where('facturaPaga','=','1')
	 			->orderBy('id_factura', 'desc')->get();
	 			

	 			return view('almacen.caja.index',["usuarios"=>$usuarios,"sedes"=>$sedes,"cargos"=>$cargos,"cajas"=>$cajas, "modulos"=>$modulos,"cuentas"=>$cuentas, "ventasFac"=>$ventasFac]);
	 		}
	 				
	 	}

	 	public function store(CajaFormRequest $request){
	 		$caja = new Caja;
	 		$caja->base_monetaria=$request->get('base_monetaria');
	 		$caja->ingresos_efectivo=$request->get('ingresos_efectivo');
	 		$caja->ingresos_electronicos=$request->get('ingresos_electronicos');
	 		$caja->egresos_efectivo=$request->get('egresos_efectivo');
	 		$caja->egresos_electronicos=$request->get('egresos_electronicos');
	 		$caja->ventas=$request->get('ventas');
	 		$caja->fecha=$request->get('fecha');
	 		$caja->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$caja->sede_id_sede=$request->get('sede_id_sede');
	 		$caja->save();

			return back()->with('msj','Caja guardada');

	 	}

	 	public function show($id){

	 		return view("almacen.caja.index.show",["caja"=>Caja::findOrFail($id)]);
	 	}

	 	public function edit($id){
	 		$sedes=DB::table('sede')->get();
	 		$periodos=DB::table('p_tiempo')->get();
	 		$usuarios=DB::table('empleado')->get();
	 		$cargos=DB::table('tipo_cargo')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 		return view("almacen.caja.edit",["periodos"=>$periodos,"cargos"=>$cargos, "usuarios"=>$usuarios,"sedes"=>$sedes,"caja"=>Caja::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 	public function update(CajaFormRequest $request, $id){
	 		$caja = Caja::findOrFail($id);
	 		$caja->base_monetaria=$request->get('base_monetaria');
	 		$caja->ingresos_efectivo=$request->get('ingresos_efectivo');
	 		$caja->ingresos_electronicos=$request->get('ingresos_electronicos');
	 		$caja->egresos_efectivo=$request->get('egresos_efectivo');
	 		$caja->egresos_electronicos=$request->get('egresos_electronicos');
	 		$caja->ventas=$request->get('ventas');
	 		$caja->fecha=$request->get('fecha');
	 		$caja->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$caja->sede_id_sede=$request->get('sede_id_sede');
	 		$caja->update();


			return back()->with('msj','Caja actualizada');

	 	}

	 	public function destroy($id){
	 		$caja=Caja::findOrFail($id);
	 		$caja->delete();

			return back()->with('msj','¡registro eliminado!');
	 	}
}
