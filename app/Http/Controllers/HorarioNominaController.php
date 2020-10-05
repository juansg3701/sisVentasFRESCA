<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Nomina_Horario;
use sisVentas\Usuario;
use sisVentas\Cargo;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\NominaHorFormRequest;
use DB;
use DateTime;

class HorarioNominaController extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}  
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			$nominas=DB::table('nomina as n')
	 			->join('empleado as e','n.empleado_id_empleado','=','e.id_empleado')
	 			->select('n.id','e.nombre as empleado','n.fecha','n.horaentrada','n.horasalida','n.jornada','n.no_horas','n.pago_sem','n.hora_total','n.pago_total')
	 			->where('e.nombre','LIKE', '%'.$query0.'%')
	 			->orderBy('n.id', 'desc')
	 			->paginate(10);
	 			$nominas2=DB::table('nomina as n')
	 			->join('empleado as e','n.empleado_id_empleado','=','e.id_empleado')
	 			->select('n.id','e.nombre as empleado','n.fecha','n.horaentrada','n.horasalida','n.jornada','n.no_horas','n.pago_sem','n.hora_total','n.pago_total')
	 			->where('e.nombre','LIKE', '%'.$query0.'%')
	 			->where('e.id_empleado','LIKE', '%'.$query3)
	 			->where('n.fecha','>=',$query1)
	 			->where('n.fecha','<=',$query2)
	 			->orderBy('n.id', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.nomina.horario.index',["nominas"=>$nominas, "nominas2"=>$nominas2,"usuarios"=>$usuarios, "modulos"=>$modulos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3]);
	 		}
	 	}

	 	public function show(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			$query3=trim($request->get('searchText3'));
	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			$nominas=DB::table('nomina as n')
	 			->join('empleado as e','n.empleado_id_empleado','=','e.id_empleado')
	 			->select('n.id','e.nombre as empleado','n.fecha','n.horaentrada','n.horasalida','n.jornada','n.no_horas','n.pago_sem','n.hora_total','n.pago_total')
	 			->where('e.nombre','LIKE', '%'.$query0.'%')
	 			->orderBy('n.id', 'desc')
	 			->paginate(10);


	 			$nominas2=DB::table('nomina as n')
	 			->join('empleado as e','n.empleado_id_empleado','=','e.id_empleado')
	 			->select('n.id','e.nombre as empleado','n.fecha','n.horaentrada','n.horasalida','n.jornada','n.no_horas','n.pago_sem','n.hora_total','n.pago_total')
	 			->where('e.nombre','LIKE', '%'.$query0.'%')
	 			->where('e.id_empleado','LIKE', '%'.$query3)
	 			->where('n.fecha','>=',$query1)
	 			->where('n.fecha','<=',$query2)
	 			->orderBy('n.id', 'desc')
	 			->paginate(100);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$empleadoP=DB::table('empleado')->get();

	 			return view('almacen.nomina.lista_horarios.index',["nominas"=>$nominas, "nominas2"=>$nominas2,"usuarios"=>$usuarios, "modulos"=>$modulos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"searchText3"=>$query3,"empleadoP"=>$empleadoP]);
	 		}
	 	}


	 	public function store(NominaHorFormRequest $request){
	 		$nomina = new Nomina_Horario;
	 		$empleado = new Usuario;
	 		$cargo = new Cargo;
	 		$entrada=$request->get('horaentrada');
	 		$salida=$request->get('horasalida');

	 		if($salida>$entrada){
	 		$nomina->horaentrada=$entrada;
	 		$nomina->horasalida=$salida;
	 		$nomina->fecha=$request->get('fecha');
	 		$jornadas=$nomina->jornada=$request->get('jornada');		
	 		$usu=$nomina->empleado_id_empleado=$request->get('empleado_id_empleado');

	 		$intervalo =intval($salida)-intval($entrada);
	 		$nomina->no_horas=$intervalo;
	 		$jh=$nomina->no_horas=$intervalo;

	 		$cargos=DB::table('tipo_cargo as tc')->get();
	 		$empleados=DB::table('empleado as e')->get();
	 		$nominas=DB::table('nomina as n');

	 		$cargos=DB::table('tipo_cargo as tc')
	 			->join('empleado as e','tc.id_cargo','=','e.tipo_cargo_id_cargo')
	 			->select('tc.horaordinaria','tc.horadominical','tc.horaextra','tc.horaextdom')
	 			->get();

	 		$emp=DB::table('empleado as e')
	 			->join('tipo_cargo as tc','e.tipo_cargo_id_cargo','=','tc.id_cargo')
	 			->select('tc.horaordinaria','tc.horadominical','tc.horaextra','tc.horaextdom' )
	 			->get();

	 		$cargosOrd=DB::table('tipo_cargo as tc')
	 			->join('empleado as e','tc.id_cargo','=','e.tipo_cargo_id_cargo')
	 			->select('tc.horaordinaria')
	 			->where('e.id_empleado','=',$usu)
	 			->get();
	 		$cargosExt=DB::table('tipo_cargo as tc')
	 			->join('empleado as e','tc.id_cargo','=','e.tipo_cargo_id_cargo')
	 			->select('tc.horaextra')
	 			->where('e.id_empleado','=',$usu)
	 			->get();
	 		$cargosDom=DB::table('tipo_cargo as tc')
	 			->join('empleado as e','tc.id_cargo','=','e.tipo_cargo_id_cargo')
	 			->select('tc.horadominical')
	 			->where('e.id_empleado','=',$usu)
	 			->get();
	 		$cargosExtDom=DB::table('tipo_cargo as tc')
	 			->join('empleado as e','tc.id_cargo','=','e.tipo_cargo_id_cargo')
	 			->select('tc.horaextdom')
	 			->where('e.id_empleado','=',$usu)
	 			->get();


	 		$total=0;

	 		if ($jornadas=='Ordinaria') {
	 			foreach ($cargosOrd as $vi){
	 			$total=($vi->horaordinaria*$intervalo);	
	 			}
			}
			if ($jornadas=='Extraordinaria') {
				foreach ($cargosExt as $vi) {
	 			$total=($vi->horaextra*$intervalo);	
	 			}
			  
			}
			if ($jornadas=='Dominical') {
				foreach ($cargosDom as $vi) {
	 			$total=($vi->horadominical*$intervalo);	
	 			}
			  
			}
			if ($jornadas=='Extradominical') {
				foreach ($cargosExtDom as $vi) {
	 			$total=($vi->horaextdom*$intervalo);	
	 			}
			}

	 		$nomina->pago_sem=$total;
	 		$jp=$nomina->pago_sem=$total;

	 		$sumaHoras=DB::table('nomina as no')
	 			->select('no_horas', DB::raw('SUM(no_horas) as no_horas'))
	 			->where('no.empleado_id_empleado','=',$usu)
	 			->get();
	 		$sumh=0;
	 		foreach ($sumaHoras as $vi) {
	 			$sumh=($vi->no_horas+$jh);	
	 		}
	 		$nomina->hora_total=$sumh;


	 		$sumaPagos=DB::table('nomina as no')
	 			->select('pago_sem', DB::raw('SUM(pago_sem) as pago_sem'))
	 			->where('no.empleado_id_empleado','=',$usu)
	 			->get();
	 		$sump=0;
	 		foreach ($sumaPagos as $vi) {
	 			$sump=($vi->pago_sem+$jp);	
	 		}
	 		$nomina->pago_total=$sump;


	 		$nomina->save();


	 		return back()->with('msj','Horario guardado');
	 		}else{
	 			return back()->with('errormsj','Ingrese una salida mayor a la entrada');
	 		}

	 	}


	 	public function destroy($id){
	 		$nomina=Nomina_Horario::findOrFail($id);
	 		$nomina->delete();
	 		return Redirect::to('almacen/nomina/horario');
	 	}
	 
}
