<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Impuesto;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ImpuestoFormRequest;
use DB;

class ImpuestoProducto extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$impuestos=Impuesto::where('nombre','LIKE', '%'.$query.'%')
	 			->orderBy('id_impuestos', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$impuP=Impuesto::get();
	 			$sedes=DB::table('sede')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			
	 			return view('almacen.inventario.producto-sede.impuestoProducto.index',["impuestos"=>$impuestos,"searchText"=>$query, "modulos"=>$modulos,"impuP"=>$impuP,"sedes"=>$sedes,"usuarios"=>$usuarios]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.impuestoProducto.index",["modulos"=>$modulos]);
	 	}

	 	public function store(ImpuestoFormRequest $request){
	 		$impuesto = new Impuesto;
	 		$impuesto->nombre=$request->get('nombre');
	 		$impuesto->descripcion=$request->get('descripcion');
	 		$impuesto->valor_impuesto=$request->get('valor_impuesto');
	 		$impuesto->sede_id_sede=$request->get('sede_id_sede');
	 		$impuesto->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$impuesto->fecha=$request->get('fecha');
	 		$impuesto->save();

	 		return back()->with('msj','Impuesto guardado');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.impuestoProducto.show",["impuestos"=>Impuesto::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		$sedes=DB::table('sede')->get();
	 		$usuarios=DB::table('empleado')->get();

	 			
	 		return view("almacen.inventario.producto-sede.impuestoProducto.edit",["impuestos"=>Impuesto::findOrFail($id),"modulos"=>$modulos,"sedes"=>$sedes,"usuarios"=>$usuarios]);
	 	}

	 	public function update(ImpuestoFormRequest $request, $id){
	 		$impuesto = Impuesto::findOrFail($id);
	 		
	 		$impuesto->nombre=$request->get('nombre');
	 		$impuesto->descripcion=$request->get('descripcion');
	 		$impuesto->valor_impuesto=$request->get('valor_impuesto');
	 		$impuesto->sede_id_sede=$request->get('sede_id_sede');
	 		$impuesto->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$impuesto->fecha=$request->get('fecha');
	 		$impuesto->update();

	 		return back()->with('msj','Impuesto actualizado');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeP=ProductoSede::where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($existeP)==0){
	 			
	 		$impuesto=Impuesto::findOrFail($id);
	 		$impuesto->delete();

	 		return back()->with('msj','Impuesto eliminado');
	 		}else{
	 			return back()->with('errormsj','¡Impuesto relacionado!');
	 		}

	 		
	 	}

	 
}
