<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\ProductoSede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventario extends Controller
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
	 			
	 			
	 			$reportes=RInventarios::orderBy('id_rInventario', 'desc')->get();
	 			$usuarios=DB::table('empleado')->get();

	 			return view('almacen.reportes.inventario.inventario',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
	 		}
	 	}


	 	public function store(RInventariosFormRequest $request){
	 		
	 		$fechaInicialR=$request->get('fechaInicial');
	 		$fechaFinalR=$request->get('fechaFinal');

	 		if($fechaInicialR<=$fechaFinalR){

	 		$reporte = new RInventarios;
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
	 		$id=$id;
	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$r=RInventarios::findOrFail($id);
	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();




	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			if(auth()->user()->superusuario==0){

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
	 			->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			
	 			}
	 			
	 			$productos=ProductoSede::get();
				foreach($productos_stock as $pastels){	 	
				$productos->where('id_producto','=',$pastels->producto_id_producto);	
	 			}
	 	

	 			$productos_buscar=ProductoSede::get();
	 		

	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado,"id"=>$id,"ventas"=>$ventas,"r"=>$r,"productos"=>$productos,"productos_stock"=>$productos_stock,"id"=>$id, "productos_buscar"=>$productos_buscar]);
	 	}
	 	
	 	public function show(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$id=trim($request->get('id'));

			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$r=RInventarios::findOrFail($id);
	 		

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			if(auth()->user()->superusuario==0){

	 			$Transformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','!=',6)
	 			->orderBy('s.id_stock', 'desc')->get();

	 			$NoTransformado=DB::table('stock as s')
	 			->select(DB::raw('sum(total) as numero'))
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.transformacion_stock_id','=',6)
	 			->orderBy('s.id_stock', 'desc')->get();


	 			$ventas=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('categoria_producto_trans as tp','s.transformacion_stock_id','=','tp.id_categoria')
	 			->select('s.id_stock','s.total', 'tp.nombre as categoria', 's.fecha_registro','s.producto_id_producto','s.noFactura','s.cantidad')
	 			->where('s.id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			$productos_stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->select('s.id_stock','s.total', 's.fecha_registro','s.producto_id_producto','p.nombre_proveedor as nombre_proveedor','s.cantidad')
	 			->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 			->where('s.fecha_registro','>=',$r->fechaInicial)
	 			->where('s.fecha_registro','<=',$r->fechaFinal)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(50);

	 			
	 			}
	 			
	 			$productos=ProductoSede::where('nombre','LIKE', '%'.$query.'%')
	 			->get();

	 			$productos_buscar=ProductoSede::get();
	 			   foreach($productos_stock as $pastels){
              foreach ($productos as $p){
                if ($pastels->producto_id_producto===$p->id_producto){
                  $pastels->producto_id_producto=$p->nombre;
				                }
				            }
				    }


	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos,"Transformado"=>$Transformado,"NoTransformado"=>$NoTransformado,"id"=>$id,"ventas"=>$ventas,"r"=>$r,"productos"=>$productos,"productos_stock"=>$productos_stock, "id"=>$id,"productos_buscar"=>$productos_buscar]);
	 	} 
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
					$stock2=DB::table('stock as s')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
					->select('s.producto_id_producto as producto',
						DB::raw('sum(s.cantidad_rep) as cantidad'),
						DB::raw('sum(s.total) as total'))
						->where(DB::raw('YEAR(s.fecha_registro)'),'=',$valor_year)
						->where(DB::raw('WEEK(s.fecha_registro)'),'=',$valor_clave)
					->orderBy('s.id_stock','asc')
					->groupBy('s.producto_id_producto')
					->paginate(100);


		 			if(auth()->user()->superusuario==0){
						$stock2=DB::table('stock as s')
						->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
						->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
						->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
						->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
						->select('s.producto_id_producto as producto',
							DB::raw('sum(s.cantidad_rep) as cantidad'),
							DB::raw('sum(s.total) as total'))
							->where(DB::raw('YEAR(s.fecha_registro)'),'=',$valor_year)
							->where(DB::raw('WEEK(s.fecha_registro)'),'=',$valor_clave)
							->where('sed.id_sede','=',auth()->user()->sede_id_sede)
						->orderBy('s.id_stock','asc')
						->groupBy('s.producto_id_producto')
						->paginate(100);
		 		
		 		
		 			}

		 			$productosDB=ProductoSede::get();
					$total_inventario_diario=0;
				
		 			foreach ($stock2 as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($stock2[$key]->producto==$productosDB[$key2]->id_producto){
		 						$stock2[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_inventario_diario=intval($total_inventario_diario)+intval($stock2[$key]->total);
		 			}
		 			$tipo_reporte_detallado="s";
					 
		 			return view("almacen.reportes.inventario.graficad2",["modulos"=>$modulos,"ventas"=>$stock2,"fecha_d"=>$valor_clave,"total_ventas"=>$total_inventario_diario,"tipo_reporte_detallado"=>$tipo_reporte_detallado]);
						break;

						
					case 'm':

					//Detallado de mes
					$stock_m=DB::table('stock as s')
						->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
						->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
						->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
						->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
						->select('s.producto_id_producto as producto',
							DB::raw('sum(s.cantidad_rep) as cantidad'),
							DB::raw('sum(s.total) as total'))
							->where(DB::raw('YEAR(s.fecha_registro)'),'=',$valor_year)
							->where(DB::raw('MONTH(s.fecha_registro)'),'=',$valor_clave)
						->orderBy('s.id_stock','asc')
						->groupBy('s.producto_id_producto')
						->paginate(100);


		 			if(auth()->user()->superusuario==0){
				
						$stock_m=DB::table('stock as s')
						->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
						->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
						->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
						->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
						->select('s.producto_id_producto as producto',
							DB::raw('sum(s.cantidad_rep) as cantidad'),
							DB::raw('sum(s.total) as total'))
							->where(DB::raw('YEAR(s.fecha_registro)'),'=',$valor_year)
							->where(DB::raw('MONTH(s.fecha_registro)'),'=',$valor_clave)
							->where('sed.id_sede','=',auth()->user()->sede_id_sede)
							->orderBy('s.id_stock','asc')
						->groupBy('s.producto_id_producto')
						->paginate(100);

		 		
		 			}

		 			$productosDB=ProductoSede::get();
					$total_inventario_mes=0;
				
		 			foreach ($stock_m as $key => $value) {
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($stock_m[$key]->producto==$productosDB[$key2]->id_producto){
		 						$stock_m[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_inventario_mes=intval($total_inventario_mes)+intval($stock_m[$key]->total);
		 			}
		 			$tipo_reporte_detallado="m";
					
		 			
		 			return view("almacen.reportes.inventario.graficad2",["modulos"=>$modulos,"ventas"=>$stock_m,"fecha_d"=>$valor_fecha_final,"total_ventas"=>$total_inventario_mes,"tipo_reporte_detallado"=>$tipo_reporte_detallado]);
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
	 				$stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
	 			->select('s.id_stock','s.total','s.cantidad_rep', 's.fecha_registro','s.costo_compra')
	 			->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
	 			->orderBy('s.id_stock','asc')
	 			->paginate(100);

	 			$total_stock=DB::table('stock as s')
	 			->select(DB::raw('sum(s.total) as pago_total'))
	 			->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(100);

	 				if(auth()->user()->superusuario==0){

	 				$stock=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
	 			->select('s.id_stock','s.total','s.cantidad_rep', 's.fecha_registro','s.costo_compra')
	 			->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('s.id_stock','asc')
	 			->paginate(100);

	 			$total_stock=DB::table('stock as s')
	 			->select(DB::raw('sum(s.total) as pago_total'))
	 			->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy('s.id_stock', 'desc')
	 			->paginate(100);
	 				
		 			}

		 			return view("almacen.reportes.inventario.graficad",
					 ["modulos"=>$modulos,"stock"=>$stock,"fecha_d"=>$fecha_d,
					 "total_stock"=>$total_stock]);

				}else{

	 					//Reporte detallado
					
					$stock2=DB::table('stock as s')
					->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
					->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
					->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
					->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
					->select('s.producto_id_producto as producto',
						DB::raw('sum(s.cantidad_rep) as cantidad'),
					 	DB::raw('sum(s.total) as total'))
					->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
					->orderBy('s.id_stock','asc')
					->groupBy('s.producto_id_producto')
					->paginate(100);
					
				
		 			if(auth()->user()->superusuario==0){	
						$stock2=DB::table('stock as s')
						->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
						->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
						->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
						->join('categoria_producto_trans as cpt','s.transformacion_stock_id','=','cpt.id_categoria')
						->select('s.producto_id_producto as producto',
							DB::raw('sum(s.cantidad_rep) as cantidad'),
							DB::raw('sum(s.total) as total'))
						->where('s.fecha_registro','LIKE', '%'.$fecha_d.'%')
						->where('sed.id_sede','=',auth()->user()->sede_id_sede)
						->orderBy('s.id_stock','asc')
						->groupBy('s.producto_id_producto')
						->paginate(100);
		 			}

					$productosDB=ProductoSede::get();
					$total_inventario_diario=0;
				
		 			foreach ($stock2 as $key => $value) {	
		 				foreach ($productosDB as $key2 => $value2) {
		 					if($stock2[$key]->producto==$productosDB[$key2]->id_producto){
		 						$stock2[$key]->producto=$productosDB[$key2]->nombre;
		 					}
		 				}
		 			$total_inventario_diario=intval($total_inventario_diario)+intval($stock2[$key]->total);
		 			}
		 			$tipo_reporte_detallado="d";
		 			
		 			return view("almacen.reportes.inventario.graficad2",["modulos"=>$modulos,"ventas"=>$stock2,"fecha_d"=>$fecha_d,"total_ventas"=>$total_inventario_diario,"tipo_reporte_detallado"=>$tipo_reporte_detallado]);

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

	 			$stock_semanal=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select('s.id_stock',DB::raw('sum(s.total) as total'),
				 DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('WEEK(s.fecha_registro) as fecha_registro'),
				 DB::raw('YEAR(s.fecha_registro) as year'))
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'>=',$fecha_semana_inicial)
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'<=',$fecha_semana_final)
	 			->where(DB::raw('YEAR(s.fecha_registro)'),'=',$fecha_year)
	 			->orderBy(DB::raw('WEEK(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('WEEK(s.fecha_registro)'))
	 			->paginate(100);

	 			if(auth()->user()->superusuario==0){

	 				$stock_semanal=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select('s.id_stock',DB::raw('sum(s.total) as total'),
				 DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('WEEK(s.fecha_registro) as fecha_registro'),
				 DB::raw('YEAR(s.fecha_registro) as year'))
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'>=',$fecha_semana_inicial)
	 			->where(DB::raw('WEEK(s.fecha_registro)'),'<=',$fecha_semana_final)
	 			->where(DB::raw('YEAR(s.fecha_registro)'),'=',$fecha_year)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy(DB::raw('WEEK(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('WEEK(s.fecha_registro)'))
	 			->paginate(100);

	 			}

	 			$total_stock_semanales=0;
	 			foreach ($stock_semanal as $key => $value) {	
		 				$total_stock_semanales=intval($total_stock_semanales)+intval($stock_semanal[$key]->total);
		 			}

	 			return view("almacen.reportes.inventario.graficas",
				 ["modulos"=>$modulos,"stock"=>$stock_semanal,
				 "fecha_inicial"=>$fecha_semana_inicial,
				 "fecha_final"=>$fecha_semana_final,
				 "total_stock"=>$total_stock_semanales]);
			
	 			
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
					 $stock_mensuales=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select('s.id_stock',DB::raw('sum(s.total) as total'),
				 DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('MONTH(s.fecha_registro) as fecha_registro'), 
				 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
				 DB::raw('MONTH(s.fecha_registro) as fecha_mes'))
	 			->where(DB::raw('MONTH(s.fecha_registro)'),'>=',$fecha_mes_inicial)
	 			->where(DB::raw('MONTH(s.fecha_registro)'),'<=',$fecha_mes_final)
	 			->where(DB::raw('YEAR(s.fecha_registro)'),'=',$fecha_year)
	 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('MONTH(s.fecha_registro)'))
	 			->paginate(100);


	 			if(auth()->user()->superusuario==0){

	 				$stock_mensuales=DB::table('stock as s')
	 			->join('empleado as e','s.empleado_id_empleado','=','e.id_empleado')
	 			->join('proveedor as p','s.proveedor_id_proveedor','=','p.id_proveedor')
	 			->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 			->select('s.id_stock',DB::raw('sum(s.total) as total'),
				 DB::raw('sum(s.cantidad_rep) as cantidad_rep'), 
				 DB::raw('MONTH(s.fecha_registro) as fecha_registro'), 
				 DB::raw('YEAR(s.fecha_registro) as fecha_year'),
				 DB::raw('MONTH(s.fecha_registro) as fecha_mes'))
	 			->where(DB::raw('date(s.fecha_registro)'),'>=',$fecha_mes_inicial)
	 			->where(DB::raw('date(s.fecha_registro)'),'<=',$fecha_mes_final)
	 			->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 			->orderBy(DB::raw('MONTH(s.fecha_registro)'), 'asc')
	 			->groupBy(DB::raw('MONTH(s.fecha_registro)'))
	 			->paginate(100);
	
	 			}


	 			$total_stock_mensuales=0;
	 			foreach ($stock_mensuales as $key => $value) {	
		 				$total_stock_mensuales=intval($total_stock_mensuales)+intval($stock_mensuales[$key]->total);

		 				switch ($stock_mensuales[$key]->fecha_registro) {
		 					case '1':
		 						$stock_mensuales[$key]->fecha_registro="Enero";
		 					break;

		 					case '2':
		 						$stock_mensuales[$key]->fecha_registro="Febrero";
		 					break;

		 					case '3':
		 						$stock_mensuales[$key]->fecha_registro="Marzo";
		 					break;

		 					case '4':
		 						$stock_mensuales[$key]->fecha_registro="Abril";
		 					break;

		 					case '5':
		 						$stock_mensuales[$key]->fecha_registro="Mayo";
		 					break;

		 					case '6':
		 						$stock_mensuales[$key]->fecha_registro="Junio";
		 					break;

		 					case '7':
		 						$stock_mensuales[$key]->fecha_registro="Julio";
		 					break;

		 					case '8':
		 						$stock_mensuales[$key]->fecha_registro="Agosto";
		 					break;

		 					case '9':
		 						$stock_mensuales[$key]->fecha_registro="Septiembre";
		 					break;

		 					case '10':
		 						$stock_mensuales[$key]->fecha_registro="Octubre";
		 					break;

		 					case '11':
		 						$stock_mensuales[$key]->fecha_registro="Noviembre";
		 					break;

		 					case '12':
		 						$stock_mensuales[$key]->fecha_registro="Diciembre";
		 					break;
		 					
		 					default:
		 						$stock_mensuales[$key]->fecha_registro="Ninguno";
		 							break;
		 				}
		 			}

	 			return view("almacen.reportes.inventario.graficam",["modulos"=>$modulos,"stock"=>$stock_mensuales,"fecha_inicial"=>$fecha_mes_inicial,"fecha_final"=>$fecha_mes_final,"total_stock"=>$total_stock_mensuales]);
	 			
	 			}

	 		}

	 	}	

	 	public function destroy($id){
	 		$reporte = RInventarios::findOrFail($id);
	 		$reporte->delete();
	 		return back()->with('msj','Reporte eliminado');
	 	}

	 	public function downloadExcelReport($id){

			$i=RInventarios::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;
			return view('almacen.reportes.inventario.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 

	 	public function downloadPDFReport($id){

			$i=RInventarios::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;

			$desde=$ini;
		 	$hasta=$fin;

		 	$productos="SELECT s.id_stock, s.total, tp.nombre as categoria, s.fecha_registro, s.producto_id_producto, s.noFactura,s.cantidad, s.producto_id_producto FROM stock as s, empleado as e, categoria_producto_trans as tp, proveedor as p WHERE s.fecha_registro>='$desde' and s.fecha_registro<='$hasta' and s.transformacion_stock_id=tp.id_categoria and s.empleado_id_empleado=e.id_empleado and s.proveedor_id_proveedor=p.id_proveedor ORDER BY s.id_stock desc";

		 	$productos2="SELECT p.id_producto, p.nombre as nombre_producto FROM producto as p";


			return view('almacen.reportes.inventario.reportePDF.pdf',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos,"productos2"=>$productos2]);
	 	}

	 
}
