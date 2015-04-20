<?php
/* 
    Author: Brenda 
*/

#Catalogos
require '../../../class/catalogos.class.php';
$catalogo = new catalogos();
$cat_paises = $catalogo->cat_paises();
//$cat_entidadesFed = $catalogo->cat_entidadesFed();
//$cat_municipios = $catalogo->cat_municipios();
//$cat_localidades = $catalogo->cat_localidades();
$cat_sexo = $catalogo->cat_sexo();
$cat_estado_registrado = $catalogo->cat_estado_registrado();
$cat_comparece = $catalogo->cat_comparece();
//print_r($cat_paises);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Captura Nacimientos</title>
  
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
        
        <style>
            body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 11px;
            }          
            input {
                 border: 1px solid #C5C5C5;
                 padding: 4px;
                 font-size: 1em;
                 background-color: white;
                 width: 16em;
                 font-family: Consolas, monospace;
             }  
            label {

                font-weight: bold;
                margin-bottom:0.1px;
            }                         
        </style>
               
        <script>
            $( "#FECHA_REGISTRO" ).datepicker();
            $( "#FECHA_NACIMIENTO" ).datepicker();
        </script>  
        
</head>

<body>

    
<div class="container">
<form  role="form" id="capturaNacimiento" name="capturaNacimiento"> 
    
    <!--<h3 align="center">CAPTURA DE ACTA DE NACIMIENTO</h3>-->
    <table class="table table-condensed" border="0" align="center">
                <tr class="bg-danger">
                    <th id="col_cuadernillo">CUADERNILLO&nbsp;<input style="width: 25px" id="CUADERNILLO" type="checkbox" value="1"></th>
                    <th>INSCRIPCI&Oacute;N&nbsp;<input style="width: 25px" id="INSCRIPCION" type="checkbox" value="1"></th>
                    <th>TOMO<input style="width: 70px" type="text" name="TOMO" size="2" value="" disabled></th>
                    <th>TOMO BIS<input style="width: 70px" type="text" name="TOMOBIS" size="2" value="" disabled></th>                     
                    <th>OFICIAL&Iacute;A<input style="width: 70px" id="OFICIALIA" type="text" maxlength="5" class="validaNumeros" disabled></th>
                    <th>N&deg; ACTA*<input style="width: 70px" id="ACTA" type="text" maxlength="5" class="validaNumeros" required=""></th>
                    <th>FECHA DE REGISTRO*<input style="width: 100px" id="FECHA_REGISTRO" placeholder="DD/MM/YYYY" name="fecha" type="text" size="10" maxlength="10" onKeyUp = "this.value=formateafecha(this.value);" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="Formato incorrecto, debe ser dd/mm/yyyy" required=""></th>
                </tr>
    </table>
    
<!--**************************************DATOS DEL REGISTRADO*******************************************************-->  
<h5 align="center"><font color="#A05A33"><strong>DATOS DE IDENTIFICACI&Oacute;N DEL REGISTRADO</strong></font></h5> 
                <table  class="table table-condensed" border="0" align="center">
                        <tr>
                            <td>
                                <label>PRIMER APELLIDO*</label>
                                <input style="width: 130px" id="PRIMER_APELLIDO" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </td>
                            <td>
                                <label>SEGUNDO APELLIDO*</label>
                                <input style="width: 130px" id="SEGUNDO_APELLIDO" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>NOMBRE*</label>
                                <input style="width: 130px" id="NOMBRE" type="text"  class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>FECHA Y HORA DE NACIMIENTO*</label>
                                <input style="width: 100px" id="FECHA_NACIMIENTO" placeholder="DD/MM/YYYY" name="fecha" type="text" size="10" maxlength="10" onKeyUp = "this.value=formateafecha(this.value);" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="Formato incorrecto, debe ser dd/mm/yyyy">
                                <input style="width: 70px"  id="HORA_NACIMIENTO" placeholder="HH:MM" name="hora" type="text" maxlength="5" class="validaNumeros" onKeyUp = "this.value=validarHora(this.value);">                               
                            </td>                           
                        </tr>
                        
                        <tr id="fila">
                            <td>
                                
                                <label id="etiquetaPais">PA&Iacute;S DE NACIMIENTO*</label><br>
                                <div  class="ui-widget">
                                <select style="width: 200px" id="ID_PAIS_REG">
                                    <option value="0">========</option>
                                    <?php
                                    foreach ($cat_paises as $item) {
                                        ?>
                                        <option value="<?php echo $item['0']?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[1]; ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="00">OTRO</option>
                                </select>
                                </div>
                            </td>
                            
                            <td>
                                <label>ENTIDAD FEDERATIVA*</label><br>
                                <div  class="ui-widget">
                                <select style="width: 200px" id="ID_ESTADO"></select>
                                <div id="ID_ESTADO_OCULTO" style="display: none;"><br>
                                <label>Otra Entidad</label><br>
                                <input id="ESTADO_NACIMIENTO" style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div>
                            </td>    
                          
                            <td>
                                <label>MUNICIPIO O TENENCIA*</label><br>
                                <div  class="ui-widget">
                                <select style="width: 200px" id="ID_MUNICIPIO"></select>
                                <div id="ID_MUNICIPIO_OCULTO" style="display: none;"><br>
                                <label>Otro Municipio</label><br>
                                <input id="MUNICIPIO_NACIMIENTO" style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div>
                            </td> 
                            
                            <td>
                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOCALIDAD*</label><br>
                                <div  class="ui-widget">&nbsp;&nbsp;&nbsp;
                                <select style="width: 200px" id="ID_LOCALIDAD"></select>
                                <div id="ID_LOCALIDAD_OCULTO" style="display: none;"><br>
                                <label>Otra Localidad</label><br>
                                <input id="LOCALIDAD_NACIMIENTO" style="width: 200px" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                </div>
                            </td>                        

                        </tr>  
                        
                                                                                                                                            
                        
                        <tr>
                            <td>
                                <label>SEXO*</label><br>
                                <div  class="ui-widget">
                                <select style="width: 200px" id="ID_SEXO">
                                    <option value="0">========</option>
                                    <?php
                                    foreach ($cat_sexo as $item) {
                                        ?>
                                        <option value="<?php echo $item['0']; ?>"><?php echo $item[1]; ?></option>
                                        <?php
                                    }
                                    ?>                                                                  
                                </select> 
                                </div>
                            </td>
                            <td>
                                <label>STATUS DE REGISTRO*</label><br>
                                <div  class="ui-widget">
                                <select style="width: 200px" id="ID_REGISTRADO">
                                    <option value="0">========</option>
                                    <?php
                                    foreach ($cat_estado_registrado as $item) {
                                        ?>
                                        <option value="<?php echo $item['0']; ?>" <?php if($item[0]=='1') echo "selected"; ?>><?php echo $item[1]; ?></option>
                                        <?php
                                    }
                                    ?>                                     
                                </select>
                                </div>
                            </td>
                            <td>
                                 <label>COMPARECIO*</label><br>
                                 <div  class="ui-widget">
                                 <select style="width: 200px" id="ID_COMPARECE">
                                     <option value="0" selected>========</option>
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
                            <td></td>
                        </tr>                          
                </table>

<!--**************************************DATOS DEL PADRE***************************************************-->  

 <h5 align="center"><font color="#A05A33"><strong>DATOS DEL PADRE</strong></font></h5> 
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td>          
                                <label>PRIMER APELLIDO*</label>
                                <input style="width: 130px" id="PRIMER_APELLIDO_PADRE" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </td>
                            <td>
                                <label>SEGUNDO APELLIDO*</label>
                                <input style="width: 130px" id="SEGUNDO_APELLIDO_PADRE" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>NOMBRE*</label>
                                <input style="width: 130px" id="NOMBRE_PADRE" type="text"  class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>EDAD</label>
                                <input id="EDAD_PADRE" style="width: 40px" type="text" maxlength="3" class="validaNumeros">                                
                            </td>
                            <td>
                              <label>NACIONALIDAD*</label>
                              <div  class="ui-widget">
                              <select  style="width: 150px" id="NACIONALIDAD_PADRE">
                                    <option value="0">========</option>
                                    <?php
                                    foreach ($cat_paises as $item) {
                                        ?>
                                        <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[2]; ?></option>
                                        <?php
                                    }
                                    ?>
                              </select>
                              </div>
                            </td>
                        </tr>
                </table> 


<!--**************************************DATOS DE LA MADRE***************************************************-->  
<h5 align="center"><font color="#A05A33"><strong>DATOS DE LA MADRE</strong></font></h5>   
                <table class="table table-condensed" border="0" align="center" >
                        <tr>
                            <td>          
                                <label>PRIMER APELLIDO*</label>
                                <input style="width: 130px" id="PRIMER_APELLIDO_MADRE" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </td>
                            <td>
                                <label>SEGUNDO APELLIDO*</label>
                                <input style="width: 130px" id="SEGUNDO_APELLIDO_MADRE" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">                                
                            </td>
                            <td>
                                <label>NOMBRE*</label>
                                <input style="width: 130px" id="NOMBRE_MADRE" type="text" class="validaLetras" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </td>
                            <td>
                                <label>EDAD</label>
                                <input id="EDAD_MADRE" style="width: 40px" type="text" maxlength="3" class="validaNumeros">                                
                            </td>
                            <td>
                                <label>NACIONALIDAD*</label>
                              <div  class="ui-widget">
                              <select style="width: 150px" id="NACIONALIDAD_MADRE">
                                    <option value="0">========</option>
                                    <?php
                                    foreach ($cat_paises as $item) {
                                        ?>
                                        <option value="<?php echo $item['0'] ?>" <?php if($item[0]=='223') echo "selected"; ?>><?php echo $item[2]; ?></option>
                                        <?php
                                    }
                                    ?>
                              </select>
                              </div>
                            </td>
                        </tr>
                </table> 

<!--**************************************NOTA DEL ACTA***************************************************-->   
<!--<h5 align="center"><font color="#A05A33"><strong>NOTA DEL ACTA</strong></font></h5>-->
               <table class="table table-condensed" border="0" align="center">
                        <tr><strong>NOTA DEL ACTA</strong>
                            <td id="nota_acta1">
                                <textarea id="NOTA_ACTA" class="form-control" rows="1" cols="1000" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>
                            <td id="nota_acta2">
                                <textarea style="display: none;" id="NOTA_ACTA_INSCRIPCION" class="form-control" rows="10" cols="1000" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    EN ___________________________ MUNICIPIO DE _________________________ DEL ESTADO DE MICHOACÁN DE OCAMPO,
                                    SIENDO LAS _____:______ ______________________________ DEL DIA _________________ DEL MES DE
                                    __________________ DE 20__ ____________________, ANTE MI
                                    _______________________ OFICIAL DE REGISTRO CIVIL, COMPARECE CON DOMICILIO EN LA CALLE: ________________, 
                                    NUMERO: __________  DE LA COLONIA ____________________________ DE ESTA CIUDAD, QUIEN DE ACUERDO A LO 
                                    ESTABLECIDO POR LOS ARTICULOS 38 Y 39 DEL CODIGO FAMILIAR VIGENTE EN EL ESADO, PIDE SE TRASLADE AL LIBRO 
                                    CORRESPONDIENTE EL ACTA DE NACIMIENTO QUE A LALETRA DICE:
                                    
                                </textarea>
                            </td>
                        </tr>
                </table>  

<!--**************************************NOTA MARGINAL***************************************************-->     
<!--<h5 align="center"><font color="#A05A33"><strong>NOTA MARGINAL</strong></font></h5> -->
                <table class="table table-condensed" border="0" align="center">                      
                        <tr><strong>NOTA MARGINAL</strong>
                            <td>
                                <textarea id="NOTA_MARGINAL" class="form-control" rows="1" cols="1000" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </td>
                        </tr>
                        <tr align="center">                            
                            <td><label>Estado de cerficicacion</label>
                              <select style="width: 120px" id="">
                                    <option value="NINGUNO">NINGUNO</option>                                    
                                    <option value="ALTERADO">ALTERADO</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="RESTRINGIDO">RESTRINGIDO</option>
                              </select>                                                                                                
                            </td>
                        </tr>                          
                        <tr align="center">
                            <td>
                                <button id="capturar_nacimiento">CAPTURAR ACTA</button>
                            </td>
                        </tr>                        
                </table> 
    
</form> 
</div><!--END div container-->


<script type="text/javascript">
/*---------------------------------------------------------------
 * 
 * FUNCION: ready()
 ----------------------------------------------------------------*/     
$( document ).ready(function() { 

    verificarSiesInscripcion();    
    validacionesGenerales();//Se aplian las validaciones conforme se llena el formulario    
    listaEstadosMexico();//Carga la lista de estados del pais de Mexico   
    filtrarOptions();//Carga dinamica de las opciones de los select
    
    //Evento: capturar_nacimiento     
    $("#capturar_nacimiento").click(function() {            
        var INSCRIPCION=$("#INSCRIPCION").is(':checked') ? 1 : 0; 
        if(INSCRIPCION===1){
            guardarInscripcionNacimiento();
        }else{
            guardarActaNacimiento();
            
        }                
    });     
    
    $( "#FECHA_REGISTRO" ).datepicker({
         dateFormat: "dd/mm/yy",
          yearRange: "1900:2015"
          //minDate: $("#FECHA_NACIMIENTO").val()
         
    });
    $( "#FECHA_NACIMIENTO" ).datepicker({
         dateFormat: "dd/mm/yy",
         yearRange: "1900:2015",
         maxDate: $("#FECHA_REGISTRO").val()
    });  
    
    
    
});//END Ready
      
    
/*---------------------------------------------------------------
 * MER PERMITIRA MANDAR LOS ELEMENTOS O VALORES QUE NECESITARE PARA EJECUTAR LA CONSULTA 
 * FUNCION: guardarActaNacimiento()
 ----------------------------------------------------------------*/  
    function guardarActaNacimiento(){
        var CUADERNILLO=$("#CUADERNILLO").is(':checked') ? 1 : 0;//falta   
        
        var ID_PAIS=$("#ID_PAIS_REG").val();
        
        var ID_ESTADO=$("#ID_ESTADO").val();
        var ESTADO_NACIMIENTO="0";
        
        var ID_MUNICIPIO=$("#ID_MUNICIPIO").val();
        var MUNICIPIO_NACIMIENTO="0";
        
        var ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
        var LOCALIDAD_NACIMIENTO="0";
        
        if($("#ID_ESTADO").val() ==="00"){ 
           ID_ESTADO="0"
           ESTADO_NACIMIENTO=$("#ESTADO_NACIMIENTO").val();;
        }        
        if($("#ID_MUNICIPIO").val() ==="00"){ 
           ID_MUNICIPIO="0"
           MUNICIPIO_NACIMIENTO=$("#MUNICIPIO_NACIMIENTO").val();;
        }        
        if($("#ID_LOCALIDAD").val() ==="00"){ 
           ID_LOCALIDAD="0"
           LOCALIDAD_NACIMIENTO=$("#LOCALIDAD_NACIMIENTO").val();;
        }          
        
            
      var PRIMER_APELLIDO=$("#PRIMER_APELLIDO").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO=$("#SEGUNDO_APELLIDO").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE=$("#NOMBRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var PRIMER_APELLIDO_PADRE=$("#PRIMER_APELLIDO_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO_PADRE=$("#SEGUNDO_APELLIDO_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE_PADRE=$("#NOMBRE_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var PRIMER_APELLIDO_MADRE=$("#PRIMER_APELLIDO_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO_MADRE=$("#SEGUNDO_APELLIDO_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE_MADRE=$("#NOMBRE_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOTA_ACTA=$("#NOTA_ACTA").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOTA_MARGINAL=$("#NOTA_MARGINAL").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 

  /*
        alert(
                "ACTA: "+$("#ACTA").val()+
                "\n CUADERNILLO: "+CUADERNILLO+ 
                "\n FECHA_REGISTRO: "+$("#FECHA_REGISTRO").val()+            
                "\n PRIMER APELLIDO: "+$("#PRIMER_APELLIDO").val()+
                "\n SEGUNDO APELLIDO: "+$("#SEGUNDO_APELLIDO").val()+
                "\n NOMBRE: "+$("#NOMBRE").val()+
                "\n FECHA_NACIMIENTO: "+$("#FECHA_NACIMIENTO").val()+
                "\n HORA_NACIMIENTO: "+$("#HORA_NACIMIENTO").val()+                
                "\n PAIS NACIMIENTO: "+ID_PAIS+                
                "\n ID ESTADO: "+ID_ESTADO+
                "\n ESTADO NACIMIENTO: "+ESTADO_NACIMIENTO+
                "\n ID MUNICIPIO: "+ID_MUNICIPIO+
                "\n MUNICIPIO NACIMIENTO: "+MUNICIPIO_NACIMIENTO+
                "\n ID LOCALIDAD: "+ID_LOCALIDAD+
                "\n LOCALIDAD NACIMIENTO: "+LOCALIDAD_NACIMIENTO+                
                "\n SEXO: "+$("#ID_SEXO").val()+
                "\n STATUS REGISTRO: "+$("#ID_REGISTRADO").val()+
                "\n COMPARECIO: "+$("#ID_COMPARECE").val()+                
                "\n PRIM AP PADRE: "+$("#PRIMER_APELLIDO_PADRE").val()+
                "\n SEG AP PADRE: "+$("#SEGUNDO_APELLIDO_PADRE").val()+
                "\n NOMBRE PADRE: "+$("#NOMBRE_PADRE").val()+
                "\n EDAD PADRE: "+$("#EDAD_PADRE").val()+                
                "\n NACIONALIDAD PADRE: "+$("#NACIONALIDAD_PADRE").val()+                
                "\n PRIM AP MADRE: "+$("#PRIMER_APELLIDO_MADRE").val()+
                "\n SEG AP MADRE: "+$("#SEGUNDO_APELLIDO_MADRE").val()+
                "\n NOMBRE MADRE: "+$("#NOMBRE_MADRE").val()+
                "\n EDAD MADRE: "+$("#EDAD_MADRE").val()+
                "\n NACIONALIDAD MADRE: "+$("#NACIONALIDAD_MADRE").val()+
                "\n NOTA DEL ACTA: "+$("#NOTA_ACTA").val()+
                "\n NOTA MARGINAL: "+$("#NOTA_MARGINAL").val()
        );*/


      $.ajax({
            type: "POST",
            url: "consultasCapturaNacimientos.php",
            data: {
                ACTION: "4",
                CUADERNILLO: CUADERNILLO,
                ACTA: $("#ACTA").val(),
                FECHA_REGISTRO: $("#FECHA_REGISTRO").val(),               
                PRIMER_APELLIDO: $.trim(PRIMER_APELLIDO),
                SEGUNDO_APELLIDO: $.trim(SEGUNDO_APELLIDO),
                NOMBRE: $.trim(NOMBRE),                
                FECHA_NACIMIENTO: $("#FECHA_NACIMIENTO").val(), 
                HORA_NACIMIENTO: $("#HORA_NACIMIENTO").val(),         
                ID_PAIS: ID_PAIS,                
                ID_ESTADO: ID_ESTADO,
                ESTADO_NACIMIENTO: ESTADO_NACIMIENTO,        
                ID_MUNICIPIO: ID_MUNICIPIO,        
                MUNICIPIO_NACIMIENTO: MUNICIPIO_NACIMIENTO,        
                ID_LOCALIDAD: ID_LOCALIDAD,
                LOCALIDAD_NACIMIENTO: LOCALIDAD_NACIMIENTO,         
                SEXO: $("#ID_SEXO").val(),
                STATUS_REGISTRO: $("#ID_REGISTRADO").val(),
                COMPARECIO: $("#ID_COMPARECE").val(),          
                PRIMER_APELLIDO_PADRE: $.trim(PRIMER_APELLIDO_PADRE),
                SEGUNDO_APELLIDO_PADRE: $.trim(SEGUNDO_APELLIDO_PADRE),
                NOMBRE_PADRE: $.trim(NOMBRE_PADRE),
                EDAD_PADRE: $("#EDAD_PADRE").val(),            
                NACIONALIDAD_PADRE: $("#NACIONALIDAD_PADRE").val(),
                PRIMER_APELLIDO_MADRE: $.trim(PRIMER_APELLIDO_MADRE),
                SEGUNDO_APELLIDO_MADRE: $.trim(SEGUNDO_APELLIDO_MADRE),
                NOMBRE_MADRE: $.trim(NOMBRE_MADRE),
                EDAD_MADRE: $("#EDAD_MADRE").val(),
                NACIONALIDAD_MADRE: $("#NACIONALIDAD_MADRE").val(),
                NOTA_ACTA: $.trim(NOTA_ACTA),
                NOTA_MARGINAL: $.trim(NOTA_MARGINAL)                
            },
            //timeout: 28000,
           error: function(data) {
                alert(data);
               
            },
            success: function(data) {
                alert(data);
                              
            }
        });//END Ajax 
        
    }  
    
/*---------------------------------------------------------------
 * EN CASO DE QUE SEA UNS INSCRIPCION SE EJECUTAR ESTA FUNCION PARA DAR DE ALTA 
 * FUNCION: guardarInscripcionNacimiento()
 ----------------------------------------------------------------*/  
    function guardarInscripcionNacimiento(){

      var PRIMER_APELLIDO=$("#PRIMER_APELLIDO").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO=$("#SEGUNDO_APELLIDO").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE=$("#NOMBRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var PRIMER_APELLIDO_PADRE=$("#PRIMER_APELLIDO_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO_PADRE=$("#SEGUNDO_APELLIDO_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE_PADRE=$("#NOMBRE_PADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var PRIMER_APELLIDO_MADRE=$("#PRIMER_APELLIDO_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var SEGUNDO_APELLIDO_MADRE=$("#SEGUNDO_APELLIDO_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOMBRE_MADRE=$("#NOMBRE_MADRE").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOTA_ACTA_INSCRIPCION=$("#NOTA_ACTA_INSCRIPCION").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," "); 
      var NOTA_MARGINAL=$("#NOTA_MARGINAL").val().replace("  "," ").replace("   "," ").replace("    "," ").replace("     "," ").replace("      "," ").replace("       "," ").replace("        "," ").replace("         "," ").replace("          "," ").replace("           "," ").replace("            "," ");        
      
       /* 
       alert(
                "ACTA: "+$("#ACTA").val()+
                "\n FECHA_REGISTRO: "+$("#FECHA_REGISTRO").val()+            
                "\n PRIMER APELLIDO: "+$("#PRIMER_APELLIDO").val()+
                "\n SEGUNDO APELLIDO: "+$("#SEGUNDO_APELLIDO").val()+
                "\n NOMBRE: "+$("#NOMBRE").val()+
                "\n FECHA_NACIMIENTO: "+$("#FECHA_NACIMIENTO").val()+
                "\n HORA_NACIMIENTO: "+$("#HORA_NACIMIENTO").val()+
                "\n SEXO: "+$("#ID_SEXO").val()+
                "\n STATUS REGISTRO: "+$("#ID_REGISTRADO").val()+
                "\n COMPARECIO: "+$("#ID_COMPARECE").val()+                
                "\n PRIM AP PADRE: "+$("#PRIMER_APELLIDO_PADRE").val()+
                "\n SEG AP PADRE: "+$("#SEGUNDO_APELLIDO_PADRE").val()+
                "\n NOMBRE PADRE: "+$("#NOMBRE_PADRE").val()+
                "\n EDAD PADRE: "+$("#EDAD_PADRE").val()+                
                "\n NACIONALIDAD PADRE: "+$("#NACIONALIDAD_PADRE").val()+                
                "\n PRIM AP MADRE: "+$("#PRIMER_APELLIDO_MADRE").val()+
                "\n SEG AP MADRE: "+$("#SEGUNDO_APELLIDO_MADRE").val()+
                "\n NOMBRE MADRE: "+$("#NOMBRE_MADRE").val()+
                "\n EDAD MADRE: "+$("#EDAD_MADRE").val()+
                "\n NACIONALIDAD MADRE: "+$("#NACIONALIDAD_MADRE").val()+
                "\n NOTA ACTA INSCRIPCION: "+$("#NOTA_ACTA_INSCRIPCION").val()+
                "\n NOTA MARGINAL: "+$("#NOTA_MARGINAL").val()
        );        
      */        
      
      $.ajax({
            type: "POST",
            url: "consultasCapturaNacimientos.php",
            data: {
                ACTION: "5",
                ACTA: $("#ACTA").val(),
                FECHA_REGISTRO: $("#FECHA_REGISTRO").val(),               
                PRIMER_APELLIDO: $.trim(PRIMER_APELLIDO),
                SEGUNDO_APELLIDO: $.trim(SEGUNDO_APELLIDO),
                NOMBRE: $.trim(NOMBRE),               
                FECHA_NACIMIENTO: $("#FECHA_NACIMIENTO").val(), 
                HORA_NACIMIENTO: $("#HORA_NACIMIENTO").val(), 
                SEXO: $("#ID_SEXO").val(),
                STATUS_REGISTRO: $("#ID_REGISTRADO").val(),
                COMPARECIO: $("#ID_COMPARECE").val(),          
                PRIMER_APELLIDO_PADRE: $.trim(PRIMER_APELLIDO_PADRE),
                SEGUNDO_APELLIDO_PADRE: $.trim(SEGUNDO_APELLIDO_PADRE),
                NOMBRE_PADRE: $.trim(NOMBRE_PADRE),
                EDAD_PADRE: $("#EDAD_PADRE").val(),            
                NACIONALIDAD_PADRE: $("#NACIONALIDAD_PADRE").val(),
                PRIMER_APELLIDO_MADRE: $.trim(PRIMER_APELLIDO_MADRE),
                SEGUNDO_APELLIDO_MADRE: $.trim(SEGUNDO_APELLIDO_MADRE),
                NOMBRE_MADRE: $.trim(NOMBRE_MADRE),
                EDAD_MADRE: $("#EDAD_MADRE").val(),
                NACIONALIDAD_MADRE: $("#NACIONALIDAD_MADRE").val(),                
                NOTA_ACTA_INSCRIPCION: $.trim(NOTA_ACTA_INSCRIPCION),
                NOTA_MARGINAL: $.trim(NOTA_MARGINAL) 
            },
            //timeout: 28000,
           error: function(data) {
                alert(data);               
            },
            success: function(data) {
                alert(data);
                              
            }
        });//END Ajax   
        
    }      
      
/*---------------------------------------------------------------
 * 
 * FUNCION: validacionesGenerales()
 ----------------------------------------------------------------*/      
      
    function validacionesGenerales(){
        //Validacion que solo permite letras en campos como nombres, apellidos...
        $(".validaLetras").validCampoFranz(" abcdefghijklmnñopqrstuvwxyzáéíóü.");            
        //Validacion que solo permite numeros en campos como edad, tomo, numero de acta...   
        $('.validaNumeros').validCampoFranz('0123456789');  

        //Captura de apellidos iguales como sugerencia para acelerar la captura y ya no se tengan que escribir
        $("#PRIMER_APELLIDO").keyup(function () {
            $("#PRIMER_APELLIDO_PADRE").val($(this).val());
        });    
        $("#PRIMER_APELLIDO").blur(function(){
           $("#PRIMER_APELLIDO_PADRE").val($(this).val());
        });     
        $("#SEGUNDO_APELLIDO").keyup(function () {
            $("#PRIMER_APELLIDO_MADRE").val($(this).val());
        });
        $("#SEGUNDO_APELLIDO").blur(function(){
           $("#PRIMER_APELLIDO_MADRE").val($(this).val());
        });        
    
        //validacion de diferencias de pellido paterno
        $("#PRIMER_APELLIDO_PADRE").keyup(function () {           
                if($(this).val() !== $("#PRIMER_APELLIDO").val()){
                   $("#PRIMER_APELLIDO").css("background","#F2DEDE");
                   $(this).css("background","#F2DEDE");
                   //alert("Primer Apellido del Abuelo Materno Inconcistente con el Primer Apellido de la Madre");
                }else{
                  $("#PRIMER_APELLIDO").css("background","white");
                  $(this).css("background","white");
                }            
        });
        $("#PRIMER_APELLIDO_PADRE").blur(function () {                       
                if($(this).val() !== $("#PRIMER_APELLIDO").val()){
                   $("#PRIMER_APELLIDO").css("background","#F2DEDE");
                   $(this).css("background","#F2DEDE");
                   //alert("Primer Apellido del Abuelo Materno Inconcistente con el Primer Apellido de la Madre");
                }else{
                  $("#PRIMER_APELLIDO").css("background","white");
                  $(this).css("background","white");
                }            
        });   
        
        //validacion de diferencias de pellido materno
        $("#PRIMER_APELLIDO_MADRE").keyup(function () {            
                if($(this).val() !== $("#SEGUNDO_APELLIDO").val()){
                   $("#SEGUNDO_APELLIDO").css("background","#F2DEDE");
                   $(this).css("background","#F2DEDE");
                   //alert("Primer Apellido del Abuelo Materno Inconcistente con el Primer Apellido de la Madre");
                }else{
                  $("#SEGUNDO_APELLIDO").css("background","white");
                  $(this).css("background","white");
                }            
        });   
        $("#PRIMER_APELLIDO_MADRE").blur(function () {            
                if($(this).val() !== $("#SEGUNDO_APELLIDO").val()){
                   $("#SEGUNDO_APELLIDO").css("background","#F2DEDE");
                   $(this).css("background","#F2DEDE");
                   //alert("Primer Apellido del Abuelo Materno Inconcistente con el Primer Apellido de la Madre");
                }else{
                  $("#SEGUNDO_APELLIDO").css("background","white");
                  $(this).css("background","white");
                }            
        });    
        
        /*
        $("#FECHA_NACIMIENTO").blur(function () {   
            var fecha_registro=$("#FECHA_REGISTRO").val();
            var fecha_nacimiento=$("#FECHA_NACIMIENTO").val();            
            if(fecha_registro !== null && fecha_nacimiento !== null){
                var ano_reg=fecha_registro.substr(6,4);                        
                var ano_nac=fecha_nacimiento.substr(6,4);                
                if(ano_nac>ano_reg){
                    fecha_nacimiento=fecha_nacimiento.substr(0,6); 
                    $("#FECHA_NACIMIENTO").val(fecha_nacimiento);                                         
                    $("#FECHA_NACIMIENTO").focusin();
                    alert("Error: fecha de nacimiento no puede ser mayor a la fecha de registro");
                }
             }
            
        });  */   
                   
        $("#HORA_NACIMIENTO").blur(function () {   
            var long_hora_nacimiento=$("#HORA_NACIMIENTO").val().length;             
            if(long_hora_nacimiento<5 && long_hora_nacimiento>0){
                alert("Formato de hora incompleta, debe ser hh/mm");
             }            
        }); 
        
    }
 
/*---------------------------------------------------------------
 * PARA VALIDACION SI LA FECHA ES NUMERICA
 * FUNCION: IsNumeric()
 ----------------------------------------------------------------*/      
    
    function IsNumeric(valor){
        var log=valor.length; var sw="S";
        for (x=0; x<log; x++)
        { v1=valor.substr(x,1);
        v2 = parseInt(v1);
        //Compruebo si es un valor numérico
        if (isNaN(v2)) { sw= "N";}
        }
        if (sw=="S") {return true;} else {return false; }
    }
    
/*---------------------------------------------------------------
 * PARA VALIDAR EL FORMATO DE FECHA Y FORMAR LA ESTRUCTURA DD/MM/YYYY
 * FUNCION: formateafecha(fecha)
 ----------------------------------------------------------------*/
    var primerslap=false;
    var segundoslap=false;
    
    function formateafecha(fecha){
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
        
        if (long>=7){ ano=fecha.substr(6,4);            
            if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); }
            else {
                var f = new Date();//fecha actual
                var fecha_registro=$("#FECHA_REGISTRO").val();
                var ano_reg=fecha_registro.substr(6,4);
                //alert(ano_reg);                
                if (long==10){ if ((ano==0) || (ano<1900) || (ano>f.getFullYear()) || (ano>ano_reg)) { 
                        fecha=fecha.substr(0,6); 
                        // //alert("Año incorrecto"); 
                 } } 
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
 * ME PERMITE VERIFICAR SI EL ACTA ES UNA INSCRIPCION PARA QUITAR LOS ELEMENTOS QUE NO SERAN NECESARIOS EN EL FORMUALARIO
 * FUNCION: verificarSiesInscripcion()
 ----------------------------------------------------------------*/    
    function verificarSiesInscripcion(){
        //Se revisa en caso de que sea una inscripcion
        $("#INSCRIPCION").change( function(){
            var INSCRIPCION=$("#INSCRIPCION").is(':checked') ? 1 : 0; 
            if(INSCRIPCION===1){
                $("#fila").hide();
                $("#col_cuadernillo").hide();
                $("#NOTA_ACTA").hide();
                $("#NOTA_ACTA_INSCRIPCION").show();
            }else{
                $("#fila").show();
                $("#NOTA_ACTA").show();
                $("#col_cuadernillo").show();
                $("#NOTA_ACTA_INSCRIPCION").hide();            
            }
        });                        
    }
    
/*---------------------------------------------------------------
 * ME PERMITE CARGAR LA LISTA DE ESTADOS DEL PAIS DE MEXICO POR DEFAULT CUANDO SE EJECUTA EL ARCHIVO
 * FUNCION: listaEstadosMexico()
 ----------------------------------------------------------------*/    
//    function listaEstadosMexico(){
//        //Lista de estados del pais de Mexico
//        $.ajax({
//            type: "POST",
//            url: "../../../class/filtros.php",
//            data: {
//                ACTION: "1",
//                ID_PAIS: $("#ID_PAIS_REG").val()
//            },
//           error: function(data) {
//                alert(data);               
//            },
//            success: function(data) {
//                //alert(data);
//                $("#ID_ESTADO").html(data);                             
//            }
//        });//END Ajax
//        
//    /*$.post("consultasCapturaNacimientos.php", { ACTION: "1", ID_PAIS : $("#ID_PAIS_REG").val()}, function(data) {
//        $("#ID_ESTADO").html(data);
//    });*/                        
//    }    
    
/*---------------------------------------------------------------
 * ME PERMITE CONSTRUIR LOS SELECT REALIZANDO LOS FILTROS CORRESPONDIENTES PARA PAIS, ESTADO, MUNICIPIO, LOCALIDAD
 * FUNCION: filtrarOptions()
 ----------------------------------------------------------------*/    
//    function filtrarOptions(){
//          
//    $("#ID_PAIS_REG").combobox({ 
//        select: function (event, ui) { 
//            var id_pais=$("#ID_PAIS_REG").val();
//            if(id_pais!=="00"){    
//                
//                $.ajax({
//                    type: "POST",
//                    url: "../../../class/filtros.php",
//                    data: {
//                        ACTION: "1",
//                        ID_PAIS: $("#ID_PAIS_REG").val()
//                    },
//                   error: function(data) {
//                        alert(data);               
//                    },
//                    success: function(data) {
//                        $("#ID_ESTADO").html(data);                             
//                    }
//                });//END Ajax                              
//              
//            /*
//            $.post("consultasCapturaNacimientos.php", { ACTION: "1", ID_PAIS : id_pais}, function(data) {
//                //alert(data);//Regresa la consulta y la estructura de option
//                $("#ID_ESTADO").html(data);  
//            });
//            */
//           
//            }else{
//                $("#ID_ESTADO").html("<option value=''>========</option><option value='00'>OTRO</option>");
//            }
//        } 
//    });
//    
//    $("#ID_ESTADO").combobox({
//        select: function (event, ui) {         
//            var id_estado=$("#ID_ESTADO").val();
//            if(id_estado!=="00"){
//            $("#ID_ESTADO_OCULTO").hide(); 
//                $.ajax({
//                    type: "POST",
//                    url: "../../../class/filtros.php",
//                    data: {
//                        ACTION: "2",
//                        ID_ESTADO : id_estado
//                    },
//                   error: function(data) {
//                        alert(data);               
//                    },
//                    success: function(data) {
//                        //alert(data);//Regresa la consulta y la estructura de option                         
//                        $("#ID_MUNICIPIO").html(data);                            
//                    }
//                });//END Ajax               
//            
//            /*
//            $.post("consultasCapturaNacimientos.php", { ACTION: "2", ID_ESTADO : id_estado}, function(data) {
//                //alert(data);//Regresa la consulta y la estructura de option                                                                                         
//                $("#ID_MUNICIPIO").html(data);                    
//            });
//            */
//           
//            }else{
//                $("#ID_MUNICIPIO").html("<option value=''>========</option><option value='00'>OTRO</option>");
//                $("#ID_ESTADO_OCULTO").show();
//            }
//        }
//    });
//    
//    $("#ID_MUNICIPIO").combobox({
//        select: function (event, ui) {         
//            var id_estado=$("#ID_ESTADO").val();
//            var id_municipio=$("#ID_MUNICIPIO").val();
//            if(id_estado!=="00" && id_municipio!=="00"){
//            $("#ID_MUNICIPIO_OCULTO").hide();
//                $.ajax({
//                    type: "POST",
//                    url: "../../../class/filtros.php",
//                    data: {
//                        ACTION: "3",
//                        ID_MUNICIPIO : id_municipio ,
//                        ID_ESTADO : id_estado
//                    },
//                   error: function(data) {
//                        alert(data);               
//                    },
//                    success: function(data) {
//                        //alert(data);//Regresa la consulta y la estructura de option
//                        $("#ID_LOCALIDAD").html(data);                            
//                    }
//                });//END Ajax                            
//                    /*
//                   $.post("consultasCapturaNacimientos.php", { ACTION: "3", ID_MUNICIPIO : id_municipio ,ID_ESTADO : id_estado}, function(data) {
//                        //alert(data);//Regresa la consulta y la estructura de option
//                        $("#ID_LOCALIDAD").html(data);                    
//                    });
//                    */            
//            }else{
//                $("#ID_LOCALIDAD").html("<option value=''>========</option><option value='00'>OTRO</option>");
//                $("#ID_MUNICIPIO_OCULTO").show();
//                
//            }
//        }
//    });
//    
//    $("#ID_LOCALIDAD").combobox({
//        select: function (event, ui) {
//            var id_localidad=$("#ID_LOCALIDAD").val();
//            if(id_localidad==="00"){
//                $("#ID_LOCALIDAD_OCULTO").show();                
//            }else{
//                $("#ID_LOCALIDAD_OCULTO").hide(); 
//            }             
//        }
//    }); 
//
//
//
//    }//END filtrarOptions()  
    
    
    
</script>


</body>
</html>

