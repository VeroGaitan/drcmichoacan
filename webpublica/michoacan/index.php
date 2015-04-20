<?php
include 'class/conexion.php';
$municipio = $mysqli->query("SELECT clavem, descrm FROM municip");
?>

<html>
    <head>
        <meta charset='utf-8'/>
        <title>Registro Civil - Morelia, Mich.</title>
        <link href="css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection" />
        <link href="css/blueprint/print.css" type="text/css" rel="stylesheet" media="print" />
        <!--[if lt IE 8]><link rel="stylesheet" href="./css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
        <link href="css/jquery.dropmenu.css" type="text/css" rel="stylesheet" media="" />
        <!--<link href="http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css" type="text/css" rel="stylesheet" />-->
        <link href="css/blitzer/jquery-ui-1.10.3.custom.css" type="text/css" rel="stylesheet" />
		<link href="css/forms.css" type="text/css" rel="stylesheet" />
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.js"></script>
        <script src="js/jquery.dropmenu.js"></script>
		<script src="js/jquery.ui.datepicker-es.js"></script>
		
        <script src="js/jquery.selectOff.js"></script>
        <script type="text/javascript">
            $(document).bind("contextmenu", function() {
                return false;
            });
            $(document).ready(function() {
                $('button').button();
                $.dropmenu(200, 600);
                $("body").selectOff();
            }); //termina $(document).ready(function(){//termina $(document).ready(function(){
        </script>
		
    </head>
    <body>
        <div class="container">
            
           
            <div class="span-24 last"> 
             <!-- MUESTRA RESULTADO DE BUSQUEDA -->

<div class="" id="resultSearch"></div>
<!-- TERMINA MUESTRA RESULTADO DE BUSQUEDA --> 
<!-- AVISO DE BUSQUEDA -->
<div id="searched" class="span-24 last hide prepend-top" style="text-align:center; margin-top:15px"> 
    <img src="./images/horizontal_loading.gif" alt="Buscando acta" /><br />
    <h1>Buscando acta. Por favor, espere un poco.</h1>
    <p>Este proceso puede tardar segun la velocidad de su conexion a Internet</p>
</div>
<!-- TERMINA AVISO DE BUSQUEDA --> 
<!-- FORMULARIO DE BUSQUEDA -->

<div class="span-22 prepend-1 append-1 l last">
    <div class="span-22 ast boxForm" id="formSearch">
        <form name="actasNac" id="actasNac">
            <h3 style="text-align:center" class="prepend-top">Busca el acta de nacimiento</h3>
            <div class="span-20 prepend-1 append-1 last"><div style="text-align:center" class="error">*<strong>Campos obligatorios</strong></div></div>
            <div class="span-7 prepend-1">
                <input name="nombre" type="text" autofocus class=" text span-7 inputForm" value="GUADALUPE LIMBANNIA" id="nombre-notnull" placeholder="Nombre(s)" />
                <div class="labelForm"><strong>*</strong>Nombre(s)</div>
            </div>
            <div class="span-4">
                <input name="apatern" type="text" class="span-4 text inputForm" id="apatern-notnull" value="NUÑEZ" placeholder="Primer Apellido" />
                <div class="labelForm"><strong>*</strong>Primer Apellido</div>
            </div>
            <div class="span-4">
                <input name="amatern" type="text" class="span-4 text inputForm" id="tel" value="JARAMILLO" placeholder="Segundo apellido" />
                <div class="labelForm">Segundo apellido</div>
            </div>
            <div class="span-5 append-1 last ">
                <input name="fechanacimiento" type="text" class="span-5 text inputForm" id="fechanacimiento-notnull-date" placeholder="fecha de nacimiento DD/MM/AAAA" value="02/01/1987" />
                <div class="labelForm"><strong>*</strong>F. de Nacimiento (dd/mm/aaaa)</div>
            </div>
            <div class="span-22 last append-bottom prepend-top">
                <div class="span-20 prepend-1 append-1 last" style="text-align:center">
                    <div class="notice"> <b>De los siguientes datos es necesario ingresar por lo menos 3</b> </div>
                </div>
                <div class="span-10 prepend-1">
                    <div class="span-10 last boxForm" style="height: 170px">
                        <h4 style="text-align: center; margin-top: 5px; margin-bottom: 0px; font-weight:  bold">DATOS DE REGISTRO</h4>
                        <hr/>
                        <div class="span-8 prepend-1 append-1 last">
                            <div class="ui-widget">
                                <select name="municipio" id="municipio" class="span-8">
                                    <option selected="selected" value=""></option>
                                    <?php  while ($myItem = mysqli_fetch_assoc($municipio)) { ?>
                                        <option value="<?php echo $myItem['descrm']; ?>"><?php echo $myItem['descrm']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="labelForm">Municipio de Registro</div>
                        </div>
                        <div class="span-8 append-1 prepend-1 last">
                            <div class="span-2">
                                <input name="anio" class="span-2 text inputForm" maxlength="4" placeholder="Año" id="anio" onkeypress="return IsNumber(event)" onblur="blurNumeric(this)" VALUE="1987"/>
                                <div class="labelForm">A&ntilde;o de Registro</div>
                            </div>
                            <div class="span-2">
                                <input name="tomo" id="tomo"  maxlength="2" class="span-2 text inputForm" placeholder="Tomo" onkeypress="return IsNumber(event)" onblur="blurNumeric(this)" />
                                <div class="labelForm">No de Tomo</div>
                            </div>
                            <div class="span-2 last">
                                <input name="acta" class="span-2 text inputForm" maxlength="6" placeholder="Acta" id="acta" onkeypress="return IsNumber(event)" onblur="blurNumeric(this)" />
                                <div class="labelForm">No de Acta</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span-10 append-1 last" style="text-align:center">
                    <div class="span-10 boxForm" style="height: 170px">
                        <h4 style="text-align: center; margin-top: 5px; margin-bottom: 0px; font-weight:  bold">DATOS DE LOS PADRES</h4>
                        <hr/>
                        <div class="span-8 prepend-1 append-1 last">
                            <input name="nombrep" id="nombrep" class="span-8 text inputForm" placeholder="Nombre del padre" value="RUBEN" />
                            <div class="labelForm">Nombre del Padre (Sin apellidos)</div>
                        </div>
                        <div class="span-8 prepend-1 append-1 last" >
                            <input name="nombrem" id="nombrem" class="span-8 text inputForm" placeholder="Nombre de la madre" value="MARIA BLANCA" />
                            <div class="labelForm">Nombre de la Madre (Sin apellidos)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span-16 prepend-4 append-4 last append-bottom" style="text-align: center">
                <button type="reset" id="nuevosDatosBtn">NUEVOS DATOS<br/><img src="./images/erase.jpg" alt="Nuevos datos" /></button>
                <button type="button" id="submitForm">BUSCAR ACTA<br />
                    <img src="./images/Search_32.png" alt="Buscar Acta" /></button>
            <script>
    $("button").button();
    $("input").attr("autocomplete", "off");
    /* FECHA DE NACIMIENTO */
    $('#fechanacimiento-notnull-date').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0',
        regional: "es",
        maxDate: "0"
    });

    //para boton enviar
    $("#submitForm").click(function() {
  
	
            var cont = null;
            if ($("#municipio").val() !== "") {
                cont++;
                m = 1;
            }
            if ($("#anio").val() !== "") {
			
                cont++;
            }
            if ($("#tomo").val() !== "") {
                cont++;
            }
            if ($("#acta").val() !== "") {
                cont++;
            }
            if ($("#nombrep").val() !== "") {
                cont++;
            }
            if ($("#nombrem").val() !== "") {
                cont++;
            }
            if (cont >= 3) {
                $("#searched").show();
                $("#formSearch").addClass("hide");
                $.ajax({
                    type: "POST",
                    url: "actasNac.php",
                    data: $("#actasNac").serialize(), // serializes the form's elements.
                    timeout: 28000,
                    error: function() {
                        $("#searched").hide();
                        $("#formSearch").removeClass("hide");
                        $('<div id="dialog" title="ALERTA"><p><span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>Al parecer algo salio mal, intentalo nuevamente o llama a nuestra linea de actas foraneas 555-555-55-55<p></div>').dialog({
                            modal: true,
                            buttons: {Ok: function() {
                                    $(this).dialog("close");
                                    $(this).remove();
                                }}
                        });
                    },
                    success: function(data) {
                        $("#resultSearch").html(data);
                        $("button").button();
                        $("#searched").hide();
                    }
                });
            } else {
                $('<div id="dialog" title="IMPORTANTE"><p><span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>Es necesario que proporciones por lo menos 3 datos de entre: <strong>DATOS DE REGISTRO</strong> y <strong>DATOS DE LOS PADRES</strong><p></div>').dialog({modal: true, buttons: {Ok: function() {
                            $(this).dialog("close");
                            $(this).remove();
                        }}});
            }
        
    });

    $("#nuevosDatosBtn").click(function() {
        $("#nombre-notnull").focus();
    });

    $("#municipio").combobox();
</script>
			</div>
        </form>
    </div>
</div>
<!-- TERMINA FORMULARIO DE BUSQUEDA -->
            </div>
            <div class="span-24 last" style="text-align:center">
                <hr/>
                <em>Valent&iacute;n G&oacute;mez Farias No. 525. Col. Industrial,Morelia Michoac&aacute;n - Todos los derechos reservados - Registro Civil, Morelia, Mich. MX</em> 
            </div>
        </div>
    </body>
</html>


