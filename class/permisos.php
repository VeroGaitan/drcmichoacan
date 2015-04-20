<?php

require_once('sesion.class.php');
require_once('conexion/conectar.class.php');


if (verificar_usuario()){

$conexion = new DbConstant('rcivil');
//conexion a base de datos
$conexion->conectar();

		$permisos = $conexion->execute_single_query("SELECT * FROM det_roles_permisos WHERE ID_ROL={$_SESSION["NO_ROL"]}");
		$arrayusuario=array();
			while($row=$permisos->fetch_assoc()){
					 $arrayusuario[]=array('ID_ROL'=>$row['ID_ROL'],'ID_PERMISO'=>$row['ID_PERMISO'],'estado'=>'ok');
			}


			$p=array();
			$resultado = count($arrayusuario);
			for ($i = 0; $i <= $resultado-1; $i++) {
			    $p[]=$arrayusuario[$i]["ID_PERMISO"];
			}

			/*$p2=array();
			while($row=$p->fetch_assoc()){
					 $P2[]=array('ID_PERMISO'=>$row['ID_PERMISO']);
			}*/			



		echo json_encode($arrayusuario,JSON_FORCE_OBJECT);

} else {
    //si el usuario no es verificado volvera al formulario de ingreso
    header('Location: ../index.php');
}


?>