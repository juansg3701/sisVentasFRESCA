<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Descuentos;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\DescuentosFormRequest;
use DB;

class DescuentoProducto extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));

	 			$descuentos=Descuentos::where('nombre','LIKE', '%'.$query.'%')
	 			->orderBy('id_descuento', 'desc')
    			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$sedes=DB::table('sede')->get();

	 			$descuentoP=Descuentos::get();

	 			$usuarios=DB::table('empleado')->get();

	 			return view('almacen.inventario.producto-sede.descuentos.index',["descuentos"=>$descuentos,"searchText"=>$query, "modulos"=>$modulos,"sedes"=>$sedes,"descuentoP"=>$descuentoP,"usuarios"=>$usuarios]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.descuentos.index",["modulos"=>$modulos]);
	 	}

	 	public function store(DescuentosFormRequest $request){
	 		$descuento = new Descuentos;
	 		$descuento->nombre=$request->get('nombre');
	 		$descuento->descripcion=$request->get('descripcion');
	 		$descuento->valor_descuento=$request->get('valor_descuento');
	 		$descuento->sede_id_sede=$request->get('sede_id_sede');
	 		$descuento->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$descuento->fecha=$request->get('fecha');
	 		$descuento->save();

	 		return back()->with('msj','Descuento guardado');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.descuentos.show",["impuestos"=>Descuentos::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		$sedes=DB::table('sede')->get();
	 		$usuarios=DB::table('empleado')->get();
	 			
	 		return view("almacen.inventario.producto-sede.descuentos.edit",["descuentos"=>Descuentos::findOrFail($id),"modulos"=>$modulos,"sedes"=>$sedes,"usuarios"=>$usuarios]);
	 	}

	 	public function update(DescuentosFormRequest $request, $id){
	 		$descuento = Descuentos::findOrFail($id);
	 		$descuento->nombre=$request->get('nombre');
	 		$descuento->descripcion=$request->get('descripcion');
	 		$descuento->valor_descuento=$request->get('valor_descuento');
	 		$descuento->sede_id_sede=$request->get('sede_id_sede');
	 		$descuento->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$descuento->fecha=$request->get('fecha');
	 		$descuento->update();

	 		return back()->with('msj','Descuento actualizado');


	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeD=ProductoSede::where('descuento_id_descuento','=',$id)
	 		->orderBy('id_producto', 'desc')->get();


	 		if(count($existeD)==0){

	 		$descuento=Descuentos::findOrFail($id);
	 		$descuento->delete();

	 		return back()->with('msj','Descuento eliminado');

	 		}else{
	 			return back()->with('errormsj','¡Descuento relacionado!');
	 		}

	 	}

	 
}
