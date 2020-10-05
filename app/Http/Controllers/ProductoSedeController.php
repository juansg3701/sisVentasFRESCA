<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductoSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductoSedeFormRequest;
use DB;


class ProductoSedeController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query0=trim($request->get('searchText0'));
	 			$query1=trim($request->get('searchText1'));
	 			$query2=trim($request->get('searchText2'));
	 			
	 			$productos=DB::table('producto as p')
	 			->join('categoria as c','p.categoria_id_categoria','=','c.id_categoria')
	 			->join('impuestos as i','p.impuestos_id_impuestos','=','i.id_impuestos')
	 			->select('p.id_producto','p.nombre','p.plu','p.ean','c.nombre as categoria_id_categoria','p.unidad_de_medida','p.precio','i.nombre as impuestos_id_impuestos','p.stock_minimo')
	 			->where('p.nombre','LIKE', '%'.$query0.'%')
	 			->where('p.plu','LIKE', '%'.$query1.'%')
	 			->where('p.ean','LIKE', '%'.$query2.'%')
	 			->orderBy('p.id_producto', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();
	 			
	 			return view('almacen.inventario.producto-sede.productoCompleto.index',["productos"=>$productos,"searchText0"=>$query0,"searchText1"=>$query1,"searchText2"=>$query2,"modulos"=>$modulos,"eanP"=>$eanP]);
	 		}
	 	}


	 	public function create(){
	 		$categorias=DB::table('categoria')->get();
	 		$impuestos=DB::table('impuestos')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.registrar",["categorias"=>$categorias,"impuestos"=>$impuestos, "modulos"=>$modulos]);
	 	}

	 	public function store(ProductoSedeFormRequest $request){
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');

	 		$pluE=DB::table('producto')
	 		->where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$eanE=DB::table('producto')
	 		->where('ean','=',$eanR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0){
	 			if(count($eanE)==0){
	 			$ps = new ProductoSede;
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$request->get('nombre');
		 		$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio=$request->get('precio');
		 		$ps->impuestos_id_impuestos=$request->get('impuestos_id_impuestos');
		 		$ps->stock_minimo=$request->get('stock_minimo');
		 		$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
		 		$ps->save();

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
	 		$categorias=DB::table('categoria')->get();
	 		$impuestos=DB::table('impuestos')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.productoCompleto.edit",["productos"=>ProductoSede::findOrFail($id),"categorias"=>$categorias,"impuestos"=>$impuestos, "modulos"=>$modulos]);

	 	}

	 	public function update(ProductoSedeFormRequest $request, $id){
	 		$id=$id;
	 		$pluR=$request->get('plu');
	 		$eanR=$request->get('ean');

	 		$pluE=DB::table('producto')
	 		->where('id_producto','!=',$id)
	 		->where('plu','=',$pluR)
	 		->orderBy('id_producto', 'desc')->get();

	 		$eanE=DB::table('producto')
	 		->where('id_producto','!=',$id)
	 		->where('ean','=',$eanR)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($pluE)==0){
	 			if(count($eanE)==0){
	 			$ps = ProductoSede::findOrFail($id);
		 		$ps->plu=$pluR;
		 		$ps->ean=$eanR;
		 		$ps->nombre=$request->get('nombre');
		 		$ps->unidad_de_medida=$request->get('unidad_de_medida');
		 		$ps->precio=$request->get('precio');
		 		$ps->impuestos_id_impuestos=$request->get('impuestos_id_impuestos');
		 		$ps->stock_minimo=$request->get('stock_minimo');
		 		$ps->categoria_id_categoria=$request->get('categoria_id_categoria');
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

}