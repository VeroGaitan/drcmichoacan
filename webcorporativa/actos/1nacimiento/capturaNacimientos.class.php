<?php
/* 
    Author: Brenda Ortiz
*/

require ('../../../class/mysqli.class.php');

class capturaNacimientos extends conexionmysqli {
    /*
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
    */
    public function __construct() { 
        parent::__construct();
    }
    /*
    public function cat_paises() {//PAIS Y NACIONALIDAD
        $this->paises = $this->query("SELECT id, DESCRIPCION, NACIONALIDAD FROM drcmichoacan.cat_pais c;");
        $resultArray = $this->paises->fetch_all();
        unset($this);
        return $resultArray;       
    }
    */
    /*
    public function cat_entidadesFed() {//ENTIDAD FEDERATIVA O ESTADO
        $this->entidadesFed = $this->query("SELECT id, DESCRIPCION FROM drcmichoacan.cat_estado c;");
        $resultArray = $this->entidadesFed->fetch_all();
        unset($this);
        return $resultArray;       
    }
    */
    /*
    public function filtrar_entidadesFed($id_pais) {// FILTRO DE ENTIDAD FEDERATIVA O ESTADO
        $sql="SELECT id, DESCRIPCION FROM drcmichoacan.cat_estado c where ID_PAIS={$id_pais};";
        $this->entidadesFed_f = $this->query($sql);
        $resultArray = $this->entidadesFed_f->fetch_all();
        unset($this);
        return $resultArray;       
    }
    */
    /*
    public function cat_municipios() {//MUNICIPIO
        $this->municipios = $this->query("SELECT id, NOMBRE FROM drcmichoacan.cat_municipio c;");
        $resultArray = $this->municipios->fetch_all();
        unset($this);
        return $resultArray;       
    }     
    */
    /*
    public function filtrar_municipios($id_estado) {//FILTRO DE MUNICIPIOS
        $sql="SELECT ID_RENAPO, NOMBRE FROM drcmichoacan.cat_municipio c where ID_ESTADO={$id_estado};";
        $this->municipios_f = $this->query($sql);
        $resultArray = $this->municipios_f->fetch_all();
        unset($this);
        return $resultArray;       
    }    
    */
    /*
    public function cat_localidades() {//LOCALIDAD
        $this->localidades = $this->query("SELECT ID, LOCALIDAD FROM drcmichoacan.cat_localidades c;");
        $resultArray = $this->localidades->fetch_all();
        unset($this);
        return $resultArray;       
    }    
    */
    /*
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
    } */    
    
    //INSERT DE ACTA DE NACIMIENTO
    public function capturaActaNacimiento($CUADERNILLO,$ACTA,$FECHA_REGISTRO,$PRIMER_APELLIDO,$SEGUNDO_APELLIDO,$NOMBRE,$FECHA_NACIMIENTO,$HORA_NACIMIENTO,$ID_PAIS,$ID_ESTADO,$ESTADO_NACIMIENTO,$ID_MUNICIPIO,$MUNICIPIO_NACIMIENTO,$ID_LOCALIDAD,$LOCALIDAD_NACIMIENTO,$SEXO,$STATUS_REGISTRO,$COMPARECIO,$PRIMER_APELLIDO_PADRE,$SEGUNDO_APELLIDO_PADRE,$NOMBRE_PADRE,$EDAD_PADRE,$NACIONALIDAD_PADRE,$PRIMER_APELLIDO_MADRE,$SEGUNDO_APELLIDO_MADRE,$NOMBRE_MADRE,$EDAD_MADRE,$NACIONALIDAD_MADRE,$NOTA_ACTA,$NOTA_MARGINAL) {
   
    echo "capturaNacimientos.class.php//ACTA: ".$ACTA
            ." \n CUADERNILLO: ".$CUADERNILLO
            ." \n FECHA_REGISTRO: ".$FECHA_REGISTRO
            ." \n PRIMER_APELLIDO: ".$PRIMER_APELLIDO
            ." \n SEGUNDO_APELLIDO: ".$SEGUNDO_APELLIDO
            ." \n NOMBRE: ".$NOMBRE
            ." \n FECHA_NACIMIENTO: ".$FECHA_NACIMIENTO
            ." \n HORA_NACIMIENTO: ".$HORA_NACIMIENTO
            ." \n ID_PAIS: ".$ID_PAIS
            ." \n ID_ESTADO: ".$ID_ESTADO
            ." \n ESTADO_NACIMIENTO: ".$ESTADO_NACIMIENTO
            ." \n ID_MUNICIPIO: ".$ID_MUNICIPIO
            ." \n MUNICIPIO_NACIMIENTO: ".$MUNICIPIO_NACIMIENTO
            ." \n ID_LOCALIDAD: ".$ID_LOCALIDAD             
            ." \n LOCALIDAD_NACIMIENTO: ".$LOCALIDAD_NACIMIENTO
            ." \n SEXO: ".$SEXO
            ." \n STATUS_REGISTRO: ".$STATUS_REGISTRO
            ." \n COMPARECIO: ".$COMPARECIO
            ." \n PRIMER_APELLIDO_PADRE: ".$PRIMER_APELLIDO_PADRE
            ." \n SEGUNDO_APELLIDO_PADRE: ".$SEGUNDO_APELLIDO_PADRE
            ." \n NOMBRE_PADRE: ".$NOMBRE_PADRE
            ." \n EDAD_PADRE: ".$EDAD_PADRE
            ." \n NACIONALIDAD_PADRE: ".$NACIONALIDAD_PADRE
            ." \n PRIMER_APELLIDO_MADRE: ".$PRIMER_APELLIDO_MADRE
            ." \n SEGUNDO_APELLIDO_MADRE: ".$SEGUNDO_APELLIDO_MADRE
            ." \n NOMBRE_MADRE: ".$NOMBRE_MADRE
            ." \n EDAD_MADRE: ".$EDAD_MADRE
            ." \n NACIONALIDAD_MADRE: ".$NACIONALIDAD_MADRE
            ." \n NOTA_ACTA: ".$NOTA_ACTA
            ." \n NOTA_MARGINAL: ".$NOTA_MARGINAL; 
         
        /*
        $sql="";
        $resultado=$this->query($sql);
         
        if (!$resultado) {
            echo $this->error;
        } else {
            echo "Captura Exitosa";
        }
         */
    }    
    
    //INSERT DE INSCRIPCION DE NACIMIENTO
    public function capturaInscripcionNacimiento($ACTA,$FECHA_REGISTRO,$PRIMER_APELLIDO,$SEGUNDO_APELLIDO,$NOMBRE,$FECHA_NACIMIENTO,$HORA_NACIMIENTO,$SEXO,$STATUS_REGISTRO,$COMPARECIO,$PRIMER_APELLIDO_PADRE,$SEGUNDO_APELLIDO_PADRE,$NOMBRE_PADRE,$EDAD_PADRE,$NACIONALIDAD_PADRE,$PRIMER_APELLIDO_MADRE,$SEGUNDO_APELLIDO_MADRE,$NOMBRE_MADRE,$EDAD_MADRE,$NACIONALIDAD_MADRE,$NOTA_ACTA_INSCRIPCION,$NOTA_MARGINAL) {
   
    echo "capturaNacimientos.class.php//ACTA: ".$ACTA
            ." \n FECHA_REGISTRO: ".$FECHA_REGISTRO
            ." \n PRIMER_APELLIDO: ".$PRIMER_APELLIDO
            ." \n SEGUNDO_APELLIDO: ".$SEGUNDO_APELLIDO
            ." \n NOMBRE: ".$NOMBRE
            ." \n FECHA_NACIMIENTO: ".$FECHA_NACIMIENTO
            ." \n HORA_NACIMIENTO: ".$HORA_NACIMIENTO          
            ." \n SEXO: ".$SEXO
            ." \n STATUS_REGISTRO: ".$STATUS_REGISTRO
            ." \n COMPARECIO: ".$COMPARECIO
            ." \n PRIMER_APELLIDO_PADRE: ".$PRIMER_APELLIDO_PADRE
            ." \n SEGUNDO_APELLIDO_PADRE: ".$SEGUNDO_APELLIDO_PADRE
            ." \n NOMBRE_PADRE: ".$NOMBRE_PADRE
            ." \n EDAD_PADRE: ".$EDAD_PADRE
            ." \n NACIONALIDAD_PADRE: ".$NACIONALIDAD_PADRE
            ." \n PRIMER_APELLIDO_MADRE: ".$PRIMER_APELLIDO_MADRE
            ." \n SEGUNDO_APELLIDO_MADRE: ".$SEGUNDO_APELLIDO_MADRE
            ." \n NOMBRE_MADRE: ".$NOMBRE_MADRE
            ." \n EDAD_MADRE: ".$EDAD_MADRE
            ." \n NACIONALIDAD_MADRE: ".$NACIONALIDAD_MADRE
            ." \n NOTA_ACTA_INSCRIPCION: ".$NOTA_ACTA_INSCRIPCION
            ." \n NOTA_MARGINAL: ".$NOTA_MARGINAL; 
         
        /*
        $sql="";
        $resultado=$this->query($sql);
         
        if (!$resultado) {
            echo $this->error;
        } else {
            echo "Captura Inscripcion Exitosa";
        }
         */
    }       
    
   
    
    public function __destruct() { //imprime las notas en pantalla
        $this->close();
    }
    public function closeBD() { //imprime las notas en pantalla
        $this->close();
    }
}//END class
