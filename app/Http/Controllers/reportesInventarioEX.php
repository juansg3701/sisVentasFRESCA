<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use DB;

class reportesInventarioEX extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function show($id){
			$i=RInventarios::findOrFail($id);
			$ini=$i->fechaInicial;
			$fin=$i->fechaFinal;
			$desde=$ini;
		 	$hasta=$fin;
			return view('almacen.reportes.inventario.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	 	} 

	 	public function edit($id){
	 		
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();
	 		$r=RInventarios::findOrFail($id);
	 		

	 		$productos=DB::table('producto as p')
	 		->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 		->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 		->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo', 'p.fecha_registro')
	 		->where('p.fecha_registro','>=',$r->fechaInicial)
	 		->where('p.fecha_registro','<=',$r->fechaFinal)
	 		->orderBy('p.id_producto', 'desc')
	 		->paginate(10);

	 		$pastel=DB::table('producto as p')
            ->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 		->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
            ->select('p.nombre','p.stock_minimo')
            ->where('p.fecha_registro','>=',$r->fechaInicial)
	 		->where('p.fecha_registro','<=',$r->fechaFinal)->get();

	 		$longitud=DB::table('producto as p')
	 		->select(DB::raw('p.nombre','count(*) as name'))
		    ->get();
	
	 			 			
	 		return view("almacen.reportes.inventario.grafica",["modulos"=>$modulos, "productos"=>$productos,"longitud"=>$longitud, 'pastel'=>$pastel]);
	 	}

	 
}
