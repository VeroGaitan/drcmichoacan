<?
//aqui vamos hacer la conexion y consulta de ruta
	require_once '../../class/mysqli.class.php';

	//Se declaran las variables de conexion
	$conexion1 = new conexionmysqli('rcivil');

echo $NOMBRE = $_POST["NOMBRE"]; 
echo "<br>";
echo $PRIMER_APELLIDO = $_POST["PRIMER_APELLIDO"]; 
echo "<br>";
echo $SEGUNDO_APELLIDO = $_POST["SEGUNDO_APELLIDO"]; 
echo "<br>";
echo $FECHA_NACIMIENTO = $_POST["FECHA_NACIMIENTO"];
echo "<br>";
list($dia, $mes, $anio) = explode("/", $FECHA_NACIMIENTO);
echo $FECHA_NACIMIENTO=$anio."-".$mes."-".$dia;
echo "<br>";
echo $DIRECCION=$_POST["DIRECCION"];
echo "<br>";
echo $NO_CELULAR = $_POST["NO_CELULAR"];
echo "<br>";
echo $TELEFONO_CASA = $_POST["TELEFONO_CASA"];
echo "<br>";
echo $TELEFONO_EMERGENCIA = $_POST["TELEFONO_EMERGENCIA"];
echo "<br>";
echo $NO_SEGURIDAD_SOCIAL = $_POST["NO_SEGURIDAD_SOCIAL"];
echo "<br>";
echo $CURP = $_POST["CURP"];
echo "<br>";
echo $ID_PROFESION = $_POST["ID_PROFESION"];
echo "<br>";
echo $DESCRIPCION_PROFESION = $_POST["DESCRIPCION_PROFESION"]; 
echo "<br>";
echo $CORREO_PARTICULAR = $_POST["CORREO_PARTICULAR"];
echo "<br>";
echo $SEXO = $_POST["SEXO"]; 
echo "<br>";
echo $ESTADO_CIVIL = $_POST["ESTADO_CIVIL"];
echo "<br>";
echo $RFC = $_POST["RFC"]; 
echo "<br>";
echo $ID_USUARIO=$_POST["ID_USUARIO"];
echo "<br>";



echo "<br>";
echo $sql="UPDATE drcmichoacan.rh_cat_empleados SET NOMBRE='$NOMBRE', PRIMER_APELLIDO='$PRIMER_APELLIDO', SEGUNDO_APELLIDO='$SEGUNDO_APELLIDO', DIRECCION='$DIRECCION',
NO_CELULAR='$NO_CELULAR', TELEFONO_CASA='$TELEFONO_CASA', TELEFONO_EMERGENCIA='$TELEFONO_EMERGENCIA', NO_SEGURIDAD_SOCIAL='$NO_SEGURIDAD_SOCIAL',
CURP='$CURP', ID_PROFESION='$ID_PROFESION', DESCRIPCION_PROFESION='$DESCRIPCION_PROFESION', CORREO_PARTICULAR='$CORREO_PARTICULAR', SEXO='$SEXO', ESTADO_CIVIL='$ESTADO_CIVIL',
RFC='$RFC' WHERE ID_USUARIO=$ID_USUARIO";
 $resultado = $conexion1->query($sql);
echo "<br>";

if(!$resultado)
{
  printf("Error: %s\n", $conexion1->error);
}
else
{
print_r($resultado);
}



?>