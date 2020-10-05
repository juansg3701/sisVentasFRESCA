<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\FacturaCobrarDetalle;
use sisVentas\FacturaCobrar;
use sisVentas\Factura;
use sisVentas\DetalleBanco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaCobrarDetalleFormRequest;
use DB;

class facturasCobrarDetalleController extends Controller
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
	 			
	 			$abonos=DB::table('detalle_cartera as dc')
	 			->join('empleado as e','dc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cartera as c','dc.id_cartera','=','c.id_cartera')
	 			->join('tipo_pago as tp','dc.tipo_pago','=','tp.id_tpago')
	 			->select('dc.id_dCartera as id','dc.fecha as fecha','dc.valor_abono as valorabono','dc.valor_total as valortotal','dc.valor_restante as valorrestante','e.nombre as nombreE','c.id_cartera as id_cartera','tp.nombre as nombreP')
	 			->where('dc.id_cartera','=',$id)
	 			->orderBy('dc.id_dCartera','desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();

	 			$valorrestanteT=DB::table('cartera')
	 			->where('id_cartera','=',$id)
	 			->orderBy('id_cartera', 'desc')->get();

	 			$valortotalT=DB::table('detalle_cartera')
	 			->where('id_cartera','=',$id)
	 			->orderBy('id_dCartera', 'desc')->get();

	 			$bancos=DB::table('bancos')->get();

	 			$sedes=DB::table('sede')->get();


	 			return view('almacen.pagosCobros.AbonosCartera.index',["searchText"=>$query, "modulos"=>$modulos,"abonos"=>$abonos,"usuarios"=>$usuarios,"tipoPago"=>$tipoPago,"id"=>$id,"valorrestanteT"=>$valorrestanteT,"valortotalT"=>$valortotalT,"bancos"=>$bancos,"sedes"=>$sedes]);
	 		}
	 	}
 	 	public function edit(Request $request){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$bancos=DB::table('bancos')->get();

	 			return view('almacen.pagosCobros.AbonosCartera.index', ["modulos"=>$modulos,"bancos"=>$bancos]);	
	 	}


	 		public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesM=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			return view('almacen.pagosCobros.FacturasCobrar.registrar', ["modulos"=>$modulos,"clientesM"=>$clientesM,"usuarios"=>$usuarios]);	
	 		
	 	}

	 	public function store(FacturaCobrarDetalleFormRequest $request){

	 		$idG=$request->get('id_cartera');
	 		$fechaR=$request->get('fecha');
	 		$valorR=$request->get('valor_abono');
	 		$bancoEfec=0;
	 		$bancoElect=1;
	 		$sede=$request->get('sede_id_sede');
	 		$tpago=$request->get('tipo_pago');

	 		$saldoActual= FacturaCobrar::findOrFail($idG);
			$totalActual=$saldoActual->total;

			if($totalActual>=$valorR){


	 		if ($tpago==1) {
	 		$detalleB = new DetalleBanco;
	 		$detalleB->fecha=$fechaR;
	 		$detalleB->ingreso_efectivo=$valorR;
	 		$detalleB->egreso_efectivo=0;
	 		$detalleB->ingreso_electronico=0;
	 		$detalleB->egreso_electronico=0;
	 		$detalleB->banco_idBanco=$bancoEfec;
	 		$detalleB->sede_id_sede=$sede;
	 		$detalleB->save();
	 	}
	 		if ($tpago==2 || $tpago==3) {
	 		$detalleB = new DetalleBanco;
	 		$detalleB->fecha=$fechaR;
	 		$detalleB->ingreso_efectivo=0;
	 		$detalleB->egreso_efectivo=0;
	 		$detalleB->ingreso_electronico=$valorR;
	 		$detalleB->egreso_electronico=0;
	 		$detalleB->banco_idBanco=$bancoElect;
	 		$detalleB->sede_id_sede=$sede;
	 		$detalleB->save();
	 	}


	 		$fc = new FacturaCobrarDetalle;
	 		
	 		$fc->fecha=$fechaR;
	 		$abono=$valorR;

	 		if($abono<0){	
	 			$abono=0;
	 		}
	 		$fc->valor_abono=$abono;
	 		
	 		$fc->valor_total=$request->get('valor_total');

	 		
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->tipo_pago=$request->get('tipo_pago');
	 		$id=$request->get('id_cartera');
	 		$fc->id_cartera=$id;

	 		$factura= FacturaCobrar::findOrFail($id);
	 		$cuotasrestantes=$factura->cuotas_restantes;
	 		$anteriortotal=$factura->total;
	 		$actual=$anteriortotal-$abono;
	 		if($actual<0){
	 			$actual=0;
	 		}

	 			$factura->atraso=1;
	 		
	 		$factura->total=$actual;
	 		$factura->cuotas_restantes=$cuotasrestantes-1;

	 		$factura->update();

	 		$fz= FacturaCobrar::findOrFail($id);
	 		$ValorFinal=$fz->total;
	 		$fz->update();

	 		$fbuscar=Factura::findOrFail($factura->factura_id_factura);
	 			$fbuscar->tipo_pago_id_tpago=4;
	 			$fbuscar->save();

	 		$fc->valor_restante=$actual;
	 		if ($ValorFinal==0) {
	 			$fbuscar=Factura::findOrFail($factura->factura_id_factura);
	 			$fbuscar->facturaPaga=1;
	 			$fbuscar->save();
	 		}
	 		$fc->save();
	 		

	 		return back()->with('msj','Abono guardado');

			}else{
				return back()->with('errormsj','¡Ingrese un abono menor o igual al restante!');
			}

	 	}


	 		public function show($id){
	 		return view("almacen.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
	 	}

	 	public function update(FacturaCobrarDetalleFormRequest $request, $id){
	 		$fc = FacturaCobrarDetalle::findOrFail($id);
	 		$fc->fecha=$request->get('fecha');
	 		$fc->valor_abono=$request->get('valor_abono');
	 		$fc->valor_total=$request->get('valor_total');
	 		$fc->valor_restante=$request->get('valor_restante');
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->tipo_pago=$request->get('tipo_pago');
	 		$fc->id_cartera=$request->get('id_cartera');
	 		$fc->update();
	 		return Redirect::to('almacen/pagosCobros/AbonosCartera');
	 	}

	 	public function destroy($idf){
	 		
	 		$id=$idf;
	 		$fc=FacturaCobrarDetalle::findOrFail($idf);
	 		$idC=$fc->id_cartera;
	 		$restanteR=$fc->valor_abono;
	 		$fc->delete();

	 		$saldoActual= FacturaCobrar::findOrFail($idC);
			$totalActual=$saldoActual->total;
			$saldoActual->total=$totalActual+$restanteR;
			$saldoActual->update();

			return back()->with('msj','Abono eliminado');
	 		
	 	}
	 
}