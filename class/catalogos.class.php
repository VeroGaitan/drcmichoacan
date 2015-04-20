<?php

require_once 'mysqli.class.php';

class catalogos extends  conexionmysqli{

    private $oficialias = array(); //solo es usado dentro de la clase y no es heredable (protected si es heredable)
    private $tomos = array();
    private $tbis = array();
    private $anos = array();
    private $actos = array();
    private $meses = array();

    /*
    private $ACTION;
    private $ACTO;
    private $MUNICIPIO;
    private $OFICIALIA;
    private $ANO;
    private $TOMO;
    private $TBIS;
    private $ACTA_INICIAL;
    private $ACTA_FINAL;
    private $FOJAS;
    private $ENCUADERNADO;
    private $VERIFICADO_ARCHIVO;
    private $VERIFICADO_OFICIALIA;
    private $DIGITALIZADO;
    private $INDEXADO;
    private $CAPTURADO;
    private $VERIFICADO;
    private $LIBERADO;
    private $resul = array();
    */
    
    private $localidades = array();
    private $localidades_f=array();
    private $entidadesFed = array();
    private $entidadesFed_f = array();
    private $municipios = array();
    private $municipios_f=array();    
    private $paises = array();
    private $sexo= array();
    private $estado_registrado= array();
    private $comparece= array();
    


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
        
        $this->oficialias = $this->query("SELECT VALOR, DESCRIPCION FROM drcmichoacan.cat_tbis c;");
        $resultArray = $this->oficialias->fetch_all();
        unset($this);
        return $resultArray;
        
        /*$this->tbis= array( array('00', '00'),array('01', 'A'),array('02', 'B'),array('01', 'CAM'));
      
        return $this->tbis;*/
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
                ("==========",
                  "ENERO",
                  "FEBRERO",
                  "MARZO",
                  "ABRIL",
                  "MAYO",
                  "JUNIO",
                  "JULIO",
                  "AGOSTO",
                  "SEPTIEMPRE",
                  "OCTUBRE",
                  "NOVIEMBRE",
                  "DICIEMBRE"
                );
      
        return $this->meses;
      
        return $this->meses;
    }
        public function execute_single_query($sql_string) {
    	//return  mysqli_query($this->conexion,$sql_string);
        	 $result= $this->query($sql_string);
                   $resultArray = $result->fetch_assoc();
                  return $resultArray;
            
    }
    
    
//*********************************************************************************
    public function cat_paises() {//PAIS Y NACIONALIDAD
        $this->paises = $this->query("SELECT id, DESCRIPCION, NACIONALIDAD FROM drcmichoacan.cat_pais c;");
        $resultArray = $this->paises->fetch_all();
        unset($this);
        return $resultArray;       
    }
    
    /*
    public function cat_entidadesFed() {//ENTIDAD FEDERATIVA O ESTADO
        $this->entidadesFed = $this->query("SELECT id, DESCRIPCION FROM drcmichoacan.cat_estado c;");
        $resultArray = $this->entidadesFed->fetch_all();
        unset($this);
        return $resultArray;       
    }
    */
    
    public function filtrar_entidadesFed($id_pais) {// FILTRO DE ENTIDAD FEDERATIVA O ESTADO
        $sql="SELECT id, DESCRIPCION FROM drcmichoacan.cat_estado c where ID_PAIS={$id_pais};";
        $this->entidadesFed_f = $this->query($sql);
        $resultArray = $this->entidadesFed_f->fetch_all();
        unset($this);
        return $resultArray;       
    }
    
    /*
    public function cat_municipios() {//MUNICIPIO
        $this->municipios = $this->query("SELECT id, NOMBRE FROM drcmichoacan.cat_municipio c;");
        $resultArray = $this->municipios->fetch_all();
        unset($this);
        return $resultArray;       
    }     
    */
    
    public function filtrar_municipios($id_estado) {//FILTRO DE MUNICIPIOS
        $sql="SELECT ID_RENAPO, NOMBRE FROM drcmichoacan.cat_municipio c where ID_ESTADO={$id_estado};";
        $this->municipios_f = $this->query($sql);
        $resultArray = $this->municipios_f->fetch_all();
        unset($this);
        return $resultArray;       
    }    
    
    /*
    public function cat_localidades() {//LOCALIDAD
        $this->localidades = $this->query("SELECT ID, LOCALIDAD FROM drcmichoacan.cat_localidades c;");
        $resultArray = $this->localidades->fetch_all();
        unset($this);
        return $resultArray;       
    }    
    */
    
    public function filtrar_localidades($id_municipio,$id_estado) {//FILTRO DE LOCALIDADES
        $sql="SELECT CLAVE_LOCALIDAD, LOCALIDAD FROM drcmichoacan.cat_localidades c where CLAVE_MUNICIPIO={$id_municipio} AND CLAVE_ENTIDAD={$id_estado};";
        $this->localidades_f = $this->query($sql);
        $resultArray = $this->localidades_f->fetch_all();
        unset($this);
        return $resultArray;       
    }     
    
    public function cat_sexo() {
        $this->sexo = $this->query("SELECT ID_SEXO, DESCRIPCION FROM drcmichoacan.cat_sexo c;");
        $resultArray = $this->sexo->fetch_all();
        unset($this);
        return $resultArray;       
    }   
    
    public function cat_estado_registrado() {
        $this->estado_registrado = $this->query("SELECT ID_ESTADOREGISTRADO, DESCRIPCION FROM drcmichoacan.01_cat_estadoregistrado c;");
        $resultArray = $this->estado_registrado->fetch_all();
        unset($this);
        return $resultArray;       
    }     
    
    public function cat_comparece() {
        $this->comparece = $this->query("SELECT ID_COMPARECE, DESCRIPCION FROM drcmichoacan.01_cat_comparece c;");
        $resultArray = $this->comparece->fetch_all();
        unset($this);
        return $resultArray;       
    }    
    
    
    
    
//********************************************************************************    
    
    
    
    
    
    
    
    
    public function __destruct() { //imprime las notas en pantalla
        $this->close();
    }
    public function closeBD() { //imprime las notas en pantalla
        $this->close();
    }
}//END class

?>