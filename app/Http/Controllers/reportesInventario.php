<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\ProductoSede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventario extends Controller
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
	 			
	 			
	 			$reportes=RInventarios::orderBy('id_rInventario', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();

	 			return view('almacen.reportes.inventario.inventario',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
	 		}
	 	}


	 	public function store(RInventariosFormRequest $request){
	 		
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RInventarios;
	 		$reporte->fechaInicial=$request->get('fechaInicial');
	 		$reporte->fechaFinal=$request->get('fechaFinal');
	 		$reporte->fechaActual=$request->get('fechaActual');

	 		$nop="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";
	 		$reporte->noProductos=$nop;
	 		$reporte->total=$request->get('total');
	 		$reporte->save();

	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 		
	 	}

	 	public function edit($id){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$r=RInventarios::findOrFail($id);
	 		

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			if(auth()->user()->superusuario==0){

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto')
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			
	 			}
	 			$productos=ProductoSede::get();
	 			 			
	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado,"id"=>$id,"ventas"=>$ventas,"r"=>$r,"productos"=>$productos]);
	 	}


	 	public function destroy($id){
	 		$reporte = RInventarios::findOrFail($id);
	 		$reporte->delete();
	 		return back()->with('msj','Reporte eliminado');
	 	}

	 
}
