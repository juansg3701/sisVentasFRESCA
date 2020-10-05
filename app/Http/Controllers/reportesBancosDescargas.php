<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RBancos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RBancosFormRequest;
use DB;

class reportesBancosDescargas extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function show($id){
		$i=RBancos::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;
		$desde=$ini;
	 	$hasta=$fin;
		return view('almacen.reportes.bancos.bancos.download.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	} 

	public function edit($id){
		$i=RBancos::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT db.id_Dbanco,db.fecha,db.ingreso_efectivo,db.egreso_efectivo,b.nombre_banco as banco,db.ingreso_electronico,db.egreso_electronico,s.nombre_sede as sede FROM detalle_banco as db, bancos as b, sede as s WHERE db.banco_idBanco=b.id_banco and db.sede_id_sede=s.id_sede and db.fecha>='$desde' and db.fecha<='$hasta'";

		return view('almacen.reportes.bancos.bancos.download.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



	 
}
