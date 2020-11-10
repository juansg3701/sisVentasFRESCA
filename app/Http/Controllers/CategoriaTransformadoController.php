<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\CategoriaTransformado;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaTransformadoFormRequest;
use DB;

class CategoriaTransformadoController extends Controller
{
	    
	    public function __construct(){
			$this->middleware('auth');	
		} 

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$usuarios=DB::table('empleado')->get();
	 			$sedes=DB::table('sede')->get();
	 		
	 			$categorias=DB::table('categoria_cliente as cc')
	 			->join('empleado as u','cc.empleado_id_empleado','=','u.id_empleado')
	 			->join('sede as s','cc.sede_id_sede','=','s.id_sede')
	 			->select('cc.id_categoria','cc.nombre','cc.descripcion','s.nombre_sede as sede_id_sede','u.nombre as empleado_id_empleado', 'cc.fecha')
	 			->where('cc.nombre','LIKE', '%'.$query.'%')
	 			->orderBy('cc.id_categoria', 'desc')
	 			->paginate(10);


	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 			return view('almacen.inventario.CategoriaTransformado.index',["categorias"=>$categorias,"searchText"=>$query, "modulos"=>$modulos, "usuarios"=>$usuarios, "sedes"=>$sedes]);
	 		}
	 	}

	 	public function create(){
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.cliente.categoria.index",["modulos"=>$modulos]);
	 	}

	 	public function store(CategoriaTransformadoFormRequest $request){
	 		$categoria = new CategoriaTransformado;
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->fecha=$request->get('fecha');
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado');
			$categoria->sede_id_sede=$request->get('sede_id_sede');
	 		$categoria->save();

	 		return back()->with('msj','Categoria guardada');
	 	}

	 	public function show($id){
	 		return view("almacen.cliente.categoria.show",["categoria"=>CategoriaCliente::findOrFail($id)]);
	 	}

	 	public function edit($id){

	 		$usuarios=DB::table('empleado')->get();
	 		$sedes=DB::table('sede')->get();

	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			
	 		return view("almacen.cliente.categoria.edit",["categoria"=>CategoriaCliente::findOrFail($id), "modulos"=>$modulos, "usuarios"=>$usuarios, "sedes"=>$sedes]);
	 	}

	 	public function update(CategoriaClienteFormRequest $request, $id){
	 		$categoria = CategoriaCliente::findOrFail($id);
	 		
	 		$categoria->nombre=$request->get('nombre');
	 		$categoria->descripcion=$request->get('descripcion');
	 		$categoria->fecha=$request->get('fecha');
			$categoria->empleado_id_empleado=$request->get('empleado_id_empleado');
			$categoria->sede_id_sede=$request->get('sede_id_sede');
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
