<?php
/* 
    Author: Brenda Ortiz
*/
require 'catalogos.class.php';
$action=filter_input(INPUT_POST,'ACTION');

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
}

?>