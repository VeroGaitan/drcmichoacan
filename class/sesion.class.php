<?php

class session {

//funcion para construir una sesion
    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

//funcion para crear una sesion con todas sus variables de session
    public function createSession($sessionData) {
        foreach ($sessionData as $varSession => $mySession) {
            $_SESSION[$varSession] = $mySession;
        }
    }

//verifica si hay una sesion activa
    public function verifySession($sessionData) {
        $errorStatus = 0;
        foreach ($sessionData as $nameSession) {
            if (!isset($_SESSION[$nameSession])) {
                $errorStatus++;
            }
        }
        if ($errorStatus == 0) {
            return true;
        }
    }

    //funcion para cerrar sesion
    public function closeSession($go = null) {
        session_destroy();
        if (isset($go)) {
            header("Location:{$go}");
            exit;
        }
    }

}

//funcion para verificar que dentro del arreglo global $_SESSION existe el nombre del usuario
function verificar_usuario() {
    //continuar una sesion iniciada
    session_start();
    //comprobar la existencia del usuario
    if ($_SESSION['usuario']) {
        return true;
    }
}

?>