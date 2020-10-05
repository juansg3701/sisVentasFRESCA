<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RInventarios;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RInventariosFormRequest;
use sisVentas\Http\Requests\NominaHor4FormRequest;
use DB;

class reportesInventarioPDF extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 


	public function edit($id){
		$i=RInventarios::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT p.id_producto,p.nombre,p.plu,p.ean,p.fecha_registro,c.nombre as categoria_id_categoria,p.unidad_de_medida,p.precio,i.nombre as impuestos_id_impuestos,p.stock_minimo FROM producto as p, categoria as c, impuestos as i WHERE p.categoria_id_categoria=c.id_categoria and p.impuestos_id_impuestos=i.id_impuestos and p.fecha_registro>='$desde' and p.fecha_registro<='$hasta'";

		return view('almacen.reportes.inventario.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	 	} 
}
