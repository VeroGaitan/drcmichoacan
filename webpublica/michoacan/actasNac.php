<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'class/conexion.php';
$mysqli->set_charset("utf8");
$consultaNac = file_get_contents("sqlQuery/nacimientoNAC.sql");
$consultaDBO = file_get_contents("sqlQuery/nacimientoDBO.sql");
#se establecen parametros de busqueda
$condicion = NULL;
if (trim(filter_input(INPUT_POST, "municipio")) != "" or trim(filter_input(INPUT_POST, "municipio")) != null) {
    $condicion = $condicion . " and municipio='" . trim(filter_input(INPUT_POST, "municipio")) . "'";
}
if (trim(filter_input(INPUT_POST, "anio")) != "" or trim(filter_input(INPUT_POST, "anio")) != null) {
    $condicion = $condicion . " and right(fregistro,4)='" . trim(filter_input(INPUT_POST, "anio")) . "'";
}
if (filter_input(INPUT_POST, "acta") != "" or filter_input(INPUT_POST, "acta") != null) {
    if (strlen(filter_input(INPUT_POST, "acta")) < 5) {
        $condicion = $condicion . " and  acta=" . filter_input(INPUT_POST, "acta") . "";
    }
}
if (trim(filter_input(INPUT_POST, "nombrep")) != "" or trim(filter_input(INPUT_POST, "nombrep")) != null) {
    $condicion = $condicion . " and   nombre_padre='" . trim(filter_input(INPUT_POST, "nombrep")) . "'";
}
if (trim(filter_input(INPUT_POST, "nombrem")) != "" or trim(filter_input(INPUT_POST, "nombrem")) != null) {
    $condicion = $condicion . " and nombre_madre='" . trim(filter_input(INPUT_POST, "nombrem")) . "'";
}
if (trim(filter_input(INPUT_POST, "tomo")) != "" or trim(filter_input(INPUT_POST, "tomo")) != null) {
    $condicion = $condicion . " and tomo=" . trim(filter_input(INPUT_POST, "tomo"));
}
if (trim(filter_input(INPUT_POST, "amatern")) != "" or trim(filter_input(INPUT_POST, "amatern")) != null) {
    $condicion = $condicion . " AND amatern='" . trim(filter_input(INPUT_POST, "amatern"))."'";
}

#busca el acta solicitada
$acta_ = $mysqli->query($consultaNac . " WHERE nombre='" . trim(filter_input(INPUT_POST, "nombre")) . "' AND apatern='" . trim(filter_input(INPUT_POST, "apatern")) . "' and fnacimiento='" . filter_input(INPUT_POST, "fechanacimiento") . "'" . $condicion);
//verificamos que se encuentre en la primer BD
if ($acta_->num_rows < 1) {
    //si no se encontro en la primer BD, se busca en la segunda.
    $acta_ = $mysqli->query($consultaDBO . " WHERE nombre='" . trim(filter_input(INPUT_POST, "nombre")) . "' AND apatern='" . trim(filter_input(INPUT_POST, "apatern")) . "' and fnacimiento='" . filter_input(INPUT_POST, "fechanacimiento") . "'" . $condicion);
}
$acta = mysqli_fetch_assoc($acta_);
if ($acta != NULL) {
//    var_dump($acta);
#se verifica si el acta ya ha sido agregada al maletin
    $found = FALSE;
    $shopping = isset($_SESSION["shopping"]) ? $_SESSION["shopping"] : NULL;
    if ($shopping != NULL) {
        for ($i = 0; $i < count($shopping); $i++) {
            if (in_array($acta["id_registro"], $shopping[$i]["id_registro"])) {
                $found = TRUE;
                break;
            } else {
                $found = FALSE;
                break;
            }
        }
    }
    ?>
<link href="Watermark/Watermark.css" type="text/css" rel="stylesheet"></link>
    <!-- formulario de verificacion de acta incorrecta-->
    <div id="dialog-datos-verificar" title="DATOS A VERIFICAR">
        <div class="notice">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><b><strong>*</strong>DATOS OBLIGATORIOS.</b></p>
            <p>El acta solicitada: <strong><?php echo $acta["nombre"] . " " . $acta["apatern"] . " " . $acta["amatern"] ?></strong>  con fecha de nacimiento: <strong><?php echo $acta["fnacimiento"] ?></strong> e hijo de: <strong><?php echo $acta["nombre_padre"] . " " . $acta["primer_ap_padre"] . " " . $acta["segundo_ap_padre"] ?></strong> y <strong><?php echo $acta["nombre_madre"] . " " . $acta["primer_ap_madre"] . " " . $acta["segundo_ap_madre"] ?></strong>. sera verificada conforme al acta original del libro correspondiente, en caso de algun error de captura se corregira de inmediato, pero si es un error de origen, se le indicara cual sera el proceso a seguir, para esto es necesario llenar el siguiente formulario con la descripcion del error encontrado</p>
        </div>
        <form id="formVerificar">
            <fieldset>
                <label for="obsCiudadano-notnull"><span class="ui-icon ui-icon-pencil" style="float:left; margin:0 7px 20px 0;"></span><strong>*</strong>DESCRIPCION DE LOS ERRORES ENCONTRADOS EN EL ACTA</label>
                <textarea name="obsCiudadano" id="obsCiudadano-notnull" style="width: 100%; resize: none; height: 70px" class="text ui-widget-content ui-corner-all"></textarea>
                <input type="text" name="nombre" id="name-notnull" value="" class="text ui-widget-content ui-corner-all" placeholder="*NOMBRE" />
                <input type="text" name="correoElectronico" id="correoElectronico-null-checkMail" value="" class="text ui-widget-content ui-corner-all" placeholder="CORREO ELECTRONICO" />
                <input type="text" name="telf" id="telf-notnull-justNumbers" value="" class="text ui-widget-content ui-corner-all" maxlength="10" onkeypress="return IsNumber(event)" onblur="blurNumeric(this)" placeholder="*NUMERO TELEFONICO" />
                <input type="hidden" name="nombre1" value="<?php echo $acta["nombre"] ?>"/>
                <input type="hidden" name="primerApellido1" value="<?php echo $acta["apatern"] ?>"/>
                <input type="hidden" name="segundoApellido1" value="<?php echo $acta["amatern"] ?>"/> 
                <input type="hidden" name="fechaNac" value="<?php echo $acta["fnacimiento"] ?>"/>
                <input type="hidden" name="oficialia" value="<?php echo $acta["oficialia"] ?>" />
                <input type="hidden" name="padre" value="<?php echo $acta["nombre_padre"] . " " . $acta["primer_ap_padre"] . " " . $acta["segundo_ap_padre"] ?>" />
                <input type="hidden" name="madre" value="<?php echo $acta["nombre_madre"] . " " . $acta["primer_ap_madre"] . " " . $acta["segundo_ap_madre"] ?>" />
                <input type="hidden" name="fechaActo" value="<?php echo $acta["fregistro"] ?>"/>
                <input type="hidden" name="tomo" value="<?php echo $acta["tomo"] ?>"/>
                <input type="hidden" name="tomoBis" value="<?php
                $tomoBis = isset($acta["tomoBis"]) ? $acta["tomoBis"] : NULL;
                if (!is_null($tomoBis)) {
                    echo $tomoBis;
                }
                ?>"/>
                <input type="hidden" name="acta" value="<?php
                $actaItem = isset($acta["acta"]) ? $acta["acta"] : NULL;
                if (!is_null($actaItem)) {
                    echo $actaItem;
                }
                ?>" />
                <input  type="hidden" name="actaBis" value="<?php
                $actaBis = isset($acta["actaBis"]) ? $acta["actaBis"] : NULL;
                if (!is_null($actaBis)) {
                    echo $actaBis;
                }
                ?>"/>
                <input type="hidden" name="origenBD" value="<?php echo $acta["origen"]; ?>"/>
                <input type="hidden" name="idActa" value="<?php echo $acta["id_registro"]; ?>"/>
            </fieldset>
        </form>
    </div>
    <style type="text/css">
div.watermark .text {
	position: absolute;
	cursor: default;
	font: bold 22px Verdana, Arial, Sans-serif;
	color: White;
	margin: 4px;
	line-height: 20px;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=50);
	opacity: .5;
	-moz-opacity: .5;
}
</style>
    <!-- formulario de verificacion de acta incorrecta-->
    <script>
        $("#dialog-datos-verificar").dialog({
            autoOpen: false,
            height: 500,
            width: 990,
            modal: true,
            position: 'top',
            resizable: false,
            buttons: {
                "Guardar": function() {
                    if (validate(document.getElementById("formVerificar"))) {
                        $.ajax({
                            type: "POST",
                            url: "./class/insertcaptura.php",
                            data: $("#formVerificar").serialize(),
                            success: function(data) {
                                var dialog = "<div title=\"SOLICITUD DE REVISION\"><p><span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>Su mensaje sera revisado en un lapso no mayor a 2 dias h&aacute;biles. Para consultar la repuesta a su solicitud es necesario ingresar a la seccion de verificacion de tramites, en la categoria de actas foraneas. " + data + "</p></div>";
                                $(dialog).dialog({
                                    modal: true,
                                    position: 'top',
                                    resizable: false,
                                    buttons: {
                                        "Ok": function() {
                                            $(this).dialog("close");
                                            //location = "modulosolicitudActas.php";
                                        }
                                    }
                                });
                                $("#dialog-datos-verificar").dialog("close");
                            }
                        });
                    }
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                allFields.val("");
            }
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 238) {
                $("#panelIzq").addClass("fixed");
                $("#imprime").css("margin-left", "240px");
            } else {
                $("#panelIzq").removeClass("fixed");
                $("#imprime").css("margin-left", "0px");
            }
        });
        $("#shoppingCart").attr("title", $("#irMaletin").attr("title"));
        $("#noticeShoping").html($("#irMaletin").attr("title"));

        var descripcion = $("#obsCiudadano-notnull"), correoElectronico = $("#correoElectronico-null-checkMail"), telefono = $("#telefono-notnull-justNumbers"), allFields = $([]).add(descripcion).add(correoElectronico).add(telefono);

        $("#verificar")
                .button()
                .click(function() {
                    $("#dialog-datos-verificar").dialog("open");
                });

        var value = <?php echo count($shopping); ?> * 20;
        progressLabel = $(".progress-label");
        $("#progressbar").progressbar({
            value: value,
            complete: function() {
                progressLabel.text("!MALETIN LLENO¡");
            }
        });
     
    </script>
<SCRIPT>
var id = 0;
function muestra_en_diagonal (text, down, deg, lsp) {
  deg = deg || 45;
  deg = Math.PI / 180 * deg;
  lsp = lsp || 10;
  dy = lsp * Math.tan(deg);
  var html = '';
  html += '<DIV style="font-size:50;color:gray;" ID="td' + id + '"' + ' CLASS="positioned"' + '>';
  if (down) {
    for (var r = 0; r < text.length; r++) {
      html += '<SPAN ID="td' + id + r
             + '" CLASS="positioned" STYLE="left: '
             + (r * lsp) + 'px; top: ' + (r * dy) + 'px;">';
      html += text.charAt(r);
      html += '</SPAN>';
    }
  }
  else {
    for (var r = 0; r < text.length; r++) {
      html += '<SPAN ID="td' + id + r
              + '" CLASS="positioned" STYLE="left: '
              + (r * lsp) + 'px; top: '
              + ((text.length - r) * dy) + 'px;">';
      html += text.charAt(r);
      html += '</SPAN>';
    }
  }
  html += '</DIV>';
  id++;
  document.write(html);
}
</SCRIPT>
                   
    <div class="span-24 last" id="viewSearch">        
        <!-- PANEL IZQ --> 
        <div class="span-6" style="margin-left: 3px; margin-right: 7px;" id="panelIzq">
            <div class="info">
                <p class="error" style="font-size:14px; font-weight:bold; text-align:center">INFORMACI&Oacute;N IMPORTANTE</p>
                 <p class="notice" style="text-align:justify; font-size:15px">La información proporcionada corresponde al registro de su acta contenida en los archivos del Registro Civil y se presenta solamente con fines informativos.
                    En caso de detectar una diferencia o error en sus datos, acuda a nuestras oficinas a solicitar se lleve a cabo el procedimiento adecuado para la corrección correspondiente.
                 Para solicitar el envío de certificaciones vía paquetería a cualquier parte fuera del Estado de Michoacán, comuníquese a los siguientes teléfonos o correo electr&oacute;nico:</p>
                 <ul>
                    <li> (443) 113 42 00 extensiones 214, 219 ,220 o 208,</li>
                    <li>  (443) 3 12 88 77</li>
                    <li>(443) 3 12 88 78</li>
                    <li>rcivil.mich.foraneas@gmail.com</li>
·          </ul>
                 <p class="notice" style="text-align:justify; font-size:15px"> Si radica en el Estado de Michoacán, puede acudir a cualquiera de nuestras oficinas, <a href="http://registrocivil.michoacan.gob.mx/index.php/nosotros/directorio-oficiales13" target="_black">oprima aquí</a> para ver sus ubicaciones.</p>
                 <hr />
                <div class="notice <?php
                if (count($shopping) < 1) {
                    echo "hide";
                }
                ?>" id="noticeShoping" style="text-align: center"></div>
                <div id="progressbar" class="<?php
                if (count($shopping) < 1) {
                    echo "hide";
                }
                ?>"><div class="progress-label"></div></div>
            </div>
        </div>
        <!-- TERMINA PANEL IZQ --> 

        <!-- PANEL DERECHO -->
        <div id="imprime" class="span-18 last">
         
         
            <!--            <div class="span-16 prepend-1 append-1 last append-bottom">-->
            <?php if ($found) { ?>
                <div class="span-16 prepend-1 append-1 last append-bottom"><div class="notice" style="text-align: center"><img src="./images/advertencia.png" alt="Acta localizada y agregada" /><br/><strong>ESTA ACTA YA ESTA EN TU MALETIN DE COMPRAS</strong></div></div>
            <?php } if (count($shopping) >= 5) { ?>
                <div class="span-16 prepend-1 append-1 last append-bottom"><div class="info" style="text-align: center;"> <img src="./images/advertencia.png" alt="Maximo de actas" /><br/><strong>EL MAXIMO DE ACTAS POR TRAMITE ES DE 5, YA HAS ALCANZADO EL LIMITE.</strong></div></div>
            <?php } ?>
            <!--            </div>-->

            <!--***************** MUESTRA ACTA **********************************-->
            <div class="box">
            <div class="watermark posicion">
           
               
              
  

  <div class="span-16 last append-bottom info" style="text-align:center;font-size: 16px"><strong>ACTA DE NACIMIENTO</strong></div>
                <div class="span-16 last append-bottom" style="text-align:center;font-size: 16px"><strong>CRIP: </strong><?php echo $acta["crip"]; ?></div>
                <div class="span-16 last append-bottom">
                  <div class="text" style="font-size:90">DOCUMENTO</div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">OFICIALIA:</strong><br/><?php echo $acta["oficialia"]; ?></div>
                    <div class="span-2" style="text-align:center"><strong class="titulo">TOMO: </strong><br/><?php echo $acta["tomo"]; ?></div>
                    <div class="span-2" style="text-align:center"><strong class="titulo">TBIS:</strong><br/><?php echo $acta["tbis"]; ?></div>
                    <div class="span-2" style="text-align:center"><strong class="titulo">ACTA: </strong><br/><?php echo $acta["acta"]; ?></div>
                    <div class="span-5 last" style="text-align:center"><strong class="titulo">FECHA DE REGISTRO:</strong><br/><?php echo $acta["fregistro"]; ?></div>
                </div>
                <div class="span-16 last" style="text-align:center">
                    <strong style="font-size:14px;">LUGAR DE REGISTRO</strong>
                    <hr />
               
                </div>
                
                <div class="span-16 last append-bottom">
                    <div class="span-5" style="text-align:center"><strong class="titulo">LOCALIDAD</strong><br/><?php echo $acta["localidad"] ?></div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">MUNICIPIO</strong><br/><?php echo $acta["municipio"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">ENTIDAD FEDERATIVA</strong><br/>MICHOACAN</div>
                </div>
                <div class="span-16 last" style="text-align:center">
                     <div class="text" style="font-size:100">SIN VALOR</div>
                    <strong class="titulo">DATOS DEL REGISTRADO</strong></div>
                <hr />
        
                <div class="span-16 last append-bottom">
                    <div class="span-5" style="text-align:center"><strong class="titulo">PRIMER APELLIDO</strong><br/><?php echo $acta["apatern"] ?></div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">SEGUNDO APELLIDO</strong><br/><?php echo $acta["amatern"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">NOMBRE(S)</strong><br/><?php echo $acta["nombre"] ?></div>
                </div>
                <div class="span-16 last append-bottom">
                    <div class="span-5" style="text-align:center"><strong class="titulo">REGISTRADO</strong><br/><?php echo $acta["registrado"] ?></div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">SEXO</strong><br/><?php echo $acta["sexo"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">NACIONALIDAD</strong><br/><?php echo $acta["pais"] ?></div>
                </div>  
                <div class="span-16 last append-bottom">
                      <div class="text" style="font-size:100">---LEGAL---</div>
                    <div class="span-8" style="text-align:center"> <strong class="titulo">FECHA DE NACIMIENTO: </strong><?php echo $acta["fnacimiento"] ?> </div>
                    <div class="span-8 last" style="text-align:center"> <strong class="titulo">HORA DE NACIMIENTO: </strong><?php echo $acta["hnacimiento"] ?> </div>
                </div>
			<?php 	if($acta["tipo_docto"]==1) {?>
                <div class="span-16 last" style="text-align:center">
                    <strong class="titulo">LUGAR DE NACIMIENTO</strong>
                    <hr/>
                </div>
                <div class="span-16 last append-bottom">
                    
                    <div class="span-5" style="text-align:center">
                        <strong class="titulo">LOCALIDAD</strong><br/>
                        <?php
                        //if ($acta["localidadnan2"] == null) {
                        echo $acta["localidadnan"];
                        /* } else {
                          echo $acta["localidadnan2"];
                          } */
                        ?>
                    </div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">MUNICIPIO</strong><br/><?php echo $acta["munnan"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">ESTADO</strong><br/><?php echo $acta["Estado"] ?></div>
                </div>
                <div class="span-16 last" style="text-align:center">
                    <strong class="titulo">DATOS DEL PADRE</strong>
                    <hr/>
                </div>
                <div class="span-16 last append-bottom">
                    <div class="span-5" style="text-align:center"><strong class="titulo">NOMBRE</strong><br/><?php echo $acta["nombre_padre"] . " " . $acta["primer_ap_padre"] . " " . $acta["segundo_ap_padre"] ?></div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">EDAD</strong><br/><?php echo $acta["edadpadre"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">NACIONALIDAD</strong><br/><?php echo $acta["nacionp"] ?></div>
                
                </div>
                <div class="span-16 last" style="text-align:center">
                    <strong class="titulo">DATOS DE LA MADRE</strong>
                    <hr/>
                </div>
                <div class="span-16 last append-bottom">
                    <div class="span-5" style="text-align:center"><strong class="titulo">NOMBRE</strong><br/><?php echo $acta["nombre_madre"] . " " . $acta["primer_ap_madre"] . " " . $acta["segundo_ap_madre"] ?></div>
                    <div class="span-5" style="text-align:center"><strong class="titulo">EDAD</strong><br/><?php echo $acta["edadmadre"] ?></div>
                    <div class="span-6 last" style="text-align:center"><strong class="titulo">NACIONALIDAD</strong><br/><?php echo $acta["nacionm"] ?></div>
                </div>
				<?php } else { ?>
				 <div class="span-16 last append-bottom">
                                       <div class="text" style="font-size:100">LEGAL</div>
                    <div class="span-16" style="text-align:justify"><strong class="titulo">TRADUCCION</strong><br/><?php echo $acta["nota"] . " " . $acta["primer_ap_madre"] . " " . $acta["segundo_ap_madre"] ?></div>
                    
                </div>
				<?php }?>
                <hr/>
                <div class="span-16 last" style="text-align: center">
                    <!--*********************************BOTONES**********************************-->
                    <!--<?php if (!$found) { ?><button type="button" name="verificar" id="verificar" style="">LOS DATOS SON INCORRECTOS<br />
                            <img src="./images/advertencia.png" /></button> <?php } ?>-->
                    <?php if (!$found && count($shopping) < 5) { ?>
                      <!--  <button id="shoppingCart" type="button" style="">
                            AGREGAR AL MALETIN<br />
                            <img src="./images/Case-32.png" alt="" />
                        </button>!-->
                    <?php } ?>
                    <script type="text/javascript">
                        $("#shoppingCart").click(function() {
                            $("#verificar, #shoppingCart").hide("1500");
                            $("#noticeShoping, #progressbar").show("fast");
                            $.ajax({
                                type: "GET",
                                url: "class/shoppingCart.class.php",
                                data: {f: "add", nombre: "<?php echo $acta["nombre"] . " " . $acta["apatern"] . " " . $acta["amatern"]; ?>", acta: "<?php echo $acta["acta"]; ?>", id_registro: "<?php echo $acta["id_registro"]; ?>", BD: "<?php echo $acta["origen"]; ?>", tomo: "<?php echo $acta["tomo"]; ?>", oficialia: "<?php echo $acta["oficialia"]; ?>", municipio: "<?php echo $acta["municipio"]; ?>", estado: "<?php echo $acta["Estado"]; ?>", fregistro: "<?php echo $acta["fregistro"]; ?>", tbis: "<?php echo $acta["tbis"]; ?>", actaBis: "<?php echo $acta["actaBis"]; ?>"}
                            }).done(function(html) {
                                if (parseInt(html) < 5) {
                                    $("#irMaletin").show().attr("title", "TIENES " + html + " ACTA(S) EN TU MALETIN");
                                    $("#noticeShoping").html($("#irMaletin").attr("title"));
                                    $("#finalizePurchase").attr("title", "TIENES " + html + " ACTA(S) EN TU MALETIN").show("1500");
                                    $("#shoppingCart").hide("1500");
                                    $("#shoppingCartCancel").show("fast");
                                }
                                else if (parseInt(html) === 5)
                                {
                                    $("#irMaletin").show().attr("title", "TIENES " + html + " ACTA(S) EN TU MALETIN");
                                    $("#noticeShoping").html("Numero de actas maximas permitidas por tramite");
                                    $("#finalizePurchase").attr("title", "Numero de actas maximas permitidas por tramite").show("1500");
                                    $("#noticeShoping").html($("#irMaletin").attr("title"));
                                    $("<div title='MALETIN LLENO'>Has alcanzado el limite de actas por tramite, por lo que te sugerimos concluir este tramite y comenzar uno nuevo. ¡Por tu comprensión gracias!</div>").dialog({
                                        modal: true,
                                        resizable: false,
                                        position: "top",
                                        buttons: {
                                            "Ok": function() {
                                                $(this).dialog("close");
                                            }
                                        }
                                    });
                                    //$("#dialog-form").dialog("close");
                                }
                                else
                                {
                                    $("#irMaletin").show().attr("title", "TIENES " + html + " ACTA(S) EN TU MALETIN");
                                    $("#noticeShoping").html("Numero de actas maximas permitidas por tramite");
                                    $("#finalizePurchase").attr("title", "Numero de actas maximas permitidas por tramite").show("1500");

                                    //$("#dialog-form").dialog("close");
                                    //Termina else de mas de 5 actas
                                }
                                $("#progressbar").progressbar("value", html * 20);
                            }
                            );
                        });
                    </script>
                    <button id="finalizePurchase" type="button" style="<?php
                    if ($found or ( count($shopping) >= 5)) {
                        echo "display: inline";
                    } else {
                        echo "display: none";
                    }
                    ?>" title="<?php
                            if ($found && (count($shopping) < 5)) {
                                echo "Acta agregada al maletin";
                            }
                            if ((count($shopping) >= 5)) {
                                echo "No maximo de Actas agregadas al maletin, favor de continuar con la compra, si requieres mas actas concluye este tramite e inicia uno nuevo para las restantes ";
                            }
                            ?>">FINALIZAR COMPRA<br />
                        <img src="./images/Case-32.png" alt="FINALIZAR COMPRA" /></button>
                    <script type="text/javascript">
                        $("#finalizePurchase").click(function() {
                            location = "detalleMaletin.php";
                        });
                    </script>
                    <button type="button" id="newSearch" style="" >NUEVA BUSQUEDA<br />
                        <img src="images/Search_32.png" alt="NUEVA BUSQUEDA" />
                    </button>
                    <script type="text/javascript">
                        $("#newSearch").click(function() {
                            $("#viewSearch").addClass("hide");
                            $("#formSearch").removeClass("hide");
                            $("#nombre-notnull").focus();
                            $("#nuevosDatosBtn").click();
                        });
                    </script>
                    <!--*********************************TERMINAN BOTONES**********************************-->
                </div>
                <hr/>
            </div>
                 </div>
            <!--***************** TERMINA MUESTRA ACTA **********************************-->
        </div>
        <!-- TERMINA PANEL DERECHO --> 
    </div>
<?php } else { ?>
    <!--                formulario de solicitud de captura-->
    <div id="frmDialogCaptura" title="SOLICITUD DE CAPTURA">
        <p style="font-weight: bold"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Todos los campos son abligatorios.</p>
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Es necesario proporciones la siguiete información para realizar la solicitud de captura.</p>
        <form id="formSolicitarCap">
            <fieldset style="text-align: center">
                <div style="text-align: left"><label for="nombreSolicitante-notnull">Nombre:</label><br/></div>
                <input type="text" value="" name="nombreSolicitante" id="nombreSolicitante-notnull" class="text" /><br/>
                <div style="text-align: left"><label for="telf-notnull-justNumbers">Numero Telefonico:</label><br/></div>
                <input type="text" value="" name="telf" id="telf-notnull-justNumbers" class="text" maxlength="10" onkeypress="return IsNumber(event)" onblur="blurNumeric(this)" /><br/>
                <div style="text-align: left"><label for="correoElectronico-null-checkMail">Correo Electronico:</label><br/></div>
                <input type="text" value="" name="correoElectronico" id="correoElectronico-null-checkMail" class="text" style="text-transform: lowercase" /><br/>
                <div style="text-align: left"><label for="obsCiudadano-notnull">Observaciones:</label><br/></div>
                <textarea name="obsCiudadano" id="obsCiudadano-notnull" style="text-transform: lowercase; height: 70px; width: 300px"></textarea><br/>
                <input type="hidden" name="nombre1" value="<?php echo filter_input(INPUT_POST, "nombre"); ?>" />
                <input type="hidden" name="primerApellido1" value="<?php echo filter_input(INPUT_POST, "apatern"); ?>" />
                <input type="hidden" name="segundoApellido1" value="<?php echo filter_input(INPUT_POST, "amatern"); ?>" />
                <input type="hidden" name="FechaNac" value="<?php echo filter_input(INPUT_POST, "fechanacimiento"); ?>" />
                <input type="hidden" name="padre" value="<?php echo filter_input(INPUT_POST, "nombrep"); ?>" />
                <input type="hidden" name="madre" value="<?php echo filter_input(INPUT_POST, "nombrem"); ?>" />
                <input type="hidden" name="fechaActo" value="<?php echo filter_input(INPUT_POST, "anio"); ?>" />
                <input type="hidden" name="tomo" value="<?php echo filter_input(INPUT_POST, "tomo"); ?>" />
                <input type="hidden" name="acta" value="<?php echo filter_input(INPUT_POST, "acta"); ?>" />
                <input type="hidden" name="tipo_Tramite" value="2" />
                <input type="hidden" name="tipoActo" value="1" />
            </fieldset>
        </form>
    </div>
    <!--                formulario de solicitud de captura-->
    <script>
        $("#solicitarCaptura")
                .button()
                .click(function() {
                    //verificamos si ya se realizo una solicitud de captura
                    /*$.ajax({
                     url: "verificaSolicitud.php",
                     type: "GET",
                     data: $("#formSolicitarCap").serialize()
                     }).done(function(data) {
                     alert(data);
                     });*/
                    $.getJSON("class/verificaSolicitud.php", $("#formSolicitarCap").serialize())
                            .done(function(jsonRequest) {
                                alert(jsonRequest.found);
                                if (jsonRequest.found) {
                                    $('<div title="SOLICITUD DE CAPTURA">Solicitud de captura exitosa. Su solicitud sera verificada en un lapso no mayor a tres dias habiles</div>').dialog({
                                        modal: true,
                                        buttons: {Ok: function() {
                                                $(this).dialog("close");
                                                $(this).remove();
                                                location = 'modulosolicitudActas.php';
                                            }}});
                                } else {
                                    $("#frmDialogCaptura").dialog("open");
                                }
                            });
                });
        $("#newSearch").click(function(e) {
            $("#viewSearch").addClass("hide");
            $("#formSearch").removeClass("hide");
        });

        $("#frmDialogCaptura").dialog({
            autoOpen: false,
            height: 550, width: 355, modal: true, resizable: false, position: "top",
            buttons: {
                "Guardar": function() {
                    if (validate(document.getElementById("formSolicitarCap"))) {
                        $.ajax({
                            type: "GET",
                            url: "./class/LlenadoSolicitudCaptura.php",
                            data: $("#formSolicitarCap").serialize(),
                            success: function(data) {
                                $('<div id="dialog" title="SOLICITUD DE CAPTURA">Solicitud de captura exitosa. Su solicitud sera verificada en un lapso no mayor a tres dias habiles<p><p>' + data + '</p></div>').dialog({modal: true, buttons: {Ok: function() {
                                            $(this).dialog("close");
                                            location = 'modulosolicitudActas.php';
                                        }}});
                                $("#frmDialogCaptura").dialog("close");
                            }
                        });
                        //$(this).dialog("close");
                    }
                },
                "Cancelar": function() {
                    $("#nombreSolicitante-notnull, #numTel-notnull-justNumbers, #correoElectronicoSolCap-notnull-checkMail").val("");
                    $(this).dialog("close");
                }
            },
            close: function() {
                //allFields.val("");
            }
        });
    </script>
    <div class="span-24 last" style="text-align:center" id="viewSearch">
        <div class="span-20 prepend-2 append-2 last">
            <div class="error">
                <h1 style="text-decoration: underline">EL ACTA NO HA SIDO ENCONTRADA</h1>
                <strong>FAVOR DE VERIFICAR LA SIGUIENTE INFORMACI&Oacute;N:</strong>
            </div>
        </div>
        <div class="span-20 prepend-2 append-2 last" style="text-align:left">
            <div class="info">
              <!--  <p style="font-size: 14px">Es posible que su acta no se encuentre registrada en nuestra base de datos aun. Usted puede solicitar una captura de su acta de nacimiento dando click en el boton <strong>"SOLICITAR CAPTURA"</strong> en la parte inferior de esta pagina.</p>--!>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>NOMBRE: </b><?php echo filter_input(INPUT_POST, "nombre") . " " . filter_input(INPUT_POST, "apatern") . " " . filter_input(INPUT_POST, "amatern"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>FECHA DE NACIMIENTO: </b><?php echo filter_input(INPUT_POST, "fechanacimiento"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>MUNICIPIO DE REGISTRO: </b><?php echo filter_input(INPUT_POST, "municipio"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>AÑO DE REGISTRO: </b><?php echo filter_input(INPUT_POST, "anio"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>NUMERO DE TOMO: </b><?php echo filter_input(INPUT_POST, "tomo"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>NUMERO DE ACTA: </b><?php echo filter_input(INPUT_POST, "acta"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>NOMBRE DEL PADRE (SIN APELLIDOS): </b><?php echo filter_input(INPUT_POST, "nombrep"); ?></div>
                <div class="span-20 last" style="text-transform: uppercase; font-size: 18px"><b>NOMBRE DE LA MADRE (SIN APELLIDOS): </b><?php echo filter_input(INPUT_POST, "nombrem"); ?></div>
                <hr/>
            </div>
        </div>
       <div class="span-20 prepend-2 append-2 last" style="text-align:right">
           <!-- <button type="button" id="solicitarCaptura">SOLICITAR CAPTURA<br />
                <img src="images/descripcion.png" alt="SOLICITAR CAPTURA " /> </button>-->
            <button type="button" id="newSearch">INTENTAR NUEVAMENTE<br />
                <img src="images/agt_reload-32.png" alt="INTENTAR NUEVAMENTE" /></button>
        </div>
    </div>
    <?php
}
$acta_->free();
$mysqli->close();
