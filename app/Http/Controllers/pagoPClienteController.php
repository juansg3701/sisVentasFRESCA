<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use sisVentas\DetalleBanco;
use sisVentas\AbonoPP;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use sisVentas\Http\Requests\DetalleBancoFormRequest;
use DB;

class pagoPClienteController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		//$id=2;	
	 		if ($request) {
	 			$id=trim($request->get('id_factura'));

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$facturas=DB::table('factura')->get();
	 			return view('almacen.facturacion.pagoEfectivo.index',["modulos"=>$modulos,"id"=>$id,"facturas"=>$facturas ]);

				}

				
	 		}
	 	
 	public function store(DetalleBancoFormRequest $request){
 			

 	}

 	public function update(DetalleBancoFormRequest $request, $id){
				
 				$tpago=$request->get('tipo_pago');
 				$id=$id;


 				switch ($tpago) {
 					case 1:

 				$abono=AbonoPP::findOrFail($id);
				 $abono->facturaPaga=1;	 		
				 $abono->update();

				$de= new DetalleBanco;
	 			$de->fecha=$request->get('fecha');
	 			$de->ingreso_efectivo=$request->get('ingreso');
	 			$de->egreso_efectivo=0;
	 			$de->ingreso_electronico=0;
	 			$de->egreso_electronico=0;
	 			$de->banco_idBanco=0;
	 			$de->sede_id_sede=auth()->user()->sede_id_sede;
	 			$de->save();

	 		return back()->with('msj','Pago en efectivo registrado');

 						break;

 			case 2:
		
				$de= new DetalleBanco;
	 			$de->fecha=$request->get('fecha');
	 			$de->ingreso_efectivo=0;
	 			$de->egreso_efectivo=0;
	 			$de->ingreso_electronico=$request->get('ingreso');
	 			$de->egreso_electronico=0;
	 			$de->banco_idBanco=1;
	 			$de->sede_id_sede=auth()->user()->sede_id_sede;
	 			$de->save();

	 			$abono=AbonoPP::findOrFail($id);
				 $abono->facturaPaga=1;	 
				 $abono->tipo_pago_id_tpago=2;		
				 $abono->update();
				
				return back()->with('msj','Pago con datafono registrado');	
 						break;
 					
 					default:
 						# code...
 						break;
 				}

	 		
	 		return back()->with('msj','Pago registrado');	

 	}
 	public function show($id){
 		$id=$id;

 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;

	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 	$facturasPagos=DB::table('tap_proveedor')
		->where('id_abono','=',$id)
	 	->orderBy('id_abono', 'desc')->get();
					 		
 	return view('almacen.pedidosDevoluciones.pagoPasarela.index',["modulos"=>$modulos,"id"=>$id,"facturasPagos"=>$facturasPagos]);	
 		


 	}
 	public function create(FacturaFormRequest  $request){
 	

	 
	 
 	}
}
