<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventarios2FormRequest;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;

class reportesInventarioEX2 extends Controller
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
	 			
	 			$reportes=DB::table('reporteinventarios2')
	 			->orderBy('id_rInventarios','desc')->get();

	 			return view('almacen.reportes.inventario.inventario',["sedes"=>$sedes,"searchText"=>$query, "modulos"=>$modulos,"reportes"=>$reportes]);
	 		}
	 	}


		public function show($id){
			$i2=RInventarios2::findOrFail($id);
			$ini=$i2->fechaInicial;
			$fin=$i2->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;
			return view('almacen.reportes.inventario2.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 


	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RInventarios2::findOrFail($id);
	 		
	 		$productos=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r->fechaInicial)
	 		->where('s.fecha_registro','<=',$r->fechaFinal)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);

	 		if(auth()->user()->superusuario==0){
	 			$productos=DB::table('stock as s')
	 		->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 		->join('sede as sed','s.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pd','s.proveedor_id_proveedor','=','pd.id_proveedor')
	 		->select('s.id_stock','p.nombre','p.plu','p.ean','sed.nombre_sede','pd.nombre_proveedor','s.cantidad','s.disponibilidad','s.fecha_registro')
	 		->where('s.fecha_registro','>=',$r->fechaInicial)
	 		->where('s.sede_id_sede','=',auth()->user()->sede_id_sede)
	 		->where('s.fecha_registro','<=',$r->fechaFinal)
	 		->orderBy('s.id_stock', 'desc')
	 		->paginate(10);
	 		}
	 			
	 		return view("almacen.reportes.inventario2.grafica",["modulos"=>$modulos, "productos"=>$productos]);
	 	}


	 	public function store(NominaHor4FormRequest $request){
	 		$desde=$request->get('desde');
	 		$hasta=$request->get('hasta');
			return view('almacen.reportes.inventario2.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	 	}





	 
}
