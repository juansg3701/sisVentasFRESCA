<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use sisVentas\DetalleBanco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ClienteFormRequest;
use DB;

class estado extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 			
	 			$id=trim($request->get('id_factura'));

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 				 $transactionState = $_REQUEST['transactionState'];
								$estadoTx="0";

								 if ($_REQUEST['transactionState'] == 4 ) {
									$estadoTx = "Transacción aprobada";
								}

								else if ($_REQUEST['transactionState'] == 6 ) {
									$estadoTx = "Transacción rechazada";
								}

								else if ($_REQUEST['transactionState'] == 104 ) {
									$estadoTx = "Error";
								}

								else if ($_REQUEST['transactionState'] == 7 ) {
									$estadoTx = "Transacción pendiente";
								}

								else {
									$estadoTx=$_REQUEST['mensaje'];
								}

								

	 			
	 		
	 				return view('almacen.facturacion.estadoVenta.index', ["modulos"=>$modulos, "estadoTx"=>$estadoTx,"id"=>$id]);
	 		}

	 		 	public function show($id){
	 		 		

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 				 $transactionState = $_REQUEST['transactionState'];
								$estadoTx="0";

								 if ($_REQUEST['transactionState'] == 4 ) {
									$estadoTx = "Transacción aprobada";

									$fact= Factura::findOrFail($id);
									 $fact->facturaPaga=1;	
									 $valorPago=$fact->pago_total; 	
									 $fact->tipo_pago_id_tpago=3;	
									 $fact->update();
									 $fechaActual=date('Y-m-d');

									 $de= new DetalleBanco;
							 		$de->fecha=$fechaActual;
							 		$de->ingreso_efectivo=0;
							 		$de->egreso_efectivo=0;
							 		$de->ingreso_electronico=$valorPago;
							 		$de->egreso_electronico=0;
							 		$de->banco_idBanco=1;
							 		$de->sede_id_sede=auth()->user()->sede_id_sede;
							 		$de->save();


									 $detalleProductos=DB::table('detalle_factura')
						 			->orderBy('id_detallef', 'desc')->get();

						 			$stock=DB::table('stock')
						 			->orderBy('id_stock', 'desc')->get();
						 			$sedeP=auth()->user()->sede_id_sede;
						 	
							

									foreach ($detalleProductos as $dp) {
										 			if($dp->factura_id_factura==$id){
										 				$producto=$dp->producto_id_producto;
										 		
										 					foreach ($stock as $s) {
																	if($s->id_stock==$producto){
											 							$pe=ProveedorSede::findOrFail($s->id_stock);
											 							$cantidadActual=$pe->cantidad;
											 							$pe->cantidad=$cantidadActual-$dp->cantidad;
											 							$pe->update();
											 							
											 						}
										 						
											 						
											 				}
										 				
											 				
										 			}

										 		}

								}

								else if ($_REQUEST['transactionState'] == 6 ) {
									$estadoTx = "Transacción rechazada";
								}

								else if ($_REQUEST['transactionState'] == 104 ) {
									$estadoTx = "Error";
								}

								else if ($_REQUEST['transactionState'] == 7 ) {
									$estadoTx = "Transacción pendiente";
								}

								else {
									$estadoTx=$_REQUEST['mensaje'];
								}

			
	 			
	 		
	 				return view('almacen.facturacion.estadoVenta.index', ["modulos"=>$modulos, "estadoTx"=>$estadoTx,"id"=>$id]);

	 		 	}
	 	

}
