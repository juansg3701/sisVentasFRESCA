<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Request\SedeFormRequest;
use DB;

class admin extends Controller
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

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			
	 			return view('layouts.admin',["modulos"=>$modulos,"clientesP"=>$clientesP]);
	 		}
	 	}
}