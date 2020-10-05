<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductosFactura;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductosFacturaFormRequest;
use DB;


class productoVentas extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$id=trim($request->get('factura_id_factura'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));

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

	 			if(auth()->user()->superusuario==0){
				
	 			$productosEAN=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('ean','=',$query)
	 			->where('p.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);

	 			$productosEAN2=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->join('proveedor as ov','p.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('impuestos as i','pr.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_stock as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','pr.precio as precioU','pr.nombre as nombre','ov.nombre_proveedor as nproveedor','p.cantidad as cantidad','p.sede_id_sede as sede','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
	 			->where('p.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('ean', 'desc')
	 			->paginate(10);	 				
	 			}
	 		
	 			$descuentos=DB::table('descuentos')->get();
	 			$productoGeneral=DB::table('producto')->get();
	 			$impuestos=DB::table('impuestos')->get();

	 			$facturas=DB::table('factura')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}
	 			$conteo=false;

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id,"descuentos"=>$descuentos, "productoGeneral"=>$productoGeneral,"impuestos"=>$impuestos,"facturas"=>$facturas,"tipoPago"=>$tipoPago,"eanP"=>$eanP,"conteo"=>$conteo]);
	 		}
	 	}


	public function create(){
	 			$tiempo=DB::table('p_tiempo')->get();

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.inventario.corte-sede.productosCorte.registrar",["tiempo"=>$tiempo, "modulos"=>$modulos]);
	 		
	 	}


	 	public function store(ProductosFacturaFormRequest $request){

	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		if(count($existeR)!=0){
			
			$ps = new ProductosFactura;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$idfactura=$request->get('factura_id_factura');
	 		$impuesto=$request->get('impuestos_id_impuestos');
	 		$descuento=$request->get('descuentos_id_descuento');
	 		$ps->cantidad=$cantidad;
	 		$ps->factura_id_factura=$idfactura;
	 		$ps->producto_id_producto=$productoR;
	 		$ps->precio_venta=$precio;
	 		$ps->descuentos_id_descuento=$descuento;
	 		$ps->impuestos_id_impuestos=$impuesto;

	 		$valorImpuesto=DB::table('impuestos')
	 		->select('valor')
	 		->where('id_impuestos','=',$impuesto)
	 		->get();
	 		
	 		$valorDescuento=DB::table('descuentos')
	 		->select('porcentaje')
	 		->where('id_descuento','=',$descuento)
	 		->get();
	 	
	 		
	 		$porcentajeI=0;
	 		foreach ($valorImpuesto as $vi) {
	 			$porcentajeI=($vi->valor*$precio)/100;
	 			
	 		}

	 		$porcentajeD=0;
	 		foreach ($valorDescuento as $vd) {
	 			$porcentajeD=($vd->porcentaje*$precio)/100;
	 			
	 		}

			$ps->total=round($cantidad*($precio+$porcentajeI-$porcentajeD),0);

	 		$ps->save();

	 		$total=$cantidad*($precio+$porcentajeI-$porcentajeD);

	 		$fact = Factura::findOrFail($idfactura);
	 		$precioAnterior=$fact->pago_total;
	 		$productos=$fact->noproductos;

	 		$fact->pago_total=round($precioAnterior+$total,0);
	 		$fact->noproductos=$productos+$cantidad;
	 		$fact->update();

			$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA-$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto guardado y descontado del stock');

	 		}else{

	 			return back()->with('errormsj','No hay suficiente stock');
	 		}


	 	}


	 		public function show($id){
	 		return view("almacen.inventario.corte-sede.productosCorte.show",["productos"=>ProductosFactura::findOrFail($id)]);
	 	}

	 	public function update(ProductosFactura $request, $id){

	 		$precio=$request->get('precio_venta');
	 		$cantidad=$request->get('noproductos');
	 		$total=$precio*$cantidad;

	 		$fact = Factura::findOrFail($id);
	 		$precioAnterior=$fact->pago_total->get();
	 		$productos=$fact->noproductos->get();


	 		$fact->pago_total=$precio+$total;
	 		$fact->noproductos=$productos+$cantidad;
	 		$fact->update();

	 		return Redirect::to('almacen/facturacion/listaVentas');
	 	}

	 	public function destroy($idf){
	 		$productos=ProductosFactura::findOrFail($idf);
	 		$id=$productos->factura_id_factura;
	 		$idProducto=$productos->producto_id_producto;
	 		$can=$productos->cantidad;
	 		$to=$productos->total;
	 		$productos->delete();

	 		$fact = Factura::findOrFail($id);
	 		$precioAnterior=$fact->pago_total;
	 		$productosTotal=$fact->noproductos;

	 		$fact->pago_total=$precioAnterior-$to;
	 		$fact->noproductos=$productosTotal-$can;
	 		
	 		$fact->update();
	
	 		$cantidadR=$can;
	 		$productoR=$idProducto;

	 		$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA+$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto eliminado y sumado al stock');
	 	}
}