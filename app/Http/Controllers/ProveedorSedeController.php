<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProveedorSede;
use sisVentas\ProductoSede;
use sisVentas\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorSedeFormRequest;
use DB;

class ProveedorSedeController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
		//redirige a la vista principal del inventario (stock)
	 	public function index(Request $request){
	 	if ($request) {

	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));


	 			$productos=DB::table('stock as s')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 			->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
	 			->select('s.id_stock','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.sede_id_sede as sede_id_sede', 's.producto_id_producto','s.fecha_registro','s.empleado_id_empleado','cpt.nombre as nombreCategoria')
	 			->where('sed.nombre_sede','LIKE', '%'.$query2.'%')
	 			->where('pd.nombre_proveedor','LIKE', '%'.$query3.'%')
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(10);

	 			$productosBuscar=ProductoSede::where('producto.nombre','LIKE', '%'.$query0.'%')
	 			->where('plu','LIKE', '%'.$query1.'%')
	 			->orderBy('id_producto', 'desc')
	 			->paginate(10);



				$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$eanP=ProductoSede::orderBy('id_producto', 'desc')->get();
	 			$sedesP=DB::table('sede')->get();
	 			$proveedoresP=DB::table('proveedor')->get();
	 			$empleados=DB::table('empleado')->get();
	 			$categoriaTrans=DB::table('categoria_producto_trans')->get();
	 			$categoria=Categoria::get();


	 			return view('almacen.inventario.proveedor-sede.index',["productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3, "modulos"=>$modulos,"eanP"=>$eanP,"sedesP"=>$sedesP,"proveedoresP"=>$proveedoresP,"productosBuscar"=>$productosBuscar,"empleados"=>$empleados,"categoriaTrans"=>$categoriaTrans]);
	 		}
	 	}
	 	


	 	public function create(Request $request){

	 	}

	 	public function store(Request $request){
	 		$id=$request->get('id');

	 		$registro=ProveedorSede::findOrFail($id);


	 		$ps = new ProveedorSede;
	 		$ps->producto_id_producto=$registro->producto_id_producto;
	 		$ps->sede_id_sede=$registro->sede_id_sede;
	 		$ps->proveedor_id_proveedor=$registro->proveedor_id_proveedor;
	 		$ps->disponibilidad=$registro->disponibilidad;
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->fecha_registro=$request->get('fecha_registro');
	 		$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$ps->transformacion_stock_id=$request->get('transformacion_stock_id');
	 		$ps->save();

	 		return back()->with('msj','Producto guardado');
	 	}

	 	public function show($id){
	 		$query=$id;

	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();
			$pEAN=DB::table('producto')
			->where('ean','=',$query)
			->get();
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			

	 		return view("almacen.inventario.ean.index",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "pEAN"=>$pEAN,"searchText"=>$query]);
	 	}

	 	public function edit($id){
	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=ProductoSede::get();
	 		$usuarios=DB::table('empleado')->get();
	 		$transformacion=DB::table('categoria_producto_trans')->get();
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		return view("almacen.inventario.proveedor-sede.edit",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto,"stock"=>ProveedorSede::findOrFail($id), "modulos"=>$modulos,"transformacion"=>$transformacion,"usuarios"=>$usuarios]);
	 	}

	 	public function update(ProveedorSedeFormRequest $request, $id){
	 		$ps = ProveedorSede::findOrFail($id);
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->sede_id_sede=$request->get('sede_id_sede');
	 		$ps->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$ps->disponibilidad=$request->get('disponibilidad');
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->fecha_registro=$request->get('fecha_registro');
	 		$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$ps->transformacion_stock_id=$request->get('transformacion_stock_id');
	 		$ps->update();

	 		return back()->with('msj','Producto actualizado');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeDF=DB::table('detalle_factura')
	 		->where('stock_id_stock','=',$id)
	 		->orderBy('id_detallef', 'desc')->get();
	 		/*
	 		$existe=DB::table('m_stock')
	 		->where('stock_id_stock','=',$id)
	 		->orderBy('id_mstock', 'desc')->get();

	 		$existeDPC=DB::table('d_p_cliente')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dpcliente', 'desc')->get();

	 		$existeDPP=DB::table('d_p_proveedor')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dpproveedor', 'desc')->get();
			*/
	 		if(count($existeDF)==0){
	 			$ps=ProveedorSede::findOrFail($id);
	 			$ps->delete();

	 		return back()->with('msj','Producto eliminado');

	 		}else{

	 		return back()->with('errormsj','¡Producto relacionado!');

	 		}


	 		
	 	}



}