<?php

require_once '../../class/conexion/mysqli.class.php';

class datos_registro extends  conexionmysqli{

    private $oficialias = array(); //solo es usado dentro de la clase y no es heredable (protected si es heredable)
    private $tomos = array();
    private $tbis = array();
    private $anos = array();
    private $actos = array();
  private $meses = array();
    public function __construct() { //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
        parent::__construct();
    }

    public function muestraPais() {
        $resultado = $this->query("SELECT * FROM Pais");
                $resultArray = $resultado->fetch_all();
        return $resultArray;
    }

    public function cat_oficialias() { //funcion que calcula el promedio, lo devuelve
       
  $resultado = $this->query("SELECT CLAVE,NOMBRE_MUNICIPIO,NOMBRE_LOCALIDAD FROM drcmichoacan.cat_oficialia c;");
        $resultArray = $resultado->fetch_all();
        return $resultArray;
    }

    public function cat_actos() { //funcion que calcula el promedio, lo devuelve
        $this->oficialias = $this->query("select ACTO_MICH,DESCRIPCION from drcmichoacan.cat_acto");
        $resultArray = $this->oficialias->fetch_all();
        unset($this);
        return $resultArray;
    }

    public function cat_tomos() { //funcion que calcula el promedio, lo devuelve
        for ($i = 1; $i <= 100; $i++) {
            $this->tomos[] = $i;
        }
        return $this->tomos;
    }

    public function cat_tbis() { //funcion que calcula el promedio, lo devuelve
        
 
        
        $this->tbis= array( array('00', '00'),array('01', 'A'),array('02', 'B'),array('01', 'CAM'));
      
        return $this->tbis;
    }

    public function cat_anos() { //funcion que calcula el promedio, lo devuelve
        for ($i = date("Y"); $i >1889; $i--) {
            $this->anos[] = $i;
        }
        return $this->anos;
    }
    public function cat_meses()  //
       {
               $this->meses = array
                (
                 array(0, "=========="),
                array(1, "ENERO"),
                array(2, "FEBRERO"),
                array(3, "MARZO"),
                array(4, "ABRIL"),
                array(5, "MAYO"),
                array(6, "JUNIO"),
                array(7, "JULIO"),
                array(8, "AGOSTO"),
                array(9, "SEPTIEMPRE"), 
                array(10, "OBTUBRE"), 
                array(11, "NOVIEMBRE"), 
                array(12, "DICIEMBRE")
            );
      
        return $this->meses;
    }
        public function execute_single_query($sql_string) {
    	//return  mysqli_query($this->conexion,$sql_string);
        	 $result= $this->query($sql_string);
                   $resultArray = $result->fetch_row();
                  return $resultArray;
            
    }
    public function __destruct() { //imprime las notas en pantalla
        unset($this);
    }

}

?>