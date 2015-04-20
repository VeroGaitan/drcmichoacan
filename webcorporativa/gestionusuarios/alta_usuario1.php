<? 
//aqui vamos hacer la conexion y consulta de ruta
require_once '../../class/mysqli.class.php';

//Se declaran las variables de conexion
$conexion1 = new conexionmysqli('rcivil');
//$conexion1->begin();


$NOMBRE = $_POST["NOMBRE"]; 
$PRIMER_APELLIDO = $_POST["PRIMER_APELLIDO"]; 
$SEGUNDO_APELLIDO = $_POST["SEGUNDO_APELLIDO"]; 
$FECHA_NACIMIENTO = $_POST["FECHA_NACIMIENTO"]; 
list($dia, $mes, $anio) = explode("/", $FECHA_NACIMIENTO);
$FECHA_NACIMIENTO=$anio."/".$mes."/".$dia;
$NO_CELULAR = $_POST["NO_CELULAR"]; 
$NO_NOMINA = $_POST["NO_NOMINA"]; 
$ID_PROFESION = $_POST["ID_PROFESION"]; 
$DESCRIPCION_PROFESION = $_POST["DESCRIPCION_PROFESION"]; 
$SEXO = $_POST["SEXO"]; 
$FECHA_INGRESO = $_POST["FECHA_INGRESO"];
list($di, $me, $ani) = explode("/", $FECHA_INGRESO);
$FECHA_INGRESO=$ani."/".$me."/".$di;
$ID_DEPARTAMENTO = $_POST["ID_DEPARTAMENTO"]; 
$ID_DEPENDENCIA = $_POST["ID_DEPENDENCIA"]; 
$ROLES=$_POST["ROLES"]; 

echo "<br>";
echo $sql="INSERT INTO rh_cat_empleados (ID_USUARIO, NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, FECHA_NACIMIENTO, NO_CELULAR, NO_NOMIMA, STATUS_ACTIVO,
ID_PROFESION, DESCRIPCION_PROFESION, SEXO, FECHA_INGRESO, ESTATUS, RFC, ID_DEPARTAMENTO, ID_DEPENDENCIA) VALUES (0, '$NOMBRE', '$PRIMER_APELLIDO', '$SEGUNDO_APELLIDO', 
'$FECHA_NACIMIENTO', '$NO_CELULAR', '$NO_NOMINA', 1, '$ID_PROFESION', '$DESCRIPCION_PROFESION', '$SEXO', '$FECHA_INGRESO', 0,'', '$ID_DEPARTAMENTO', '$ID_DEPENDENCIA');";
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
echo "<br>";

//insercion tabla cat_usuarios_sistema


date_default_timezone_set("Mexico/General");
$fech_sistema=date("Y-m-d h:i:s");

$hora_sistema=date("h:i:s");
$n = substr($NOMBRE, 0, 1);
$prim = substr($PRIMER_APELLIDO, 0, 2);
$seg = substr($SEGUNDO_APELLIDO, 0, 1);
$us_asign=$prim.$seg.$n.$anio.$mes.$dia;
$password=md5($us_asign);
$FECHA_BAJA=$ani."/".($me+2)."/".$di." ".$hora_sistema;

$SQL2="SELECT MAX(ID_USUARIO) FROM rh_cat_empleados;";
$ID = $conexion1->query($SQL2);
$ID_=$ID->fetch_assoc();
$ID_USUARIO=$ID_['MAX(ID_USUARIO)'];

echo $sql1="INSERT INTO cat_usuarios_sistema (ID_USUARIO, STATUS, NOMBRE_USUARIO, FECHA_ACTUALIZACION, FECHA_INICIO, FECHA_BAJA, USUARIOASIGNA, PASSWORD) 
VALUES ('$ID_USUARIO', 1, '$us_asign','$fech_sistema', '$FECHA_INGRESO', '$FECHA_BAJA', '$ID_USUARIO', '$password');";
 $resultado1 = $conexion1->query($sql1);
echo "<br>";

if(!$resultado1)
{
  printf("Error: %s\n", $conexion1->error);
}
else
{
print_r($resultado1);
}
echo "<br>";

//det_cat_usuarios_sistema

for ($i=0;$i<count($ROLES);$i++)    
{
$R=$ROLES[$i];     
echo $sql2="INSERT INTO det_cat_usuarios_sistema (ID_USUARIO, ID_ROL, FECHA_ASIGNACION, FECHA_BAJA, USUARIO_ASIGNA) 
VALUES ('$ID_USUARIO', '$R','$fech_sistema', '$FECHA_BAJA', '$ID_USUARIO');";
 $resultado2 = $conexion1->query($sql2);
echo "<br>";

if(!$resultado2)
{
  printf("Error: %s\n", $conexion1->error);
}
else
{
print_r($resultado2);
}
echo "<br>";
} 


?>