<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use sisVentas\Rpc2;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\Rpc2FormRequest;
use DB;

class reportesPC2Descargas extends Controller
{
	public function __construct(){
		$this->middleware('auth');	
	} 

	public function show($id){
		$i=Rpc2::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;
		$desde=$ini;
	 	$hasta=$fin;
		return view('almacen.reportes.pagosCobros.cobros.download.descargas.pdf',["desde"=>$desde, "hasta"=>$hasta]);
	} 

	public function edit($id){
		$i=Rpc2::findOrFail($id);
		$ini=$i->fechaInicial;
		$fin=$i->fechaFinal;

		$desde=$ini;
	 	$hasta=$fin;

	 	$productos="SELECT ct.id_cartera as id, cl.nombre as nombre , cl.telefono as telefono , cl.direccion as direccion , cl.correo as correo, ct.total as valortotal, ct.cuotas_totales as cuotasTotales, ct.cuotas_restantes as cuotasRestantes, ct.fecha as fecha, ct.atraso as atraso, ct.factura_id_factura as nofactura FROM cartera as ct, cliente as cl WHERE ct.cliente_id_cliente=cl.id_cliente and ct.fecha>='$desde' and ct.fecha<='$hasta'";

		return view('almacen.reportes.pagosCobros.cobros.download.descargas2.index',["desde"=>$desde, "hasta"=>$hasta,"productos"=>$productos]);

	}



	 
}
