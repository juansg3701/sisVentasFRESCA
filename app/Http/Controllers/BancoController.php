<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Banco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\BancoFormRequest;
use DB;

class BancoController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$bancos=DB::table('bancos as b')
	 			->join('tipo_cuenta as tp','b.tipo_cuenta_id_tcuenta','=','tp.id_tcuenta')
	 			->select('b.id_banco','b.nombre_banco','b.intereses','b.NoCuenta','tp.nombre as tipo')
	 			->where('b.nombre_banco','LIKE', '%'.$query.'%')
	 			->orderBy('b.id_banco', 'desc')
	 			->paginate(7);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$bancosP=DB::table('bancos')->get();	 			

	 			return view('almacen.pagosCobros.Bancos.index',["bancos"=>$bancos,"searchText"=>$query, "modulos"=>$modulos,"bancosP"=>$bancosP]);
	 		}
	 	}

	 	public function create(){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		$tcuentas=DB::table('tipo_cuenta')->get();
	 		

	 		return view("almacen.pagosCobros.Bancos.registrar", ["tcuentas"=>$tcuentas,"modulos"=>$modulos]);
	 	}

	 	public function store(BancoFormRequest $request){
	 		$banco = new Banco;
	 		$banco->nombre_banco=$request->get('nombre_banco');
	 		$banco->intereses=$request->get('intereses');
	 		$banco->NoCuenta=$request->get('NoCuenta');
	 		$banco->tipo_cuenta_id_tcuenta=$request->get('tipo_cuenta_id_tcuenta');
	 		$banco->save();

	 		return back()->with('msj','Cuenta guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.pagosCobros.Bancos.show",["bancos"=>Banco::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$tcuentas=DB::table('tipo_cuenta')->get();
	 			

	 		return view("almacen.pagosCobros.Bancos.edit",["tcuentas"=>$tcuentas,"bancos"=>Banco::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 	public function update(BancoFormRequest $request, $id){
	 		$banco = Banco::findOrFail($id);
	 		$banco->nombre_banco=$request->get('nombre_banco');
	 		$banco->intereses=$request->get('intereses');
	 		$banco->NoCuenta=$request->get('NoCuenta');
	 		$banco->tipo_cuenta_id_tcuenta=$request->get('tipo_cuenta_id_tcuenta');
	 		$banco->update();

	 		return back()->with('msj','Cuenta actualizada');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeB=DB::table('detalle_banco')
	 		->where('banco_idBanco','=',$id)
	 		->orderBy('id_Dbanco', 'desc')->get();

	 		$existeP=DB::table('ctas_a_pagar')
	 		->where('bancos_id_banco','=',$id)
	 		->orderBy('id_ctaspagar', 'desc')->get();

	 		if(count($existeB)==0 && count($existeP)==0){
	 		$banco=Banco::findOrFail($id);
	 		$banco->delete();

	 		return back()->with('msj','Cuenta eliminada');
	 		}else{
	 			return back()->with('errormsj','¡Cuenta ya relacionada!');
	 		}

	 	
	 	}

	 	
}
