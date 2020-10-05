<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\DetallePC;
use sisVentas\AbonoPC;
use sisVentas\PedidoCliente;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DetallePCFormRequest;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use DB;

class productoPedidoCliente extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	
		 	} 
	 	public function create(Request $request){
	 		if ($request) {
	 		$id=trim($request->get('t_p_cliente_id_remision'));
	 		$usuarios=DB::table('empleado')->get();
	 		$clientes=DB::table('cliente')->get();
	 		$tipoPagos=DB::table('tipo_pago')->get();
	 		$abonosCliente=DB::table('t_ab_p_cliente as apc')
	 			->join('t_p_cliente as tc','apc.t_p_cliente_id_remision','=','tc.id_remision')
	 			->join('empleado as e','apc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','apc.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as p','apc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision as t_p_cliente_id_remision','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 			->orderBy('apc.t_p_cliente_id_remision', 'desc')
	 			->paginate(10);

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();



	 		return view('almacen.pedidosDevoluciones.productoPedidoCliente.abono.registrarAbono',["abonosCliente"=>$abonosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "modulos"=>$modulos]);
	 	}

	 	}


	 	public function index(Request $request){
	 		if ($request) {
	 			$idp=trim($request->get('producto_id_producto'));
	 			$id=trim($request->get('t_p_cliente_id_remision'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
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

	 			$pedidoCliente=DB::table('t_p_cliente')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}

	 		return view('almacen.pedidosDevoluciones.productoPedidoCliente.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos, "productosImp"=>$productosImp,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP]);
	 		}
	 	}

	 	public function store(DetallePCFormRequest $request){
	 		
	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		if(count($existeR)!=0){
	 			$detallepc = new DetallePC;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$id_remision=$request->get('t_p_cliente_id_remision');
	 		$impuesto=$request->get('impuestos_id_impuestos');
	 		$descuento=$request->get('descuentos_id_descuento');
	 		$detallepc->cantidad=$cantidad;
	 		$detallepc->t_p_cliente_id_remision=$id_remision;
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


	 		$pc = PedidoCliente::findOrFail($id_remision);
	 		$precioAnterior=$pc->pago_total;
	 		$productos=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior+$total;
	 		$pc->noproductos=$productos+$cantidad;
	 		$pc->update(); 

	 		$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA-$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto guardado y descontado del stock');

	 		}else{

	 			return back()->with('errormsj','No hay suficiente stock');
	 		}

	 	}

	 	public function show(Request $request){


	 	}

	 	public function destroy($idf){
	 	
	 		$detallepc=DetallePC::findOrFail($idf);
	 		$id=$detallepc->t_p_cliente_id_remision;
	 		$can=$detallepc->cantidad;
	 		$to=$detallepc->total;
	 		$detallepc->delete();

	 		$pc=PedidoCliente::findOrFail($id);
	 		$precioAnterior=$pc->pago_total;
	 		$productosTotal=$pc->noproductos;

	 		$pc->pago_total=$precioAnterior-$to;
	 		$pc->noproductos=$productosTotal-$can;

	 		$pc->update();

	 		$cantidadR=$detallepc->cantidad;
	 		$productoR=$detallepc->producto_id_producto;

	 		$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA+$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto eliminado y sumado al stock');


		}

}
