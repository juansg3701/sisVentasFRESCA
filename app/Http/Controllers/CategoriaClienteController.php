<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\CategoriaCliente;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaClienteFormRequest;
use DB;

class CategoriaClienteController extends Controller
{
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));

	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 			

	 			$categorias=DB::table('categoria_cliente')
	 			->where('nombre','LIKE', '%'.$query.'%')
	 			->orderBy('id_categoria', 'desc')
	 			->paginate(10);

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view('almacen.cliente.categoria.index',["categorias"=>$categorias,"searchText"=>$query, "modulos"=>$modulos, "usuarios"=>$usuarios, "sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.cliente.categoria.index",["modulos"=>$modulos]);
	 	}

	 	public function store(CategoriaClienteFormRequest $request){
	 		$categoria = new CategoriaCliente;
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->fecha=$request->get('fecha');
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado');
			$categoria->sede_id_sede=$request->get('sede_id_sede');
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

	 	public function update(CategoriaClienteFormRequest $request, $id){
	 		$categoria = CategoriaCliente::findOrFail($id);
	 		
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->update();

	 		return back()->with('msj','Categoria actualizada');
	 	}

	 	public function destroy($id){
	 		$id=$id;

	 		$categoria=CategoriaCliente::findOrFail($id);
	 		$categoria->delete();

	 		return back()->with('msj','Categoria eliminada');


	 		/*$existe=DB::table('producto')
	 		->where('categoria_id_categoria','=',$id)
	 		->orderBy('id_producto', 'desc')->get();

	 		if(count($existe)==0){
	 		$categoria=Categoria::findOrFail($id);
	 		$categoria->delete();

	 		return back()->with('msj','Categoria eliminada');
	 		}else{	
	 			return back()->with('errormsj','¡Categoria relacionada!');
	 		}*/

	 		
	 	}

	 
}
