<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Usuario;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsuarioFormRequest;
use DB;

class IniciarController extends Controller
{
	  public function __construct(){
			$this->middleware('auth');	

			 	} 
	 	public function index(Request $request){
	 		if ($request) {
	 			$usuarios=DB::table('empleado as u');

	 			$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 			$modulos=DB::table('cargo_modulo')
	 			->where('id_cargo','=',$cargoUsuario)
	 			->orderBy('id_cargo', 'desc')->get();
	 			

	 			return view('almacen.usuario.iniciar.index',["modulos"=>$modulos]);
	 		}
	 	}
		public function store(Request $request){



			
	 			$query=$request->get('correo');
	 			$usuario = new Usuario;
	 			$usuarios=DB::table('empleado as u')
	 			->select('u.correo as correo')
	 			->where('u.correo','=',$query)->get();

	 			if ($usuarios[0]->correo!=null && $usuarios[0]->correo=="juan@gmail.com"){
				return view('almacen.usuario.iniciar.sesionIniciada',["usuarios"=>$usuarios,"query"=>$query]);
				}
	 			else{
					return view('layouts.admin');
				}
			
/*
			session_start();
				$email=$request->get('correo');
				$password=$request->get('contraseña');
		
				include 'conn.php';	

				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
		
			
			// Query sent to database
			$result = mysqli_query($conn, "SELECT correo, contraseña, nombre FROM empleado WHERE correo = '$email'");
			
			// Variable $row hold the result of the query
			$row = mysqli_fetch_assoc($result);
			
			// Variable $hash hold the password hash on database
			$hash = $row['contraseña'];
			
			/* 
			password_Verify() function verify if the password entered by the user
			match the password hash on the database. If everything is OK the session
			is created for one minute. Change 1 on $_SESSION[start] to 5 for a 5 minutes session.
			*/
			if (password_verify($_POST['contraseña'], $hash)) {	
				
				$_SESSION['loggedin'] = true;
				$_SESSION['nombre'] = $row['Name'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
				
				echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> $row[Name]			
				<p><a href='edit-profile.php'>Edit Profile</a></p>	
				<p><a href='logout.php'>Logout</a></p></div>";	
			
			} else {
				echo "<div class='alert alert-danger mt-4' role='alert'>Email or Password are incorrects!
				<p><a href='login.html'><strong>Please try again!</strong></a></p></div>";			
			}

*/

	 			}

	 	public function show(Request $request){
	 		return view('almacen.usuario.iniciar.sesionIniciada');
	 	}


}
