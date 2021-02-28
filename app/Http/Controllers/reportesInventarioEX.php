<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventarioEX extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$id=trim($request->get('id'));

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
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
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
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
	 			->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			
	 			}
	 			
	 			$productos=ProductoSede::where('nombre','LIKE', '%'.$query.'%')
	 			->get();

	 			$productos_buscar=ProductoSede::get();
	 			   foreach($productos_stock as $pastels){
              foreach ($productos as $p){
                if ($pastels->producto_id_producto===$p->id_producto){
                  $pastels->producto_id_producto=$p->nombre;
				                }
				            }
				    }


	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado,"id"=>$id,"ventas"=>$ventas,"r"=>$r,"productos"=>$productos,"productos_stock"=>$productos_stock, "id"=>$id,"productos_buscar"=>$productos_buscar]);
	 	} 
	 	}
	 	public function show($id){

	 	}
	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RInventarios::findOrFail($id);
	 		

	 		$productos=DB::table('producto as p')
	 		->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 		->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 		->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo', 'p.fecha_registro')
	 		->where('p.fecha_registro','>=',$r->fechaInicial)
	 		->where('p.fecha_registro','<=',$r->fechaFinal)
	 		->orderBy('p.id_producto', 'desc')
	 		->paginate(10);

	 		$pastel=DB::table('producto as p')
            ->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 		->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
            ->select('p.nombre','p.stock_minimo')
            ->where('p.fecha_registro','>=',$r->fechaInicial)
	 		->where('p.fecha_registro','<=',$r->fechaFinal)->get();

	 		$longitud=DB::table('producto as p')
	 		->select(DB::raw('p.nombre','count(*) as name'))
		    ->get();
	
	 			 			
	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos, "productos"=>$productos,"longitud"=>$longitud, 'pastel'=>$pastel]);
	 	}

	 
}
