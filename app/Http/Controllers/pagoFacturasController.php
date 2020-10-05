<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use sisVentas\DetalleBanco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use sisVentas\Http\Requests\DetalleBancoFormRequest;
use DB;

class pagoFacturasController extends Controller
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
 			$de= new DetalleBanco;
 			$de->fecha=$request->get('fecha');
 			$de->ingreso=$request->get('ingreso');
 			$de->egreso=0;
 			$de->banco_idBanco=0;
 			$de->save();

 	}

 	public function update(DetalleBancoFormRequest $request, $id){
				
 				$tpago=$request->get('tipo_pago');
 				$id=$id;

 				$detalleProductos=DB::table('detalle_factura')
	 			->orderBy('id_detallef', 'desc')->get();

	 		

 				switch ($tpago) {
 					case 1:
 					 	
				$fact= Factura::findOrFail($id);
						 $fact->facturaPaga=1;	 		
						 $fact->update();

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

	 			$fact= Factura::findOrFail($id);
				 $fact->facturaPaga=1;
				 $fact->tipo_pago_id_tpago=2;	 		
				 $fact->update();
				

				return back()->with('msj','Pago con datafono registrado');	
 						break;
 					
 					default:
 						# code...
 						break;
 				}
	 	
 	}

 	public function show($id){
 		$id=$id;
 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 	$facturasPagos=DB::table('factura')
		->where('id_factura','=',$id)
	 	->orderBy('id_factura', 'desc')->get();

	 	$detalleProductos=DB::table('detalle_factura')
	 	->orderBy('id_detallef', 'desc')->get();

					 		
 	return view('almacen.facturacion.pagoPasarela.index',["modulos"=>$modulos,"id"=>$id,"facturasPagos"=>$facturasPagos]);	

 	}

 	public function create(FacturaFormRequest  $request){
 	 
 	}
}
