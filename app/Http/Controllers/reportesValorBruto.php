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

class reportesValorBruto extends Controller
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
	 			

	 			return view('almacen.reportes.valorbruto.valorbruto',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes,"usuarios"=>$usuarios]);
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
	 
	 	}

	 	public function edit($id){
	 			
	 	}

	 	public function show($id){
	 		return  Redirect::to("almacen/reportes/ventas");
	 	}

	 	public function destroy($id){

	 	}


	 	public function update(Request $request, $id){

	 		$mes=$request->get("mes");
	 		$year=$request->get("year");

	 		$productos=ProductoSede::get();

	 		$stock_reporte=DB::table('stock as s')
	 		->where(DB::raw('MONTH(s.fecha_registro)'),'=',$mes)
	 		->where(DB::raw('YEAR(s.fecha_registro)'),'=',$year)
	 		->orderBy('s.id_stock','asc')
	 		->get();

	 		$facturas_reporte=DB::table('detalle_factura as df')
	 		->join('factura as f','df.factura_id_factura','=','f.id_factura')
	 		->join('stock as s','df.stock_id_stock','=','s.id_stock')
	 		->select('df.total as total_detalle','s.producto_id_producto as producto')
	 		->where(DB::raw('MONTH(df.fecha)'),'=',$mes)
	 		->where(DB::raw('YEAR(df.fecha)'),'=',$year)
	 		->where('f.facturapaga','=',1)
	 		->where('f.anulacion','=',0)
	 		->orderBy('df.id_detallef')
	 		->get();


	 		foreach ($productos as $key => $value) {
	 			$valor_no1=0;
	 			$valor_no2=0;
	 			$valor_estado=0;
	 			$valor_final_no1=0;
	 			$valor_final_no2=0;

	 			//ciclo para el stock (costo de compra)
	 			foreach ($stock_reporte as $key2 => $value2) {
	 				if($productos[$key]->id_producto==$stock_reporte[$key2]->producto_id_producto){
	 					$valor_no1=$valor_no1+intval($stock_reporte[$key2]->total);
	 				}
	 			}

	 			//ciclo para las facturas (ventas)
	 			foreach ($facturas_reporte as $key2 => $value2) {
	 				if($productos[$key]->id_producto==$facturas_reporte[$key2]->producto){
	 					$valor_no2=$valor_no2+intval($facturas_reporte[$key2]->total_detalle);
	 				}
	 			}

	 			if($valor_no1==0 || $valor_no2==0){
	 				$valor_estado=1;
	 			}else{
	 				$valor_final_no1=intval($valor_no2)-intval($valor_no1);
	 				$valor_final_no2=round((intval($valor_final_no1)/intval($valor_no2))*100);	
	 				
	 			}
	 			$productos[$key]->precio_1=$valor_no1;
	 			$productos[$key]->precio_2=$valor_no2;
	 			$productos[$key]->precio_3=$valor_final_no1;
	 			$productos[$key]->precio_4=$valor_final_no2;
	 			
	 		}

	 		switch ($mes) {
		 					case '1':
		 						$mes="Enero";
		 					break;

		 					case '2':
		 						$mes="Febrero";
		 					break;

		 					case '3':
		 						$mes="Marzo";
		 					break;

		 					case '4':
		 						$mes="Abril";
		 					break;

		 					case '5':
		 						$mes="Mayo";
		 					break;

		 					case '6':
		 						$mes="Junio";
		 					break;

		 					case '7':
		 						$mes="Julio";
		 					break;

		 					case '8':
		 						$mes="Agosto";
		 					break;

		 					case '9':
		 						$mes="Septiembre";
		 					break;

		 					case '10':
		 						$mes="Octubre";
		 					break;

		 					case '11':
		 						$mes="Noviembre";
		 					break;

		 					case '12':
		 						$mes="Diciembre";
		 					break;
		 					
		 					default:
		 						$mes="Ninguno";
		 					break;
		 				}


				return view('almacen.reportes.valorbruto.reporteExcel.excel',["mes"=>$mes, "year"=>$year, "productos"=>$productos,"facturas_reporte"=>$facturas_reporte]);
		 	}

			//return view('almacen.reportes.ventas.reporteExcel.excel',["desde"=>$desde, "hasta"=>$hasta]);
	 	



}

