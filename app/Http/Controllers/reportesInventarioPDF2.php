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

class reportesInventarioPDF2 extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 


	public function edit($id){
		$i2=RInventarios2::findOrFail($id);
		$ini=$i2->fechaInicial;
		$fin=$i2->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT s.id_stock,p.nombre,p.plu,p.ean, s.fecha_registro,sed.nombre_sede,pd.nombre_proveedor,s.cantidad,s.disponibilidad FROM stock as s, producto as p, sede as sed, proveedor as pd WHERE s.producto_id_producto=p.id_producto and s.sede_id_sede=sed.id_sede and s.proveedor_id_proveedor=pd.id_proveedor and s.fecha_registro>='$desde' and s.fecha_registro<='$hasta'";

		return view('almacen.reportes.inventario2.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);
	} 
}
