<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Request\SedeFormRequest;
use DB;

class reportesNomina extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){

	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query3=trim($request->get('searchText3'));
	 			$cargos=DB::table('tipo_cargo')->get();
	 			$sedes=DB::table('sede')->get();

				$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->join('nomina as n','u.id_empleado','=','n.empleado_id_empleado')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','n.hora_total','n.pago_total', DB::raw('MAX(n.hora_total) as horaTotal'), DB::raw('MAX(n.pago_total) as pagoTotal'))	
	 			->where('u.nombre','LIKE', '%'.$query.'%')
	 			->where('u.id_empleado','LIKE', '%'.$query3.'%')
	 			->orderBy('u.id_empleado', 'desc')
	 			->groupBy('n.empleado_id_empleado')
	 			->paginate(10);
 
	 			$nominas2=DB::table('nomina as n')
	 			->join('empleado as e','n.empleado_id_empleado','=','e.id_empleado')
	 			->select('n.hora_total','n.pago_total')
	 			->where('e.id_empleado','=','n.empleado_id_empleado')
	 			->orderBy('n.id', 'desc')
	 			->paginate(10);


	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$empleadoP=DB::table('empleado')->get();
	 			
	 			return view('almacen.reportes.nomina.nomina',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos, "usuarios"=>$usuarios,"searchText3"=>$query3, "nominas2"=>$nominas2, "empleadoP"=>$empleadoP]);
	 		}
	 	}

	 	public function show(Request $request){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 
	 			return view('almacen.reportes.nomina.nomina',["modulos"=>$modulos]);
	 		
	 	}

	 
}
