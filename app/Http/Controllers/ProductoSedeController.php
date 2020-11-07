<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductoSede;
use sisVentas\Categoria;
use sisVentas\Impuesto;
use sisVentas\Descuentos;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductoSedeFormRequest;
use DB;


class ProductoSedeController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 

		//Redirecciona para mostrar los productos completos
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			
	 			$productos=ProductoSede::where('producto.nombre','LIKE', '%'.$query0.'%')
	 			->where('plu','LIKE', '%'.$query1.'%')
	 			->where('ean','LIKE', '%'.$query2.'%')
	 			->join('categoria_productos as c','categoria_id_categoria','=','c.id_categoria')
	 			->join('impuestos as i','impuestos_id_impuestos','=','i.id_impuestos')
	 			->join('descuento as d','producto.descuento_id_descuento','=','d.id_descuento')
	 			->join('punto_venta as pv','punto_venta_id_punto_venta','=','pv.id_punto_venta')
	 			->select('id_producto','producto.nombre as nombre','plu','ean','c.nombre as categoria_id_categoria','unidad_de_medida','precio_1','precio_2','precio_3','precio_4','costo_compra','i.nombre as impuestos_id_impuestos','stock_minimo','producto.fecha_registro as fecha_registro','producto.empleado_id_empleado','necesita_peso','pv.nombre as nombrePV','d.nombre as nombreD','imagen','i.valor as valorI','d.valor as valorD')
	 			->orderBy('id_producto', 'desc')
    			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$eanP=ProductoSede::orderBy('id_producto', 'desc')->get();

	 			$empleados=DB::table('empleado')->get();
	 			
	 			return view('almacen.inventario.producto-sede.productoCompleto.index',["productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"modulos"=>$modulos,"eanP"=>$eanP,"empleados"=>$empleados]);
	 		}
	 	}

	 	//redirige para el registro del producto
	 	public function create(){
	 		$categorias=Categoria::get();
	 		$impuestos=Impuesto::get();
	 		$descuentos=Descuentos::get();
	 		$usuarios=DB::table('empleado')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.registrar",["categorias"=>$categorias,"impuestos"=>$impuestos, "modulos"=>$modulos,"descuentos"=>$descuentos,"usuarios"=>$usuarios]);
	 	}

	 	public function store(ProductoSedeFormRequest $request){
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');

	 		$pluE=ProductoSede::where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$eanE=ProductoSede::where('ean','=',$eanR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0){
	 			if(count($eanE)==0){
	 			$ps = new ProductoSede;
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$request->get('nombre');
		 		$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio_1=$request->get('precio_1');
		 		$ps->precio_2=$request->get('precio_2');
		 		$ps->precio_3=$request->get('precio_3');
		 		$ps->precio_4=$request->get('precio_4');
		 		$ps->costo_compra=$request->get('costo_compra');
		 		$ps->impuestos_id_impuestos=$request->get('impuestos_id_impuestos');
		 		$ps->stock_minimo=$request->get('stock_minimo');
		 		$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
		 		$ps->fecha_registro=$request->get('fecha_registro');
		 		$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
		 		$ps->necesita_peso=$request->get('necesita_peso');
		 		$ps->punto_venta_id_punto_venta=$request->get('punto_venta_id_punto_venta');
		 		$ps->descuento_id_descuento=$request->get('descuento_id_descuento');

		 		$ps->save();
				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_producto."_".$ps->nombre."_".$file->getClientOriginalName();
					$file->move(public_path().'/imagenes/articulos/', $nombre);

					$ps->imagen=$nombre;
				}
		 		$ps->update();

			 	return back()->with('msj','Producto guardado');
	 			}else{
	 				return back()->with('errormsj','¡EAN ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡PLU ya registrado!');
	 		}
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.productoCompleto.show",["productos"=>ProductoSede::findOrFail($id)]);
	 	}

	 	public function edit($id){
	 		$categorias=Categoria::get();
	 		$impuestos=Impuesto::get();
	 		$descuentos=Descuentos::get();
	 		$usuarios=DB::table('empleado')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.edit",["productos"=>ProductoSede::findOrFail($id),"categorias"=>$categorias,"impuestos"=>$impuestos, "modulos"=>$modulos,"descuentos"=>$descuentos,"usuarios"=>$usuarios]);

	 	}

	 	public function update(ProductoSedeFormRequest $request, $id){
	 		$id=$id;
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');

	 		$pluE=ProductoSede::where('id_producto','!=',$id)
	 		->where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$eanE=ProductoSede::where('id_producto','!=',$id)
	 		->where('ean','=',$eanR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0){
	 			if(count($eanE)==0){
	 			$ps = ProductoSede::findOrFail($id);
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$request->get('nombre');
		 		$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio_1=$request->get('precio_1');
		 		$ps->precio_2=$request->get('precio_2');
		 		$ps->precio_3=$request->get('precio_3');
		 		$ps->precio_4=$request->get('precio_4');
		 		$ps->costo_compra=$request->get('costo_compra');
		 		$ps->impuestos_id_impuestos=$request->get('impuestos_id_impuestos');
		 		$ps->stock_minimo=$request->get('stock_minimo');
		 		$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
		 		$ps->fecha_registro=$request->get('fecha_registro');
		 		$ps->empleado_id_empleado=$request->get('empleado_id_empleado');
		 		$ps->necesita_peso=$request->get('necesita_peso');
		 		$ps->punto_venta_id_punto_venta=$request->get('punto_venta_id_punto_venta');
		 		$ps->descuento_id_descuento=$request->get('descuento_id_descuento');


				if($request->hasFile('imagen')){
					$file=$request->file('imagen');
					$nombre=$ps->id_producto."_".$ps->nombre."_".$file->getClientOriginalName();
					$file->move(public_path().'/imagenes/articulos/', $nombre);
					$ps->imagen=$nombre;
				}
		 		$ps->update();

		 		return back()->with('msj','Producto actualizado');
	 			}else{
	 				return back()->with('errormsj','¡EAN ya registrado!');
	 			}
	 		}else{
	 				return back()->with('errormsj','¡PLU ya registrado!');
	 		}
	 	}


	 	public function destroy($id){
	 		$id=$id;

	 		$existeS=DB::table('stock')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_stock', 'desc')->get();

	 		$existeDC=DB::table('d_corte')
	 		->where('producto_id_producto','=',$id)
	 		->orderBy('id_dcorte', 'desc')->get();

	 		if(count($existeS)==0 && count($existeDC)==0){
	 			$ps=ProductoSede::findOrFail($id);
		 		$ps->delete();
		 		return back()->with('msj','Producto eliminado');
	 		}else{
	 			return back()->with('errormsj','¡Producto relacionado!');
	 		}

	 	}

	 	public function downloadExcel(Request $request){
	 		//Proveedor
	 		return view('almacen.descargarExcel.descargarProductos');
	 	}

}