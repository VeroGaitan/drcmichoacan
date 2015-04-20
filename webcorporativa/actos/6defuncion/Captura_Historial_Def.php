<?php
require 'datos_defuncion.php';
$defuncion = new datos_defuncion();
$cat_paises = $defuncion->cat_paises();
$cat_sexo = $defuncion->cat_sexo();
$cat_edo_civil = $defuncion->cat_edo_civil();
$cat_comparece = $defuncion->cat_comparece();
$cat_edoCertificacion = $defuncion->cat_edos_cert();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DRC - Michoacan - Defunciones</title>
        <script type="text/javascript" src="../../../js/jquery-1.11.2.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>        
        <script type="text/javascript" src="../../../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>
        <script type="text/javascript" src="../../../js/validCampoFranz.js"></script>
        
        <link type="text/css" rel="stylesheet" href="../../../css/jquery-ui-1.11.3.custom/jquery-ui.css" media="screen">
        <link href="../../../css/bootstrap.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../../../css/selectable.css" media="screen">
       
        
        <script type="text/javascript" src="../../../js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="../../../css/combobox-autocomplete.jquery.css" media="screen"> 
        <script type="text/javascript" src="../../../js/capturaActas.js"></script>
<!--        <link type="text/css" rel="stylesheet" href="../../../css/datepicker.css" media="screen"> -->
        
        <script type="text/javascript">
        //Función que permite solo Números        
        function ValidaSoloNumeros() {
         if ((event.keyCode < 48) || (event.keyCode > 57)) 
          event.returnValue = false;
        } 
        function ValidaOficio() {
         if ((event.keyCode < 47) || (event.keyCode > 57)) 
          event.returnValue = false;
        } 
        
    function validarSoloNumeros(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla===8) return true; // 3
        patron = /\d/;  // 4
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    }
    
        function soloLetras(e){
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
            for(var i in especiales){
                 if(key == especiales[i]){
                     tecla_especial = true;
                     break;
                 }
             }

             if(letras.indexOf(tecla)==-1 && !tecla_especial){
                 return false;
             }
        }

        function validaHoras() {
            var hrDefuncion = document.getElementById("hrDefuncion");
            var minDefuncion = document.getElementById("minDefuncion");
            if(parseInt(minDefuncion.value) > 59) {
                minDefuncion.style.border = "2px solid red";
                return false;
            }  else if(parseInt(hrDefuncion.value) > 24) {
                hrDefuncion.style.border = "2px solid red";
                return false;
            }   else if(parseInt(hrDefuncion.value) === 24 && parseInt(minDefuncion.value)> 0) {
                minDefuncion.style.border = "2px solid red";
                return false;
            }  else if(parseInt(minDefuncion.value) <= 59) {
                minDefuncion.style.border = "";
            } else if(parseInt(hrDefuncion.value) <= 24) {
                hrDefuncion.style.border = "";
            }
        }
        function enviarApellidosP() {
            var primer_apellido = document.getElementById("primer_apellido").value;
            document.getElementById("primer_apellido_padre").value = primer_apellido;
        }
        function enviarApellidosM() {
            var segundo_apellido = document.getElementById("segundo_apellido").value;
            document.getElementById("primer_apellido_madre").value = segundo_apellido;
        }
        function validarApPadre() {
            var primer_apellido_padre = document.getElementById("primer_apellido_padre");
            var primer_apellido = document.getElementById("primer_apellido");
            if(primer_apellido_padre.value===primer_apellido.value) {
                primer_apellido_padre.style.border = "";
            } else {
                primer_apellido_padre.style.border = "2px solid red";
                return false;
            }
        }
        function validarApMadre() {
            var primer_apellido_madre = document.getElementById("primer_apellido_madre");
            var segundo_apellido = document.getElementById("segundo_apellido");
            if(primer_apellido_madre.value===segundo_apellido.value) {
                primer_apellido_madre.style.border = "";
            } else {
                primer_apellido_madre.style.border = "2px solid red";
                return false;
            }
          }
         function validarFechas(fechaRecibida, nombreCampo) {
            var today = new Date();
            
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            
            if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 
            var fecActual = mm+'/'+dd+'/'+yyyy;        
            var fecha = document.getElementById(nombreCampo);
            
        var res = fechaRecibida.split("/");
        var fechaRecibida2 = res[1]+'/'+res[0]+'/'+res[2]; 
        if(res[2] > yyyy){
                //alert(res[2]+"el año es mayor no se necesita validar nada mas"+mm);
                fecha.style.border = "2px solid red";
                return false;
        }else if(res[2]< yyyy){
                fecha.style.border = "";
        }else if(res[2]===yyyy){
            if(fechaRecibida2 > fecActual) { 
                //alert(fechaRecibida2+"si es mayor la recibida"+fecActual);
                fecha.style.border = "2px solid red";
                return false;
            } else {
                //alert(fechaRecibida2+"no es mayor la recibida"+fecActual);
                fecha.style.border = "";                
            }
        }
            
      }          
        function mostrarInscripcion(){
            if (document.getElementById('inscripcion').checked){
                document.getElementById('divInscripcion').style.display = 'block';
                document.getElementById('divNormal').style.display = 'none';
                document.getElementById('tdCuadernillo').style.display = 'none';
                document.getElementById('tdCuadernilloC').style.display = 'none';
              }else{
                document.getElementById('divInscripcion').style.display = 'none';
                document.getElementById('divNormal').style.display = 'block';
                document.getElementById('tdCuadernillo').style.display = 'block';
                document.getElementById('tdCuadernilloC').style.display = 'block';
              }      
        }
        function mostrarMasEdad(){
            if (document.getElementById('masEdad').checked){
                document.getElementById('otraEdad').style.display = 'block';
              }else{
                document.getElementById('otraEdad').style.display = 'none';
              }      
        } 
        function mostrarMasEdadIns(){
            if (document.getElementById('masEdadIns').checked){
                document.getElementById('otraEdadIns').style.display = 'block';
              }else{
                document.getElementById('otraEdadIns').style.display = 'none';
              }      
        } 
        function msjDialog(msj) {
                    $("<div/>").dialog({
                        resizable: false,
                        modal: true,
                        width: 300,
                        buttons: {
                            OK: function () {
                                $(this).dialog("destroy");
                            }
                        },
                        close: function () {
                            $(this).dialog("destroy").html("").remove();
                        }
                    }).prepend(msj).css("text-align", "center").prev(".ui-dialog-titlebar").hide();
                }                
              
        $(function () {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
            $("#FECHA_REGISTRO").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
            $("#fechaNac").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
            $("#fechaDefuncion").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
            $("#fechaNac_ins").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
            $("#fecha_defuncion_ins").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
            $("#fechaAviso").datepicker({
               dateFormat: "dd/mm/yy",
               yearRange: "1900:2015",
               dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
               dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
               monthNames: 
                    ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
               monthNamesShort: 
                    ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
            });
        });         

      </script> 
      
</head>
<body>
   <?php 
  global $ID_ACTO, $ID_ESTADO, $ID_MUNICIPIO, $ID_OFICIALIA, $ANO_REG, $ACTA, $ACTA_BIS, $LIBRO, $TOMO, $TOMO_BIS;  
   if (filter_input(INPUT_POST,'ID_ACTO'))$ID_ACTO = filter_input(INPUT_POST,'ID_ACTO'); ELSE $ID_ACTO = 6;
   if (filter_input(INPUT_POST,'ID_ESTADO'))$ID_ESTADO = $_POST["ID_ESTADO"]; ELSE $ID_ESTADO = 16;
   if (filter_input(INPUT_POST,'ID_MUNICIPIO'))$ID_MUNICIPIO = $_POST["ID_MUNICIPIO"]; ELSE $ID_MUNICIPIO=5;
   if (filter_input(INPUT_POST,'ID_OFICIALIA'))$ID_OFICIALIA = $_POST["ID_OFICIALIA"]; ELSE $ID_OFICIALIA=9;
   if (filter_input(INPUT_POST,'ANO_REG'))$ANO_REG = $_POST["ANO_REG"]; ELSE $ANO_REG=2015;
   if (filter_input(INPUT_POST,'ACTA'))$ACTA = $_POST["ACTA"]; ELSE $ACTA=415;
   if (filter_input(INPUT_POST,'ACTA_BIS'))$ACTA_BIS = $_POST["ACTA_BIS"]; ELSE $ACTA_BIS = 0;
   if (filter_input(INPUT_POST,'TOMO'))$TOMO = $_POST["TOMO"]; ELSE $TOMO = 1;
   if (filter_input(INPUT_POST,'TOMO_BIS'))$TOMO_BIS = $_POST["TOMO_BIS"]; ELSE $TOMO_BIS = 2;
   if (filter_input(INPUT_POST,'LIBRO'))$LIBRO = $_POST["LIBRO"]; ELSE $LIBRO = 1;
   
   $CADENA = $ID_ACTO."".$ID_ESTADO."".str_pad($ID_MUNICIPIO, 3 , "0",STR_PAD_LEFT)."".str_pad($ID_OFICIALIA, 2 , "0",STR_PAD_LEFT)."".$ANO_REG."".$ACTA."".$ACTA_BIS;
   ?>
 <div class="container">
  
     <input type="hidden" id="libro" value="<?php echo $LIBRO; ?>"> 
     <input type="hidden" id="tomo" value="<?php echo $TOMO; ?>">
     <input type="hidden" id="tomoBis" value="<?php echo $TOMO_BIS; ?>">
     <input type="hidden" id="anoReg" value="<?php echo $ANO_REG; ?>">
     <input type="hidden" id="actaBis" value="<?php echo $ACTA_BIS; ?>">
     <input type="hidden" id="oficialia" value="<?php echo $ID_OFICIALIA; ?>">
     <input type="hidden" id="estadoReg" value="<?php echo $ID_ESTADO; ?>">
     <input type="hidden" id="municipioReg" value="<?php echo $ID_MUNICIPIO; ?>">
     <input type="hidden" id="cadena" value="<?php echo $CADENA; ?>">
    
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos del Documento</strong></h4>
    <table class="table table-condensed" border="0" align="center">
                <tr align="left" class="warning">
                    <th  id="tdCuadernillo">CUADERNILLO</th>
                    <th>INSCRIPCIÓN</th>
                    <th>TOMO</th>
                    <th>TOMO BIS</th>                     
                    <th>OFICIAL&Iacute;A:</th>
                    <th>N&deg; ACTA</th>
                    <th>FECHA DE REGISTRO</th>        
                </tr>
                <tr>        
                    <td align="center" id="tdCuadernilloC"><input id="cuadernillo" type="checkbox"></td>
                    <td align="center"><input id="inscripcion" type="checkbox" onchange="mostrarInscripcion()"></td>
                    <td><input id="tomoDisabled" type="text" class="form-control" value="<?php echo $TOMO; ?>" disabled></td>
                    <td><input id="tomoBisDisabled" type="text" class="form-control" value="<?php echo $TOMO_BIS; ?>"  disabled></td>                    
                    <td><input id="oficialiaDisabled" type="text" class="form-control" value="<?php echo $ID_OFICIALIA; ?>" disabled></td>
                    <td><input id="noActa" type="text" required class="form-control" value="<?php echo $ACTA; ?>" onkeypress="return validarSoloNumeros(event)"></td>
                    <td><input id="FECHA_REGISTRO" onblur="validarFechas(this.value, 'FECHA_REGISTRO')" onKeyUp = "this.value=formateafecha(this.value, 'FECHA_REGISTRO');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">
                    </td>
                </tr>               
    </table>
 <div id="divNormal">   
<!--**************************************DATOS DEL FINADO*******************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos del Finado</strong></h4> 
                <table  class="table table-condensed" border="0" align="center">
                <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td align="right">
                             <button type="button" id="buscar" class="btn btn-info btn-lg">
                                <span class="glyphicon glyphicon-search"></span> Buscar
                            </button> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Curp</label><br>
                            </td>
                            <td>
                                <input id="curp" type="text" class="form-control" maxlength="16" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>Sexo</label><br>
                            </td>
                            <td>
                           <div  class="ui-widget">
                            <select style="width: 200px" id="ID_SEXO"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;">
                                  <option value="0">========</option>
                                  <?php
                                  foreach ($cat_sexo as $item) {
                                      ?>
                                    <option value="<?php echo $item['1'] ?>"><?php echo $item[2]; ?></option>
                                      <?php
                                  }
                                  ?>
                            </select>
                            </div>                                  
                            </td>
                            <td><input id="popupAviso" type="checkbox"> <label>Aviso Sindico o MP</label><br> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nombre(s)*</label><br>
                            </td>
                            <td>
                            <input id="nombres" type="text" class="form-control" onkeypress="return soloLetras(event)"  onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">                                
                            </td>
                            <td> <label>Primer apellido*</label><br> </td>
                            <td><input id="primer_apellido" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="enviarApellidosP()">                                
                             </td>
                            <td><label>Segundo apellido</label><br> </td>
                            <td><input id="segundo_apellido" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"  onblur="enviarApellidosM()">                                
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>Fecha de Nacimiento*</label><br>
                            </td>
                            <td>
                                <input id="fechaNac" onblur="validarFechas(this.value, 'fechaNac')" onKeyUp = "this.value=formateafecha(this.value, 'fechaNac');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">                                 
                            </td>
                            <td><label>Edad*</label><br> </td>
                            <td align="center">
                                 <div  class="ui-widget">
                            <input id="edad" maxlength="3" type="text" size="5" onkeypress="return validarSoloNumeros(event)">
                                                          
                            <select style="width: 200px" id="tiempoEdad" class="form-control">
                              <option value="==">========</option>
                              <option value="Años">Años</option>
                              <option value="Meses">Meses</option>
                              <option value="Días">Días</option>
                              <option value="Horas">Horas</option>
                              <option value="Minutos">Minutos</option>
                              <option value="Segundos">Segundos</option>
                            </select>
                            </div>
                         </td>
                         <td align="center"> <input id="masEdad" type="checkbox" onchange="mostrarMasEdad()"> Otra</td>
                         <td><input id="otraEdad" style="display: none; text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control"> </td>
                    </tr>                                              
              </table>          
    
<!--**************************************DATOS DE NACIMIENTO***************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos de Nacimiento</strong></h4> 
                <table class="table table-condensed" border="0" align="center" >
                    <tr>
                            <td>          
                                <label>Pa&Iacute;s*</label><br>
                            </td>
                            <td>
                            <div>
                                <label id="errorPais" style="color: #FF0000"></label>
                                <select style="width: 200px" id="ID_PAIS_REG" class="ID_PAIS_REG">
                                <option value="0">========</option>
                                  <?php
                                  foreach ($cat_paises as $item) {
                                  ?>
                                  <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[5]; ?></option>
                                   <?php
                                    }
                                    ?>
                                  <option value="00">OTRO</option>
                               </select>
                            </div>                               
                            </td>
                            <td>  <label>Nacionalidad*</label><br> </td>
                            <td> 
                                <div  class="ui-widget">
                                    <label id="errorNac" style="color: #FF0000"></label>                              
                                  <select style="width: 200px" id="nacionalidad_difunto" class="nacionalidad_difunto">
                                      <option value="0">========</option>
                                      <?php
                                      foreach ($cat_paises as $item) {
                                          ?>
                                        <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[9]; ?></option>
                                      <?php
                                      }
                                      ?>
                                </select>
                        </div>  
                      </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Estado*</label><br>
                            </td>
                            <td>
                               <div  class="ui-widget">
                                <select style="width: 200px" id="ID_ESTADO" class="ID_ESTADO"></select>
                                <div id="ID_ESTADO_OCULTO" style="display: none;"><br>
                                <label>Otra Entidad</label><br>
                                <input id="ESTADO_NACIMIENTO_OCULTO" style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div>                                
                            </td>
                            <td>  <label>Municipio</label><br> </td>
                            <td>  <div  class="ui-widget">
                                <select style="width: 200px" id="ID_MUNICIPIO" class="ID_MUNICIPIO"></select>
                                <div id="ID_MUNICIPIO_OCULTO" style="display: none;"><br>
                                <label>Otro Municipio</label><br>
                                <input id="MUNICIPIO_NACIMIENTO_OCULTO" style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div> 
                            </td>
                            <td> <label>Localidad</label><br></td>
                            <td> <div  class="ui-widget">
                                <select style="width: 200px" id="ID_LOCALIDAD" class="ID_LOCALIDAD"></select>
                                <div id="ID_LOCALIDAD_OCULTO" style="display: none;"><br>
                                <label>Otra Localidad</label><br>
                                <input id="LOCALIDAD_NACIMIENTO_OCULTO"style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div>
                            </td>
                        </tr>                        
                         <tr>
                            <td>
                                <label>Estado Civil*</label><br>
                            </td>
                            <td>
                            <select style="width: 200px" id="edo_civil_difunto" class="form-control">
                                 <option value="0">========</option>
                                 <?php
                                 foreach ($cat_edo_civil as $item) {
                                 ?>
                                   <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                <?php
                                }
                                ?>
                           </select>                                
                            </td>
                            <td> </td>
                            <td>  </td>
                            <td> </td>
                            <td>  </td>
                        </tr>  
                </table> 
<!--**************************************DATOS DEL CÓNYUGUE***************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos del Cónyugue</strong></h4> 
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td>
                                <label>Nombre(s)*</label><br>
                            </td>
                            <td>
                               <input id="nombres_conyugue" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>Primer apellido*</label><br>
                            </td>
                            <td>
                             <input id="primer_apellido_conyugue" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>Segundo apellido</label><br>
                            </td>
                            <td>
                            <input id="segundo_apellido_conyugue" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nacionalidad</label><br>
                            </td>
                            <td>
                               <div  class="ui-widget">
                  <select style="width: 200px" id="nacionalidad_conyugue" class="form-control">
                        <option value="0">========</option>
                        <?php
                        foreach ($cat_paises as $item) {
                            ?>
                          <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[9]; ?></option>
                            <?php
                        }
                        ?>
                  </select>
                  </div>                            
                             </td>
                           <td align="right"> Finado </td>
                            <td align="left"> <input id="finadoCony" type="checkbox"> </td>
                        </tr>
                </table> 
 
  <!--**************************************DATOS DEL PADRE***************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos del Padre</strong></h4> 
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td>
                                <label>Nombre(s)*</label><br>
                            </td>
                            <td>
                              <input id="nombres_padre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>Primer apellido*</label><br>
                            </td>
                            <td>
                                <input id="primer_apellido_padre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="validarApPadre()">                                
                            </td> 
                            <td>
                                <label>Segundo apellido</label><br>
                            </td>
                            <td>
                                <input id="segundo_apellido_padre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                        </tr>                        
                         <tr>
                            <td>
                                <label>Nacionalidad</label><br>
                            </td>
                            <td>
                               <div  class="ui-widget">
                  <select style="width: 200px" id="nacionalidad_padre" class="form-control">
                        <option value="0">========</option>
                        <?php
                        foreach ($cat_paises as $item) {
                            ?>
                          <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[9]; ?></option>
                            <?php
                        }
                        ?>
                  </select>
                  </div>                              
                             </td>
                            <td align="right"> Finado </td>
                            <td align="left"> <input id="finadoPadre" type="checkbox"> </td>
                        </tr>
                </table>
 
 <!--**************************************DATOS DE LA MADRE***************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos de la Madre</strong></h4> 
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td>
                                <label>Nombre(s)*</label><br>
                            </td>
                            <td>
                               <input id="nombres_madre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td><label>Primer apellido*</label><br>  </td>
                            <td><input id="primer_apellido_madre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"  onblur="validarApMadre()">                                
                              </td>
                            <td><label>Segundo apellido</label><br>  </td>
                            <td> <input id="segundo_apellido_madre" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                        </tr>                       
                        
                         <tr>
                            <td>
                                <label>Nacionalidad</label><br>
                            </td>
                            <td>
                 <div  class="ui-widget">
                        <select style="width: 200px" id="nacionalidad_madre" class="form-control">
                            <option value="0">========</option>
                            <?php
                            foreach ($cat_paises as $item) {
                                ?>
                              <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[9]; ?></option>
                                <?php
                                }
                                ?>
                  </select>
                  </div>                               
                             </td>
                            <td align="right"> Finado </td>
                            <td align="left"> <input id="finadoMadre" type="checkbox"> </td>
                        </tr>
                </table>  
                
<!--**************************************DATOS DE LA DEFUNCION***************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos de la Defunción</strong></h4> 
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td width="30%">
                                <label>Fecha*</label><br>
                            </td>
                            <td width="30%">
                                <input id="fechaDefuncion" onblur="validarFechas(this.value, 'fechaDefuncion')" onKeyUp = "this.value=formateafecha(this.value, 'fechaDefuncion');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">
                              </td>
                            <td align="right"> 
                                <label>Hora</label><br>
                            </td>
                            <td width="20%">
                               <div class="input-group">
                                   <input id="hrDefuncion" type="text" class="col-xs-3" maxlength="2" onkeypress="return validarSoloNumeros(event)" onblur="validaHoras()">
                                <strong><input value=":" disabled="true" type="text" class="col-xs-2" style="border: #ffffff"></strong>
                                <input id="minDefuncion" type="text" class="col-xs-3" maxlength="2" onkeypress="return validarSoloNumeros(event)" onblur="validaHoras()"> 
<!--                            <input style="width: 70px"  id="HORA_NACIMIENTO" placeholder="HH:MM" name="hora" type="text" maxlength="5" class="validaNumeros" onKeyUp = "this.value=validarHora(this.value);">  -->
                               </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Causa*</label><br>
                            </td>
                            <td colspan="3">
                                <input id="causa" type="text" class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>  
                            <td> </td>  
                            <td> </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Lugar*</label><br>
                            </td>
                            <td>
                                <input id="lugar" type="text" class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td align="right"><label>Certificado No.*</label><br>  </td>
                            <td align="left"><input id="noCertificado" type="text" class="form-control" onkeypress="return validarSoloNumeros(event)">                                
                           </td>
                        </tr>                         
                        <tr>
                            <td>
                                <label>Nombre del médico que certifico la defunción*</label><br>
                            </td>
                            <td>
                              <input id="nombre_medico" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>No. de cédula profesional*</label><br>
                            </td>
                            <td>
                              <input id="cedula" type="text" class="form-control" onkeypress="return validarSoloNumeros(event)">                            
                             </td>
                        </tr>                         
                </table>
<!--**************************************NOTA DEL ACTA***************************************************-->   
    <h4 align="center" style="background-color:#CCCCCC"><strong>Anotaciones</strong></h4> 
               <table class="table table-condensed" border="0" align="center">
                        <tr>
                            <td width="15%">
                                <label>Notas del Acta (MAX 255 caracteres)</label><br>
                            </td>
                            <td>
                                <textarea maxlength="255" class="form-control" rows="2" cols="100" id="nota_acta"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Anotaciones Marginales</label><br>
                            </td>
                            <td>
                                <textarea class="form-control" rows="2" cols="100" id="notaMarginal"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>
                        </tr>
                        <tr>
                          <td>
                               <label>Estado de la Certificación</label><br>                                
                            </td>  
                           <td>
                               <div  class="ui-widget">
                               <select style="width: 200px" id="estado_certificado">
                                    <?php
                                    foreach ($cat_edoCertificacion as $item) {
                                        ?>
                                      <option value="<?php echo $item['0'] ?>" ><?php echo $item[1]; ?></option>
                                        <?php
                                        }
                                        ?>
                                </select>
                               </div>  
                            </td>                            
                      </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button type="submit" id="grabar_defuncion" class="btn btn-success btn-lg">
                                  <span class="glyphicon glyphicon-ok"></span> Grabar
                               </button>
                                <button type="button" id="cancelar" class="btn btn-danger btn-lg">
                                   <span class="glyphicon glyphicon-remove"></span> Cancelar
                                </button>
                            </td>
                             <td>                                
                            </td>
                        </tr>
                </table>
    </div>
<!--  FIN DIV NORMAL-->
        <div id="divInscripcion"  style="display: none">
          <!--**************************************DATOS DEL FINADO*******************************************************-->  
    <h4 align="center" style="background-color:#CCCCCC"><strong>Datos del Finado</strong></h4> 
                <table  class="table table-condensed" border="0" align="center">
                        <tr>
                            <td>
                                <label>Nombre(s)*</label><br>
                            </td>
                            <td>
                            <input id="nombres_ins" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td> <label>Primer apellido*</label><br> </td>
                            <td><input id="primer_apellido_ins" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                             </td>
                            <td><label>Segundo apellido</label><br> </td>
                            <td><input id="segundo_apellido_ins" type="text" class="form-control"  onkeypress="return soloLetras(event)" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                        </tr>                        
                         <tr>
                            <td>
                                <label>Sexo</label><br>
                            </td>
                            <td>
                           <div  class="ui-widget">
                            <select style="width: 200px" id="sexo_ins" class="form-control">
                                  <option value="0">========</option>
                                  <?php
                                  foreach ($cat_sexo as $item) {
                                      ?>
                                    <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[2]; ?></option>
                                      <?php
                                  }
                                  ?>
                            </select>
                            </div>                                  
                            </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Fecha de Nacimiento*</label><br>
                            </td>
                            <td>
                                <input id="fechaNac_ins" onblur="validarFechas(this.value, 'fechaNac_ins')" onKeyUp = "this.value=formateafecha(this.value, 'fechaNac_ins');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">
                             </td>
                            <td><label>Edad*</label><br> </td>
                            <td width="30%" align="center">
                                 <div  class="ui-widget">
                            <input id="edad_ins" maxlength="3" type="text" size="5" class="validaNumeros" onkeypress="return validarSoloNumeros(event)">
                                                          
                                <select style="width: 200px" id="tiempo_ins" class="form-control">
                                  <option value="==">========</option>
                                  <option value="Años">Años</option>
                                  <option value="Meses">Meses</option>
                                  <option value="Días">Días</option>
                                  <option value="Horas">Horas</option>
                                  <option value="Minutos">Minutos</option>
                                  <option value="Segundos">Segundos</option>
                                </select>
                                </div>
                            </td>
                            <td align="center"> <input id="masEdadIns" type="checkbox" onchange="mostrarMasEdadIns()"> Otra</td>
                            <td><input id="otraEdadIns" style="display: none; text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control"> </td>
                        </tr>  
                      <tr>
                            <td>
                                <label>Fecha de Defuncion*</label><br>
                            </td>
                            <td>
                                <input id="fecha_defuncion_ins" onblur="validarFechas(this.value, 'fecha_defuncion_ins')" onKeyUp = "this.value=formateafecha(this.value, 'fecha_defuncion_ins');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">
                            </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                      </tr>
                      <tr>
                            <td>
                                <label>Compareciente(s)*</label><br>
                            </td>
                            <td>
                            <div  class="ui-widget">
                                 <select style="width: 200px" id="compareciente_ins">
                                    <?php
                                    foreach ($cat_comparece as $item) {
                                    ?>
                                    <option value="<?php echo $item['0']; ?>"><?php echo $item[1]; ?></option>
                                    <?php
                                    }
                                    ?>                                       
                                 </select>
                                 </div>                                
                            </td>
                            <td> </td>
                            <td> </td>
                            <td><label>Pa&Iacute;s de Fallecimiento*</label><br> </td>
                            <td> <div  class="ui-widget">
                                <select style="width: 200px" id="ID_PAIS_INS" class="form-control">
                              <option value="0">========</option>
                              <?php
                              foreach ($cat_paises as $item) {
                                  ?>
                                <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[5]; ?></option>
                                  <?php
                                  }
                                  ?>
                                <option value="00">OTRO</option>
                        </select></div>
                            </td>                            
                      </tr>
                       <tr>
                           <td colspan="6" align="center">
                                <label>Transcripcion</label><br>
                                <label>(MAX 8000 caracteres)</label><br>
                            </td>                            
                      </tr>
                      <tr>
                           <td colspan="6" align="center">
                                <textarea maxlength="8000" class="form-control" rows="15" cols="100" id="transcripcion"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>                            
                      </tr>
                      <tr>
                           <td colspan="6" align="center">
                               <label>NOTAS:</label><br>
                                <textarea class="form-control" rows="2" cols="100" id="NOTAS"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>                            
                      </tr>
                      <tr>
                             <td colspan="6" align="center">
                                <label>Anotaciones Marginales</label><br>
                                <textarea class="form-control" rows="2" cols="100" id="notaMarginalIns"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>
                        </tr>
                      <tr>
                          <td colspan="3" align="right">
                               <label>Estado de la Certificación</label><br>                                
                            </td>  
                           <td colspan="3" align="left">
                                <div  class="ui-widget">
                               <select style="width: 200px" id="estado_certificado_ins">
                                    <?php
                                    foreach ($cat_edoCertificacion as $item) {
                                        ?>
                                      <option value="<?php echo $item['0'] ?>" ><?php echo $item[1]; ?></option>
                                        <?php
                                        }
                                        ?>
                                </select>
                               </div>  
                            </td>                            
                      </tr>
                      <tr>
                            <td colspan="6" align="center"><br> 
                                <button type="button" id="grabar_defuncion_ins" class="btn btn-success btn-lg">
                                  <span class="glyphicon glyphicon-ok"></span> Grabar
                               </button>
                                <button type="button" id="cancelar_ins" class="btn btn-danger btn-lg">
                                   <span class="glyphicon glyphicon-remove"></span> Cancelar
                                </button>
                            </td>
                             <td>                                
                            </td>
                        </tr>
              </table>   
        </div>
</div><!--END div container-->

<div id="avisoDefuncion" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Aviso Sindico o MP</h4>
                </div>
                <div class="modal-body"> 
                    <label>NO. OFICIO:</label><br>
                    <input id="noOficioAviso" onkeypress="ValidaOficio()" type="text" class="form-control"><br>
                
                    <label>FECHA:</label><br>
                    <input id="fechaAviso" onblur="validarFechas(this.value, 'fechaAviso')" onKeyUp = "this.value=formateafecha(this.value, 'fechaAviso');" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" type="text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="generar_Aviso">OK</button>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
/*---------------------------------------------------------------
 * 
 * FUNCION: ready()
 ----------------------------------------------------------------*/     
$( document ).ready(function() {  
    listaEstadosMexico();//Carga la lista de estados del pais de Mexico   
    filtrarOptions();//Carga dinamica de las opciones de los select
           
    $(".nacionalidad_difunto").combobox({
        select: function (event, ui) {
            //Validar que coincida la nacionalidad con el pais.
                if($(".ID_PAIS_REG").val() !== $(".nacionalidad_difunto").val()){
                   $("#nacionalidad_difunto").css("border-color","#FF0000");                   
                   $("#ID_PAIS_REG").css("border-color","#FF0000");
                   
                   $('#errorNac').text('El Pais no coincide con la Nacionalidad.');
                   $('#errorPais').text('El Pais no coincide con la Nacionalidad.');
                }else{
                  $("#nacionalidad_difunto").css("border-color","#FFFFFF");
                  $("#ID_PAIS_REG").css("border-color","#FFFFFF");
                  $('#errorNac').text('');
                  $('#errorPais').text('');
                }              
        }
    });      
    
        $("#grabar_defuncion").click(function() {            
            guardarActaDefuncion();
        });

        $("#grabar_defuncion_ins").click(function() {            
            guardarActaDefuncionIns();
        }); 
        
        $("#generar_Aviso").click(function() {            
            generarNota();
        });
        
        $("#popupAviso").click(function() {            
            var popup=$("#popupAviso").is(':checked') ? 1 : 0;
            if(popup===1) {
                $('#avisoDefuncion').modal('show');
            }
        });
        
        
});//END Ready
 
 
  function IsNumeric(valor){
        var log=valor.length; var sw="S";
        for (x=0; x<log; x++)
        { v1=valor.substr(x,1);
        v2 = parseInt(v1);
        //Compruebo si es un valor numérico
        if (isNaN(v2)) { sw= "N";}
        }
        if (sw==="S") {return true;} else {return false; }
    }
    
/*---------------------------------------------------------------
 * PARA VALIDAR EL FORMATO DE FECHA Y FORMAR LA ESTRUCTURA DD/MM/YYYY
 * FUNCION: formateafecha(fecha)
 ----------------------------------------------------------------*/
    var primerslap=false;
    var segundoslap=false;
    
    function formateafecha(fecha, campo){
        var long = fecha.length;
        var dia;
        var mes;
        var ano;
        
        if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2);
            if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; }
            else { fecha=""; primerslap=false;}
        }else{ dia=fecha.substr(0,1);
            if (IsNumeric(dia)==false)
            {fecha="";}
            if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; }
        }
        
        if ((long>=5) && (segundoslap==false)){ mes=fecha.substr(3,2);
            if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; }
            else { fecha=fecha.substr(0,3);; segundoslap=false;}
        }else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } }
        
        if (long>=7){
            ano=fecha.substr(6,4);
            if(ano!='0000'){
            if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); }
            else {
                var f = new Date();//fecha actual
                var fecha_registro=$("#"+ campo +"").val();
                var ano_reg=fecha_registro.substr(6,4);
                //alert(ano_reg);                
                if (long==10){ if ((ano==0) || (ano<1900) || (ano>f.getFullYear()) || (ano>ano_reg)) { 
                        fecha=fecha.substr(0,6); 
                        // //alert("Año incorrecto"); 
                 } }
               }
            }
        }       

        if (long>=10){
            fecha=fecha.substr(0,10);
            dia=fecha.substr(0,2);
            mes=fecha.substr(3,2);
            ano=fecha.substr(6,4);
            // Año no viciesto y es febrero y el dia es mayor a 28
            if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; }
        }       
        
        return (fecha);
    }    
    
/*---------------------------------------------------------------
 * PARA VALIDAR EL FORMATO DE HORA Y FORMAR LA ESTRUCTURA HH:MM
 * FUNCION: validarHora(hora)
 ----------------------------------------------------------------*/
    var primersl=false;
    var segundosl=false;

    function validarHora(hora){
        var long = hora.length;
        var hh;
        var mm;
        if ((long>=2) && (primersl==false)) { hh=hora.substr(0,2);
            if ((hh<=24) && (hh!="00")) { hora=hora.substr(0,2)+":"+hora.substr(3,7); primersl=true; }
            else { hora=""; primersl=false;}
        }else{       
            if ((long<=2) && (primersl=true)) {hora=hora.substr(0,1); primersl=false; }
        }         
        if (long>=4){ mm=hora.substr(3,2);
            if ((mm<60) && (mm!="00")) { hora=hora.substr(0,5); }
            else { hora=hora.substr(0,3);}
        }   
        /*
        if (long>=5){
            hora=hora.substr(0,10);
            hh=hora.substr(0,2);
            mm=hora.substr(3,2);                                    
        }*/
        return (hora);
    }
 
 /*---------------------------------------------------------------
 * 
 * FUNCION: generarNota()-- Carga los datos en la nota en caso de ser por aviso
 * del Sindico o MP. 
 ----------------------------------------------------------------*/  
    function generarNota(){
        var noOficio = '';
        var fecAviso = '';
        var msg = '';

        if ($("#noOficioAviso").val() !== 'undefined') {
          noOficio = $("#noOficioAviso").val();
        }
        if ($("#fechaAviso").val() !== 'undefined') {
          fecAviso = $("#fechaAviso").val();
        }
        if(noOficio!=='' || fecAviso!==''){
            msg = 'EL PRESENTE REGISTRO SE ASENTO POR AVISO DEL AGENTE DEL M:P SEGÚN OFICIO NO. ' + noOficio + ' DE FECHA ' + fecAviso + '.';
        }
        
         //alert(msg);       
        $('#nota_acta').val(msg);
        $('#avisoDefuncion').modal('hide');
    }  

    
/*---------------------------------------------------------------
 * 
 * FUNCION: guardarActaDefuncion()
 ----------------------------------------------------------------*/  
    function guardarActaDefuncion(){
//        alert(
//                'libro:'+ $("#libro").val()+'\n'+
//                'cuadernillo:'+ $("#cuadernillo").val()+'\n'+
//                'tomo:'+ $("#tomo").val()+'\n'+
//                'tomoBis:'+ $("#tomoBis").val()+'\n'+
//                'oficialia:'+  $("#oficialia").val()+'\n'+
//                'noActa:'+  $("#noActa").val()+'\n'+                
//                'fechaReg:'+  $("#FECHA_REGISTRO").val()+'\n'+
//                'crip:'+  $("#crip").val()+'\n'+
//                'curp:'+  $("#curp").val()+'\n'+
//                'nombres:'+  $("#nombres").val()+'\n'+
//                'primer_apellido:'+  $("#primer_apellido").val()+'\n'+
//                'segundo_apellido:'+  $("#segundo_apellido").val()+'\n'+
//                'sexo:'+  $("#ID_SEXO").val()+'\n'+
//                'fechaNac:'+  $("#fechaNac").val()+'\n'+
//                'edad:'+  $("#edad").val()+'\n'+
//                'tiempo_edad:'+  $("#tiempoEdad").val()+'\n'+
//                'ID_PAIS:'+  $("#ID_PAIS_REG").val()+'\n'+
//                'ID_ESTADO:'+  $(".ID_ESTADO").val()+'\n'+
//                'ESTADO_NACIMIENTO_OCULTO:'+  $("#ESTADO_NACIMIENTO_OCULTO").val()+'\n'+
//                'ID_MUNICIPIO:'+  $(".ID_MUNICIPIO").val()+'\n'+
//                'MUNICIPIO_NACIMIENTO_OCULTO:'+  $("#MUNICIPIO_NACIMIENTO_OCULTO").val()+'\n'+
//                'ID_LOCALIDAD:'+  $(".ID_LOCALIDAD").val()+'\n'+ 
//                'LOCALIDAD_NACIMIENTO_OCULTO:'+  $("#LOCALIDAD_NACIMIENTO_OCULTO").val()+'\n'+
//                'edo_civil_difunto:'+  $("#edo_civil_difunto").val()+'\n'+
//                'nacionalidad_difunto:'+  $("#nacionalidad_difunto").val()+'\n'+
//                'nombres_conyugue:'+  $("#nombres_conyugue").val()+'\n'+
//                'primer_apellido_conyugue:'+  $("#primer_apellido_conyugue").val()+'\n'+            
//                'segundo_apellido_conyugue:'+  $("#segundo_apellido_conyugue").val()+'\n'+
//                'finadoCony:'+  $("#finadoCony").val()+'\n'+
//                'nacionalidad_conyugue:'+  $("#nacionalidad_conyugue").val()+'\n'+
//                'nombres_padre:'+  $("#nombres_padre").val()+'\n'+
//                'primer_apellido_padre:'+  $("#primer_apellido_padre").val()+'\n'+
//                'segundo_apellido_padre:'+  $("#segundo_apellido_padre").val()+'\n'+
//                'finadoPadre:'+  $("#finadoPadre").val()+'\n'+
//                'nacionalidad_padre:'+  $("#nacionalidad_padre").val()+'\n'+
//                'nombres_madre:'+  $("#nombres_madre").val()+'\n'+
//                'primer_apellido_madre:'+  $("#primer_apellido_madre").val()+'\n'+
//                'segundo_apellido_madre:'+  $("#segundo_apellido_madre").val()+'\n'+
//                'finadoMadre:'+  $("#finadoMadre").val()+'\n'+
//                'nacionalidad_madre:'+  $("#nacionalidad_madre").val()+'\n'+
//                'fechaDefuncion: '+$("#fechaDefuncion").val()+'\n'+
//                'hrDefuncion:'+  $("#hrDefuncion").val()+'\n'+
//                'minDefuncion:'+  $("#minDefuncion").val()+'\n'+
//                'causa:'+  $("#causa").val()+'\n'+
//                'lugar:'+  $("#lugar").val()+'\n'+
//                'noCertificado:'+  $("#noCertificado").val()+'\n'+
//                'donde:'+  $("#donde").val()+'\n'+
//                'tipo_Defuncion:'+  $("#tipo_Defuncion").val()+'\n'+
//                'nombre_medico:'+  $("#nombre_medico").val()+'\n'+
//                'cedula:'+  $("#cedula").val()+'\n'+
//                'nota_acta:'+  $("#nota_acta").val()+'\n'+
//                'notaMarginal:'+  $("#notaMarginal").val()+'\n'+
//                'estado_certificado:'+  $("#estado_certificado").val()
//                )
        var cuadernillo=$("#cuadernillo").is(':checked') ? 1 : 0;
        var finadoCony=$("#finadoCony").is(':checked') ? 'SI' : 'NO';
        var finadoPadre=$("#finadoPadre").is(':checked') ? 'SI' : 'NO';
        var finadoMadre=$("#finadoMadre").is(':checked') ? 'SI' : 'NO';
        var otraEdad=$("#masEdad").is(':checked') ? $("#otraEdad").val() : '';
            
      $.ajax({
            type: "POST",
            url: "consultas_defunciones.php",
            data: {
                ACTION: "4",
                libro: $("#libro").val(),
                cuadernillo: cuadernillo,
                tomo: $("#tomo").val(),
                tomoBis: $("#tomoBis").val(),
                oficialia: $("#oficialia").val(),
                noActa: $("#noActa").val(),
                actaBis: $("#actaBis").val(),
                anoReg:$("#anoReg").val(),
                estadoReg: $("#estadoReg").val(),
                municipioReg: $("#municipioReg").val(),
                cadena: $("#cadena").val(),
                fechaReg: $("#FECHA_REGISTRO").val(),
                crip: $("#crip").val(),
                curp: $("#curp").val(),
                nombres: $("#nombres").val(),
                primer_apellido: $("#primer_apellido").val(),
                segundo_apellido: $("#segundo_apellido").val(),
                sexo: $("#ID_SEXO").val(),
                fechaNac: $("#fechaNac").val(),
                edad: $("#edad").val(),
                tiempo_edad: $("#tiempoEdad").val(),
                otra_edad: otraEdad,
                id_pais: $("#ID_PAIS_REG").val(),
                id_estado: $(".ID_ESTADO").val(),
                des_estado_nacimiento:  $("#ESTADO_NACIMIENTO_OCULTO").val(),
                id_municipio: $(".ID_MUNICIPIO").val(),
                des_municipio_nacimiento:  $("#MUNICIPIO_NACIMIENTO_OCULTO").val(),
                id_localidad: $(".ID_LOCALIDAD").val(),  
                des_localidad_nacimiento:  $("#LOCALIDAD_NACIMIENTO_OCULTO").val(),
                edo_civil_difunto: $("#edo_civil_difunto").val(),
                nacionalidad_difunto: $("#nacionalidad_difunto").val(),
                nombres_conyugue: $("#nombres_conyugue").val(),
                primer_apellido_conyugue: $("#primer_apellido_conyugue").val(),            
                segundo_apellido_conyugue: $("#segundo_apellido_conyugue").val(),
                finadoCony: finadoCony,
                nacionalidad_conyugue: $("#nacionalidad_conyugue").val(),
                nombres_padre: $("#nombres_padre").val(),
                primer_apellido_padre: $("#primer_apellido_padre").val(),
                segundo_apellido_padre: $("#segundo_apellido_padre").val(),
                finadoPadre: finadoPadre,
                nacionalidad_padre: $("#nacionalidad_padre").val(),
                nombres_madre: $("#nombres_madre").val(),
                primer_apellido_madre: $("#primer_apellido_madre").val(),
                segundo_apellido_madre: $("#segundo_apellido_madre").val(),
                finadoMadre: finadoMadre,
                nacionalidad_madre: $("#nacionalidad_madre").val(),
                fechaDefuncion: $("#fechaDefuncion").val(),
                hrDefuncion: $("#hrDefuncion").val(),
                minDefuncion: $("#minDefuncion").val(),
                causa: $("#causa").val(),
                lugar: $("#lugar").val(),
                noCertificado: $("#noCertificado").val(),
                // donde: $("#donde").val(),
                // tipo_Defuncion: $("#tipo_Defuncion").val(),
                nombre_medico: $("#nombre_medico").val(),
                cedula: $("#cedula").val(),
                nota_acta: $("#nota_acta").val(),
                notaMarginal: $("#notaMarginal").val(),
                estado_certificado: $("#estado_certificado").val()
            },
            //timeout: 28000,
           error: function(data) {
                msjDialog(data);
               
            },
            success: function(data) {
                msjDialog(data);
                              
            }
        });//END Ajax   
        
    }  
 /*---------------------------------------------------------------
 * 
 * FUNCION: guardarActaDefuncionIns()-- GUARDA LOS DATOS DE LA ACTA DE 
 * DEFUNCION DE TIPO INSCRIPCION.
 ----------------------------------------------------------------*/  
    function guardarActaDefuncionIns(){
        var otraEdadIns=$("#masEdadIns").is(':checked') ? $("#otraEdadIns").val() : '';
        
        $.ajax({
            type: "POST",
            url: "consultas_defunciones.php",
            data: {
                ACTION: "5",
                libro: $("#libro").val(),
                tomo: $("#tomo").val(),
                tomoBis: $("#tomoBis").val(),
                oficialia: $("#oficialia").val(),
                noActa: $("#noActa").val(),
                actaBis: $("#actaBis").val(),
                anoReg:$("#anoReg").val(),
                estadoReg: $("#estadoReg").val(),
                municipioReg: $("#municipioReg").val(),
                cadena: $("#cadena").val(),
                fechaReg: $("#FECHA_REGISTRO").val(),                
                nombres: $("#nombres_ins").val(),
                primer_apellido: $("#primer_apellido_ins").val(),
                segundo_apellido: $("#segundo_apellido_ins").val(),
                sexo: $("#sexo_ins").val(),
                fechaNac: $("#fechaNac_ins").val(),
                edad: $("#edad_ins").val(),
                tiempo_edad: $("#tiempo_ins").val(),
                otraEdad: otraEdadIns,                
                fechaDefuncion: $("#fecha_defuncion_ins").val(),
                compareciente: $("#compareciente_ins").val(),                
                id_pais: $("#ID_PAIS_INS").val(),                
                transcripcion: $("transcripcion").val(),
                notas:  $("#NOTAS").val(),
                notaMarginal: $("#notaMarginalIns").val(),
                estado_certificado: $("#estado_certificado_ins").val()                
            },
            //timeout: 28000,
           error: function(data) {
                msjDialog(data);
               
            },
            success: function(data) {
                msjDialog(data);
                              
            }
        });//END Ajax   
        
    }  

</script>

</body>
</html>