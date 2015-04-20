<?php
/* 
    Author: Brenda Ortiz
*/
require 'capturaNacimientos.class.php';
//require '../../../class/catalogos.class.php';
$action=filter_input(INPUT_POST,'ACTION');
/*
if($action=="1"){//FILTRO DE ENTIDAD FEDERATIVA QUE DEEPENDE DEL PAIS
    $catalogo = new catalogos();
    $entidad_federativa=$catalogo->filtrar_entidadesFed(filter_input(INPUT_POST,'ID_PAIS')); 
    //print_r($entidad_federativa);
        echo "<option value='0'>========</option>";
        foreach ($entidad_federativa as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";  
}
if($action==="2"){//FILTRO DE MUNICIPIOS QUE DEPENDE DEL ESTADO(ENTIDAD FED)
    $catalogo = new catalogos();
    $municipios=$catalogo->filtrar_municipios(filter_input(INPUT_POST,'ID_ESTADO')); 
    //print_r($municipios);
        echo "<option value='0'>========</option>";
        foreach ($municipios as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";     
}

if($action==="3"){////FILTRO DE LOCALIDADES QUE DEPENDE DE EL MUNICIPIO Y DEL ESTADO(ENTIDAD FED)
    $catalogo = new catalogos();
    $localidades=$catalogo->filtrar_localidades(filter_input(INPUT_POST,'ID_MUNICIPIO'),filter_input(INPUT_POST,'ID_ESTADO')); 
    //print_r($localidades);
        echo "<option value='0'>========</option>";
        foreach ($localidades as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";      
}*/

if($action==="4"){//CAPTURA NACIMIENTO
    
   /*
    echo "consultasCapturaNacimientos.php//ACTA: ".filter_input(INPUT_POST,'ACTA')
            ." \n CUADERNILLO: ".filter_input(INPUT_POST,'CUADERNILLO')
            ." \n FECHA_REGISTRO: ".filter_input(INPUT_POST,'FECHA_REGISTRO')
            ." \n PRIMER_APELLIDO: ".filter_input(INPUT_POST,'PRIMER_APELLIDO')
            ." \n SEGUNDO_APELLIDO: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO')
            ." \n NOMBRE: ".filter_input(INPUT_POST,'NOMBRE')
            ." \n FECHA_NACIMIENTO: ".filter_input(INPUT_POST,'FECHA_NACIMIENTO')
            ." \n HORA_NACIMIENTO: ".filter_input(INPUT_POST,'HORA_NACIMIENTO')
            ." \n PAIS_NACIMIENTO: ".filter_input(INPUT_POST,'ID_PAIS') 
            ." \n ID_ESTADO: ".filter_input(INPUT_POST,'ID_ESTADO')
            ." \n ESTADO_NACIMIENTO: ".filter_input(INPUT_POST,'ESTADO_NACIMIENTO')    
            ." \n ID_MUNICIPIO: ".filter_input(INPUT_POST,'ID_MUNICIPIO')
            ." \n MUNICIPIO_NACIMIENTO: ".filter_input(INPUT_POST,'MUNICIPIO_NACIMIENTO')
            ." \n ID_LOCALIDAD: ".filter_input(INPUT_POST,'ID_LOCALIDAD')
            ." \n LOCALIDAD_NACIMIENTO: ".filter_input(INPUT_POST,'LOCALIDAD_NACIMIENTO')     
            ." \n SEXO: ".filter_input(INPUT_POST,'SEXO')
            ." \n STATUS_REGISTRO: ".filter_input(INPUT_POST,'STATUS_REGISTRO')
            ." \n COMPARECIO: ".filter_input(INPUT_POST,'COMPARECIO')
            ." \n PRIMER_APELLIDO_PADRE: ".filter_input(INPUT_POST,'PRIMER_APELLIDO_PADRE')
            ." \n SEGUNDO_APELLIDO_PADRE: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO_PADRE')
            ." \n NOMBRE_PADRE: ".filter_input(INPUT_POST,'NOMBRE_PADRE')
            ." \n EDAD_PADRE: ".filter_input(INPUT_POST,'EDAD_PADRE')
            ." \n NACIONALIDAD_PADRE: ".filter_input(INPUT_POST,'NACIONALIDAD_PADRE')
            ." \n PRIMER_APELLIDO_MADRE: ".filter_input(INPUT_POST,'PRIMER_APELLIDO_MADRE')
            ." \n SEGUNDO_APELLIDO_MADRE: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO_MADRE')
            ." \n NOMBRE_MADRE: ".filter_input(INPUT_POST,'NOMBRE_MADRE')
            ." \n EDAD_MADRE: ".filter_input(INPUT_POST,'EDAD_MADRE')
            ." \n NACIONALIDAD_MADRE: ".filter_input(INPUT_POST,'NACIONALIDAD_MADRE')
            ." \n NOTA_ACTA: ".filter_input(INPUT_POST,'NOTA_ACTA')
            ." \n NOTA_MARGINAL: ".filter_input(INPUT_POST,'NOTA_MARGINAL');   
    
       */
    
    $catalogo = new capturaNacimientos();
    $result=$catalogo->capturaActaNacimiento(
            filter_input(INPUT_POST,'CUADERNILLO'),
            filter_input(INPUT_POST,'ACTA'),
            filter_input(INPUT_POST,'FECHA_REGISTRO'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO'),
            filter_input(INPUT_POST,'NOMBRE'),
            filter_input(INPUT_POST,'FECHA_NACIMIENTO'),
            filter_input(INPUT_POST,'HORA_NACIMIENTO'),
            filter_input(INPUT_POST,'ID_PAIS'),            
            filter_input(INPUT_POST,'ID_ESTADO'),
            filter_input(INPUT_POST,'ESTADO_NACIMIENTO'),            
            filter_input(INPUT_POST,'ID_MUNICIPIO'),
            filter_input(INPUT_POST,'MUNICIPIO_NACIMIENTO'),            
            filter_input(INPUT_POST,'ID_LOCALIDAD'),
            filter_input(INPUT_POST,'LOCALIDAD_NACIMIENTO'),            
            filter_input(INPUT_POST,'SEXO'),
            filter_input(INPUT_POST,'STATUS_REGISTRO'),
            filter_input(INPUT_POST,'COMPARECIO'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO_PADRE'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO_PADRE'),
            filter_input(INPUT_POST,'NOMBRE_PADRE'),
            filter_input(INPUT_POST,'EDAD_PADRE'),
            filter_input(INPUT_POST,'NACIONALIDAD_PADRE'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO_MADRE'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO_MADRE'),
            filter_input(INPUT_POST,'NOMBRE_MADRE'),
            filter_input(INPUT_POST,'EDAD_MADRE'),
            filter_input(INPUT_POST,'NACIONALIDAD_MADRE'),
            filter_input(INPUT_POST,'NOTA_ACTA'),
            filter_input(INPUT_POST,'NOTA_MARGINAL')); 
   
    
  
}

if($action==="5"){//CAPTURA INSCRIPCION
    
   /*
    echo "consultasCapturaNacimientos.php//ACTA: ".filter_input(INPUT_POST,'ACTA')
            ." \n FECHA_REGISTRO: ".filter_input(INPUT_POST,'FECHA_REGISTRO')
            ." \n PRIMER_APELLIDO: ".filter_input(INPUT_POST,'PRIMER_APELLIDO')
            ." \n SEGUNDO_APELLIDO: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO')
            ." \n NOMBRE: ".filter_input(INPUT_POST,'NOMBRE')
            ." \n FECHA_NACIMIENTO: ".filter_input(INPUT_POST,'FECHA_NACIMIENTO')
            ." \n HORA_NACIMIENTO: ".filter_input(INPUT_POST,'HORA_NACIMIENTO')          
            ." \n SEXO: ".filter_input(INPUT_POST,'SEXO')
            ." \n STATUS_REGISTRO: ".filter_input(INPUT_POST,'STATUS_REGISTRO')
            ." \n COMPARECIO: ".filter_input(INPUT_POST,'COMPARECIO')
            ." \n PRIMER_APELLIDO_PADRE: ".filter_input(INPUT_POST,'PRIMER_APELLIDO_PADRE')
            ." \n SEGUNDO_APELLIDO_PADRE: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO_PADRE')
            ." \n NOMBRE_PADRE: ".filter_input(INPUT_POST,'NOMBRE_PADRE')
            ." \n EDAD_PADRE: ".filter_input(INPUT_POST,'EDAD_PADRE')
            ." \n NACIONALIDAD_PADRE: ".filter_input(INPUT_POST,'NACIONALIDAD_PADRE')
            ." \n PRIMER_APELLIDO_MADRE: ".filter_input(INPUT_POST,'PRIMER_APELLIDO_MADRE')
            ." \n SEGUNDO_APELLIDO_MADRE: ".filter_input(INPUT_POST,'SEGUNDO_APELLIDO_MADRE')
            ." \n NOMBRE_MADRE: ".filter_input(INPUT_POST,'NOMBRE_MADRE')
            ." \n EDAD_MADRE: ".filter_input(INPUT_POST,'EDAD_MADRE')
            ." \n NACIONALIDAD_MADRE: ".filter_input(INPUT_POST,'NACIONALIDAD_MADRE')
            ." \n NOTA_ACTA_INSCRIPCION: ".filter_input(INPUT_POST,'NOTA_ACTA_INSCRIPCION')
            ." \n NOTA_MARGINAL: ".filter_input(INPUT_POST,'NOTA_MARGINAL');   
        */
    
    $catalogo = new capturaNacimientos();
    $result=$catalogo->capturaInscripcionNacimiento(
            filter_input(INPUT_POST,'ACTA'),
            filter_input(INPUT_POST,'FECHA_REGISTRO'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO'),
            filter_input(INPUT_POST,'NOMBRE'),
            filter_input(INPUT_POST,'FECHA_NACIMIENTO'),
            filter_input(INPUT_POST,'HORA_NACIMIENTO'),            
            filter_input(INPUT_POST,'SEXO'),
            filter_input(INPUT_POST,'STATUS_REGISTRO'),
            filter_input(INPUT_POST,'COMPARECIO'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO_PADRE'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO_PADRE'),
            filter_input(INPUT_POST,'NOMBRE_PADRE'),
            filter_input(INPUT_POST,'EDAD_PADRE'),
            filter_input(INPUT_POST,'NACIONALIDAD_PADRE'),
            filter_input(INPUT_POST,'PRIMER_APELLIDO_MADRE'),
            filter_input(INPUT_POST,'SEGUNDO_APELLIDO_MADRE'),
            filter_input(INPUT_POST,'NOMBRE_MADRE'),
            filter_input(INPUT_POST,'EDAD_MADRE'),
            filter_input(INPUT_POST,'NACIONALIDAD_MADRE'),
            filter_input(INPUT_POST,'NOTA_ACTA_INSCRIPCION'),
            filter_input(INPUT_POST,'NOTA_MARGINAL'));
            
}

?>