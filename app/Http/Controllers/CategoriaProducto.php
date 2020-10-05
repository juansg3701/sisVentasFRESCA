<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaProducto extends Controller
{
	   public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$categorias=DB::table('categoria')
	 			->where('nombre','LIKE', '%'.$query.'%')
	 			->orderBy('id_categoria', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			$catP=DB::table('categoria')->get();

	 			return view('almacen.inventario.producto-sede.categoriaProducto.index',["categorias"=>$categorias,"searchText"=>$query, "modulos"=>$modulos,"catP"=>$catP]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.categoriaProducto.index",["modulos"=>$modulos]);
	 	}

	 	public function store(CategoriaFormRequest $request){
	 		$categoria = new Categoria;
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->save();

	 		return back()->with('msj','Categoria guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.inventario.producto-sede.categoriaProducto.show",["categoria"=>Categoria::findOrFail($id)]);
	 	}

	 	public function edit($id){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.inventario.producto-sede.categoriaProducto.edit",["categoria"=>Categoria::findOrFail($id), "modulos"=>$modulos]);
	 	}

	 	public function update(CategoriaFormRequest $request, $id){
	 		$categoria = Categoria::findOrFail($id);
	 		
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->update();

	 		return back()->with('msj','Categoria actualizada');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$existe=DB::table('producto')
	 		->where('categoria_id_categoria','=',$id)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($existe)==0){
	 		$categoria=Categoria::findOrFail($id);
	 		$categoria->delete();

	 		return back()->with('msj','Categoria eliminada');
	 		}else{	
	 			return back()->with('errormsj','¡Categoria relacionada!');
	 		}

	 		
	 	}

	 
}
