<?php
require_once '../../../class/mysqli.class.php';

class datos_defuncion extends  conexionmysqli{

    private $entidadesFed_f = array();
    private $municipios_f = array();
    private $localidades_f = array();
    private $comparece= array();
    private $listaEdosCert= array();
    
    public function __construct() { //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
        parent::__construct();
    }
	public function cat_sexo() {
        $resultado = $this->query("SELECT * FROM cat_sexo");
        $resultArray = $resultado->fetch_all();
        return $resultArray;
    }
	
	public function cat_edo_civil() {
        $resultado = $this->query("SELECT * FROM cat_edo_civil");
        $resultArray = $resultado->fetch_all();
        return $resultArray;
    }

    public function cat_paises() {
        $resultado = $this->query("SELECT * FROM cat_pais");
        $resultArray = $resultado->fetch_all();
        return $resultArray;
    }
      
    public function filtrar_entidadesFed($id_pais) {// FILTRO DE ENTIDAD FEDERATIVA O ESTADO
        $sql="SELECT id, DESCRIPCION FROM drcmichoacan.cat_estado where ID_PAIS={$id_pais};";
        $this->entidadesFed_f = $this->query($sql);
        $resultArray = $this->entidadesFed_f->fetch_all();
        unset($this);
        return $resultArray;       
    }
    public function filtrar_municipios($id_estado) {// FILTRO DE MUNICIPIOS
        $sql="SELECT id, NOMBRE FROM drcmichoacan.cat_municipio where ID_ESTADO={$id_estado};";
        $this->municipios_f = $this->query($sql);
        $resultArray = $this->municipios_f->fetch_all();
        unset($this);
        return $resultArray;       
    }

   public function filtrar_localidades($id_municipio,$id_estado) {//FILTRO DE LOCALIDADES
        $sql="SELECT CLAVE_LOCALIDAD, LOCALIDAD FROM drcmichoacan.cat_localidades c where CLAVE_MUNICIPIO={$id_municipio} AND CLAVE_ENTIDAD={$id_estado};";
        $this->localidades_f = $this->query($sql);
        $resultArray = $this->localidades_f->fetch_all();
        unset($this);
        return $resultArray;       
    } 
    public function cat_comparece() {
        $this->comparece = $this->query("SELECT PARENTESCO, DESCR FROM drcmichoacan.06_cat_comparecientes c;");
        $resultArray = $this->comparece->fetch_all();
        unset($this);
        return $resultArray;       
    }
    public function cat_edos_cert(){
      $this-> listaEdosCert = $this->query("SELECT ID_ESTADO_CERTIFICACION, DESCRIPCION FROM drcmichoacan.`01_cat_estadocertificacion`;");
      $resultArray = $this->listaEdosCert->fetch_all();
      unset($this);
      return $resultArray;    
    }
    
    public function insertar_defunciones($libro,$cuadernillo, $tomo, $tomoBis, $oficialia, $noActa, $actaBis,$anoReg, $estadoReg, $municipioReg, $cadena, $fechaReg, $crip, $curp, $nombres, $primer_apellido, $segundo_apellido, $idSexo, $fechaNac, $edad, $tiempoEdad,$otraEdad, $idPais, $idEstado, $desEstado, $idMunicipio, $desMunicipio, $idLocalidad, $desLocalidad, $edo_civil_difunto, $nacionalidad_difunto, 
            $nombres_conyugue, $primer_apellido_conyugue, $segundo_apellido_conyugue, $finadoCony, $nacionalidad_conyugue, $nombres_padre, $primer_apellido_padre, $segundo_apellido_padre, $finadoPadre, $nacionalidad_padre, $nombres_madre, $primer_apellido_madre, $segundo_apellido_madre, $finadoMadre, $nacionalidad_madre, 
            $fechaDefuncion, $hrDefuncion, $causa, $lugar, $noCertificado, $nombre_medico, $cedula, $nota_acta, $notaMarginal, $estado_certificado){
    
        if($nombre_medico=='')$nombre_medico='==';
        if($edad=='')$edad='0';
        if($idMunicipio=='')$idMunicipio='0';
        if($idLocalidad=='')$idLocalidad='0';
        
    $sqlInsert = "CALL inserta_defunciones('$libro','$cuadernillo','$tomo', '$tomoBis', '$oficialia', '$noActa', '$actaBis','$anoReg',' $estadoReg',' $municipioReg',' $cadena','$fechaReg', '$crip', '$curp', '$nombres', '$primer_apellido', '$segundo_apellido', '$idSexo', '$fechaNac', '$edad', '$tiempoEdad','$otraEdad', '$idPais', '$idEstado', '$desEstado', '$idMunicipio', '$desMunicipio', '$idLocalidad', '$desLocalidad', '$edo_civil_difunto', '$nacionalidad_difunto', 
            '$nombres_conyugue', '$primer_apellido_conyugue', '$segundo_apellido_conyugue', '$finadoCony', '$nacionalidad_conyugue', '$nombres_padre', '$primer_apellido_padre', '$segundo_apellido_padre', '$finadoPadre', '$nacionalidad_padre', '$nombres_madre', '$primer_apellido_madre', '$segundo_apellido_madre', '$finadoMadre', '$nacionalidad_madre', 
            '$fechaDefuncion', '$hrDefuncion', '$causa', '$lugar', '$noCertificado', '$nombre_medico', '$cedula', '$nota_acta', '$notaMarginal', '$estado_certificado')";
    
        if ($this->query($sqlInsert)) {
            echo "Registro Guardado Exitosamente!!!";
        } else {
            printf("Mensaje Error: %s\n", $this->error);
        }
    }
   public function insertar_defunciones_ins($libro, $tomo, $tomoBis, $oficialia, $noActa,$actaBis, $anoReg, $estadoReg, $municipioReg, $cadena, $fechaReg, $nombres, $primer_apellido, $segundo_apellido, $idSexo, $fechaNac, $edad, $tiempoEdad,$otraEdad, $idPais, 
            $fechaDefuncion, $compareciente, $transcripcion, $notas, $notaMarginal,$estado_certificado){
    if($edad=='')$edad='0';
    if($idMunicipio=='')$idMunicipio='0';
    if($idLocalidad=='')$idLocalidad='0';
    
    $sqlInsert = "CALL inserta_defunciones_ins('$libro','$tomo', '$tomoBis','$oficialia', '$noActa', '$actaBis','$anoReg','$estadoReg', '$municipioReg', '$cadena','$fechaReg', '$nombres', '$primer_apellido', '$segundo_apellido', '$idSexo', '$fechaNac', '$edad', '$tiempoEdad', '$otraEdad ','$idPais', 
            '$fechaDefuncion','$compareciente', '$transcripcion', '$notas',' $notaMarginal','$estado_certificado')";
    
        if ($this->query($sqlInsert)) {
            echo "Registro Guardado Exitosamente!!!";
        } else {
            printf("Mensaje Error: %s\n", $this->error);
        }
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