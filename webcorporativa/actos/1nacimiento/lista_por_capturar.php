<?php
ECHO "brenda";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../../../class/mysqli.class.php';
$libro = new conexionmysqli("server151");
if (filter_input(INPUT_POST, "funct") == NULL) {
    require_once '../../../class/datos_registro.php';
    $datos_registro = new datos_registro();
    $combooficialias = $datos_registro->cat_oficialias();
    $combootomos = $datos_registro->cat_tomos();
    $combooanos = $datos_registro->cat_anos();
    $combooactos = $datos_registro->cat_actos();
    $combootomobis = $datos_registro->cat_tbis();
    ?>
    <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script> 
    <script type="text/javascript" src="js/validateForm.js"></script>
    <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
    <link type="text/css" rel="stylesheet" href="css/validateForm.css" media="screen">
    <div class="alert alert-danger" style="text-align: left"><b>*CAMPOS OBLIGATORIOS</b></div>
    <form role="form" class="form-horizontal" id="frmSearchBook"> 
        <div class="form-group" style="text-align: left">
            <label class="col-sm-4 control-label">*ACTO</label>
            <div class="col-sm-8">
                <select style="width: 300px;" id="acto-notnull" class="comboboxAutocomplete" name="acto">
                    <option value=""></option>
                    <?php
                    foreach ($combooactos as $item) {
                        ?>
                        <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-4 control-label">*MUNICIPIO (OFICIALIA)</label>
            <div class="col-sm-8">
                <select style="width: 300px" id="oficialia-notnull" class="comboboxAutocomplete" name="juzgado">
                    <option value=""></option>
                    <?php
                    foreach ($combooficialias as $item) {
                        ?>
                        <option value="<?php echo $item[0] ?>"><?php echo $item[0] . " " . $item[1] . " " . $item[2]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">*AÑO</label>
            <div class="col-sm-8">
                <select style="width: 300px" id="anio-notnull" class="comboboxAutocomplete" name="anio">
                    <option value=""></option>
                    <?php
                    foreach ($combooanos as $item) {
                        ?>
                        <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">*TOMO</label>
            <div class="col-sm-8">
                <select style="width: 300px" id="tomo-notnull" class="comboboxAutocomplete" name="tomo">
                    <option value=""></option>
                    <?php
                    foreach ($combootomos as $item) {
                        ?>
                        <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">*TBIS</label>
            <div class="col-sm-8">
                <select style="width: 300px" id="tbis-notnull" class="comboboxAutocomplete" name="tbis" >
                    <option value=""></option>
                    <?php
                    foreach ($combootomobis as $item) {
                        ?>
                        <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>
    <script>
    $("#acto-notnull").change(function(){
        console.log("asd");
    });   
    $(".comboboxAutocomplete").combobox()</script>
    <?php
} elseif (filter_input(INPUT_POST, "funct") == "search") {
    $ACTO = filter_input(INPUT_POST, "acto");
    $JUZGADO = filter_input(INPUT_POST, "juzgado");
    $ANIO = filter_input(INPUT_POST, "anio");
    $TOMO = filter_input(INPUT_POST, "tomo");
    $TBIS = filter_input(INPUT_POST, "tbis");
    $sql = "SELECT * FROM drcmichoacan.cat_libros WHERE ACTO='{$ACTO}' AND JUZGADO='{$JUZGADO}' AND ANO='{$ANIO}' AND TOMO='{$TOMO}' AND TBIS='{$TBIS}';";
    $query = $libro->query($sql);
    $result = $query->fetch_assoc();
    if ($result == null) {
        echo json_encode(array("search" => "fail", "ACTO" => filter_input(INPUT_POST, "acto"), "JUZGADO" => filter_input(INPUT_POST, "juzgado"), "ANO" => filter_input(INPUT_POST, "anio"), "TOMO" => filter_input(INPUT_POST, "tomo"), "TBIS" => filter_input(INPUT_POST, "tbis")));
    } else {
        echo json_encode($result);
    }
} elseif (filter_input(INPUT_POST, "funct") == "registrarLibro") {
    $JM = explode("-", filter_input(INPUT_POST, "juzgado"));
    $ACTO = filter_input(INPUT_POST, "acto");
    $JUZGADO = filter_input(INPUT_POST, "juzgado");
    $ANIO = filter_input(INPUT_POST, "anio");
    $TOMO = str_pad(filter_input(INPUT_POST, "tomo"), 3, "0", STR_PAD_LEFT);
    $TBIS = filter_input(INPUT_POST, "tbis");
    $ACTA_INICIAL = filter_input(INPUT_POST, "actInicial");
    $ACTA_FINAL = filter_input(INPUT_POST, "actFinal");
    $R = "Z:/" . $ACTO . "/16/" . $JM[0] . "/" . $JM[1] . "/" . $ANIO . "/" . $TOMO . "/" . $TBIS;
    $U = $ACTO . $JM[0] . $JM[1] . $ANIO . $TOMO . $TBIS;
    $sqlInsert = "INSERT INTO drcmichoacan.cat_libros (
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
        ) VALUES (
        {$U}
        ,{$ACTO}
        ,'{$JUZGADO}' 
        ,{$JM[0]}
        ,{$JM[1]} 
        ,{$ANIO}
        ,{$TOMO} 
        ,{$TBIS} 
        ,$ACTA_INICIAL
        ,$ACTA_FINAL
        ,($ACTA_FINAL-$ACTA_INICIAL+1)
        ,'{$R}'
        ,CURDATE() 
        ,CURDATE() 
        );";
    if ($registro = $libro->query($sqlInsert)) {
        echo json_encode(array("R" => $R, "success" => "true", "sqlsss" => $sqlInsert));
    } else {
        echo json_encode(array("success" => "false"));
    }
}
$libro->close();


