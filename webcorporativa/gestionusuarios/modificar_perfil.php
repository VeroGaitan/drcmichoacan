<?
	//aqui vamos hacer la conexion y consulta de ruta
	require_once '../../class/mysqli.class.php';

	//Se declaran las variables de conexion
	$conexion1 = new conexionmysqli('rcivil');

	$ID_USUARIO=$_POST['id'];

	$cons = $conexion1->query("SELECT * FROM rh_cat_empleados where ID_USUARIO='$ID_USUARIO'");
	$res=mysqli_fetch_assoc($cons);
  //print_r($res);
	

?>

<?php
//aqui vamos hacer la conexion y consulta de ruta
require_once '../../class/mysqli.class.php';

//Se declaran las variables de conexion
$conexion1 = new conexionmysqli('rcivil');
//conexion a base de datos

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dirección del Registro Civil del Estado de Michoacán</title>
    <link rel="stylesheet" href="../../css/jquery-ui-1.11.3.custom/jquery-ui.css">
  <script src="../../js/jquery-1.11.2.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../../js/style.css">
    <!--<link href="css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" href="js/style.css">
    <link href="css/estilo.css" rel="stylesheet" />
<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -38px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
  </style>
 
  <!--<script src="js/jquery.min.js"></script>     -->
     <script src="js/validCampoFranz.js"></script>



 
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    
    
    <script type="text/javascript">
 $(document).ready(function(){

  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Muestra todos los elementos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " no encontró ningún elemento" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( ".combobox" ).combobox();
    $( ".toggle" ).click(function() {
      $( ".combobox" ).toggle();
    });
  });



               //Para escribir solo letras

                $('.validaLetras').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóúÑäëïöü.');
                 $('.validaFech').validCampoFranz('0123456789/');
                $('.validaCurp').validCampoFranz('abcdefghijklmnñopqrstuvwxyz0123456789');
                $('.validaRFC').validCampoFranz('abcdefghijklmnñopqrstuvwxyz0123456789-');

                //Para escribir solo numeros    
                $('.validaNumeros').validCampoFranz('0123456789');
                $('.validaTelefonos').validCampoFranz(' 0123456789()/-:');


$( "#datepicker" ).datepicker({
  dateFormat: "dd/mm/yy",
  changeMonth: true,
  changeYear: true,
  showOn: "button",
  buttonImage: "js/images/calendar.png",
  buttonImageOnly: true,
  yearRange: "1900:2010",
  buttonText: "Select date"
});


    $("#ocultar").on( "click", function() {
      $('#ocultar').hide(); //oculto mediante id
      $('#text').show(); //muestro mediante id
    });



});


/*---------------------------------------------------------------
 * PARA VALIDACION DE FECHA
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
    
    var primerslap=false;
    var segundoslap=false;

/*---------------------------------------------------------------
 * PARA VALIDAR EL FORMATO DE FECHA Y FORMAR LA SETRUCTURA
 * FUNCION: formateafecha(fecha)
 ----------------------------------------------------------------*/
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
            else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } }
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


</script>

  </head>
  <body>

    <?
      $fecha=getdate();
      $d = $fecha['mday'];
      $m = $fecha['mon'];
      $y = $fecha['year'];

      $ing=$d."/".$m."/".$y;
      

list($anio, $mes, $dia) = explode("-", $res['FECHA_NACIMIENTO']);

$fechanac=$dia."/".$mes."/".$anio;

    ?>
<H1 align="center">MI PERFIL</H1>
<br>
<br>
    <form class="contact_form" id="captura_usuario" action="modificar_perfil1.php"  nombre="captura_usuario" method="POST">
      <input type="hidden" name="ID_USUARIO" value="<?echo $ID_USUARIO;?>">
      <div class="rows">
        <div class="col-md-12" align="center">
          <table width="1000">
            <thead>
              <tr align="center">
                <th>NOMBRE</th>
                <th>PRIMER APELLIDO</th>
                <th>SEGUNDO APELLIDO</th>
                <th>FECHA DE NACIMIENTO</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="text" name="NOMBRE" size="30" class="validaLetras" value="<?echo $res['NOMBRE'];?>" required autofocus style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="PRIMER_APELLIDO" size="30" class="validaLetras" value="<?echo $res['PRIMER_APELLIDO'];?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="SEGUNDO_APELLIDO" size="30" class="validaLetras" value="<?echo $res['SEGUNDO_APELLIDO'];?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="FECHA_NACIMIENTO" id="datepicker" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="Formato incorrecto, debe ser de la forma siguiente dd-mm-yyyy" maxlength="10" class="validaFech" value="<?echo $fechanac;?>" onKeyUp = "this.value=formateafecha(this.value);" required></td>
              </tr>
            </tbody>
             <thead>
              <tr align="center">
                <th>DIRECCION</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td colspan=4><input type="text" name="DIRECCION" size="158" value="<?echo $res['DIRECCION'];?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
              </tr>
            </tbody>
            <thead>
              <tr align="center">
                <th>NUMERO DE CELULAR</th>
                <th>TELEFONO DE CASA</th>
                <th>TELEFONO DE EMERGENCIA</th>
                <th>NUMERO DE SEGURO SOCIAL</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="text" name="NO_CELULAR" size="30" pattern=".{10,}" title="tiene que ser minimo 10 caracteres" maxlength="10" class="validaTelefonos" value="<?echo $res['NO_CELULAR'];?>" required></td>
                <td><input type="text" name="TELEFONO_CASA" size="30" maxlength="10" class="validaTelefonos" value="<?echo $res['TELEFONO_CASA'];?>"></td>
                <td><input type="text" name="TELEFONO_EMERGENCIA" size="30" maxlength="10" class="validaTelefonos" value="<?echo $res['TELEFONO_EMERGENCIA'];?>"></td>
                <td><input type="text" name="NO_SEGURIDAD_SOCIAL" size="30" class="validaNumeros" value="<?echo $res['NO_SEGURIDAD_SOCIAL'];?>" ></td>
              </tr>
            </tbody>
            <tr align="center">
                <th>CURP</th>
                <th>PROFESION</th>
                <th>DESCRIPCION DE LA PROFESION</th>
                <th>CORREO</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="text" name="CURP" size="30" maxlength="18" class="validaCurp" value="<?echo $res['CURP'];?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><div class="ui-widget">
                  <select name="ID_PROFESION" size="1" class="combobox" required>
                  <option value='null'>==========</option>
                  <?
                  
                    $conss = $conexion1->query("SELECT * FROM cat_escolaridad");
                    $numm=mysqli_num_rows($conss);  

                    for($x=0; $x<$numm; $x++)
                    {
                      $ress=mysqli_fetch_array($conss);
                      echo $idEscolaridad=$ress["idEscolaridad"];
                      $descripcion=$ress["descripcion"];

                      if ($res['ID_PROFESION']==$idEscolaridad) 
                      {
                         echo "<option value='$idEscolaridad' selected>$descripcion</option>";
                      }
                      else{
                        echo "<option value='$idEscolaridad'>$descripcion</option>";
                      }                          
                      
                      
                      
                    }


                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><input type="text" name="DESCRIPCION_PROFESION" size="30" class="validaLetras" value="<?echo $res['DESCRIPCION_PROFESION'];?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="CORREO_PARTICULAR" pattern="[a-zA-Z0-9.!#$%'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)" title="Formato incorrecto debe ser con la siguiente sintaxis alguien@ejemplo.com" size="30" value="<?echo $res['CORREO_PARTICULAR'];?>"></td>
              </tr>
            </tbody>
            <thead>
              <tr align="center">
                
                <th>SEXO</th>
                <th>ESTADO CIVIL</th>
                <th>RFC</th>
                
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                
                <td><div class="ui-widget">
                  <select name="SEXO" size="1" class="combobox" required>
                  <option value='null'>==========</option>
                  <?
                    $conss=$conexion1->query("SELECT * FROM cat_sexo");
                    $numm=mysqli_num_rows($conss);  
                    for($x=0; $x<$numm; $x++)
                    {
                      $ress=mysqli_fetch_array($conss);
                      $CIDSEXO=$ress["CIDSEXO"];
                      $DESCRIPCION=$ress["DESCRIPCION"];
                      
                      if ($res['SEXO']==$CIDSEXO) 
                      {    
                        echo "<option value='$CIDSEXO' selected>$DESCRIPCION</option>";
                      }else{
                        echo "<option value='$CIDSEXO'>$DESCRIPCION</option>";
                      }

                    }
                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><div class="ui-widget">
                  <select name="ESTADO_CIVIL" size="1" class="combobox" required>
                  <option value='null'>==========</option>
                  <?
                    $conss=$conexion1->query("SELECT * FROM cat_edo_civil");
                    $numm=mysqli_num_rows($conss);  
                    for($x=0; $x<$numm; $x++)
                    {
                      $ress=mysqli_fetch_array($conss);
                      $DESCRIPCION=$ress["DESCRIPCION"];
                      
                      if ($res['ESTADO_CIVIL']==$DESCRIPCION) 
                      {    
                        echo "<option value='$DESCRIPCION' selected>$DESCRIPCION</option>";
                      }else{
                        echo "<option value='$DESCRIPCION'>$DESCRIPCION</option>";
                      }

                    }
                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><input type="text" name="RFC" size="30" maxlength="15" class="validaRFC" value="<?echo $res['RFC'];?>" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
              </tr>
            </tbody>
          </table>
          <br>
          <br>
          <button class="submit" type="submit">GUARDAR</button>
        </div>
      </div>
    </form>
  </body>
</html>