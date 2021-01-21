<?php
		class Conexion{
			var $ruta;
			var $usuario;
			var $contrasena;
			var $baseDatos;

			function __construct(){

				$this->ruta       ="remotemysql.com"; //
				$this->usuario    ="FzhnWzfWhw"; //usuario que tengas definido
				$this->contrasena ="4lwAqoEP8s"; //contraseña que tengas definidad
				$this->baseDatos  ="FzhnWzfWhw"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala


				/*$this->ruta       ="controler.com.co"; //
				$this->usuario    ="control3_cosechafresca1"; //usuario que tengas definido
				$this->contrasena ="ctj9jN7ePPt@"; //contraseña que tengas definidad
				$this->baseDatos  ="control3_cosechafresca1"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala*/

			}

			function conectarse(){
				//---------------------------TIPO DE CONEXION 1-----------------------------------
				/*$conectarse= mysql_connect($this->ruta,$this->usuario, $this->contrasena) or die(mysql_error()); //conexion al BD
				if($conectarse){
					mysql_select_db($this->baseDatos);
					return($conectarse);
				}else{
					return ("Error");
					}*/
				//------------------------TIPO DE CONEXION 2 - RECOMENDADA---------------------------------------------
				$enlace = mysqli_connect($this->ruta, $this->usuario, $this->contrasena, $this->baseDatos);
				if($enlace){
					//echo "Conexion exitosa";	//si la conexion fue exitosa nos muestra este mensaje como prueba, despues lo puedes poner comentarios de nuevo: //
				}else{
					die('Error de Conexión (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
				}
				return($enlace);
				// mysqli_close($enlace); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
			}
		}

?>
