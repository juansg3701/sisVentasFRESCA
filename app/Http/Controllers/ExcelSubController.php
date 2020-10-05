<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Proveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorFormRequest;
use DB;

class ExcelSubController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function index(Request $request){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 		return view('almacen.excel2.interfaz.index' ,["modulos"=>$modulos]);	
	 		//return view('almacen.excel2.index');
	 	}

	 	public function create(Request $request){
	 		return view('almacen.excel.pdf');
	 	}

	 	public function store(ProveedorFormRequest $request){
	 		$proveedor = new Proveedor;
	 		$proveedor->nombre_empresa=$request->get('nombre_empresa');
	 		$proveedor->nombre_proveedor=$request->get('nombre_proveedor');
	 		$proveedor->direccion=$request->get('direccion');
	 		$proveedor->telefono=$request->get('telefono');
	 		$proveedor->correo=$request->get('correo');
	 		$proveedor->documento=$request->get('documento');
	 		$proveedor->verificacion_nit=$request->get('verificacion_nit');
	 		$proveedor->save();
	 		return Redirect::to('almacen/proveedor');
	 	}

	 	public function show(Request $request){
	 		
	 		return view('almacen.excel2.import');
	 	}
}
