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

class pagoEfectivo extends Controller
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

 	public function update(DetalleBancoFormRequest  $request, $id){
				

	 			$id=$id;
	 			

				 $detalleProductos=DB::table('detalle_factura')
	 			->orderBy('id_detallef', 'desc')->get();

	 			$stock=DB::table('stock')
	 			->orderBy('id_stock', 'desc')->get();
	 			$sedeP=auth()->user()->sede_id_sede;
	 	

		if ($descuento!=2) {
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
		}
		


	 		$query="";
	 		$query1="";

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$productos=DB::table('detalle_factura as df')
	 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
	 			->join('stock as s','df.producto_id_producto','=','s.id_stock')
	 			->join('proveedor as ov','s.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('descuentos as d','df.descuentos_id_descuento','=','d.id_descuento')
	 			->join('impuestos as i','df.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('df.id_detallef as id_detallef','df.cantidad as cantidad','df.precio_venta as precio_venta','f.id_factura as factura_id_factura','p.nombre as producto_id_producto','d.nombre as descuentos_id_descuento','i.nombre as impuestos_id_impuestos','df.total as total','ov.nombre_proveedor as nproveedor')
	 			->where('df.factura_id_factura','=',$id)
	 			->orderBy('df.id_detallef', 'desc')
	 			->paginate(10);

	 			
	 			$productosEAN=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('ean','=',$query)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 		
	 			
	 			$productosEAN2=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 		
	 			$descuentos=DB::table('descuentos')->get();
	 			$productoGeneral=DB::table('producto')->get();
	 			$impuestos=DB::table('impuestos')->get();

	 			$facturas=DB::table('factura')->get();

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id,"descuentos"=>$descuentos, "productoGeneral"=>$productoGeneral,"impuestos"=>$impuestos,"facturas"=>$facturas]);


	
 	}
 	public function show($id){
 		$id=$id;
	 			$fact= Factura::findOrFail($id);
				 $fact->facturaPaga=1;	 		
				 $fact->update();

				 $detalleProductos=DB::table('detalle_factura')
	 			->orderBy('id_detallef', 'desc')->get();

	 			$stock=DB::table('stock')
	 			->orderBy('id_stock', 'desc')->get();
	 			$sedeP=auth()->user()->sede_id_sede;
	 	
		
				$descuento=0;

				foreach ($detalleProductos as $dp) {
					 			if($dp->factura_id_factura==$id){
					 				$producto=$dp->producto_id_producto;
					 		
					 					foreach ($stock as $s) {
												if($s->id_stock==$producto){
						 							$pe=ProveedorSede::findOrFail($s->id_stock);
						 							$cantidadActual=$pe->cantidad;
						 							if ($dp->cantidad<=$cantidadActual) {
						 								$pe->cantidad=$cantidadActual-$dp->cantidad;
						 							$pe->update();
						 								$descuento=1;
						 							}
						 							else{
						 								$descuento=2;
						 							}
						 							
						 							
						 							
						 						}
					 						
						 						
						 				}
					 				
						 				
					 			}

					 		}
		if ($descuento!=2) {
		$fact= Factura::findOrFail($id);
				 $fact->facturaPaga=1;	 		
				 $fact->update();
		}

	 		$query="";
	 		$query1="";

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$productos=DB::table('detalle_factura as df')
	 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
	 			->join('stock as s','df.producto_id_producto','=','s.id_stock')
	 			->join('proveedor as ov','s.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('descuentos as d','df.descuentos_id_descuento','=','d.id_descuento')
	 			->join('impuestos as i','df.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('df.id_detallef as id_detallef','df.cantidad as cantidad','df.precio_venta as precio_venta','f.id_factura as factura_id_factura','p.nombre as producto_id_producto','d.nombre as descuentos_id_descuento','i.nombre as impuestos_id_impuestos','df.total as total','ov.nombre_proveedor as nproveedor')
	 			->where('df.factura_id_factura','=',$id)
	 			->orderBy('df.id_detallef', 'desc')
	 			->paginate(10);

	 			
	 			$productosEAN=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('ean','=',$query)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 		
	 			
	 			$productosEAN2=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 		
	 			$descuentos=DB::table('descuentos')->get();
	 			$productoGeneral=DB::table('producto')->get();
	 			$impuestos=DB::table('impuestos')->get();

	 			$facturas=DB::table('factura')->get();

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id,"descuentos"=>$descuentos, "productoGeneral"=>$productoGeneral,"impuestos"=>$impuestos,"facturas"=>$facturas]);

 	}
 	public function create(FacturaFormRequest  $request){
 	

	 
	 
 	}
}
