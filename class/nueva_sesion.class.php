<?php

date_default_timezone_set("Mexico/General");
require_once('sesion.class.php');
require_once('conexion/conectar.class.php');
$mySession = new session();

$usuario = $_POST['usuario'];
$password = $_POST['password']; 
$serverName = 'rcivil';
$autentificacion = new nueva_sesion($serverName,$usuario,$password,$mySession);


//Clase nueva_sesion
class nueva_sesion{

	public function __construct($serverName,$usuario,$password,$mySession){

		//Se declaran las variables de conexion
		$conexion1 = new DbConstant($serverName);
		//conexion a base de datos
		$conexion1->conectar();

		$consulta_usuario = $conexion1->execute_single_query("SELECT * FROM v_usuario_sistema WHERE NOMBRE_USUARIO='$usuario' AND PASSWORD='$password'");
		
/*revisar fecha de baja de la consulta*/
			if(mysqli_num_rows($consulta_usuario) > 0){
					//Arreglo de datos para sesion
			        $sessionData=array();
			        while($row=$consulta_usuario->fetch_assoc()){					
		            	$sessionData[] = array('ID_USUARIO' => $row['ID_USUARIOSISTEMA'],'ID_EMPLEADO'=>$row['ID_EMPLEADO'],'STATUS'=>$row['STATUS'],'NOMBRE_USUARIO' => $row['NOMBRE_USUARIO'], 'NO_ROL' => $row['NO_ROL'],'USUARIOASIGNA'=>$row['USUARIOASIGNA'],'NOMBRE'=>$row['NOMBRE'],'PRIMER_APELLIDO'=>$row['PRIMER_APELLIDO'],'SEGUNDO_APELLIDO'=>$row['SEGUNDO_APELLIDO'],'ID_MUNICIPIO'=>$row['ID_MUNICIPIO'],'ID_OFICIALIA'=>$row['ID_OFICIALIA'],'FECHA_BAJA'=>$row['FECHA_BAJA']);
		           	}
		           	
		           	if($sessionData[0]["FECHA_BAJA"] >=  date("Y\-m\-d\ h:i:s")){
		          
		           		//Se verifica que el usuario este activo
						if ($sessionData[0]["STATUS"] == 1) {
							//Creo al Usuario de la sesion
							$_SESSION['usuario'] = $usuario;					
							//creo las Variables de sesion
						    foreach ($sessionData as $data) {
						         $mySession->createSession($data);
						    }
					    	
							//print_r( $_SESSION );
							echo '{"estado": "existe"}';
				    		//echo json_encode($_SESSION,JSON_FORCE_OBJECT);

							exit();

						}else{
							echo '{"estado": "statusnoactivo"}';
							exit();
						}

					}else{ echo '{"estado": "fechabaja"}'; exit();}

					
			}else{
					//echo "No existe";
					
			        //header("Location:../index.php?access=failure");			      				
      				echo '{"estado": "noExiste"}';	  
      				exit();    				
			      	//return;
			}

	}// END construct

}//END class nueva_sesion




?>
