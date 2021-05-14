<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\RVentas;
use sisVentas\Factura;
use sisVentas\Cliente;
use sisVentas\ProductoSede;
use sisVentas\ProductosFactura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RVentasFormRequest;
use DB;
use DateTime;

class reportesVentas extends Controller
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

	 			$reportes=RVentas::orderBy('id_rVentas', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();
	 			

	 			return view('almacen.reportes.ventas.ventas',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
	 		}
	 	}


	 	public function create(){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view("almacen.cliente.registrar",["modulos"=>$modulos]);
	 		
	 	}

	 	public function store(RVentasFormRequest $request){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RVentas;
	 		$reporte->fechaInicial=$request->get('fechaInicial');
	 		$reporte->fechaFinal=$request->get('fechaFinal');
	 		$reporte->fechaActual=$request->get('fechaActual');

	 		$nop="SELECT SUM(df.cantidad) FROM detalle_factura as df,factura as f WHERE df.factura_id_factura=f.id_factura";
	 		$reporte->noProductos=$nop;
	 		$reporte->total=$request->get('total');
	 		$reporte->save();

	 		return back()->with('msj','Reporte guardado');
	 		}else{
	 			return back()->with('errormsj','¡Las fechas no son correctas!');
	 		}
	 	}

	 	public function edit($id){
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$fecha = new DateTime($r->fechaInicial);
				$semana = $fecha->format('W');
				dd("Semana: ".$semana);
	 			 			
	 		return view("almacen.reportes.ventas.grafica2",["modulos"=>$modulos,"NoPagoE"=>$NoPagoE,"NoPagoD"=>$NoPagoD,"NoPagoP"=>$NoPagoP,"id"=>$id,"ventas"=>$ventas,"r"=>$r]);
	 	}

	 	public function show($id){
	 		return  Redirect::to("almacen/reportes/ventas");
	 	}


		public function detalleVenta($id){
		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$cadena=$id;
	 			$separador = ".";

	 			$separada = explode($separador, $cadena);
			$count=1;

			$valor_no1=0;
			$valor_no2=0;
			$valor_no3=0;

			if(count($separada)==4){
				$valor_clave=$separada[0];
				$valor_year=$separada[1];
				$valor_fecha_final=$separada[2];
				$valor_tipo=$separada[3];


				switch ($valor_tipo) {
					case 's':

					//Detallado de semana
						$ventas2=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$valor_year)
	 				->where(DB::raw('WEEK(f.fecha)'),'=',$valor_clave)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);


		 			if(auth()->user()->superusuario==0){
		 			$ventas2=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$valor_year)
	 				->where(DB::raw('WEEK(f.fecha)'),'=',$valor_clave)
	 				->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);
		 		
		 			}

		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas2 as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas2[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas2[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas2[$key]->total);
		 			}
		 			$tipo_reporte_detallado="s";
		 			return view("almacen.reportes.ventas.graficad2",["modulos"=>$modulos,"ventas"=>$ventas2,"fecha_d"=>$valor_clave,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado, "valor_year"=>$valor_year, "valor_clave"=>$valor_clave, "valor_fecha_final"=>$valor_fecha_final, "valor_tipo"=>$valor_tipo]);
						break;

						
					case 'm':

					//Detallado de mes
						$ventas_m=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$valor_year)
	 				->where(DB::raw('MONTH(f.fecha)'),'=',$valor_clave)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 			if(auth()->user()->superusuario==0){
		 				$ventas_m=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$valor_year)
	 				->where(DB::raw('MONTH(f.fecha)'),'=',$valor_clave)
	 				->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);
		 		
		 			}

		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas_m as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas_m[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas_m[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas_m[$key]->total);
		 			}
		 			$tipo_reporte_detallado="m";

		 			//dd($valor_year.' '.$valor_clave);
		 			
		 			return view("almacen.reportes.ventas.graficad2",["modulos"=>$modulos,"ventas"=>$ventas_m,"fecha_d"=>$valor_fecha_final,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado, "valor_year"=>$valor_year, "valor_clave"=>$valor_clave, "valor_fecha_final"=>$valor_fecha_final, "valor_tipo"=>$valor_tipo]);
						break;

					default:
						# code...
						break;
				}
			}
		}
	 			
	 	public function update(Request $request, $id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		$tipo_consulta=$request->get('tipo');
	 		$tipo_reporte=$request->get('tipo_reporte');
	 		$fecha_actual=date('Y-m-d');
	 		

	 		//Reporte por dias
	 		if($tipo_consulta==1){
	 			$fecha_d=$request->get('fecha_diaria');

	 			if($fecha_d>$fecha_actual || $fecha_d==""){
	 				return back()->with('errormsj','¡¡La fecha no debe ser mayor a la actual!!');
	 			}else{
	 				//Reporte general
	 				if($tipo_reporte==1){
	 				
	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
	 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->paginate(100);

	 			$total_ventas=DB::table('factura as f')
	 			->select(DB::raw('sum(f.pago_total) as pago_total'))
	 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(100);

	 				if(auth()->user()->superusuario==0){
	 				$ventas=DB::table('factura as f')
		 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
		 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
		 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
		 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
		 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->orderBy('f.id_factura', 'asc')
		 			->paginate(100);

		 			$total_ventas=DB::table('factura as f')
		 			->select(DB::raw('sum(f.pago_total) as pago_total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->orderBy('f.id_factura', 'desc')
		 			->paginate(100);
		 			}


		 			return view("almacen.reportes.ventas.graficad",["modulos"=>$modulos,"ventas"=>$ventas,"fecha_d"=>$fecha_d,"total_ventas"=>$total_ventas]);
	 				}else{

	 				//Reporte detallado

		 			$ventas2=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);


		 			if(auth()->user()->superusuario==0){
		 				$ventas2=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 		
		 			}

					$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas2 as $key => $value) {	
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas2[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas2[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas2[$key]->total);
		 			}
		 			$tipo_reporte_detallado="d";
		 			
		 			return view("almacen.reportes.ventas.graficad2",["modulos"=>$modulos,"ventas"=>$ventas2,"fecha_d"=>$fecha_d,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado]);

	 				}
	 			}
	 		}
	 		// reporte por semanas
	 		if ($tipo_consulta==2) {
	 			$fecha_semana_inicial=$request->get('fecha_semana_inicial');
	 			$fecha_semana_final=$request->get('fecha_semana_final');
	 			$fecha_year=$request->get('fecha_year');

	 			if($fecha_semana_inicial>$fecha_semana_final || $fecha_semana_inicial=="" || $fecha_semana_final==""){
	 				return back()->with('errormsj','¡¡La fecha inicial no debe ser mayor a la final!!');
	 			}else{

	 			//General
	 			$ventas_semanal=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',
				 DB::raw('sum(f.pago_total) as pago_total'),
				 DB::raw('sum(f.noproductos) as noproductos'), 
				 DB::raw('WEEK(f.fecha) as fecha'), 
				 DB::raw('YEAR(f.fecha) as year'))
	 			->where(DB::raw('WEEK(f.fecha)'),'>=',$fecha_semana_inicial)
	 			->where(DB::raw('WEEK(f.fecha)'),'<=',$fecha_semana_final)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$fecha_year)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy(DB::raw('WEEK(f.fecha)'), 'asc')
	 			->groupBy(DB::raw('WEEK(f.fecha)'))
	 			->paginate(100);

	 			if(auth()->user()->superusuario==0){
	 				$ventas_semanal=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 	
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), DB::raw('WEEK(f.fecha) as fecha'),DB::raw('YEAR(f.fecha) as year'))
	 			->where(DB::raw('WEEK(f.fecha)'),'>=',$fecha_semana_inicial)
	 			->where(DB::raw('WEEK(f.fecha)'),'<=',$fecha_semana_final)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$fecha_year)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy(DB::raw('WEEK(f.fecha)'), 'asc')
	 			->groupBy(DB::raw('WEEK(f.fecha)'))
	 			->paginate(100);
	 			}

	 			$total_ventas_semanales=0;
	 			foreach ($ventas_semanal as $key => $value) {	
		 				$total_ventas_semanales=intval($total_ventas_semanales)+intval($ventas_semanal[$key]->pago_total);
		 			}

	 			return view("almacen.reportes.ventas.graficas",["modulos"=>$modulos,"ventas"=>$ventas_semanal,"fecha_inicial"=>$fecha_semana_inicial,"fecha_final"=>$fecha_semana_final, "fecha_year"=>$fecha_year,"total_ventas"=>$total_ventas_semanales]);
	 			}

	 		}
	 		//reporte por meses
	 		if($tipo_consulta==3){
	 			
	 			$fecha_mes_inicial=$request->get('fecha_mes_inicial');
	 			$fecha_mes_final=$request->get('fecha_mes_final');
	 			$fecha_year=$request->get('fecha_year');

	 			if($fecha_mes_inicial>$fecha_mes_final || $fecha_mes_inicial=="" || $fecha_mes_final==""){
	 				return back()->with('errormsj','¡¡La fecha inicial no debe ser mayor a la final!!');
	 			}else{

	 			$ventas_mensuales=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',
				 DB::raw('sum(f.pago_total) as pago_total'),
				 DB::raw('sum(f.noproductos) as noproductos'), 
				 'tp.nombre as tipo_pago_id_tpago', 
				 DB::raw('MONTH(f.fecha) as fecha'), 
				 DB::raw('YEAR(f.fecha) as fecha_year'),
				 DB::raw('MONTH(f.fecha) as fecha_mes'))
	 			->where(DB::raw('MONTH(f.fecha)'),'>=',$fecha_mes_inicial)
	 			->where(DB::raw('MONTH(f.fecha)'),'<=',$fecha_mes_final)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$fecha_year)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);


	 			if(auth()->user()->superusuario==0){
	 			$ventas_mensuales=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), 'tp.nombre as tipo_pago_id_tpago', DB::raw('MONTH(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as fecha_year'), DB::raw('MONTH(f.fecha) as fecha_mes'))
	 			->where(DB::raw('MONTH(f.fecha)'),'>=',$fecha_mes_inicial)
	 			->where(DB::raw('MONTH(f.fecha)'),'<=',$fecha_mes_final)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$fecha_year)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);	
	 			}


	 			$total_ventas_mensuales=0;
	 			foreach ($ventas_mensuales as $key => $value) {	
		 				$total_ventas_mensuales=intval($total_ventas_mensuales)+intval($ventas_mensuales[$key]->pago_total);

		 				switch ($ventas_mensuales[$key]->fecha) {
		 					case '1':
		 						$ventas_mensuales[$key]->fecha="Enero";
		 					break;

		 					case '2':
		 						$ventas_mensuales[$key]->fecha="Febrero";
		 					break;

		 					case '3':
		 						$ventas_mensuales[$key]->fecha="Marzo";
		 					break;

		 					case '4':
		 						$ventas_mensuales[$key]->fecha="Abril";
		 					break;

		 					case '5':
		 						$ventas_mensuales[$key]->fecha="Mayo";
		 					break;

		 					case '6':
		 						$ventas_mensuales[$key]->fecha="Junio";
		 					break;

		 					case '7':
		 						$ventas_mensuales[$key]->fecha="Julio";
		 					break;

		 					case '8':
		 						$ventas_mensuales[$key]->fecha="Agosto";
		 					break;

		 					case '9':
		 						$ventas_mensuales[$key]->fecha="Septiembre";
		 					break;

		 					case '10':
		 						$ventas_mensuales[$key]->fecha="Octubre";
		 					break;

		 					case '11':
		 						$ventas_mensuales[$key]->fecha="Noviembre";
		 					break;

		 					case '12':
		 						$ventas_mensuales[$key]->fecha="Diciembre";
		 					break;
		 					
		 					default:
		 						$ventas_mensuales[$key]->fecha="Ninguno";
		 					break;
		 				}
		 			}

		 			switch ($fecha_mes_inicial) {
		 					case '1':
		 						$fecha_mes_inicial="Enero";
		 					break;

		 					case '2':
		 						$fecha_mes_inicial="Febrero";
		 					break;

		 					case '3':
		 						$fecha_mes_inicial="Marzo";
		 					break;

		 					case '4':
		 						$fecha_mes_inicial="Abril";
		 					break;

		 					case '5':
		 						$fecha_mes_inicial="Mayo";
		 					break;

		 					case '6':
		 						$fecha_mes_inicial="Junio";
		 					break;

		 					case '7':
		 						$fecha_mes_inicial="Julio";
		 					break;

		 					case '8':
		 						$fecha_mes_inicial="Agosto";
		 					break;

		 					case '9':
		 						$fecha_mes_inicial="Septiembre";
		 					break;

		 					case '10':
		 						$fecha_mes_inicial="Octubre";
		 					break;

		 					case '11':
		 						$fecha_mes_inicial="Noviembre";
		 					break;

		 					case '12':
		 						$fecha_mes_inicial="Diciembre";
		 					break;
		 					
		 					default:
		 						$fecha_mes_inicial="Ninguno";
		 					break;
		 				}

		 				switch ($fecha_mes_final) {
		 					case '1':
		 						$fecha_mes_final="Enero";
		 					break;

		 					case '2':
		 						$fecha_mes_final="Febrero";
		 					break;

		 					case '3':
		 						$fecha_mes_final="Marzo";
		 					break;

		 					case '4':
		 						$fecha_mes_final="Abril";
		 					break;

		 					case '5':
		 						$fecha_mes_final="Mayo";
		 					break;

		 					case '6':
		 						$fecha_mes_final="Junio";
		 					break;

		 					case '7':
		 						$fecha_mes_final="Julio";
		 					break;

		 					case '8':
		 						$fecha_mes_final="Agosto";
		 					break;

		 					case '9':
		 						$fecha_mes_final="Septiembre";
		 					break;

		 					case '10':
		 						$fecha_mes_final="Octubre";
		 					break;

		 					case '11':
		 						$fecha_mes_final="Noviembre";
		 					break;

		 					case '12':
		 						$fecha_mes_final="Diciembre";
		 					break;
		 					
		 					default:
		 						$fecha_mes_final="Ninguno";
		 					break;
		 				}
	 			return view("almacen.reportes.ventas.graficam",["modulos"=>$modulos,"ventas"=>$ventas_mensuales,"fecha_inicial"=>$fecha_mes_inicial,"fecha_final"=>$fecha_mes_final, "fecha_year"=>$fecha_year, "total_ventas"=>$total_ventas_mensuales]);
	 			}

	 		}

	 	}	

	 	public function update2(Request $request, $id){
	 		dd("prueba");
	 	}

	 	public function destroy($id){
	 		$reporte=RVentas::findOrFail($id);
	 		$reporte->delete();

	 		return back()->with('msj','Reporte eliminado');
	 	}


	 	

	 	public function downloadPDFReport($id){

	 		$cadena=$id;
	 		$separador = ".";
	 		$separada = explode($separador, $cadena);
			$count=1;

			$desde=0;
			$hasta=0;
			$año=0;
			$valor=0;


			$fecha_d=0;

			if(count($separada)==4){
				$fecha_d=$separada[0];
				$desde=$separada[0];
				$hasta=$separada[1];
				$año=$separada[2];
				$valor=$separada[3];
				
			}


			//dd($fecha_d);
		 	
		 	//dd($desde.' '.$hasta);

		 	if($valor==3){


	 			//Mensual General
	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), 'tp.nombre as tipo_pago_id_tpago', DB::raw('MONTH(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as fecha_year'))
	 			->where(DB::raw('MONTH(f.fecha)'),'>=',$desde)
	 			->where(DB::raw('MONTH(f.fecha)'),'<=',$hasta)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$año)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);

	 			foreach ($ventas as $key => $value) {	

	 				switch ($ventas[$key]->fecha) {
	 					case '1':
	 						$ventas[$key]->fecha="Enero";
	 					break;

	 					case '2':
	 						$ventas[$key]->fecha="Febrero";
	 					break;

	 					case '3':
	 						$ventas[$key]->fecha="Marzo";
	 					break;

	 					case '4':
	 						$ventas[$key]->fecha="Abril";
	 					break;

	 					case '5':
	 						$ventas[$key]->fecha="Mayo";
	 					break;

	 					case '6':
	 						$ventas[$key]->fecha="Junio";
	 					break;

	 					case '7':
	 						$ventas[$key]->fecha="Julio";
	 					break;

	 					case '8':
	 						$ventas[$key]->fecha="Agosto";
	 					break;

	 					case '9':
	 						$ventas[$key]->fecha="Septiembre";
	 					break;

	 					case '10':
	 						$ventas[$key]->fecha="Octubre";
	 					break;

	 					case '11':
	 						$ventas[$key]->fecha="Noviembre";
	 					break;

	 					case '12':
	 						$ventas[$key]->fecha="Diciembre";
	 					break;
	 					
	 					default:
	 						$ventas[$key]->fecha="Ninguno";
	 					break;
	 				}
		 		}
		 		$tipo="MENSUAL";
		 		$valor=3;

				return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);

		 	}


		 	

		 	if($valor==2){


	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), DB::raw('WEEK(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as year'))
	 			->where(DB::raw('WEEK(f.fecha)'),'>=',$desde)
	 			->where(DB::raw('WEEK(f.fecha)'),'<=',$hasta)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$año)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy(DB::raw('WEEK(f.fecha)'), 'asc')
	 			->groupBy(DB::raw('WEEK(f.fecha)'))
	 			->paginate(100);


				$tipo="SEMANAL";
		 		$valor=2;

				return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);
		 	}


		 	if($valor==1){


	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->paginate(100);

				$tipo="DIARIO";
		 		$valor=1;

				return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);
		 	}


		 	if($valor=='m'){

	 			//Detallado de mes
				$ventas=DB::table('detalle_factura as df')
		 		->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 		->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 		->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 		->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 		->where(DB::raw('YEAR(f.fecha)'),'=',$hasta)
	 			->where(DB::raw('MONTH(f.fecha)'),'=',$desde)
		 		->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
		 		->orderBy('df.id_detallef', 'asc')
		 		->groupBy('s.producto_id_producto')
		 		->paginate(100);


				$tipo="MENSUAL DETALLADO";
		 		$valor='m';

		 		$productosDB=ProductoSede::get();
				$total_ventas_diarias=0;
			
	 			foreach ($ventas as $key => $value) {
	 				foreach ($productosDB as $key2 => $value2) {
	 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
	 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
	 					}
	 				}
	 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
	 			}
	 			$tipo_reporte_detallado="m";

				return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);
		 	}

		 	if($valor=='s'){

		 		//Detallado de semana
					$ventas=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$hasta)
	 				->where(DB::raw('WEEK(f.fecha)'),'=',$desde)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 			$tipo="SEMANAL DETALLADO";
		 			$valor='s';


		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
		 			}
		 			$tipo_reporte_detallado="s";

		 			return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);

		 	}


		 	if($valor=='d'){

		 		//Detallado de semana
					$ventas=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 			$tipo="DIARIO DETALLADO";
		 			$valor='d';

		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas as $key => $value) {	
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
		 			}
		 			$tipo_reporte_detallado="d";

		 			return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);

		 	}

	 	} 


















	 	public function downloadExcelReport($id){

		 	$cadena=$id;
	 		$separador = ".";
	 		$separada = explode($separador, $cadena);
			$count=1;

			$desde=0;
			$hasta=0;
			$año=0;
			$valor=0;

			$fecha_d=0;
			

			if(count($separada)==4){
				$fecha_d=$separada[0];
				$desde=$separada[0];
				$hasta=$separada[1];
				$año=$separada[2];
				$valor=$separada[3];
				
			}
		 	
		 	//dd($desde.' '.$hasta);


		 	if($valor==3){

	 			//Mensual General
	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), 'tp.nombre as tipo_pago_id_tpago', DB::raw('MONTH(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as fecha_year'))
	 			->where(DB::raw('MONTH(f.fecha)'),'>=',$desde)
	 			->where(DB::raw('MONTH(f.fecha)'),'<=',$hasta)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$año)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);

	 			foreach ($ventas as $key => $value) {	

	 				switch ($ventas[$key]->fecha) {
	 					case '1':
	 						$ventas[$key]->fecha="Enero";
	 					break;

	 					case '2':
	 						$ventas[$key]->fecha="Febrero";
	 					break;

	 					case '3':
	 						$ventas[$key]->fecha="Marzo";
	 					break;

	 					case '4':
	 						$ventas[$key]->fecha="Abril";
	 					break;

	 					case '5':
	 						$ventas[$key]->fecha="Mayo";
	 					break;

	 					case '6':
	 						$ventas[$key]->fecha="Junio";
	 					break;

	 					case '7':
	 						$ventas[$key]->fecha="Julio";
	 					break;

	 					case '8':
	 						$ventas[$key]->fecha="Agosto";
	 					break;

	 					case '9':
	 						$ventas[$key]->fecha="Septiembre";
	 					break;

	 					case '10':
	 						$ventas[$key]->fecha="Octubre";
	 					break;

	 					case '11':
	 						$ventas[$key]->fecha="Noviembre";
	 					break;

	 					case '12':
	 						$ventas[$key]->fecha="Diciembre";
	 					break;
	 					
	 					default:
	 						$ventas[$key]->fecha="Ninguno";
	 					break;
	 				}
		 		}
		 	
				$tipo="MENSUAL";
		 		$valor=3;

				return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);

		 	}


		 	if($valor==2){

	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), DB::raw('WEEK(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as year'))
	 			->where(DB::raw('WEEK(f.fecha)'),'>=',$desde)
	 			->where(DB::raw('WEEK(f.fecha)'),'<=',$hasta)
	 			->where(DB::raw('YEAR(f.fecha)'),'=',$año)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy(DB::raw('WEEK(f.fecha)'), 'asc')
	 			->groupBy(DB::raw('WEEK(f.fecha)'))
	 			->paginate(100);


				$tipo="SEMANAL";
		 		$valor=2;

				return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);
		 	}



		 	if($valor==1){


	 			$ventas=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura','f.pago_total','f.noproductos', 'tp.nombre as tipo_pago_id_tpago', 'f.fecha')
	 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->paginate(100);


				$tipo="DIARIO";
		 		$valor=1;

				return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor]);
		 	}

		 	if($valor=='m'){

	 			//Detallado de mes
				$ventas=DB::table('detalle_factura as df')
		 		->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 		->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 		->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 		->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 		->where(DB::raw('YEAR(f.fecha)'),'=',$hasta)
	 			->where(DB::raw('MONTH(f.fecha)'),'=',$desde)
		 		->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
		 		->orderBy('df.id_detallef', 'asc')
		 		->groupBy('s.producto_id_producto')
		 		->paginate(100);


				$tipo="MENSUAL DETALLADO";
		 		$valor='m';

		 		$productosDB=ProductoSede::get();
				$total_ventas_diarias=0;
			
	 			foreach ($ventas as $key => $value) {
	 				foreach ($productosDB as $key2 => $value2) {
	 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
	 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
	 					}
	 				}
	 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
	 			}
	 			$tipo_reporte_detallado="m";

				return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);
		 	}


		 	if($valor=='s'){

		 		//Detallado de semana
					$ventas=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'),DB::raw('WEEK(f.fecha) as prueba'))
		 			->where(DB::raw('YEAR(f.fecha)'),'=',$hasta)
	 				->where(DB::raw('WEEK(f.fecha)'),'=',$desde)
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 			$tipo="SEMANAL DETALLADO";
		 			$valor='s';


		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
		 			}
		 			$tipo_reporte_detallado="s";

		 			return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);

		 	}

		 	if($valor=='d'){

		 		//Detallado de semana
					$ventas=DB::table('detalle_factura as df')
		 			->join('stock as s','df.stock_id_stock','=','s.id_stock')
		 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
		 			->join('sede as sed','f.sede_id_sede','=','sed.id_sede')
		 			->select('s.producto_id_producto as producto',DB::raw('sum(df.cantidad) as cantidad'),DB::raw('sum(df.total) as total'))
		 			->where('f.fecha','LIKE', '%'.$fecha_d.'%')
		 			->where('f.facturapaga','=',1)
		 			->where('f.anulacion','=',0)
		 			->orderBy('df.id_detallef', 'asc')
		 			->groupBy('s.producto_id_producto')
		 			->paginate(100);

		 			$tipo="DIARIO DETALLADO";
		 			$valor='d';

		 			$productosDB=ProductoSede::get();
					$total_ventas_diarias=0;
				
		 			foreach ($ventas as $key => $value) {	
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($ventas[$key]->producto==$productosDB[$key2]->id_producto){
		 						$ventas[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_ventas_diarias=intval($total_ventas_diarias)+intval($ventas[$key]->total);
		 			}
		 			$tipo_reporte_detallado="d";

		 			return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "ventas"=>$ventas, "tipo"=>$tipo, "valor"=>$valor,"total_ventas"=>$total_ventas_diarias,"tipo_reporte_detallado"=>$tipo_reporte_detallado,]);

		 	}



			//return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 

	 	public function downloadExcelReportValorBruto($id){

		 	$cadena=$id;
	 		$separador = ".";
	 		$separada = explode($separador, $cadena);
			$count=1;

			$desde=0;
			$hasta=0;
			$valor=0;

			if(count($separada)==3){
				$desde=$separada[0];
				$hasta=$separada[1];
				$valor=$separada[2];
			}

		 	
		 	//dd($desde.' '.$hasta);

		 	if($valor==3){

		 		/*$productos=DB::table('factura as f')
		 		->select('f.id_factura')
	 			->paginate(100);*/

		 		$productos=DB::table('factura as f')
	 			->join('empleado as e','f.empleado_id_empleado','=','e.id_empleado')
	 			->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 			->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 			->join('sede as sed','e.sede_id_sede','=','sed.id_sede')
	 			->select('f.id_factura',DB::raw('sum(f.pago_total) as pago_total'),DB::raw('sum(f.noproductos) as noproductos'), 'tp.nombre as tipo_pago_id_tpago', DB::raw('MONTH(f.fecha) as fecha'), DB::raw('YEAR(f.fecha) as fecha_year'))
	 			->where(DB::raw('date(f.fecha)'),'>=',$desde)
	 			->where(DB::raw('date(f.fecha)'),'<=',$hasta)
	 			->where('f.facturapaga','=',1)
		 		->where('f.anulacion','=',0)
	 			->orderBy('f.id_factura', 'asc')
	 			->groupBy(DB::raw('MONTH(f.fecha)'))
	 			->paginate(100);

	 			foreach ($productos as $key => $value) {	

	 				switch ($productos[$key]->fecha) {
	 					case '1':
	 						$productos[$key]->fecha="Enero";
	 					break;

	 					case '2':
	 						$productos[$key]->fecha="Febrero";
	 					break;

	 					case '3':
	 						$productos[$key]->fecha="Marzo";
	 					break;

	 					case '4':
	 						$productos[$key]->fecha="Abril";
	 					break;

	 					case '5':
	 						$productos[$key]->fecha="Mayo";
	 					break;

	 					case '6':
	 						$productos[$key]->fecha="Junio";
	 					break;

	 					case '7':
	 						$productos[$key]->fecha="Julio";
	 					break;

	 					case '8':
	 						$productos[$key]->fecha="Agosto";
	 					break;

	 					case '9':
	 						$productos[$key]->fecha="Septiembre";
	 					break;

	 					case '10':
	 						$productos[$key]->fecha="Octubre";
	 					break;

	 					case '11':
	 						$productos[$key]->fecha="Noviembre";
	 					break;

	 					case '12':
	 						$productos[$key]->fecha="Diciembre";
	 					break;
	 					
	 					default:
	 						$productos[$key]->fecha="Ninguno";
	 					break;
	 				}
		 		}

				return view('almacen.reportes.valorbruto.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta, "productos"=>$productos]);
		 	}

			//return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 



}



/*public function downloadExcelReport($id){
			$i=RVentas::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;

		 	$cadena=$id;
	 		$separador = ".";
	 		$separada = explode($separador, $cadena);
			$count=1;

			$desde=0;
			$hasta=0;
			$valor=0;

			if(count($separada)==3){
				$desde=$separada[0];
				$hasta=$separada[1];
				$valor=$separada[2];
			}

			return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	} */

	 	/*public function downloadPDFReport($id){
			$i=RVentas::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;

		 	$productos="SELECT f.id_factura, f.pago_total, f.noproductos, tp.nombre as tipo_pago_id_tpago, f.fecha FROM factura as f, tipo_pago as tp, cliente as c, empleado as e WHERE f.tipo_pago_id_tpago=tp.id_tpago and f.empleado_id_empleado=e.id_empleado and f.cliente_id_cliente=c.id_cliente and f.fecha>='$desde' and f.fecha<='$hasta' ORDER BY f.id_factura DESC";

			return view('almacen.reportes.ventas.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta, "productos"=>$productos]);
	 	}*/