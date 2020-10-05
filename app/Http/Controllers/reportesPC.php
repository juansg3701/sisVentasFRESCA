<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\Rpc;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RpcFormRequest;
use DB;

class reportesPC extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$sedes=DB::table('usuario')->where('nombre_sede','LIKE', '%'.$query.'%');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$reportes=DB::table('reportepc')
	 			->orderBy('id_rpc','desc')->get();

	 			return view('almacen.reportes.pagosCobros.pagos.pagos',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}

	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=Rpc::findOrFail($id);

	 		$productos=DB::table('ctas_a_pagar as cp')
	  		->join('bancos as b','cp.bancos_id_banco','=','b.id_banco')	
	  		->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
	 		->select('cp.id_ctaspagar','cp.fecha','cp.nombrepago','cp.descripcion','b.nombre_banco as bancos','cp.total','cp.cuotas_totales','e.nombre as nombreE','cp.cuotas_restantes','b.NoCuenta as nocuenta','b.intereses as intereses')
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
	 		->orderBy('cp.id_ctaspagar', 'desc')
	 		->paginate(10);

		    $atrasados=DB::table('ctas_a_pagar as cp')
	 		->select(DB::raw('COUNT(cp.cuotas_totales) as atrasado'), 'cp.cuotas_restantes')
	 		->where('cp.cuotas_restantes','>',0)
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
		    ->get();

		    $pagos=DB::table('ctas_a_pagar as cp')
	 		->select(DB::raw('COUNT(cp.cuotas_restantes) as pago'))
	 		->where('cp.cuotas_restantes','=',0)
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
		    ->get();

		    if(auth()->user()->superusuario==0){
			$productos=DB::table('ctas_a_pagar as cp')
	  		->join('bancos as b','cp.bancos_id_banco','=','b.id_banco')	
	  		->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
	  		->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select('cp.id_ctaspagar','cp.fecha','cp.nombrepago','cp.descripcion','b.nombre_banco as bancos','cp.total','cp.cuotas_totales','e.nombre as nombreE','cp.cuotas_restantes','b.NoCuenta as nocuenta','b.intereses as intereses')
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('cp.id_ctaspagar', 'desc')
	 		->paginate(10);

		    $atrasados=DB::table('ctas_a_pagar as cp')
		    ->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(cp.cuotas_totales) as atrasado'), 'cp.cuotas_restantes')
	 		->where('cp.cuotas_restantes','>',0)
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();

		    $pagos=DB::table('ctas_a_pagar as cp')
		    ->join('empleado as e','cp.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(cp.cuotas_restantes) as pago'))
	 		->where('cp.cuotas_restantes','=',0)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->where('cp.fecha','>=',$r->fechaInicial)
	 		->where('cp.fecha','<=',$r->fechaFinal)
		    ->get();		    	
		    }
		 			
	 		return view("almacen.reportes.pagosCobros.pagos.grafica",["modulos"=>$modulos, "productos"=>$productos, "atrasados"=>$atrasados, "pagos"=>$pagos]);
	 	}


	 	public function show($id){}


	 	public function store(RpcFormRequest $request){
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new Rpc;
	 		$reporte->fechaInicial=$fechaInicialR;
	 		$reporte->fechaFinal=$fechaFinalR;
	 		$reporte->fechaActual=$request->get('fechaActual');
	 		$reporte->save();
	 			return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 	}

	 	public function destroy($id){
	 		$reporte = Rpc::findOrFail($id);
	 		$reporte->delete();

	 		
	 	return back()->with('msj','Reporte eliminado');
	 	}
 
}