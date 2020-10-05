<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\AbonoPC;
use sisVentas\PedidoCliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use DB;

class facturacionTListaVentas extends Controller
{
	public function __construct(){
		
	} 

	public function edit($id){
			$id=$id;

		 	$datos="SELECT f.id_factura,tp.nombre,f.pago_total,f.noproductos FROM factura as f, tipo_pago as tp where f.id_factura=$id and f.tipo_pago_id_tpago=tp.id_tpago";


		 	$nomEmpleado="SELECT * FROM factura as f, empleado as e where f.id_factura=$id and f.empleado_id_empleado=e.id_empleado";

		 	$nomCliente="SELECT * FROM factura as f, cliente as c where f.id_factura=$id and f.cliente_id_cliente=c.id_cliente";

		 	$productos="SELECT df.id_detallef,p.nombre,df.cantidad,df.total,p.precio FROM detalle_factura as df, stock as st,producto as p where df.factura_id_factura=$id  and st.id_stock=df.producto_id_producto and p.id_producto=st.producto_id_producto ORDER BY df.id_detallef";


		 	$impuestos="SELECT df.id_detallef,i.nombre, i.valor  FROM detalle_factura as df, impuestos as i where df.factura_id_factura=$id and i.id_impuestos=df.impuestos_id_impuestos ORDER BY df.id_detallef";

		 	$descuentos="SELECT df.id_detallef,d.nombre, d.porcentaje  FROM detalle_factura as df, descuentos as d where df.factura_id_factura=$id and d.id_descuento=df.descuentos_id_descuento ORDER BY df.id_detallef";


		
			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
			$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		return view('almacen.facturacion.TicketFactura.index',["id"=>$id,"modulos"=>$modulos,"datos"=>$datos, "productos"=>$productos, "nomEmpleado"=>$nomEmpleado, "nomCliente"=>$nomCliente, "impuestos"=>$impuestos, "descuentos"=>$descuentos]);
 	}

 	public function create(Request $request){
	 		return view('almacen.AbonoRecibo.index');
	}

 	public function store(AbonoPCFormRequest $request){}
 	
 	public function index(Request $request){}


}