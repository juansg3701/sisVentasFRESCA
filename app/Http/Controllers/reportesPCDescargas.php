<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\Rpc;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RpcFormRequest;
use DB;

class reportesPCDescargas extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function index(Request $request){
		if ($request) {
	 		$query=trim($request->get('searchText'));
	 		$id1=trim($request->get('id1'));
	 		$id2=trim($request->get('id2'));
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=Rpc::findOrFail($id1);
	 		$fechaR1=$r->fechaActual;
	 		$r2=Rpc::findOrFail($id2);
	 		$fechaR2=$r2->fechaActual;

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

		    $atrasados2=DB::table('ctas_a_pagar as cp')
	 		->select(DB::raw('COUNT(cp.cuotas_totales) as atrasado'), 'cp.cuotas_restantes')
	 		->where('cp.cuotas_restantes','>',0)
	 		->where('cp.fecha','>=',$r2->fechaInicial)
	 		->where('cp.fecha','<=',$r2->fechaFinal)
		    ->get();

		    $pagos2=DB::table('ctas_a_pagar as cp')
	 		->select(DB::raw('COUNT(cp.cuotas_restantes) as pago'))
	 		->where('cp.cuotas_restantes','=',0)
	 		->where('cp.fecha','>=',$r2->fechaInicial)
	 		->where('cp.fecha','<=',$r2->fechaFinal)
		    ->get();


	 		return view("almacen.reportes.pagosCobros.pagos.download.index",["modulos"=>$modulos,  "atrasados"=>$atrasados, "pagos"=>$pagos, "atrasados2"=>$atrasados2, "pagos2"=>$pagos2]);
	 		}
	 	}


	public function show($id){
		$i=Rpc::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;
		$desde=$ini;
	 	$hasta=$fin;
		return view('almacen.reportes.pagosCobros.pagos.download.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	} 

	public function edit($id){
		$i=Rpc::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT cp.id_ctaspagar, cp.fecha, cp.nombrepago, cp.descripcion, b.nombre_banco as bancos, cp.total, cp.cuotas_totales, e.nombre as nombreE, cp.cuotas_restantes, b.NoCuenta as nocuenta, b.intereses as intereses FROM ctas_a_pagar as cp, bancos as b,empleado as e WHERE cp.bancos_id_banco=b.id_banco and cp.empleado_id_empleado=e.id_empleado and cp.fecha>='$desde' and cp.fecha<='$hasta'";

		return view('almacen.reportes.pagosCobros.pagos.download.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



	 
}
