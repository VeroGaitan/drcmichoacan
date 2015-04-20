<?php

include_once './mysqli.class.php';
require_once('./sesion.class.php');

class log extends conexionmysqli {

    private $user, $pass;

    function __construct($user, $pass) {
        parent::__construct("rcivil");  
        $this->user = $user;
        $this->pass = $pass;
    }

    public function verificarUsuario() {
        $myLogin = $this->query("SELECT ID_USUARIO, STATUS, FECHA_BAJA_USUARIO, NOMBRE_USUARIO FROM view_usuarios_sistema U left join  view_rol_permisos P on u.ID_ROL=P.ID_ROL WHERE NOMBRE_USUARIO = '{$this->user}' AND PASSWORD = md5('{$this->pass}') LIMIT 1");
        $_myLogin = $myLogin->fetch_assoc();
        return $_myLogin;
    }

}

$mySession = new session();
$logIn = new log(filter_input(INPUT_GET, "user"), filter_input(INPUT_GET, "pass"));
if ($logIn->verificarUsuario()) {
    $user = $logIn->verificarUsuario();
    foreach ($user as $key => $data) {
        if ($data != "") {
            $session = array($key => $data);
            $mySession->createSession($session);
        }
    }
    echo json_encode($logIn->verificarUsuario());
} else {
    echo json_encode(array("logInFail" => 1));
}
$logIn->close();
