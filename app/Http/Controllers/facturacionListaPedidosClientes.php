<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\PedidoCliente;
use sisVentas\AbonoPC;
use sisVentas\DetallePC;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use DB;

class facturacionListaPedidosClientes extends Controller
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
	 			$clientes=DB::table('cliente')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();
	 			$pedidosCliente=DB::table('t_p_cliente as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->where('tc.fecha_entrega','LIKE', '%'.$query2.'%')
	 			->where('tc.id_remision','LIKE', '%'.$query3.'%')
	 			->where('c.nombre','LIKE', '%'.$query4.'%')
	 			->orderBy('tc.id_remision', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesP=DB::table('cliente')->get();
	 			$pedidoP=DB::table('t_p_cliente')->get();

	 			return view('almacen.facturacion.listaPedidosClientes.listaPedidos',["pedidosCliente"=>$pedidosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "searchText"=>$query, "searchText2"=>$query2, "searchText3"=>$query3, "searchText4"=>$query4, "modulos"=>$modulos,"clientesP"=>$clientesP,"pedidoP"=>$pedidoP]);
	 		}
	 	}
		

	 	public function show(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$usuarios=DB::table('empleado')->get();
	 			$clientes=DB::table('cliente')->get();
	 			$tipoPagos=DB::table('tipo_pago')->get();
	 			$pedidosCliente=DB::table('t_p_cliente as tc')
	 			->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 			->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 			->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 			->orderBy('tc.id_remision', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			return view('almacen.pedidosDevoluciones.pedidoCliente.pedidoCliente',["pedidosCliente"=>$pedidosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "searchText"=>$query, "modulos"=>$modulos]);
	 		}		
	 	}

	 	public function edit($id){	
	 		
	 		$id=$id;
	 		$query="";
	 		$query1="";
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



	 	public function store(PedidoClienteFormRequest $request){


	 		$pedidoCliente = new PedidoCliente;
	 		$pedidoCliente->noproductos=$request->get('noproductos');
	 		$pedidoCliente->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoCliente->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoCliente->pago_inicial=$request->get('pago_inicial');
	 		$pedidoCliente->porcentaje_venta=$request->get('porcentaje_venta');
	 		$pedidoCliente->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$pedidoCliente->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoCliente->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$pedidoCliente->save();


	 		$id=$pedidoCliente->id_remision;

	 		$idp=trim($request->get('producto_id_producto'));
	 			
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$producto=DB::table('producto')->get();
	 			$tpCliente=DB::table('t_p_cliente')->get();
	 			$impuestos=DB::table('impuestos')->get();
	 			$descuentos=DB::table('descuentos')->get();
	 			$detalleCliente=DB::table('d_p_cliente as dc')
	 			->join('producto as p','dc.producto_id_producto','=','p.id_producto')
	 			->join('t_p_cliente as tpc','dc.t_p_cliente_id_remision','=','tpc.id_remision')
	 			->join('impuestos as i','dc.impuestos_id_impuestos','=','i.id_impuestos')
	 			->join('descuentos as d','dc.descuentos_id_descuento','=','d.id_descuento')
	 			->select('dc.id_dpcliente','dc.cantidad as cantidad', 'dc.precio_venta as precio_venta', 'tpc.id_remision as t_p_cliente_id_remision','p.nombre as producto_id_producto', 'd.nombre as descuentos_id_descuento', 'i.nombre as impuestos_id_impuestos','dc.total as total')
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

	 			$pedidoCliente=DB::table('t_p_cliente')->get();

	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}

	 		return view('almacen.pedidosDevoluciones.productoPedidoCliente.registrarProductos',["id"=>$id,"producto"=>$producto,"productosNom"=>$productosNom,"searchText"=>$query,"searchText1"=>$query1,"productosEAN2"=>$productosEAN2,"modulos"=>$modulos, "productosImp"=>$productosImp,"productosEAN"=>$productosEAN, "detalleCliente"=>$detalleCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos, "pedidoCliente"=>$pedidoCliente,"eanP"=>$eanP]);

	 	}

	 	public function update(PedidoClienteFormRequest $request, $id){

	 		$pedidoCliente = PedidoCliente::findOrFail($id);
	 		$pedidoCliente->noproductos=$request->get('noproductos');
	 		$pedidoCliente->fecha_solicitud=$request->get('fecha_solicitud');
	 		$pedidoCliente->fecha_entrega=$request->get('fecha_entrega');	
	 		$pedidoCliente->pago_inicial=$request->get('pago_inicial');
	 		$pedidoCliente->porcentaje_venta=$request->get('porcentaje_venta');
	 		$pedidoCliente->pago_total=$request->get('pago_total');
	 		$pedidoCliente->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$pedidoCliente->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$pedidoCliente->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');

	 		$pedidoCliente->update();
	 		return Redirect::to('almacen/facturacion/listaPedidosClientes');

	 	}


	 	public function destroy($id){
	 		$id=$id;

	 		$modulos=DB::table('d_p_cliente')
	 			->select('id_dpcliente as id_abono')
	 			->where('t_p_cliente_id_remision','=',$id)
	 			->orderBy('id_dpcliente', 'desc')->get();

	 		$abonos=DB::table('t_ab_p_cliente')
	 			->select('id_abono as id_abono')
	 			->where('t_p_cliente_id_remision','=',$id)
	 			->orderBy('id_abono', 'desc')->get();

	 			if(count($modulos)==0 && count($abonos)==0){
	 				$pedidoCliente = PedidoCliente::findOrFail($id);
	 				$pedidoCliente->delete();
	 				
	 				return back()->with('msj','Pedido eliminado');
	 			}
	 			else{
	 		
	 			return back()->with('errormsj','¡Pedido con productos o abonos!');

	 			}
	 	
	 	}


}