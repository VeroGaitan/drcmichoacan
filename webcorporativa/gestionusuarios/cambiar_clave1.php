<?
	//aqui vamos hacer la conexion y consulta de ruta
	require_once '../../class/mysqli.class.php';

	//Se declaran las variables de conexion
	$conexion1 = new conexionmysqli('rcivil');


echo $ID_USUARIO=$_POST['ID_USUARIO'];
echo "<br>";
echo $PASSWORD=$_POST['PASSWORD'];
echo "<br>";
echo $PASSWORD=md5($PASSWORD);

echo "<br>";
echo $sql="UPDATE drcmichoacan.cat_usuarios_sistema SET PASSWORD='$PASSWORD' WHERE ID_USUARIO=$ID_USUARIO";
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