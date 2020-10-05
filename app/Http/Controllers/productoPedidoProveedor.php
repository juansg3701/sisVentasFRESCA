<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\DetallePP;
use sisVentas\PedidoProveedor;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DetallePPFormRequest;
use DB;

class productoPedidoProveedor extends Controller
{
	    public function __construct(){
			$this->middleware('auth');
		}

		public function create(Request $request){
		}

	 	public function index(Request $request){
	 		if ($request) {
				$idp=trim($request->get('producto_id_producto'));
	 			$id=trim($request->get('tp_aproveedor_id_rproveedor'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$producto=DB::table('producto')->get();
	 			$tpCliente=DB::table('tp_aproveedor')->get();
	 			$impuestos=DB::table('impuestos')->get();
	 			$descuentos=DB::table('descuentos')->get();


	 			$detalleProveedor=DB::table('d_p_proveedor as dc')
	 			->join('tp_aproveedor as tpc','dc.tp_aproveedor_id_rproveedor','=','tpc.id_rproveedor')
	 			->join('stock as s','dc.producto_id_producto','=','s.id_stock')
	 			->join('proveedor as ov','s.proveedor_id_proveedor','=','ov.id_proveedor')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->join('impuestos as i','dc.impuestos_id_impuestos','=','i.id_impuestos')
	 			->join('descuentos as d','dc.descuentos_id_descuento','=','d.id_descuento')
	 			->select('dc.id_dpproveedor as id_dpproveedor','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_rproveedor as tp_aproveedor_id_rproveedor','p.nombre as producto_id_producto', 'd.nombre as descuentos_id_descuento', 'i.nombre as impuestos_id_impuestos','dc.total as total','ov.nombre_proveedor as nproveedor')
	 			->where('dc.tp_aproveedor_id_rproveedor','=',$id)
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


	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}

	 			return view('almacen.pedidosDevoluciones.productoPedidoProveedor.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"modulos"=>$modulos, "productosImp"=>$productosImp,"productosEAN"=>$productosEAN, "detalleProveedor"=>$detalleProveedor, "impuestos"=>$impuestos, "descuentos"=>$descuentos,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"eanP"=>$eanP]);
	 		}
	 	}


	 	public function store(DetallePPFormRequest $request){
	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		if(count($existeR)!=0){


	 		$detallepc = new DetallePP;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$id_rproveedor=$request->get('tp_aproveedor_id_rproveedor');
	 		$detallepc->cantidad=$cantidad;
	 		$impuesto=$request->get('impuestos_id_impuestos');
	 		$descuento=$request->get('descuentos_id_descuento');
	 		$detallepc->tp_aproveedor_id_rproveedor=$id_rproveedor;
	 		$detallepc->producto_id_producto=$productoR;
	 		$detallepc->precio_venta=$precio;
	 		$detallepc->descuentos_id_descuento=$descuento;
	 		$detallepc->impuestos_id_impuestos=$impuesto;
	 		
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

	 		$detallepc->total=$cantidad*($precio+$porcentajeI-$porcentajeD);
	 		$detallepc->save();
	 		$total=$cantidad*($precio+$porcentajeI-$porcentajeD);

	 		$pc = PedidoProveedor::findOrFail($id_rproveedor);
	 		$precioAnterior=$pc->pago_total;
	 		$productos=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior+$total;
	 		$pc->noproductos=$productos+$cantidad;
	 		$pc->update();


	 		return back()->with('msj','Producto guardado y descontado del stock');

	 		}else{

	 			return back()->with('errormsj','No hay suficiente stock');
	 		}

	 	}
	 	public function show(Request $request){


	 	}

	 	public function destroy($idf){
	 		
	 		$detallepc=DetallePP::findOrFail($idf);
	 		$id=$detallepc->tp_aproveedor_id_rproveedor;
	 		$can=$detallepc->cantidad;
	 		$to=$detallepc->total;
	 		$detallepc->delete();

	 		$pc=PedidoProveedor::findOrFail($id);
	 		$precioAnterior=$pc->pago_total;
	 		$productosTotal=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior-$to;
	 		$pc->noproductos=$productosTotal-$can;	
	 		$pc->update();

	 		$cantidadR=$detallepc->cantidad;
	 		$productoR=$detallepc->producto_id_producto;


	 		return back()->with('msj','Producto eliminado y sumado al stock');
		}

	 
}