<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\Rpc2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\Rpc2FormRequest;
use DB;

class reportesPC2 extends Controller
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
	 			
	 			$reportes=DB::table('reportepc2')
	 			->orderBy('id_rpc','desc')->get();

	 			return view('almacen.reportes.pagosCobros.cobros.cobros',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}

	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=Rpc2::findOrFail($id);

	 		$productos=DB::table('cartera as ct')
	 		->join('cliente as cl','ct.cliente_id_cliente','=','cl.id_cliente')
	 		->select('ct.id_cartera as id','cl.nombre as nombre','cl.telefono as telefono','cl.direccion as direccion','cl.correo as correo','ct.total as valortotal','ct.cuotas_totales as cuotasTotales','ct.cuotas_restantes as cuotasRestantes','ct.fecha as fecha','ct.atraso as atraso','ct.factura_id_factura as nofactura')
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->orderBy('ct.id_cartera','desc')
	 		->paginate(100);

	 		/*$longitud=DB::table('cartera as ct')
	 		->select('ct.id_cartera as id', DB::raw('SUM(atraso) as sumTotal'))
		    ->get();*/

		    $atrasados=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
		    ->get();

		    $pagos=DB::table('cartera as ct')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
		    ->get();

		    if(auth()->user()->superusuario==0){
			$productos=DB::table('cartera as ct')
			->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->join('cliente as cl','ct.cliente_id_cliente','=','cl.id_cliente')
	 		->select('ct.id_cartera as id','cl.nombre as nombre','cl.telefono as telefono','cl.direccion as direccion','cl.correo as correo','ct.total as valortotal','ct.cuotas_totales as cuotasTotales','ct.cuotas_restantes as cuotasRestantes','ct.fecha as fecha','ct.atraso as atraso','ct.factura_id_factura as nofactura')
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->orderBy('ct.id_cartera','desc')
	 		->paginate(100);

		    $atrasados=DB::table('cartera as ct')
		    ->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as atrasado'))
	 		->where('ct.atraso','=',0)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();

		    $pagos=DB::table('cartera as ct')
		    ->join('empleado as e','ct.empleado_id_empleado','=','e.id_empleado')
		    ->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 		->select(DB::raw('COUNT(ct.atraso) as pago'))
	 		->where('ct.atraso','=',1)
	 		->where('ct.fecha','>=',$r->fechaInicial)
	 		->where('ct.fecha','<=',$r->fechaFinal)
	 		->where('e.sede_id_sede','=',auth()->user()->sede_id_sede)
		    ->get();		    	
		    }
		 			
	 		return view("almacen.reportes.pagosCobros.cobros.grafica",["modulos"=>$modulos, "productos"=>$productos, "atrasados"=>$atrasados, "pagos"=>$pagos]);
	 	}

	 	public function store(Rpc2FormRequest $request){

	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new Rpc2;
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
	 		$reporte = Rpc2::findOrFail($id);
	 		$reporte->delete();

		 	return back()->with('msj','Reporte eliminado');
	 	}
 
}