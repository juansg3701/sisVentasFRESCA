<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProveedorSede;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorSedeFormRequest;
use DB;

class registroProductoProveedor extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}
			 	
	 	public function index(Request $request){
	 				if ($request) {
	 				$query=trim($request->get('searchText'));

	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$usuarios=DB::table('empleado')->get();
	 		$transformacion=DB::table('categoria_producto_trans')->get();
	 		$producto=ProductoSede::get();
	 			$query=trim($request->get('searchText'));
			$pEAN=ProductoSede::where('ean','=',$query)
			->get();
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		return view("almacen.inventario.ean.index",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "pEAN"=>$pEAN,"searchText"=>$query,"usuarios"=>$usuarios,"transformacion"=>$transformacion]);
	 	}
	 	}

	 	public function create(Request $request){
	 			 		if ($request) {
	 				$query=trim($request->get('searchText'));

	 		$sede=DB::table('sede')->get();
	 		$proveedor=DB::table('proveedor')->get();
	 		$producto=DB::table('producto')->get();
	 			$query=trim($request->get('searchText'));
			$pEAN=DB::table('producto')
			->where('ean','=',$query)
			->get();
	 			
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			

	 		return view("almacen.inventario.proveedor-sede.registrar.registrar",["sede"=>$sede,"proveedor"=>$proveedor,"producto"=>$producto, "modulos"=>$modulos,  "pEAN"=>$pEAN,"searchText"=>$query]);
	 	}
	 	}

	 	public function store(ProveedorSedeFormRequest $request){
	 		$ps = new ProveedorSede;
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->sede_id_sede=$request->get('sede_id_sede');
	 		$ps->proveedor_id_proveedor=$request->get('proveedor_id_proveedor');
	 		$ps->disponibilidad=$request->get('disponibilidad');
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->fecha_registro=$request->get('fecha_registro');
	 		$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$ps->transformacion_stock_id=$request->get('transformacion_stock_id');
	 		$ps->save();

	 		return back()->with('msj','Producto guardado');
	 	}

	 	public function show($id){
	 		
	 	}

}