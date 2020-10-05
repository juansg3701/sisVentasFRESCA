<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Nomina_Horario;
use sisVentas\Usuario;
use sisVentas\Cargo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\NominaHor2FormRequest;
use DB;
use DateTime;

class HorarioNominaController3 extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}  
	 	public function index(Request $request){
	 		if ($request) {

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view('almacen.nomina.modal.aviso',["modulos"=>$modulos]);
	 		}
	 	}

	 
	 
}
