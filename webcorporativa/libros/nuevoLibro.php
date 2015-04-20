
        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>  
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">

<?PHP
//CODIGO PARA DATOS DE REGISTRO
//DATOS DE LA OFICIALIA
require '../../class/catalogos.class.php';
$datos_registro = new catalogos(); //Usa la clase
$combooficialias = $datos_registro->cat_oficialias();
$combootomos = $datos_registro->cat_tomos();
$combooanos = $datos_registro->cat_anos();
$combooactos = $datos_registro->cat_actos();
$combootomobis = $datos_registro->cat_tbis();
$comboomes = $datos_registro->cat_meses();
//unset($datos_registro);
//print_r($datos_registro);
?>
    <div class="container">
        <form role="form" id="newBook" name="newBook">
            <div class="row">

                <div class="col-md-3">
                    <div class="ui-widget">

                        <select style="width: 80%" id="comboboxacto" name="comboboxacto" required="" class="acto" >
                            <option value="">========</option>
                            <?php
                            foreach ($combooactos as $item) {
                                ?>
                                <option value="<?php echo $item['0']; ?>"> <?php echo $item[0] . " " . $item[1]; ?> </option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>ACTO </label>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="ui-widget">

                        <select id="comboboxoficialia" style="width:90%" required="" >

                            <option value="0">ESCRIBE O SELECCIONA UNA OFICIALIA</option>
                            <?php
                            foreach ($combooficialias as $item) {
                                ?>
                                <option value="<?php echo $item[0] ?>"><?php echo $item[0] . " " . $item[1] . " " . $item[2]; ?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                        <label>MUNICIPIO OFICIALIA</label>

                    </div>
                </div>
                <div class="col-md-1">
                <div class="ui-widget">
                    <select style="width: 55%"   id="comboboxanos" required="">

                        <option value="0">==</option>
                        <?php
                        foreach ($combooanos as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>A&Ncaron;O: </label>
                </div>
                </div>
                <div class="col-md-1">
                     <div class="ui-widget">
                    <select style="width: 50%" id="comboboxtomos" required="" >
                        <option value="0">==</option>
                        <?php
                        foreach ($combootomos as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                     </div>
                    <label>TOMO: </label>
                </div>
                <div class="col-md-2">
                     <div class="ui-widget">
                    <select style="width: 70%"   id="comboboxtbis" >
                       
                            <?php
                            foreach ($combootomobis as $item) {
                                ?>
                                <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                <?php
                            }
                            ?>
                    </select>
                    <label>TBIS: </label>
                </div>
                </div>
            </div>
            <div class="row">                
                <div class="col-md-2">
                    <div class="form-group">

                        <input type="text" class="form-control" id="ACTA_INICIAL" 
                               placeholder="INICIAL">
                        <label for="ACTA_INICIAL">ACTA INICIAL</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">

                        <input type="text" class="form-control" id="ACTA_FINAL" 
                               placeholder="FINAL">
                        <label for="ACTA_FINAL">ACTA FINAL</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">

                        <input type="text" class="form-control" id="FOJAS" 
                               placeholder="FOJAS" required="">
                        <label for="FOJAS">FOJAS</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <select style="width:75%" id="MES_FINAL" >             
                        <?php
                        foreach ($comboomes as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>MES FINAL </label>

                </div>
                <div class="col-md-4"><div class="radio">
                        <label>
                            <input class="form-group" id="encuadernado" type="checkbox">ENCUADERNADO
                        </label>
                        <label>
                            <input id="verificado_archivo" type="checkbox">VERIFICADO EN ARCHIVO
                        </label>
                    </div>
                </div>

            </div>




            <div class="row hidden">


                <div class="col-md-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea1" value="opcion_1">VERIFICADO EN OFICIALIA
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea1" value="opcion_1">DIGITALIZADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea2" value="opcion_2"> INDEXADO
                    </label>
                    <img src="" alt=""/>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> CAPTURADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> VERIFICADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> LIBERADO
                    </label>

                </div>  
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="hidden" class="form-control" id="ACTION" 
                           value="1"></div>
                <div class="col-md-4 "><button  id="submitForm" type="button"   ><span class="glyphicon glyphicon-floppy-save"></span> GUARDAR</button></div>

            </div>

        </form>

        <script type="text/javascript">
            $("#submitForm").click(function() {
//alert($(".acto").val());
                $.ajax({
                    type: "POST",
                    url: "webcorporativa/libros/caseLibro.php",
                    data: {
                    ACTION: "1",
                    ACTO: $(".acto").val(),
                    JUZGADO: $("#comboboxoficialia").val(),
                    ANO: $("#comboboxanos").val(),
                    TOMO: $("#comboboxtomos").val(),
                    TBIS: $("#comboboxtbis").val(),
                    ACTA_INICIAL: $("#ACTA_INICIAL").val(),
                    ACTA_FINAL: $("#ACTA_FINAL").val(),
                    FOJAS: $("#FOJAS").val(),
                    MES_FINAL: $("#MES_FINAL").val(),
                    ENCUADERNADO: $("#encuadernado").val(),
                    VERIFICADO_ARCHIVO: $("#verificado_archivo").val()
                          
            },
            
                    timeout: 28000,
                    error: function(data) {
                    //alert(data);

                    $("#resultSearch").html(data);
   
//                        $('<div id="dialog" title="ALERTA"><p><span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>Al parecer algo salio mal, intentalo nuevamente o llama a nuestra linea de actas foraneas 555-555-55-55<p></div>').dialog({
//                            modal: true,
//                            buttons: {Ok: function() {
//                                    $(this).dialog("close");
//                                    $(this).remove();
//                                }}
//                        });
                    },
                    success: function(data) {
                        //alert(data);
                        $("#resultSearch").html(data);
                        $("button").button();
                  
                    }
                });//ENd ajax
            });


        </script>

        <div id="resultSearch"></div>

    </div><!--END DIV CONTAINER-->















