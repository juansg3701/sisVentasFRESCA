<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Descuentos;
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
	 			$descuentos=DB::table('descuentos as d')
	 			->join('sede as s','d.sede_id_sede','=','s.id_sede')
	 			->select('d.id_descuento as id_descuento','d.nombre as nombre','d.caracteristica as caracteristica', 'd.porcentaje as porcentaje','s.nombre_sede as sede_id_sede','d.sede_id_sede as sedeId')
	 			->where('d.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('d.id_descuento', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$sedes=DB::table('sede')->get();

	 			$descuentoP=DB::table('descuentos')->get();

	 			return view('almacen.facturacion.descuentos.index',["descuentos"=>$descuentos,"searchText"=>$query, "modulos"=>$modulos,"sedes"=>$sedes,"descuentoP"=>$descuentoP]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.facturacion.descuentos.index",["modulos"=>$modulos]);
	 	}

	 	public function store(DescuentosFormRequest $request){
	 		$descuento = new Descuentos;
	 		$descuento->nombre=$request->get('nombre');
	 		$descuento->caracteristica=$request->get('caracteristica');
	 		$descuento->porcentaje=$request->get('porcentaje');
	 		$descuento->sede_id_sede=$request->get('sede_id_sede');
	 		$descuento->save();

	 		return back()->with('msj','Descuento guardado');
	 	}

	 	public function show($id){
	 		return view("almacen.facturacion.descuentos.show",["impuestos"=>Descuentos::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 		$sedes=DB::table('sede')->get();
	 			
	 		return view("almacen.facturacion.descuentos.edit",["descuentos"=>Descuentos::findOrFail($id),"modulos"=>$modulos,"sedes"=>$sedes]);
	 	}

	 	public function update(DescuentosFormRequest $request, $id){
	 		$descuento = Descuentos::findOrFail($id);
	 		$descuento->nombre=$request->get('nombre');
	 		$descuento->caracteristica=$request->get('caracteristica');
	 		$descuento->porcentaje=$request->get('porcentaje');
	 		$descuento->sede_id_sede=$request->get('sede_id_sede');
	 		$descuento->update();

	 		return back()->with('msj','Descuento actualizado');


	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeD=DB::table('detalle_factura')
	 		->where('descuentos_id_descuento','=',$id)
	 		->orderBy('id_detallef', 'desc')->get();

	 		$existePC=DB::table('d_p_cliente')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_dpcliente', 'desc')->get();

	 		$existePP=DB::table('d_p_proveedor')
	 		->where('impuestos_id_impuestos','=',$id)
	 		->orderBy('id_dpproveedor', 'desc')->get();

	 		if(count($existeD)==0 && count($existePC)==0 && count($existePP)==0){

	 		$descuento=Descuentos::findOrFail($id);
	 		$descuento->delete();

	 		return back()->with('msj','Descuento eliminado');

	 		}else{
	 			return back()->with('errormsj','¡Descuento relacionado!');
	 		}

	 	}

	 
}
