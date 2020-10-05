<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventarioEXP extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	
} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$reportes=DB::table('reporteinventarios')
	 			->orderBy('id_rInventarios','desc')->get();

	 			return view('almacen.reportes.inventario.inventario',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}




	 	public function create(Request $request){

	 		if ($request) {

	 			return view('almacen.reportes.pedidos.descargas.pdf');
	 		}
	 		
	 	}

	 	public function show(Request $request){

	 		if ($request) {
	 			$nombre='Carlos Martinez';
	 			$desdes='2020-03-15';
	 			$desde=$request->get('desde');
	 			$hasta=trim($request->get('hasta'));
	 			
	 			$productos="SELECT tc.id_remision,tc.noproductos,tc.fecha_solicitud,tc.fecha_entrega,tc.pago_inicial,tc.porcentaje_venta,tc.pago_total, e.nombre as empleado, c.nombre as cliente, p.nombre as tipo_pago FROM t_p_cliente as tc, empleado as e, cliente as c, tipo_pago as p WHERE tc.empleado_id_empleado=e.id_empleado and tc.cliente_id_cliente=c.id_cliente and tc.tipo_pago_id_tpago=p.id_tpago";

	 			return view('almacen.reportes.pedidos.descargas.tipoPDF.index',["productos"=>$productos]);
	 		}
	 		
	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$reporte=RInventarios::findOrFail($id)->get();
	 			foreach ($reporte as $r) {
	 				# code...
	 			$grafican2=DB::table('factura as f')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('pr.nombre as nombrep')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$graficac2=DB::table('factura as f')
	 			->join('detalle_factura as df','f.id_factura','=','df.factura_id_factura')
	 			->join('stock as p','df.producto_id_producto','=','p.id_stock')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('df.cantidad as cantidad')
	 			->where('f.fecha','>=',$r->fechaInicial)
	 			->where('f.fecha','<=',$r->fechaFinal)
	 			->orderBy('f.id_factura', 'desc')->get();

	 			$grafican=DB::table('producto as pro')
	 			->select('pro.nombre as nombrep')->get();

	 			$graficac=DB::table('producto as pro')
	 			->select('pro.stock_minimo as cantidad')->get();

	 			$graProvn=DB::table('stock as st')
	 			->join('producto as pro','st.producto_id_producto','=','pro.id_producto')
	 			->select('pro.nombre as nombrep')->get();

	 			$graProvc=DB::table('stock as st')
	 			->join('producto as pro','st.producto_id_producto','=','pro.id_producto')
	 			->select('st.cantidad as cantidad')->get();


	 			$productos=DB::table('producto as p')
	 			->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 			->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo')
	 			->orderBy('p.id_producto', 'desc')
	 			->paginate(10);

	 			$longitud=DB::table('producto as p')
	 			->select(DB::raw('p.nombre','count(*) as name'))
		        ->get();
	
	 		}	 			
	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos,"grafican"=>$grafican,"graficac"=>$graficac,"graProvn"=>$graProvn,"graProvc"=>$graProvc, "productos"=>$productos,"longitud"=>$longitud]);
	 	}





	 
}
