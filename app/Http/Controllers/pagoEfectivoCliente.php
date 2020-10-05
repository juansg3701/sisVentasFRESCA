<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\PedidoCliente;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use DB;

class pagoEfectivoCliente extends Controller
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
	 	
 	public function store(FacturaFormRequest $request){
	//$id=$request->get('id_factura');
 		$fact= Factura::findOrFail(9);
	 			$fact->facturaPaga=0;	 		
	 			$fact->update();


	 
 	}
 	public function update(FacturaFormRequest  $request, $id){
				$fact= Factura::findOrFail(9);
	 		//	$fact->facturaPaga=1;
	 			$fact->facturaPaga=$request->get('facturaPaga');	 		
	 			$fact->update();

	 			return Redirect::to('almacen/cliente');


	
 	}
 	public function show($id){
 		$id=$id;
	 			$fact= PedidoCliente::findOrFail($id);
				 $fact->pedidoPago=1;	 		
				 $fact->update();

				$detalleProductos=DB::table('d_p_cliente')
	 			->orderBy('id_dpcliente', 'desc')->get();

	 			$stock=DB::table('stock')
	 			->orderBy('id_stock', 'desc')->get();
	 			$sedeP=auth()->user()->sede_id_sede;
	 	
		

				foreach ($detalleProductos as $dp) {
					 			if($dp->t_p_cliente_id_remision==$id){
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

	 		$id=$id;
	 		$query="";
	 		$producto=DB::table('producto')->get();
	 		$tpCliente=DB::table('t_p_cliente')->get();
	 		$impuestos=DB::table('impuestos')->get();
	 		$descuentos=DB::table('descuentos')->get();
	 		$detalleCliente=DB::table('d_p_cliente as dc')
	 			->join('t_p_cliente as tpc','dc.t_p_cliente_id_remision','=','tpc.id_remision')
	 			->join('stock as s','dc.producto_id_producto','=','s.id_stock')
	 			->join('proveedor as ov','s.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('impuestos as i','dc.impuestos_id_impuestos','=','i.id_impuestos')
	 			->join('descuentos as d','dc.descuentos_id_descuento','=','d.id_descuento')
	 			->select('dc.id_dpcliente as id_dpcliente','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_remision as t_p_cliente_id_remision','p.nombre as producto_id_producto', 'd.nombre as descuentos_id_descuento', 'i.nombre as impuestos_id_impuestos','dc.total as total','ov.nombre_proveedor as nproveedor')
	 			->where('dc.t_p_cliente_id_remision','=',$id)
	 			->orderBy('dc.producto_id_producto', 'desc')
	 			->paginate(10);


	 		$productosNom=DB::table('producto')
	 		->where('nombre','=',$query)
	 		->orderBy('nombre', 'desc')
	 			->paginate(10);

	 		$productosImp=DB::table('producto')
	 		->where('impuestos_id_impuestos','=',$query)
	 		->orderBy('impuestos_id_impuestos', 'desc')
	 		->paginate(10);

	 		$productosEAN=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('ean','=',$query)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 		$pedidoCliente=DB::table('t_p_cliente')->get();

	 		return view('almacen.pedidosDevoluciones.productoPedidoCliente.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"modulos"=>$modulos, "productosImp"=>$productosImp,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos, "pedidoCliente"=>$pedidoCliente]);

 	}
 	public function create(FacturaFormRequest  $request){
 	

	 
	 
 	}
}
