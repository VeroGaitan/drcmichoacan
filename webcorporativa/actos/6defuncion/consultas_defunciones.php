<?php
require_once 'datos_defuncion.php';
$action = filter_input(INPUT_POST,'ACTION');

if($action=="1"){//FILTRO DE ENTIDAD FEDERATIVA QUE DEEPENDE DEL PAIS
    $defuncion = new datos_defuncion();
    $entidad_federativa=$defuncion->filtrar_entidadesFed(filter_input(INPUT_POST,'ID_PAIS')); 
    //print_r($entidad_federativa);
         echo "<option value='0'>========</option>";
        foreach ($entidad_federativa as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";  
}
if($action=="2"){//FILTRO DE MUNICIPIOS QUE DEPENDEN DE LA ENTIDAD FEDERATIVA
//echo filter_input(INPUT_POST,'ID_ESTADO');
    $defuncion = new datos_defuncion();
    $municipios=$defuncion->filtrar_municipios(filter_input(INPUT_POST,'ID_ESTADO')); 
    //print_r($municipios);
         echo "<option value='0'>========</option>";
        foreach ($municipios as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";  
}
else if($action=="3"){//FILTRO DE ENTIDAD FEDERATIVA QUE DEEPENDE DEL PAIS
    $defuncion = new datos_defuncion();
    $localidades=$defuncion->filtrar_localidades(filter_input(INPUT_POST,'ID_MUNICIPIO'),filter_input(INPUT_POST,'ID_ESTADO')); 
    //print_r($entidad_federativa);
         echo "<option value='0'>========</option>";
        foreach ($localidades as $item){            
            echo "<option value='$item[0]'>{$item[1]}</option>";
        }echo "<option value='00'>OTRO</option>";  
}

else if($action=="4"){//GUARDA LOS DATOS DE LAS DEFUNCIONES.
    $defuncion = new datos_defuncion();
    $insert=$defuncion->insertar_defunciones(
                            trim(filter_input(INPUT_POST,'libro')),
                            trim(filter_input(INPUT_POST,'cuadernillo')),
                            trim(filter_input(INPUT_POST,'tomo')),
                            trim(filter_input(INPUT_POST,'tomoBis')),
                            trim(filter_input(INPUT_POST,'oficialia')),
                            trim(filter_input(INPUT_POST,'noActa')),                            
                            trim(filter_input(INPUT_POST,'actaBis')),
                            trim(filter_input(INPUT_POST,'anoReg')),
                            trim(filter_input(INPUT_POST,'estadoReg')),
                            trim(filter_input(INPUT_POST,'municipioReg')),
                            trim(filter_input(INPUT_POST,'cadena')),
            
                            trim(filter_input(INPUT_POST,'fechaReg')),
                            trim(filter_input(INPUT_POST,'crip')),
                            trim(filter_input(INPUT_POST,'curp')),
                            trim(filter_input(INPUT_POST,'nombres')),
                            trim(filter_input(INPUT_POST,'primer_apellido')),
                            trim(filter_input(INPUT_POST,'segundo_apellido')),
                            trim(filter_input(INPUT_POST,'sexo')),
                            trim(filter_input(INPUT_POST,'fechaNac')),
                            trim(filter_input(INPUT_POST,'edad')),
                            trim(filter_input(INPUT_POST,'tiempo_edad')),
                            trim(filter_input(INPUT_POST,'otra_edad')),
                            trim(filter_input(INPUT_POST,'id_pais')),
                            trim(filter_input(INPUT_POST,'id_estado')),
                            trim(filter_input(INPUT_POST,'des_estado_nacimiento')),
                            trim(filter_input(INPUT_POST,'id_municipio')),
                            trim(filter_input(INPUT_POST,'des_municipio_nacimiento')),
                            trim(filter_input(INPUT_POST,'id_localidad')),
                            trim(filter_input(INPUT_POST,'des_localidad_nacimiento')),
                            trim(filter_input(INPUT_POST,'edo_civil_difunto')),
                            trim(filter_input(INPUT_POST,'nacionalidad_difunto')),
                            trim(filter_input(INPUT_POST,'nombres_conyugue')),
                            trim(filter_input(INPUT_POST,'primer_apellido_conyugue')),
                            trim(filter_input(INPUT_POST,'segundo_apellido_conyugue')),
                            trim(filter_input(INPUT_POST,'finadoCony')),
                            trim(filter_input(INPUT_POST,'nacionalidad_conyugue')),
                            trim(filter_input(INPUT_POST,'nombres_padre')),
                            trim(filter_input(INPUT_POST,'primer_apellido_padre')),
                            trim(filter_input(INPUT_POST,'segundo_apellido_padre')),
                            trim(filter_input(INPUT_POST,'finadoPadre')),
                            trim(filter_input(INPUT_POST,'nacionalidad_padre')),
                            trim(filter_input(INPUT_POST,'nombres_madre')),
                            trim(filter_input(INPUT_POST,'primer_apellido_madre')),
                            trim(filter_input(INPUT_POST,'segundo_apellido_madre')),
                            trim(filter_input(INPUT_POST,'finadoMadre')),
                            trim(filter_input(INPUT_POST,'nacionalidad_madre')),
                            trim(filter_input(INPUT_POST,'fechaDefuncion')),
                            trim(filter_input(INPUT_POST,'hrDefuncion')),
                            trim(filter_input(INPUT_POST,'minDefuncion')),
                            trim(filter_input(INPUT_POST,'causa')),
                            trim(filter_input(INPUT_POST,'lugar')),
                            trim(filter_input(INPUT_POST,'noCertificado')),
                            trim(filter_input(INPUT_POST,'nombre_medico')),
                            trim(filter_input(INPUT_POST,'cedula')),
                            trim(filter_input(INPUT_POST,'nota_acta')),
                            trim(filter_input(INPUT_POST,'notaMarginal')),
                            trim(filter_input(INPUT_POST,'estado_certificado')) 
                            );      
 }
 else if($action=="5"){//GUARDA LOS DATOS DE LAS DEFUNCIONES DE TIPO INSCRIPCION.
    $defuncion = new datos_defuncion();
    $insert=$defuncion->insertar_defunciones_ins(
                            trim(filter_input(INPUT_POST,'libro')),
                            trim(filter_input(INPUT_POST,'tomo')),
                            trim(filter_input(INPUT_POST,'tomoBis')),
                            trim(filter_input(INPUT_POST,'oficialia')),
                            trim(filter_input(INPUT_POST,'noActa')),
                            trim(filter_input(INPUT_POST,'actaBis')),
                            trim(filter_input(INPUT_POST,'anoReg')),
                            trim(filter_input(INPUT_POST,'estadoReg')),
                            trim(filter_input(INPUT_POST,'municipioReg')),
                            trim(filter_input(INPUT_POST,'cadena')),
                            trim(filter_input(INPUT_POST,'fechaReg')),            
                            trim(filter_input(INPUT_POST,'nombres')),
                            trim(filter_input(INPUT_POST,'primer_apellido')),
                            trim(filter_input(INPUT_POST,'segundo_apellido')),
                            trim(filter_input(INPUT_POST,'sexo')),
                            trim(filter_input(INPUT_POST,'fechaNac')),
                            trim(filter_input(INPUT_POST,'edad')),
                            trim(filter_input(INPUT_POST,'tiempo_edad')),
                            trim(filter_input(INPUT_POST,'otraEdad')),
                            trim(filter_input(INPUT_POST,'id_pais')),            
                            trim(filter_input(INPUT_POST,'fechaDefuncion')),                                         
                            trim(filter_input(INPUT_POST,'compareciente')),
                            trim(filter_input(INPUT_POST,'transcripcion')),
                            trim(filter_input(INPUT_POST,'notas')),  
                            trim(filter_input(INPUT_POST,'notaMarginal')),
                            trim(filter_input(INPUT_POST,'estado_certificado'))
                         );      
 }
?>
