<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\FacturaPagarDetalle;
use sisVentas\FacturaPagar;
use sisVentas\DetalleBanco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaPagarDetalleFormRequest;
use DB;

class FacturasPagarDetalleController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$id=trim($request->get('id'));
	 			$query=trim($request->get('searchText'));
	 		
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
	 	}
 	 	public function edit(Request $request){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$bancos=DB::table('bancos')->get();

	 			return view('almacen.pagosCobros.AbonosPagos.index', ["modulos"=>$modulos,"bancos"=>$bancos]);	
	 	}


	 		public function create($id){
	 		$bancos=DB::table('bancos')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 		return view("almacen.pagosCobros.FacturasPagar.edit",["bancos"=>$bancos, "facturaPagar"=>FacturaPagar::findOrFail($id),"modulos"=>$modulos]);	
	 		
	 	}

	 	public function store(FacturaPagarDetalleFormRequest $request){

	 
	 		$idG=$request->get('id_cuentas');
	 		$fechaR=$request->get('fecha');
	 		$valorR=$request->get('valor_abono');
	 		$bancoR=$request->get('banco_idBanco');
	 		$sede=$request->get('sede_id_sede');
	 		$tpago=$request->get('tipo_pago');

			$saldoActual= FacturaPagar::findOrFail($idG);
			$totalActual=$saldoActual->total;


			if($totalActual>=$valorR){
				if ($tpago==1) {
	 		$detalleB = new DetalleBanco;
	 		$detalleB->fecha=$fechaR;
	 		$detalleB->ingreso_efectivo=0;
	 		$detalleB->egreso_efectivo=$valorR;
	 		$detalleB->ingreso_electronico=0;
	 		$detalleB->egreso_electronico=0;
	 		$detalleB->banco_idBanco=$bancoR;
	 		$detalleB->sede_id_sede=$sede;
	 		$detalleB->save();
	 		}
	 		
	 		
			if ($tpago==2 || $tpago==3 ) {
	 			$detalleB = new DetalleBanco;
	 		$detalleB->fecha=$fechaR;
	 		$detalleB->ingreso_efectivo=0;
	 		$detalleB->egreso_efectivo=0;
	 		$detalleB->ingreso_electronico=0;
	 		$detalleB->egreso_electronico=$valorR;
	 		$detalleB->banco_idBanco=$bancoR;
	 		$detalleB->sede_id_sede=$sede;
	 		$detalleB->save();

	 		}

	 		$fc = new FacturaPagarDetalle;
	 		$fc->fecha=$fechaR;
	 		$abono=$valorR;

	 		if($abono<0){	
	 			$abono=0;
	 		}
	 		$fc->valor_abono=$abono;
	 		
	 		$fc->valor_total=$request->get('valor_total');

	 		
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->tipo_pago=$request->get('tipo_pago');
	 		$id=$idG;
	 		$fc->id_cuentas=$id;
	 		
	 		$factura= FacturaPagar::findOrFail($id);
	 		$cuotasrestantes=$factura->cuotas_restantes;
	 		$anteriortotal=$factura->total;
	 		$actual=$anteriortotal-$abono;
	 		if($actual<0){
	 			$actual=0;
	 		}
	 		
	 		$factura->total=$actual;
	 		$factura->cuotas_restantes=$cuotasrestantes-1;

	 		$factura->update();

	 		$fc->valor_restante=$actual;
	 		$fc->save();


			return back()->with('msj','Abono guardado');

		}else{
			return back()->with('errormsj','¡Ingrese un abono menor o igual al restante!');
		}

	 	}

	 		public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(FacturaPagarDetalleFormRequest $request, $id){
	 		$fc = FacturaPagarDetalle::findOrFail($id);
	 		$fc->fecha=$request->get('fecha');
	 		$fc->valor_abono=$request->get('valor_abono');
	 		$fc->valor_total=$request->get('valor_total');
	 		$fc->valor_restante=$request->get('valor_restante');
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->tipo_pago=$request->get('tipo_pago');
	 		$fc->id_cuentas=$request->get('id_cuentas');
	 		$fc->update();
	 		return Redirect::to('almacen/pagosCobros/AbonosPagos');
	 	}

	 	public function destroy($idf){
	 		
	 		$id=$idf;
	 		$fc=FacturaPagarDetalle::findOrFail($id);
	 		$idC=$fc->id_cuentas;
	 		$restanteR=$fc->valor_abono;
	 		$fc->delete();

	 		$saldoActual= FacturaPagar::findOrFail($idC);
			$totalActual=$saldoActual->total;
			$saldoActual->total=$totalActual+$restanteR;
			$saldoActual->update();

			return back()->with('msj','Abono eliminado');

	 	}
	 
}