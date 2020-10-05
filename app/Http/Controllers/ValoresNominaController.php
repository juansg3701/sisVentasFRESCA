<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cargo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\NominaValFormRequest;
use DB;

class ValoresNominaController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$cargos=DB::table('tipo_cargo')
	 			
	 			->orderBy('id_cargo', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.nomina.valores.index',["cargos"=>$cargos, "modulos"=>$modulos]);
	 		}
	 	}

	 	public function edit($id){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		
	 		return view("almacen.nomina.valores.edit",["cargo"=>Cargo::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 


	 	public function update(NominaValFormRequest $request, $id){
	 		$cargo = Cargo::findOrFail($id);	
	 		$cargo->nombre=$request->get('nombre');
	 		$cargo->descripcion=$request->get('descripcion');
	 		$cargo->horaordinaria=$request->get('horaordinaria');
	 		$cargo->horadominical=$request->get('horadominical');
	 		$cargo->horaextra=$request->get('horaextra');
	 		$cargo->horaextdom=$request->get('horaextdom');
	 		$cargo->fecha=$request->get('fecha');
	 		$cargo->update();


			return back()->with('msj','Valores actualizados');
	 	}

	 	public function store(NominaValFormRequest $request){
	 		$nomina_valores = new Nomina_Valores;
	 		$nomina_valores->horaordinaria=$request->get('horaordinaria');
	 		$nomina_valores->horadominical=$request->get('horadominical');
	 		$nomina_valores->horaextra=$request->get('horaextra');
	 		$nomina_valores->horaextdom=$request->get('horaextdom');
	 		$nomina_valores->fecha=$request->get('fecha');
	 		$nomina_valores->save();
	 		return Redirect::to('almacen/nomina/valores');
	 	}
	 	

	 
}
