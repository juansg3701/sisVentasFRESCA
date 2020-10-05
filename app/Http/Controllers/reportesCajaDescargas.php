<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\RCaja;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RCajaFormRequest;
use DB;

class reportesCajaDescargas extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function show($id){
		$i=RCaja::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;
		$desde=$ini;
	 	$hasta=$fin;
		return view('almacen.reportes.caja.caja.download.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	} 

	public function edit($id){
		$i=RCaja::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;


	 	$productos="SELECT k.id_caja, k.base_monetaria, k.ingresos_efectivo, k.ingresos_electronicos, k.egresos_efectivo, k.egresos_electronicos, k.ventas, k.fecha, u.nombre as empleado,s.nombre_sede as sede, p.periodo_tiempo as p_tiempo FROM caja as k, empleado as u, sede as s, p_tiempo as p WHERE k.empleado_id_empleado=u.id_empleado and k.sede_id_sede=s.id_sede and k.p_tiempo_id_tiempo=p.id_tiempo and k.fecha>='$desde' and k.fecha<='$hasta'";

		return view('almacen.reportes.caja.caja.download.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}
	 
}
