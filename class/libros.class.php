<?php

require ('mysqli.class.php');

class libros extends conexionmysqli {

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

    public function __construct() {
        parent::__construct();
    }

   public function insert_libro($ACTO, $JUZGADO, $MUNICIPIO, $OFICIALIA, $ANO, $TOMO, $TBIS, $ACTA_INICIAL, $ACTA_FINAL, $MES_FINAL, $ENCUADERNADO, $VERIFICADO_ARCHIVO, $VERIFICADO_OFICIALIA, $DIGITALIZADO, $INDEXADO, $CAPTURADO, $VERIFICADO, $LIBERADO) {
       if($ACTA_INICIAL=="" || $ACTA_FINAL=="" ){
           echo "Faltan datos por llenar";           
       }else{
       

        if($TBIS=="==" && $TBIS=0){
            //echo "hola";
            $TBIS=00;
            
        }        
       
        $sqlInsert = "INSERT INTO drcmichoacan.cat_libros( 
        UNICO
        ,ACTO
        ,JUZGADO
        ,MUNICIPIO
        ,OFICIALIA
        ,ANO
        ,TOMO
        ,TBIS
        ,ACTA_INICIAL
        ,ACTA_FINAL
        ,FOJAS
        ,RUTA
        ,FECHA_RECEPCION
        ,FECHA_ALTA
        ,MES_FINAL
        ,PRIMER_REGISTRADO
        ,ENCUADERNADO
        ,ORIGENLIBRO
        ,TIPO_CAPTURA
        ,DIGITALIZADO
        ,INDEXADO
        ,CAPTURADO
        ,VERIFICADO
        ,LIBERADO
        ,VERIFICADO_ARCHIVO
        ,VERIFICADO_OFICIALIA
        ,ID_ANTERIOR
      ) VALUES (
        '{$ACTO}{$MUNICIPIO}{$OFICIALIA}{$ANO}{$TOMO}{$TBIS}'
        ,{$ACTO}
        ,'{$JUZGADO}'   
        ,{$MUNICIPIO}
        ,{$OFICIALIA} 
        ,{$ANO}
        ,{$TOMO} 
        ,{$TBIS} 
        ,$ACTA_INICIAL
        ,$ACTA_FINAL
        ,($ACTA_FINAL-$ACTA_INICIAL+1)
        ,'Z:/$ACTO/16/$MUNICIPIO/$OFICIALIA/$ANO/$TOMO/$TBIS'
        ,CURRENT_DATE() 
        ,CURRENT_DATE()
        ,'{$MES_FINAL}'
        ,'======' 
        ,0      
        ,0 
        ,NULL
        ,NULL 
        ,NULL 
        ,NULL 
        ,NULL
        ,NULL
        ,NULL
        ,NULL
        ,NULL);
      ";
        if (!$this->query($sqlInsert)) {
            echo $this->error;
        } else {
            echo "LIBRO GUARDADO EXITOSAMENTE";
        }
        
       }//END ELSE
    }
	
    #UPDATE Libro
    public function update_libro($ID_LIBRO,$ACTO, $JUZGADO, $MUNICIPIO, $OFICIALIA, $ANO, $TOMO, $TBIS, $ACTA_INICIAL, $ACTA_FINAL, $FOJAS, $MES_FINAL, $ENCUADERNADO, $DIGITALIZADO, $INDEXADO, $CAPTURADO, $VERIFICADO,  $LIBERADO, $VERIFICADO_ARCHIVO, $VERIFICADO_OFICIALIA,$NO_LOCALIZADO,$OBSERVACIONES) {        
       
        //print_r($FOJAS);
        var_dump($FOJAS);
        
        
        if($FOJAS==""){
            //echo "hola";
            $FOJAS=0;
            
        }

        if($TBIS=="==" && $TBIS=0){
            //echo "hola";
            $TBIS=00;
            
        }          


        
         echo $updatequery="UPDATE drcmichoacan.cat_libros SET 
          UNICO='{$ACTO}{$MUNICIPIO}{$OFICIALIA}{$ANO}{$TOMO}{$TBIS}',
          ACTO ='{$ACTO}',
          JUZGADO ='{$JUZGADO}',
          MUNICIPIO ='{$MUNICIPIO}',
          OFICIALIA ='{$OFICIALIA}',
          ANO ='{$ANO}',
          TOMO ='{$TOMO}',
          TBIS ='{$TBIS}',
          ACTA_INICIAL ='{$ACTA_INICIAL}', 
          ACTA_FINAL='{$ACTA_FINAL}', 
          FOJAS='{$FOJAS}',
          MES_FINAL='{$MES_FINAL}',      
          ENCUADERNADO='{$ENCUADERNADO}', 
          DIGITALIZADO='{$DIGITALIZADO}', 
          INDEXADO='{$INDEXADO}', 
          CAPTURADO='{$CAPTURADO}',
          VERIFICADO='{$VERIFICADO}', 
          LIBERADO='{$LIBERADO}', 
          VERIFICADO_ARCHIVO='{$VERIFICADO_ARCHIVO}', 
          VERIFICADO_OFICIALIA='{$VERIFICADO_OFICIALIA}',
          NO_LOCALIZADO='{$NO_LOCALIZADO}', 
          OBSERVACIONES='{$OBSERVACIONES}'              
          WHERE ID_LIBRO = '{$ID_LIBRO}';";
              $resultado = $this->query($updatequery);
              //$resul = $resultado->fetch_assoc();
              return $resultado;
              unset($resultado);      
              //return $this->self[$name];
    }

    #SELECT Libro para
    public function libro_en_proceso_para($ACTO, $JUZGADO, $MUNICIPIO, $OFICIALIA, $ANO, $PROCESO_ACTUAL ) {   
          $condicion="";
        if ($ANO <> 0)
        {
            $condicion=$condicion." and ANO={$ANO}";
        }
    
       


    if($PROCESO_ACTUAL== "DIGITALIZADO"){
          $sql="SELECT * FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' AND (DIGITALIZADO=0 OR DIGITALIZADO IS NULL) {$condicion};";
    }else if($PROCESO_ACTUAL== "CAPTURADO"){
          $sql="SELECT * FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' AND (CAPTURADO=0 OR CAPTURADO IS NULL) {$condicion};";
    }else if($PROCESO_ACTUAL== "VERIFICADO"){
          $sql="SELECT * FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' AND (VERIFICADO=0 OR VERIFICADO IS NULL) {$condicion};";
    }else{
          echo "No existen libros";
          exit();
    }         
             
                  $resultado = $this->query($sql);
                  $resul = $resultado->fetch_all();
                  $no_filas=$resultado->num_rows;
                  if ($no_filas==0){
                      return $no_filas;
                  }
                  else{
                      return $resul;
                  }
                  unset($resultado);
              
             
    }


    #SELECT BY ID_LIBRO
    public function selectById($ID_LIBRO) {        
              $selectID="SELECT * FROM drcmichoacan.cat_libros c where ID_LIBRO='{$ID_LIBRO}'  limit 1;";
              $resultado = $this->query($selectID);
              $resul = $resultado->fetch_assoc();
              return $resul;
              unset($resultado);      
    }   

    public function muestra_libros() { //funcion que calcula el promedio, lo devuelve
        $resultado = $this->query("SELECT UNICO,ACTO  
,JUZGADO
  ,ANO
  ,TOMO
  ,TBIS
  ,ACTA_INICIAL
  ,ACTA_FINAL
  ,DIGITALIZADO
  ,INDEXADO
  ,CAPTURADO
  ,VERIFICADO
  ,LIBERADO
  ,VERIFICADO_ARCHIVO
  ,VERIFICADO_OFICIALIA FROM drcmichoacan.cat_libros limit 10 ;");
        $resul = $resultado->fetch_all();
        return $resul;
        unset($resultado);
    }

    public function muestra_libro($UNICO) { //funcion que calcula el promedio, lo devuelve
        $resultado = $this->query("SELECT UNICO,ACTO  
,JUZGADO
  ,ANO
  ,TOMO
  ,TBIS
  ,ACTA_INICIAL
  ,ACTA_FINAL
  ,DIGITALIZADO
  ,INDEXADO
  ,CAPTURADO
  ,VERIFICADO
  ,LIBERADO
  ,VERIFICADO_ARCHIVO
  ,VERIFICADO_OFICIALIA FROM drcmichoacan.cat_libros WHERE UNICO='{$UNICO}' ;");
        $resul = $resultado->fetch_all();
        $no_filas=$resultado->num_rows;
        if ($no_filas==0)
        {
            return $no_filas;
        }
        else
        {
            return $resul;
        }
        unset($resultado);
    }

    public function muestra_libropordatos($ACTO, $JUZGADO, $ANO, $TOMO, $TBIS) { //funcion que calcula el promedio, lo devuelve
      $condicion="";
         if ($TOMO > 0)
        {
            $condicion=$condicion." and TOMO={$TOMO}";
        }
        if ($ANO <> 0)
        {
            $condicion=$condicion." and ANO={$ANO}";
        }
        if ($TBIS <> 0)
        {
            $condicion=$condicion." and TBIS={$TBIS}";
        }       
       


           $sql = "SELECT ID_LIBRO,ACTO  
,JUZGADO
  ,ANO
  ,TOMO
  ,TBIS
  ,ACTA_INICIAL
  ,ACTA_FINAL
  ,DIGITALIZADO
  ,INDEXADO
  ,CAPTURADO
  ,VERIFICADO
  ,LIBERADO
  ,VERIFICADO_ARCHIVO
  ,VERIFICADO_OFICIALIA FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' {$condicion} ;";
        
        $resultado = $this->query($sql);
        $resul = $resultado->fetch_all();
        $no_filas=$resultado->num_rows;
        if ($no_filas==0)
        {
            return $no_filas;
        }
        else
        {
            return $resul;
        }
        unset($resultado);
    }
    public function gestiona_libropordatos($ACTO, $JUZGADO, $ANO1,$ANO2, $ETAPA) { //funcion que calcula el promedio, lo devuelve
      
        echo "LLEGA A LA FUNCION".$ETAPA;
       
//
//
//            $sql = "SELECT UNICO,ACTO  
//,JUZGADO
//  ,ANO
//  ,TOMO
//  ,TBIS
//  ,ACTA_INICIAL
//  ,ACTA_FINAL
//  ,DIGITALIZADO
//  ,INDEXADO
//  ,CAPTURADO
//  ,VERIFICADO
//  ,LIBERADO
//  ,VERIFICADO_ARCHIVO
//  ,VERIFICADO_OFICIALIA FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' {$condicion} ;";
//        
//        $resultado = $this->query($sql);
//        $resul = $resultado->fetch_all();
//        $no_filas=$resultado->num_rows;
//        if ($no_filas==0)
//        {
//            return $no_filas;
//        }
//        else
//        {
//            return $resul;
//        }
//        unset($resultado);
    }
    public function __destruct() {
        unset($this);
    }

}
