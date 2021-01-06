<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\MovimientoSede;
use sisVentas\ProveedorSede;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\MovimientoSedeFormRequest;
use DB;


class MovimientoSedeController extends Controller
{
	 public function __construct(){
			$this->middleware('auth');	


			 	}
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$movimientos=DB::table('m_stock as m')
	 			->join('sede as s','m.sede_id_sede','=','s.id_sede')
	 			->join('sede as s2','m.sede_id_sede2','=','s2.id_sede')
	 			->join('stock as st','m.stock_id_stock','=','st.id_stock')
	 			->join('t_movimiento as mv','m.t_movimiento_id_tmovimiento','=','mv.id_tmovimiento')
	 			->join('empleado as e','m.id_empleado','=','e.id_empleado')
	 			->join('proveedor as pr','st.proveedor_id_proveedor','=','pr.id_proveedor')
	 			->select('m.id_mstock','m.fecha','s.nombre_sede as sede_id_sede','s2.nombre_sede as sede_id_sede2','st.producto_id_producto as stock_id_stock','mv.descripcion as t_movimiento_id_tmovimiento','e.nombre as id_empleado','pr.nombre_proveedor as nombre_proveedor','m.t_movimiento_id_tmovimiento as mov','m.cantidad as cantidad','m.total as total')
	 			->where('m.fecha','like','%'.$query0.'%')
 	 			->orderBy('m.fecha', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();

	 			$producto=ProductoSede::get();
	 			

	 			return view('almacen.inventario.movimiento-sede.index',["movimientos"=>$movimientos,"searchText0"=>$query0, "searchText1"=>$query1,"modulos"=>$modulos,"producto"=>$producto]);
	 		}
	 	}

	 	public function edit($id){
	 		$sedes=DB::table('sede')->get();
	 		$movs=DB::table('t_movimiento')->get();
	 		$productos=DB::table('stock as st')
	 		->join('sede as sed','st.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pr','st.proveedor_id_proveedor','=','pr.id_proveedor')
	 		->select('st.id_stock as id_stock', 'sed.nombre_sede as nombre_sede','pr.nombre_proveedor as nombre_proveedor','st.producto_id_producto as producto_id_producto')
	 		->get();

	 		if(auth()->user()->superusuario==0){
	 		$productos=DB::table('stock as st')
	 		->join('sede as sed','st.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pr','st.proveedor_id_proveedor','=','pr.id_proveedor')
	 		->select('st.id_stock as id_stock', 'sed.nombre_sede as nombre_sede','pr.nombre_proveedor as nombre_proveedor','st.producto_id_producto as producto_id_producto')
	 		->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 		->get();
	 	}
	 		$empl=DB::table('empleado')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		$productoDB=ProductoSede::get();
	 		$usuarios=DB::table('empleado')->get();
	 			

	 		return view("almacen.inventario.movimiento-sede.edit",["movimientos"=>MovimientoSede::findOrFail($id),"sedes"=>$sedes,"movs"=>$movs,"productos"=>$productos,"empl"=>$empl, "modulos"=>$modulos,"productoDB"=>$productoDB,"usuarios"=>$usuarios]);
	 	}

	 	
	 	public function show($id){
	 		$mv = MovimientoSede::findOrFail($id);
	 		$mv->t_movimiento_id_tmovimiento='1';
	 		$mv->update();

	 		$sede=$mv->sede_id_sede2;
	 		$idStock=$mv->stock_id_stock;

	 		$productoR=DB::table('stock')
	 		->select('producto_id_producto as id_producto')
	 		->where('id_stock','=',$idStock)
	 		->orderBy('id_stock', 'desc')->get();

	 		$proveedorR=DB::table('stock')
	 		->select('proveedor_id_proveedor as id_proveedor')
	 		->where('id_stock','=',$idStock)
	 		->orderBy('id_stock', 'desc')->get();

	 		$existe=DB::table('stock')
	 		->select('id_stock as id')
	 		->where('sede_id_sede','=',$sede)
	 		->where('producto_id_producto','=',$productoR[0]->id_producto)
	 		->where('proveedor_id_proveedor','=',$proveedorR[0]->id_proveedor)
	 		->where('cantidad','>=',$mv->cantidad)
	 		->orderBy('id_stock', 'desc')->get();
	 		$fecha_actual=date("Y-m-d H:i:s"); 

	 		$stock1 = ProveedorSede::findOrFail($idStock);
		 	$actualC=$stock1->cantidad;
		 	

	 		if($actualC>=$mv->cantidad){
	 			if(count($existe)==0){
	 		$stock1->cantidad=$actualC-$mv->cantidad;
	 		$stock1->update();

		 			$ps = new ProveedorSede;
			 		$ps->producto_id_producto=$productoR[0]->id_producto;
			 		$ps->sede_id_sede=$sede;
			 		$ps->proveedor_id_proveedor=$proveedorR[0]->id_proveedor;
			 		$ps->disponibilidad=1;
			 		$ps->cantidad=$mv->cantidad;

		 		$ps->fecha_registro=$fecha_actual;
		 		$ps->empleado_id_empleado=$mv->id_empleado;
		 		$ps->transformacion_stock_id=6;
		 		$ps->noFactura=0;
		 		$ps->total=$mv->total;
			 		$ps->save();

			 		return back()->with('msj','Producto guardado');
		 		}else{
		 		$stock = ProveedorSede::findOrFail($existe[0]->id);
		 		$actCantidad=$stock->cantidad;
		 		$actTotal=$stock->total;
		 		$stock->cantidad=$actCantidad+$mv->cantidad;
		 		$stock->total=$actTotal+$mv->total;
		 		$stock->update();	

		 		$stock1 = ProveedorSede::findOrFail($idStock);
			 	$actualC=$stock1->cantidad;
			 	$actualT=$stock1->total;
		 		$stock1->cantidad=$actualC-$mv->cantidad;
		 		$stock1->total=$actualT-$mv->total;
		 		$stock1->update(); 

		 		dd($stock1->cantidad.'+'.$stock1->total.'+'.$stock->cantidad.'+'.$stock->total);		

		 		return back()->with('msj','Estado actualizado');
		 		}

	 		}else{
	 			return back()->with('errormsj','No hay suficiente en stock');
	 		}

	 	}

		public function create(){
			$sedes=DB::table('sede')->get();
	 		$movs=DB::table('t_movimiento')->get();

	 		$productos=DB::table('stock as st')
	 		->join('sede as sed','st.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pr','st.proveedor_id_proveedor','=','pr.id_proveedor')
	 		->select('st.id_stock as id_stock', 'sed.nombre_sede as nombre_sede','pr.nombre_proveedor as nombre_proveedor','st.producto_id_producto as producto_id_producto')
	 		->where('st.cantidad','>','0')
	 		->get();

	 		if(auth()->user()->superusuario==0){
	 		$productos=DB::table('stock as st')
	 		->join('sede as sed','st.sede_id_sede','=','sed.id_sede')
	 		->join('proveedor as pr','st.proveedor_id_proveedor','=','pr.id_proveedor')
	 		->select('st.id_stock as id_stock', 'sed.nombre_sede as nombre_sede','pr.nombre_proveedor as nombre_proveedor','st.producto_id_producto as producto_id_producto')
	 		->where('st.cantidad','>','0')
	 		->where('sed.id_sede','=',auth()->user()->sede_id_sede)
	 		->get();
	 	}

	 		$empl=DB::table('empleado')->get();
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 		$productoDB=ProductoSede::get();
	 		$usuarios=DB::table('empleado')->get();
	 			

	 			return view("almacen.inventario.movimiento-sede.registrar",["sedes"=>$sedes,"movs"=>$movs,"productos"=>$productos,"empl"=>$empl, "modulos"=>$modulos,"productoDB"=>$productoDB,"usuarios"=>$usuarios]);
	 		
	 	}

	 	public function store(MovimientoSedeFormRequest $request){
	 		$productoR=$request->get('stock_id_stock');
	 		$cantidadR=$request->get('cantidad');

	 		$productoBuscar=ProductoSede::where('producto.nombre','=', $productoR)
	 		->orderBy('id_producto', 'desc')
	 		->paginate(10);

	 		if(count($productoBuscar)>0){
	 			$stockBuscar=ProveedorSede::where('producto_id_producto','=', $productoBuscar[0]->id_producto)
	 				->where('cantidad','>=', $cantidadR)
			 		->orderBy('id_stock', 'desc')
			 		->paginate(10);

			 	if(count($stockBuscar)>0){
			 		$mv = new MovimientoSede;
			 		$mv->fecha=$request->get('fecha');
			 		$mv->stock_id_stock=$stockBuscar[0]->id_stock;
			 		$mv->sede_id_sede=$request->get('sede_id_sede');
			 		$mv->sede_id_sede2=$request->get('sede_id_sede2');
			 		$mv->t_movimiento_id_tmovimiento=$request->get('t_movimiento_id_tmovimiento');
			 		$mv->id_empleado=$request->get('id_empleado');
			 		$mv->cantidad=$cantidadR;
			 		$mv->total=$request->get('total');
			 		$mv->save();

	 		return back()->with('msj','Movimiento guardado');
			 	}else{
			 		return back()->with('errormsj','No hay stock');
			 	}

	 		}else{
	 			return back()->with('errormsj','El producto no existe');
	 		}
		
	 	}

	 	public function update(MovimientoSedeFormRequest $request, $id){
	 		$productoR=$request->get('stock_id_stock');
	 		$cantidadR=$request->get('cantidad');

	 		$productoBuscar=ProductoSede::where('producto.nombre','=', $productoR)
	 		->orderBy('id_producto', 'desc')
	 		->paginate(10);

	 		if(count($productoBuscar)>0){
	 			$stockBuscar=ProveedorSede::where('producto_id_producto','=', $productoBuscar[0]->id_producto)
	 				->where('cantidad','>=', $cantidadR)
			 		->orderBy('id_stock', 'desc')
			 		->paginate(10);

			 	if(count($stockBuscar)>0){

			 		$mv = MovimientoSede::findOrFail($id);
			 		$mv->fecha=$request->get('fecha');
			 		$mv->stock_id_stock=$stockBuscar[0]->id_stock;
			 		$mv->sede_id_sede=$request->get('sede_id_sede');
			 		$mv->sede_id_sede2=$request->get('sede_id_sede2');
			 		$mv->t_movimiento_id_tmovimiento=$request->get('t_movimiento_id_tmovimiento');
			 		$mv->id_empleado=$request->get('id_empleado');
			 		$mv->cantidad=$request->get('cantidad');
			 		$mv->total=$request->get('total');
			 		$mv->update();

	 		return back()->with('msj','Movimiento actualizado');
			 	}else{
			 		return back()->with('errormsj','No hay stock');
			 	}

	 		}else{
	 			return back()->with('errormsj','El producto no existe');
	 		}
	 	}

	 	public function destroy($id){
	 		$mv=MovimientoSede::findOrFail($id);
	 		$mv->delete();

	 		return back()->with('msj','Movimiento eliminado');
	 	}




}