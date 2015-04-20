<?php
$mysqli = new mysqli("curp.michoacan.gob.mx", "consultasweb", "Rcivil2014", "nacimientos");
if ($mysqli->connect_errno) {
    echo "<div class='span-22 prepend-1 append-1 last'><div class='error'><center><strong>Hubo un error en el servidor MySQL!!</strong><br/>(" . htmlentities($menysqli->connect_errno) . ") " . htmlentities($mysqli->connect_error) . "</center></div></div>";
}
$mysqli->set_charset("utf8");

//para seleccionar otra bd usar:
//$mysqli->select_db("world");