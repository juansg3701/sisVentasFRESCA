<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\AbonoPC;
use sisVentas\PedidoCliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\AbonoPCFormRequest;
use sisVentas\Http\Requests\PedidoClienteFormRequest;
use Mail;
use DB;

class AbonoPCController extends Controller
{
	public function __construct(){
		
		
	} 


	public function create(Request $request){
        $subject = "Asunto del correo";
        $for = "juangomez3701@gmail.com";
        Mail::send('almacen.emails.tickets',$request->all(), function($msj) use($subject,$for){
            $msj->from("holman.test17@gmail.com","Prueba-Ticket");
            $msj->subject($subject);
            $msj->to($for);
             $msj->attach(public_path('/').'/prueba.pdf');
           

        });

        return back()->with('msj','Correo enviado');
	}

	public function index(Request $request){


	 	$query=trim($request->get('searchText'));
		$query2=trim($request->get('searchText2'));
	 	$query3=trim($request->get('searchText3'));
	 	$query4=trim($request->get('searchText4'));
	 	$usuarios=DB::table('empleado')->get();
	 	$clientes=DB::table('cliente')->get();
	 	$tipoPagos=DB::table('tipo_pago')->get();
	 	$pedidosCliente=DB::table('t_p_cliente as tc')
	 	->join('empleado as e','tc.empleado_id_empleado','=','e.id_empleado')
	 	->join('cliente as c','tc.cliente_id_cliente','=','c.id_cliente')
	 	->join('tipo_pago as p','tc.tipo_pago_id_tpago','=','p.id_tpago')
	 	->select('tc.id_remision','tc.noproductos','tc.fecha_solicitud','tc.fecha_entrega','tc.pago_inicial','tc.porcentaje_venta','tc.pago_total', 'e.nombre as empleado', 'c.nombre as cliente', 'p.nombre as tipo_pago')
	 	->where('tc.fecha_solicitud','LIKE', '%'.$query.'%')
	 	->where('tc.fecha_entrega','LIKE', '%'.$query2.'%')
	 	->where('tc.id_remision','LIKE', '%'.$query3.'%')
	 	->where('c.nombre','LIKE', '%'.$query4.'%')
	 	->orderBy('tc.id_remision', 'desc')
	 	->paginate(10);

	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
	 	->orderBy('id_cargo', 'desc')->get();
	 	return view('almacen.facturacion.listaPedidosClientes.listaPedidos',["tipoPagos"=>$tipoPagos,"modulos"=>$modulos,"pedidosCliente"=>$pedidosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "searchText"=>$query, "searchText2"=>$query2, "searchText3"=>$query3, "searchText4"=>$query4]);
 	}


	public function edit($id){

	 	$id=$id;
	 	$usuarios=DB::table('empleado')->get();
	 	$clientes=DB::table('cliente')->get();
	 	$tipoPagos=DB::table('tipo_pago')->get();
	 	$abonosCliente=DB::table('t_ab_p_cliente as apc')
	 	->join('t_p_cliente as tc','apc.t_p_cliente_id_remision','=','tc.id_remision')
	 	->join('empleado as e','apc.empleado_id_empleado','=','e.id_empleado')
	 	->join('tipo_pago as p','apc.tipo_pago_id_tpago','=','p.id_tpago')
	 	->select('apc.id_abono','tc.id_remision as t_p_cliente_id_remision','apc.abono','apc.restante','apc.total','apc.fecha','e.nombre as empleado', 'p.nombre as tipo_pago','apc.tipo_pago_id_tpago as tipo_pago_id_tpago','apc.facturaPaga as facturaPaga')
	 	->where('apc.t_p_cliente_id_remision','=',$id)
		->orderBy('apc.t_p_cliente_id_remision', 'desc')
	 	->paginate(10);

	 	$totales=DB::table('t_p_cliente')
	 	->select('pago_total')
	 	->where('id_remision','=',$id)
	 	->get();



	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();


	 	$abCliente=DB::table('t_ab_p_cliente')->get();

	 	$tipoPago=DB::table('tipo_pago')->get();
	 	$facturas=DB::table('t_ab_p_cliente')->get();

	 	return view('almacen.pedidosDevoluciones.abonoCliente.abonoCliente',["id"=>$id,"abonosCliente"=>$abonosCliente, "tipoPagos"=>$tipoPagos, "clientes"=>$clientes, "usuarios"=>$usuarios, "modulos"=>$modulos,"totales"=>$totales, "abCliente"=>$abCliente,"tipoPago"=>$tipoPago,"facturas"=>$facturas]);
	 	
 	}

	 public function store(AbonoPCFormRequest $request){
		$abonopc = new AbonoPC;
		$valorAbono=$request->get('abono');
		$idPedido=$request->get('t_p_cliente_id_remision');

		$saldoActual= PedidoCliente::findOrFail($idPedido);
		$totalActual=$saldoActual->pago_total;


		if($totalActual>=$valorAbono){
			$pedidoCliente = new PedidoCliente;
		$id_remision=$idPedido;
	 	$abonopc->t_p_cliente_id_remision=$id_remision;


	 	$abonopc->abono=$valorAbono;

	 	$abonopc->total=$request->get('total');
	 	$abonopc->fecha=$request->get('fecha');
	 	$abonopc->empleado_id_empleado=$request->get('empleado_id_empleado');
	 	$abonopc->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');


	 	$id=$pedidoCliente->id_remision;

	 	$res=$abonopc->total-$abonopc->abono;
	 	
	 	$abonopc->restante=$res;
	 	$abonopc->facturaPaga=0;
	 	$abonopc->save();

	 	$pc = PedidoCliente::findOrFail($id_remision);
	 	$pc->pago_total=$res;
	 	$pc->update();

	 	return back()->with('msj','Abono guardado');

		}else{
			return back()->with('errormsj','¡Ingrese un abono menor o igual al restante!');
		}
	 }

	public function destroy($idf){
	 	$abonopc = AbonoPC::findOrFail($idf);
		$id=$abonopc->t_p_cliente_id_remision;
	 	$res=$abonopc->abono;
		$abonopc->delete();
	 	
	 	$pc = PedidoCliente::findOrFail($id);
	 	$anteriorT=$pc->pago_total;
	 	$pc->pago_total=$anteriorT+$res;
	 	$pc->update();

	 	return back()->with('msj','Abono eliminado');

	}


	public function show(Request $request){
	}

}