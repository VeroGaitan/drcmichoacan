<?php
require '../../class/libros.class.php';
//echo filter_input(INPUT_POST, 'ACTO');
switch (filter_input(INPUT_POST, 'ACTION')) {
     case "1":
        $clase = new libros();
        
        $clase->insert_libro(filter_input(INPUT_POST, 'ACTO'),filter_input(INPUT_POST, 'JUZGADO'), substr(filter_input(INPUT_POST, 'JUZGADO'), 0, 3),substr(filter_input(INPUT_POST, 'JUZGADO'), 4, 2),filter_input(INPUT_POST, 'ANO'), str_pad(filter_input(INPUT_POST, 'TOMO'), 3, "0", STR_PAD_LEFT), str_pad(filter_input(INPUT_POST, 'TBIS'), 2, "0", STR_PAD_LEFT), filter_input(INPUT_POST, 'ACTA_INICIAL'), filter_input(INPUT_POST, 'ACTA_FINAL'), filter_input(INPUT_POST, 'MES_FINAL'),filter_input(INPUT_POST, 'ENCUADERNADO'), filter_input(INPUT_POST, 'VERIFICADO_ARCHIVO'), filter_input(INPUT_POST, 'VERIFICADO_OFICIALIA'), filter_input(INPUT_POST, 'DIGITALIZADO'), filter_input(INPUT_POST, 'INDEXADO'), filter_input(INPUT_POST, 'CAPTURADO'), filter_input(INPUT_POST, 'VERIFICADO'), filter_input(INPUT_POST, 'LIBERADO'));
        unset($clase);
        break;
     case "2":
        echo "Entra a Case 2";
        $clase = new libros();
        $Listalibros=$clase->muestra_libro(filter_input(INPUT_POST, 'UNICO'));
        unset($clase);
        print_r($Listalibros);
        return $Listalibros;
        break;		
     case "3":
	    //echo "Entra a Case 3 para hacer UPDATE de los datos en el catalogo de libros";
        $clase = new libros();	
        //echo filter_input(INPUT_POST, 'FOJAS');
        $clase->update_libro(filter_input(INPUT_POST, 'ID_LIBRO'),filter_input(INPUT_POST, 'ACTO'),filter_input(INPUT_POST, 'JUZGADO'), substr(filter_input(INPUT_POST, 'JUZGADO'), 0, 3),substr(filter_input(INPUT_POST, 'JUZGADO'), 4, 2),filter_input(INPUT_POST, 'ANO'), str_pad(filter_input(INPUT_POST, 'TOMO'), 3, "0", STR_PAD_LEFT), str_pad(filter_input(INPUT_POST, 'TBIS'), 2, "0", STR_PAD_LEFT), filter_input(INPUT_POST, 'ACTA_INICIAL'), filter_input(INPUT_POST, 'ACTA_FINAL'), filter_input(INPUT_POST, 'FOJAS'),filter_input(INPUT_POST, 'MES_FINAL'), filter_input(INPUT_POST, 'ENCUADERNADO'), filter_input(INPUT_POST, 'DIGITALIZADO'), filter_input(INPUT_POST, 'INDEXADO'), filter_input(INPUT_POST, 'CAPTURADO'),  filter_input(INPUT_POST, 'VERIFICADO'), filter_input(INPUT_POST, 'LIBERADO'), filter_input(INPUT_POST, 'VERIFICADO_ARCHIVO'), filter_input(INPUT_POST, 'VERIFICADO_OFICIALIA'),filter_input(INPUT_POST, 'NO_LOCALIZADO'),filter_input(INPUT_POST, 'OBSERVACIONES'));
		if($clase){echo '{"estado": "updateExitoso"}';}       
        break;
     default:
        echo "No envia el Dato";
        break;
}
