<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use DB;

class facturacionListaVentas extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));

	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$clientes=DB::table('cliente')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();
			
				$BuscarCliente=DB::table('cliente')
				->where('documento','=',$query1)
				->orderBy('documento', 'desc')
	 			->paginate(10);

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			return view('almacen.facturacion.listaVentas.nuevaVenta',["sedes"=>$sedes,"searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos, "clientes"=>$clientes,"usuarios"=>$usuarios,"tipoPago"=>$tipoPago,"BuscarCliente"=>$BuscarCliente,"clientesP"=>$clientesP]);
	 		}
	 	}

	 	public function edit($id){

	 			$id=$id;


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
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
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

	 			$conteo=true;

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id,"descuentos"=>$descuentos, "productoGeneral"=>$productoGeneral,"impuestos"=>$impuestos,"facturas"=>$facturas,"tipoPago"=>$tipoPago,"eanP"=>$eanP,"conteo"=>$conteo]);
	 	}

	 public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.facturacion.listaVentas.registrar",["modulos"=>$modulos]);
	

	 	}

	 	public function store(FacturaFormRequest $request){
	 		$fact = new Factura;
	 		$fact->pago_total=$request->get('pago_total');
	 		$fact->noproductos=$request->get('noproductos');
	 		$fact->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$fact->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fact->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$fact->fecha=$request->get('fecha');
	 		$fact->facturaPaga=$request->get('facturaPaga');
	 		$fact->tiendaodomicilio=$request->get('tiendaodomicilio');
	 		
	 		$fact->save();

	 		$id=$fact->id_factura;


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
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
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

	 			$conteo=true;

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id,"descuentos"=>$descuentos, "productoGeneral"=>$productoGeneral,"impuestos"=>$impuestos,"facturas"=>$facturas,"tipoPago"=>$tipoPago,"eanP"=>$eanP,"conteo"=>$conteo]);

	 	}

	 	
	 		public function show(Request $request){
	 		$query=trim($request->get('searchText'));
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		$facturas=DB::table('factura as f')
	 		->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 		->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 		->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 		->select('f.id_factura as id_factura','e.nombre as empleado_id_empleado','tp.nombre as tipo_pago_id_tpago','c.nombre as cliente_id_cliente', 'f.fecha as fecha','f.pago_total as pago_total','f.noproductos as noproductos','f.tiendaodomicilio as tiendaodomicilio',
	 			'f.facturaPaga as facturaPaga')
	 			
	 			->where('fecha','LIKE', '%'.$query.'%')
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(10);

	 	if(auth()->user()->superusuario==0){
	 		$facturas=DB::table('factura as f')
	 		->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 		->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 		->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select('f.id_factura as id_factura','e.nombre as empleado_id_empleado','tp.nombre as tipo_pago_id_tpago','c.nombre as cliente_id_cliente', 'f.fecha as fecha','f.pago_total as pago_total','f.noproductos as noproductos','f.tiendaodomicilio as tiendaodomicilio',
	 			'f.facturaPaga as facturaPaga')
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('fecha','LIKE', '%'.$query.'%')
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(10);
	 	}
	 	
	 	return view('almacen.facturacion.listaVentas.listaVentas', ["modulos"=>$modulos, "facturas"=>$facturas, "searchText"=>$query]);
	 	}

	 	public function update(FacturaFormRequest $request, $id){
	 		$fact = Factura::findOrFail($id);
	 		$fact->pago_total=$request->get('pago_total');
	 		$fact->noproductos=$request->get('noproductos');
	 		$fact->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$fact->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fact->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$fact->fecha=$request->get('fecha');
	 		$fact->tiendaodomicilio=$request->get('tiendaodomicilio');
	 		$fact->facturaPaga=$request->get('facturaPaga');
	 		$fact->update();
	 		return Redirect::to('almacen/facturacion/listaVentas');
	 	}

	 	public function destroy($id){

	 		$id=$id;

	 		$existeDF=DB::table('detalle_factura')
	 			->where('factura_id_factura','=',$id)
	 			->orderBy('id_detallef', 'desc')->get();

	 		$existeC=DB::table('cartera')
	 			->where('factura_id_factura','=',$id)
	 			->orderBy('id_cartera', 'desc')->get();

	 			if(count($existeDF)==0 && count($existeC)==0){
	 				$fact=Factura::findOrFail($id);
	 				$fact->delete();
	 					
	 				return back()->with('msj','Venta eliminada');
	 			}
	 			else{
	 		
	 			return back()->with('errormsj','¡Venta con productos o cartera activa!');

	 			}
	 	}
}