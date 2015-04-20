
<!--<html lang="en">
    <head>


        <meta charset="utf-8">

        <title>DRC-Gesti&oacute;n de Libros </title>-->

<!--           <script type="text/javascript" src="../../js/jquery-1.11.2.min.js"></script>

<!--
        
                                                                             <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>-->
		<script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
<!--        <link rel="stylesheet" href="../../css/thems/jquery-ui.min.css">
-->      
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
         <script type="text/javascript" src="js/TinyTableV3.js"></script>
          
        <link rel="stylesheet" href="css/TinyTableV3.css">
<!--      


</head>
<body>-->
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
unset($datos_registro);
//print_r($combooficialias);
?>
    <div class="container">
        <form role="form" id="newBook" name="newBook">
            <div class="row">

                <div class="col-md-2">
                    <div class="ui-widget">

                        <select style="width: 80%" id="comboboxacto" required="" >
                            <option value="">========</option>
                            <?php
                            foreach ($combooactos as $item) {
                                ?>
                                <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>ACTO </label>
                    </div>
                </div>

                <div class="col-md-4">
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
                        </select>
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
                    <label>A&Ncaron;O INICIAL: </label>
                </div>
                </div>
                <div class="col-md-1">
<div class="ui-widget">
                    <select style="width: 55%"   id="comboboxanos2" required="">

                        <option value="0">==</option>
                        <?php
                        foreach ($combooanos as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>A&Ncaron;O FINAL: </label>
                </div>
                </div>
                <div class="col-md-4">
                     <div class="ui-widget">
                    <select style="width: 70%"   id="etapas" >
                        <option value="1">DIGITALIZAR</option>
                         <option value="2">CAPTURAR</option>
                         <option value="3">VERIFICAR Y LIBERAR</option>
                          <option value="4">TERMINADOS</option>
                    </select>
                    <label>TBIS: </label>
                </div>
                </div>
            </div>
        



       
            <div class="row">
                <div class="col-md-8">
                    <input type="hidden" class="form-control" id="ACTION" 
                           value="1"></div>
                <div class="col-md-4 "><button  id="submitForm" type="button"   ><span class="glyphicon glyphicon-floppy-open"></span>BUSCAR</button></div>

            </div>




        </form>
        <script type="text/javascript">
            $("#submitForm").click(function() {
                     $.ajax({
                    type: "POST",
                    url: "webcorporativa/libros/listaLibros.php",
                    data: {ACTION:"2",ACTO:$("#comboboxacto").val(),JUZGADO:$("#comboboxoficialia").val(),
                    ANO1:$("#comboboxanos").val(),               
                    ANO2:$("#comboboxanos2").val(),
                    ETAPA:$("#etapas").val()
                         
            },
            
                    timeout: 28000,
                    error: function(data) {
                       

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
                 
                        $("#resultSearch").html(data);
                        $("button").button();
                  
                    }
                                 });
            });
        </script>

        <div id="resultSearch"></div>




    </div>

















<!--


</body>
</html>
-->
