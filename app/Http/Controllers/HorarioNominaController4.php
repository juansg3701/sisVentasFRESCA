<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Nomina_Horario;
use sisVentas\Usuario;
use sisVentas\Cargo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;
use DateTime;

class HorarioNominaController4 extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}  
	 	public function index(Request $request){
		if ($request) {

	 			$nombres='Carlos Martinez';
	 			$desdes='2020-03-15';
	 			
	 			$desde=$request->get('desde');
	 			$hasta=$request->get('hasta');

	 			$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->join('nomina as n','u.id_empleado','=','n.empleado_id_empleado')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','n.hora_total','n.pago_total', DB::raw('MAX(n.hora_total) as horaTotal'), DB::raw('MAX(n.pago_total) as pagoTotal'))	
	 			->orderBy('u.id_empleado', 'desc')
	 			->groupBy('n.empleado_id_empleado')
	 			->paginate(10);

	 			$nombre=$request->get('nombre');
	 			
	 			return view('almacen.nomina.datos.datos',["usuarios"=>$usuarios,"nombre"=>$nombre, "desde"=>$desde, "hasta"=>$hasta]);
	 		}
	 		
	 	}


	 		public function store(NominaHor4FormRequest $request){

	 		$nombres='Carlos Martinez';
	 		$desdes='2020-03-15';
	 		
	 		$desde=$request->get('desde');
	 		$hasta=$request->get('hasta');

	 		$usuarios=DB::table('empleado as u')
	 			->join('tipo_cargo as c','u.tipo_cargo_id_cargo','=','c.id_cargo')
	 			->join('sede as s','u.sede_id_sede','=','s.id_sede')
	 			->join('nomina as n','u.id_empleado','=','n.empleado_id_empleado')
	 			->select('u.id_empleado','u.nombre','u.correo','u.contrasena','c.nombre as tipo_cargo','s.nombre_sede as sede','u.codigo','n.hora_total','n.pago_total', DB::raw('MAX(n.hora_total) as horaTotal'), DB::raw('MAX(n.pago_total) as pagoTotal'))	
	 			->orderBy('u.id_empleado', 'desc')
	 			->groupBy('n.empleado_id_empleado')
	 			->paginate(10);

	 		$nombre=$request->get('nombre');

			return view('almacen.nomina.lista_horarios.descargas.pdf',["usuarios"=>$usuarios,"nombre"=>$nombre, "desde"=>$desde, "hasta"=>$hasta]);
	 	}


	 
}
