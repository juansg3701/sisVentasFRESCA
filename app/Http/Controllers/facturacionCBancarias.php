<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Request\SedeFormRequest;
use DB;

class facturacionCBancarias extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	}  
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));
	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$cuentas=DB::table('detalle_banco as db')
	 			->join('bancos as b','db.banco_idBanco','=','b.id_banco')
	 			->join('tipo_cuenta as tc','b.tipo_cuenta_id_tcuenta','=','tc.id_tcuenta')
	 			->join('sede as s','db.sede_id_sede','=','s.id_sede')
	 			->select('db.id_Dbanco as id','tc.nombre as tipo','db.fecha as fecha','db.ingreso_efectivo as iefectivo','db.egreso_efectivo as efectivo','db.ingreso_electronico as ielectronico','db.egreso_electronico as electronico','b.nombre_banco as nbanco','b.NoCuenta as cuenta','s.nombre_sede as sede','db.sede_id_sede as sede_id_sede')
	 			->where('db.fecha','LIKE', '%'.$query.'%')
	 			->where('db.banco_idBanco','LIKE', '%'.$query1.'%')
	 			->orderBy('db.id_Dbanco', 'desc')->get();

	 			if(auth()->user()->superusuario==0){
	 				$cuentas=DB::table('detalle_banco as db')
	 			->join('bancos as b','db.banco_idBanco','=','b.id_banco')
	 			->join('tipo_cuenta as tc','b.tipo_cuenta_id_tcuenta','=','tc.id_tcuenta')
	 			->join('sede as s','db.sede_id_sede','=','s.id_sede')
	 			->select('db.id_Dbanco as id','tc.nombre as tipo','db.fecha as fecha','db.ingreso_efectivo as iefectivo','db.egreso_efectivo as efectivo','db.ingreso_electronico as ielectronico','db.egreso_electronico as electronico','b.nombre_banco as nbanco','b.NoCuenta as cuenta','s.nombre_sede as sede','db.sede_id_sede as sede_id_sede')
	 			->where('db.fecha','LIKE', '%'.$query.'%')
	 			->where('db.banco_idBanco','LIKE', '%'.$query1.'%')
	 			->where('db.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('db.id_Dbanco', 'desc')->get();
	 			}

	 			$tipoCuenta=DB::table('bancos as b')
	 			->join('tipo_cuenta as tc','b.tipo_cuenta_id_tcuenta','=','tc.id_tcuenta')
	 			->select('tc.nombre as tipo','b.intereses as interes')
	 			->where('b.id_banco','LIKE', '%'.$query1.'%')
	 			->orderBy('b.id_banco', 'desc')->get();


	 			$bancos=DB::table('bancos')->get();


	 			return view('almacen.facturacion.cuentasBancarias.cuentasBancarias',["sedes"=>$sedes,"searchText"=>$query,"searchText1"=>$query1, "modulos"=>$modulos,"cuentas"=>$cuentas,"bancos"=>$bancos,"tipoCuenta"=>$tipoCuenta]);
	 		}
	 	}

	 
	  	public function edit(Request $request){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view('almacen.facturacion.cuentasBancarias.registrar',["modulos"=>$modulos]);
	 		
	 	}
}