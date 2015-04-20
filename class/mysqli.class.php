<?php

class conexionmysqli extends mysqli {

    //En el constructor de la clase establecemos los parámetros como usuario, host, pass el nombre de la base de datos
    public function __construct($serverName = 'rcivil') {
        switch ($serverName) {
            case "rcivil":
                $host = "10.24.163.185";
                $user = "sistemas";
                $pass = "sistemas2015";
                $database = "drcmichoacan";                                                  
                
//                $host = "10.8.7.151";
//                $user = "sistemas";
//                $pass = "sistemas2015";
//                $database = "drcmichoacan";     
                
                /*$host = "10.8.7.151";
                $user = "proyectocaptura";
                $pass = "Captura2015";
                $database = "drcmichoacan";*/
                 
                break;
            case "pagos":
//                $host = "";
//                $user = "";
//                $pass = "";
//                $database = "";
                break;
            case "server151":
                
                $host = "10.24.163.185";
                $user = "sistemas";
                $pass = "sistemas2015";
                $database = "drcmichoacan";   
                
                
//                $host = "10.8.7.151";
//                $user = "sistemas";
//                $pass = "sistemas2015";
//                $database = "drcmichoacan";
                
                
               /* $host = "10.8.7.151";
                $user = "proyectocaptura";
                $pass = "Captura2015";
                $database = "drcmichoacan";*/
                break;
            default:
                
                $host = "10.24.163.185";
                $user = "brenda";
                $pass = "Patricio2015";
                $database = "drcmichoacan"; 
                
                
                
//                $host = "10.8.7.151";
//                $user = "sistemas";
//                $pass = "sistemas2015";
//                $database = "drcmichoacan";    
                
                
                 
                /*
                $host = "localhost";
                $user = "root";
                $pass = "";
                $database = "drcmichoacan";*/
                /*
                $host = "10.8.7.151";
                $user = "proyectocaptura";
                $pass = "Captura2015";
                $database = "drcmichoacan";*/
                break;
        }
        parent::__construct($host, $user, $pass, $database); //herencia de constructor para crear una conexion mysqli
        if (mysqli_connect_error()) {                                   // validacion de la conexion
            die('Error de Conexión (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }

}
