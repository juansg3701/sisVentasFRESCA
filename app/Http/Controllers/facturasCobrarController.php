<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\FacturaCobrar;
use sisVentas\FacturaCobrarDetalle;
use sisVentas\Cliente;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaCobrarFormRequest;
use DB;

class facturasCobrarController extends Controller
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
	 			
	 			$clientes=DB::table('cartera as ct')
	 			->join('cliente as cl','ct.cliente_id_cliente','=','cl.id_cliente')
	 			->select('ct.id_cartera as id','cl.nombre as nombre','cl.telefono as telefono','cl.direccion as direccion','cl.correo as correo','ct.total as valortotal','ct.cuotas_totales as cuotasTotales','ct.cuotas_restantes as cuotasRestantes','ct.fecha as fecha','ct.atraso as atraso','ct.factura_id_factura as nofactura')
	 			->where('cl.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('ct.id_cartera','desc')->get();

	 		
	 			
	 			
	 		foreach($clientes as $cli){
	 			$cuenta=false;
	 			$cuenta2=false;
	 			$fecha=$cli->fecha;
				$a=strtotime($fecha);

			$detalleCartera=DB::table('detalle_cartera as dc')
			->where('dc.id_cartera','=',$cli->id)
			->orderBy('dc.id_dCartera')->get();

					foreach($detalleCartera as $dcar){
						$fechadc=$dcar->fecha;
						$adc=strtotime($fechadc);

						if(date("y",$adc)==date("y") && date("m",$adc)==date("m")){
							$cuenta2=true;
							if(date("d",$adc)<=date("d",$a)){
								$cuenta=true;
							}

						}	 		
			 		}
			 		$facturaDetalle= FacturaCobrar::findOrFail($cli->id);

			 		if($cuenta2==true){
			 			$facturaDetalle->atraso=1;
			 		}
			 		if (date("d",$a)<=date("d") && $cuenta2==false) {
			 			$facturaDetalle->atraso=0;
			 		}

			 		$facturaDetalle->update();

	 		}	
	 		$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

							
	 			return view('almacen.pagosCobros.FacturasCobrar.facturasCobrar',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"clientes"=>$clientes,"clientesP"=>$clientesP]);
	 		}
	 	}
 	 	public function edit($id){
 	 			$id=$id;
	 			$query="";
	 		
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$abonos=DB::table('detalle_cartera as dc')
	 			->join('empleado as e','dc.empleado_id_empleado','=','e.id_empleado')
	 			->join('cartera as c','dc.id_cartera','=','c.id_cartera')
	 			->join('tipo_pago as tp','dc.tipo_pago','=','tp.id_tpago')
	 			->select('dc.id_dCartera as id','dc.fecha as fecha','dc.valor_abono as valorabono','dc.valor_total as valortotal','dc.valor_restante as valorrestante','e.nombre as nombreE','c.id_cartera as id_cartera','tp.nombre as nombreP')
	 			->where('dc.id_cartera','=',$id)
	 			->orderBy('dc.id_dCartera','desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();

	 				$valorrestanteT=DB::table('cartera')
	 			->where('id_cartera','=',$id)
	 			->orderBy('id_cartera', 'desc')->get();
				
				$valortotalT=DB::table('detalle_cartera')
	 			->where('id_cartera','=',$id)
	 			->orderBy('id_dCartera', 'desc')->get();

	 			$bancos=DB::table('bancos')->get();

	 			$sedes=DB::table('sede')->get();

	 			return view('almacen.pagosCobros.AbonosCartera.index',["searchText"=>$query, "modulos"=>$modulos,"abonos"=>$abonos,"usuarios"=>$usuarios,"tipoPago"=>$tipoPago,"id"=>$id,"valorrestanteT"=>$valorrestanteT,"valortotalT"=>$valortotalT,"bancos"=>$bancos,"sedes"=>$sedes]);
	 	}


	 		public function create(){
	 			$cliente="";
	 			$clienteN="";
	 			$total="";
	 			$empleado="";
	 			$empleadoN="";
	 			$facturaId=0;


	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$clientesM=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			$usuarios=DB::table('empleado')->get();
	 			return view('almacen.pagosCobros.FacturasCobrar.registrar', ["modulos"=>$modulos,"clientesM"=>$clientesM,"usuarios"=>$usuarios,"cliente"=>$cliente,"clienteN"=>$clienteN,"total"=>$total,"empleado"=>$empleado,"empleadoN"=>$empleadoN,"facturaId"=>$facturaId]);	
	 		
	 	}

	 	public function store(FacturaCobrarFormRequest $request){
	 		$clienteR=$request->get('cliente_id_cliente');

	 		$fc = new FacturaCobrar;
	 		$fc->cuotas_totales=$request->get('cuotas_totales');
	 		$fc->cuotas_restantes=$request->get('cuotas_totales');
	 		$fc->cliente_id_cliente=$clienteR;
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->total=$request->get('total');
	 		$fc->fecha=$request->get('fecha');
	 		$fc->atraso=$request->get('atraso');
	 		$fc->factura_id_factura=$request->get('factura_id_factura');
	 		$fc->save();

	 		$clienteBD = Cliente::findOrFail($clienteR);
	 		$clienteBD->cartera_activa=1;
	 		$clienteBD->update();


	 		return back()->with('msj','Cartera guardada');
	 	}


	 	public function show($id){
	 			$id=$id;
	 			$cliente="";
	 			$clienteN="";
	 			$total="";
	 			$empleado="";
	 			$empleadoN="";
	 			$facturaId=0;

	 			$facturas=DB::table('factura as f')
		 		->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
		 		->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
		 		->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
		 		->select('e.nombre as nombreE','f.empleado_id_empleado as id_empleado','c.nombre as nombreC','f.cliente_id_cliente as id_cliente','f.pago_total as total','f.id_factura as id_factura')
	 			->where('f.id_factura','=',$id)
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(10);

	 			foreach ($facturas as $f) {
		 			$cliente=$f->id_cliente;
		 			$clienteN=$f->nombreC;
		 			$total=$f->total;
		 			$empleado=$f->id_empleado;
		 			$empleadoN=$f->nombreE;
		 			$facturaId=$f->id_factura;
	 			}

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			$clientesM=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();

	 			$detalleProductos=DB::table('detalle_factura')
	 			->orderBy('id_detallef', 'desc')->get();
	 			$stock=DB::table('stock')
	 			->orderBy('id_stock', 'desc')->get();
	 			$sedeP=auth()->user()->sede_id_sede;
				$descuento=0;

				$facturasPagos=DB::table('factura')
				->where('id_factura','=',$id)
			 	->orderBy('id_factura', 'desc')->get();

	 				return view('almacen.pagosCobros.FacturasCobrar.registrar', ["modulos"=>$modulos,"clientesM"=>$clientesM,"usuarios"=>$usuarios,"cliente"=>$cliente,"clienteN"=>$clienteN,"total"=>$total,"empleado"=>$empleado,"empleadoN"=>$empleadoN,"facturaId"=>$facturaId]);	
	 			
	 			
	 	}


	 	public function update(FacturaCobrarFormRequest $request, $id){
	 		$fc = FacturaCobrar::findOrFail($id);
	 		$fc->cuotas_totales=$request->get('cuotas_totales');
	 		$fc->cuotas_restantes=$request->get('cuotas_restantes');
	 		$fc->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$fc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 		$fc->total=$request->get('total');
	 		$fc->fecha=$request->get('fecha');
	 		$fc->atraso=$request->get('atraso');
	 		$fc->factura_id_factura=$request->get('factura_id_factura');
	 		$fc->update();
	 		return Redirect::to('almacen/pagosCobros/FacturasCobrar');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existeC=DB::table('detalle_cartera')
		 	->where('id_cartera','=',$id)
		 	->orderBy('id_dCartera', 'desc')->get();
		 	
		 	if(count($existeC)==0){

		 	$fc=FacturaCobrar::findOrFail($id);
	 		$fc->delete();

		 		return back()->with('msj','Cartera eliminada');	
		 	}else{

	 		return back()->with('errormsj','¡Cartera con abonos!');
		 	}

	 	}
	 
}