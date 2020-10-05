<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\PedidoProveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PedidoProveedorFormRequest;
use DB;

class facturacionListaPedidosProveedor extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 
	 	
	 	public function create(Request $request){

	 	}

	 	public function index(Request $request){

	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
	 			$query4=trim($request->get('searchText4'));
	 			$usuarios=DB::table('empleado')->get();
	 			$proveedores=DB::table('proveedor')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();
	 
	 			$pedidosProveedor=DB::table('tp_aproveedor as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as c','tc.proveedor_id_proveedor','=','c.id_proveedor')
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_rproveedor','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre_empresa as proveedor', 'p.nombre as tipo_pago')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->where('tc.fecha_entrega','LIKE', '%'.$query2.'%')
	 			->where('tc.id_rproveedor','LIKE', '%'.$query3.'%')
	 			->where('c.nombre_empresa','LIKE', '%'.$query4.'%')
	 			->orderBy('tc.id_rproveedor', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$proveedoresP=DB::table('proveedor')->get();
	 			$pedidoPP=DB::table('tp_aproveedor')->get();

	 			return view('almacen.facturacion.listaPedidosProveedores.listaPedidos',["tipoPagos"=>$tipoPagos, "usuarios"=>$usuarios, "searchText"=>$query, "searchText2"=>$query2, "searchText3"=>$query3, "searchText4"=>$query4, "modulos"=>$modulos, "pedidosProveedor"=>$pedidosProveedor,"proveedoresP"=>$proveedoresP,"pedidoPP"=>$pedidoPP]);
	 		}

	 	}

	
		public function show(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$usuarios=DB::table('empleado')->get();
	 			$proveedores=DB::table('proveedor')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();
	 			$pedidosProveedor=DB::table('tp_aproveedor as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as c','tc.proveedor_id_proveedor','=','c.id_proveedor')
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_rproveedor','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre_empresa as proveedor', 'p.nombre as tipo_pago')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->orderBy('tc.id_rproveedor', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			return view('almacen.pedidosDevoluciones.pedidoProveedor.pedidoProveedor',["pedidosProveedor"=>$pedidosProveedor, "tipoPagos"=>$tipoPagos, "proveedores"=>$proveedores, "usuarios"=>$usuarios, "searchText"=>$query, "modulos"=>$modulos]);
	 		}
	 			
	 	}


	 	public function edit($id){

	 		$id=$id;
	 		$query="";
	 		$query1="";
	 		$producto=DB::table('producto')->get();
	 		$tpProveedor=DB::table('tp_aproveedor')->get();
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


	 	public function store(PedidoProveedorFormRequest $request){
	 		
			$pedidoProveedor = new PedidoProveedor;
	 		$pedidoProveedor->noproductos=$request->get('noproductos');
	 		$pedidoProveedor->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoProveedor->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoProveedor->pago_inicial=$request->get('pago_inicial');
	 		$pedidoProveedor->porcentaje_venta=$request->get('porcentaje_venta');
	 		$pedidoProveedor->pago_total=$request->get('pago_total');
	 		$pedidoProveedor->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$pedidoProveedor->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoProveedor->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$pedidoProveedor->save();	

	 		$id=$pedidoProveedor->id_rproveedor;
	 		$idp=trim($request->get('producto_id_producto'));
	 			
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$producto=DB::table('producto')->get();
	 			$tpProveedor=DB::table('tp_aproveedor')->get();
	 			$impuestos=DB::table('impuestos')->get();
	 			$descuentos=DB::table('descuentos')->get();
	 			$detalleProveedor=DB::table('d_p_proveedor as dc')
	 			->join('producto as p','dc.producto_id_producto','=','p.id_producto')
	 			->join('tp_aproveedor as tpc','dc.tp_aproveedor_id_rproveedor','=','tpc.id_rproveedor')
	 			->join('impuestos as i','dc.impuestos_id_impuestos','=','i.id_impuestos')
	 			->join('descuentos as d','dc.descuentos_id_descuento','=','d.id_descuento')
	 			->select('dc.id_rproveedor','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_rproveedor as tp_aproveedor_id_rproveedor','p.nombre as producto_id_producto', 'd.nombre as descuentos_id_descuento', 'i.nombre as impuestos_id_impuestos','dc.total as total')
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

	 			$productosEAN=DB::table('producto as p')
	 			->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_producto as id_producto','i.id_impuestos as impuestos_id_impuestos','i.nombre as nombreI','p.precio as precioU','p.nombre as nombre')
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




	 	public function update(PedidoProveedorFormRequest $request, $id){

	 		$pedidoProveedor = PedidoProveedor::findOrFail($id);
	 		$pedidoProveedor->noproductos=$request->get('noproductos');
	 		$pedidoProveedor->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoProveedor->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoProveedor->pago_inicial=$request->get('pago_inicial');
	 		$pedidoProveedor->porcentaje_venta=$request->get('porcentaje_venta');
	 		$pedidoProveedor->pago_total=$request->get('pago_total');
	 		$pedidoProveedor->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$pedidoProveedor->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoProveedor->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');

	 		$pedidoProveedor->update();
	 		return Redirect::to('almacen/facturacion/listaPedidosProveedores');

	 	}

	 
	 	public function destroy($id){
	 		

	 		$id=$id;

	 		$modulos=DB::table('d_p_proveedor')
	 			->select('id_dpproveedor as id_abono')
	 			->where('tp_aproveedor_id_rproveedor','=',$id)
	 			->orderBy('id_dpproveedor', 'desc')->get();

	 			$abonos=DB::table('tap_proveedor')
	 			->select('id_abono as id_abono')
	 			->where('tp_aproveedor_id_rproveedor','=',$id)
	 			->orderBy('id_abono', 'desc')->get();

	 			if(count($modulos)==0 && count($abonos)==0){
	 				$pedidoProveedor = PedidoProveedor::findOrFail($id);
	 				$pedidoProveedor->delete();
	 					return back()->with('msj','Pedido eliminado');
	 			}
	 			else{
	 		
	 			return back()->with('errormsj','¡Pedido con productos o abonos!');

	 			}
	 	}

	 
}