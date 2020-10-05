<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\FacturaPagar;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaPagarFormRequest;
use DB;


class FacturasPagarController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$bancos=DB::table('bancos')->get();
	 			if ($query1=="Todos los bancos") {
	 				$facturasPagar=DB::table('ctas_a_pagar as cp')
	  			->join('bancos as b','cp.bancos_id_banco','=','b.id_banco')	
	  			->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
	 			->select('cp.id_ctaspagar','cp.fecha','cp.nombrepago','cp.descripcion','b.nombre_banco as bancos','cp.total','cp.cuotas_totales','e.nombre as nombreE','cp.cuotas_restantes','b.NoCuenta as nocuenta','b.intereses as intereses')
	 			->where('cp.nombrepago','LIKE', '%'.$query.'%')
	 			->orderBy('cp.id_ctaspagar', 'desc')
	 			->paginate(10);
	 			}
	 			else{
	 			$facturasPagar=DB::table('ctas_a_pagar as cp')
	  			->join('bancos as b','cp.bancos_id_banco','=','b.id_banco')	
	  			->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
	 			->select('cp.id_ctaspagar','cp.fecha','cp.nombrepago','cp.descripcion','b.nombre_banco as bancos','cp.total','cp.cuotas_totales','e.nombre as nombreE','cp.cuotas_restantes','b.NoCuenta as nocuenta','b.intereses as intereses')
	 			->where('b.nombre_banco','LIKE', '%'.$query1.'%')
	 			->where('cp.nombrepago','LIKE', '%'.$query.'%')
	 			->orderBy('cp.id_ctaspagar', 'desc')
	 			->paginate(10);
	 			}
	  			

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$facturasP=DB::table('ctas_a_pagar')->get();

	 			return view('almacen.pagosCobros.FacturasPagar.FacturasPagar',["facturasPagar"=>$facturasPagar, "bancos"=>$bancos, "searchText"=>$query, "searchText1"=>$query1,"modulos"=>$modulos,"facturasP"=>$facturasP]);
	 		}
	 	}
	 	public function show(Request $request){
	 		if ($request) {
	 			
	 			$bancos=DB::table('bancos')->get();
	  			$facturasPagar=DB::table('ctas_a_pagar as cp')
	  			->join('bancos as b','cp.bancos_id_banco','=','b.id_banco')	
	 			->select('cp.id_ctaspagar','cp.fecha','cp.nombrepago','cp.descripcion','b.nombre_banco as bancos','cp.abono','cp.total');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 				$usuarios=DB::table('empleado')->get();
	 			
	 			return view('almacen.pagosCobros.FacturasPagar.registrarFactura' ,["facturasPagar"=>$facturasPagar, "bancos"=>$bancos,"modulos"=>$modulos,"usuarios"=>$usuarios]);
	 		}
	 			
	 	}

	 	public function store(FacturaPagarFormRequest $request){
	 		$facturaPagar = new FacturaPagar;
	 		$facturaPagar->nombrepago=$request->get('nombrepago');
	 		$facturaPagar->descripcion=$request->get('descripcion');
	 		$facturaPagar->fecha=$request->get('fecha');	
	 		$facturaPagar->bancos_id_banco=$request->get('bancos_id_banco');
	 		$facturaPagar->total=$request->get('total');
	 		$facturaPagar->cuotas_totales=$request->get('cuotas_totales');
	 		$facturaPagar->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$facturaPagar->cuotas_restantes=$request->get('cuotas_totales');
	 		$facturaPagar->save();

	 		return back()->with('msj','Factura guardada');
	 	}


	 	public function edit($id){
	 		$id=$id;
	 			$query="";
	 		
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$abonos=DB::table('detalle_pagos as dc')
	 			->join('empleado as e','dc.empleado_id_empleado','=','e.id_empleado')
	 			->join('ctas_a_pagar as c','dc.id_cuentas','=','c.id_ctaspagar')
	 			->join('tipo_pago as tp','dc.tipo_pago','=','tp.id_tpago')
	 			->select('dc.id_dpagos as id','dc.fecha as fecha','dc.valor_abono as valorabono','dc.valor_total as valortotal','dc.valor_restante as valorrestante','e.nombre as nombreE','c.id_ctaspagar as id_cartera','tp.nombre as nombreP')
	 			->where('dc.id_cuentas','=',$id)
	 			->orderBy('dc.id_dpagos','desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();

	 			$valorrestanteT=DB::table('ctas_a_pagar')
	 			->where('id_ctaspagar','=',$id)
	 			->orderBy('id_ctaspagar', 'desc')->get();

	 			$valortotalT=DB::table('detalle_pagos')
	 			->where('id_cuentas','=',$id)
	 			->orderBy('id_dpagos', 'desc')->get();
	 			

	 			$bancos=DB::table('bancos')->get();


	 			$sedes=DB::table('sede')->get();

	 			$bancoId=DB::table('ctas_a_pagar')
		 		->select('bancos_id_banco as id_banco')
		 		->where('id_ctaspagar','=',$id)
		 		->orderBy('id_ctaspagar', 'desc')->get();


	 			return view('almacen.pagosCobros.AbonosPagos.index',["searchText"=>$query, "modulos"=>$modulos,"abonos"=>$abonos,"usuarios"=>$usuarios,"tipoPago"=>$tipoPago,"id"=>$id,"valorrestanteT"=>$valorrestanteT,"valortotalT"=>$valortotalT,"bancos"=>$bancos,"sedes"=>$sedes,"bancoId"=>$bancoId]);
	 	}

	 	public function update(FacturaPagarFormRequest $request, $id){

	 		$facturaPagar = FacturaPagar::findOrFail($id);
	 		$facturaPagar->nombrepago=$request->get('nombrepago');
	 		$facturaPagar->descripcion=$request->get('descripcion');
	 		$facturaPagar->fecha=$request->get('fecha');	
	 		$facturaPagar->bancos_id_banco=$request->get('bancos_id_banco');
	 		$facturaPagar->total=$request->get('total');
	 		$facturaPagar->cuotas_totales=$request->get('cuotas_totales');
	 		$facturaPagar->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$facturaPagar->cuotas_restantes=$request->get('cuotas_restantes');

	 		$facturaPagar->update();
	 		return Redirect::to('almacen/pagosCobros/FacturasPagar');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$bancoId=DB::table('detalle_pagos')
		 	->where('id_cuentas','=',$id)
		 	->orderBy('id_dpagos', 'desc')->get();
		 	
		 	if(count($bancoId)==0){
		 		$facturaPagar = FacturaPagar::findOrFail($id);
	 		$facturaPagar->delete();


	 		return back()->with('msj','Factura eliminada');	
		 	}else{

	 		return back()->with('errormsj','¡Factura con abonos!');
		 	}

	 		
	 	}

	 
}
