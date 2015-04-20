<?php
////aqui vamos hacer la conexion y consulta de ruta
require_once '../../class/mysqli.class.php';
//
////Se declaran las variables de conexion
$conexion1 = new conexionmysqli('rcivil');
//conexion a base de datos

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dirección del Registro Civil del Estado de Michoacán</title>
    <link rel="stylesheet" href="css/jquery-ui-1.11.3.custom/jquery-ui.css">
<!--  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="js/style.css">
    <link href="css/bootstrap.css" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="../../js/style.css">-->
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
                

                //Para escribir solo numeros    
                $('.validaNumeros').validCampoFranz('0123456789');
                $('.validaNumeros1').validCampoFranz('0123456789:');


$( "#datepicker" ).datepicker({
  dateFormat: "dd/mm/yy",
  changeMonth: true,
  changeYear: true,
  showOn: "button",
  buttonImage: "js/images/calendar.png",
  buttonImageOnly: true,
  yearRange: "1900:2000",
  buttonText: "Select date"
});


$( "#datepicke" ).datepicker({
  dateFormat: "dd/mm/yy",
  changeMonth: true,
  changeYear: true,
  minDate: -10,
  maxDate: "15D",
  buttonText: "Select date"
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
      $ing=date("d/m/Y");
      
      
      
    ?>

    <form class="contact_form" id="captura_usuario" action="alta_usuario1.php"  nombre="captura_usuario" method="POST">
      <div class="rows">
        <div class="col-md-12" align="center">
          <table width="1000">
            <thead>
              <tr align="center">
                <th></th>
                <th></th>
                <th></th>
                <th>FECHA DE NACIMIENTO</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="text" name="NOMBRE" size="30" class="validaLetras" placeholder="NOMBRE" title="Se requiere de un nombre" required autofocus style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="PRIMER_APELLIDO" size="30" class="validaLetras" placeholder="PRIMER APELLIDO" title="Se requiere de un primer apellido" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="SEGUNDO_APELLIDO" size="30" class="validaLetras" placeholder="SEGUNDO APELLIDO" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
                <td><input type="text" name="FECHA_NACIMIENTO" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="Formato incorrecto, debe ser de la forma siguiente dd-mm-yyyy" maxlength="10" class="validaFech" onKeyUp = "this.value=formateafecha(this.value);" class="validaFech" id="datepicker" required></td>
              </tr>
            </tbody>
            <thead>
              <tr align="center">
                <th></th>
                <th></th>
                <th>PROFESION</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="text" name="NO_CELULAR" size="30" maxlength="10" class="validaNumeros" placeholder="NUMERO DE CELULAR" pattern=".{10,}" title="Se requiere minimo 10 digitos" required></td>
                <td><input type="text" name="NO_NOMINA" size="30" maxlength="5" class="validaNumeros" pattern=".{5,}" title="Se requiere minimo 5 digitos" placeholder="NUMERO DE CONTROL-NOMINA" required></td>
                <td><div class="ui-widget">
                  <select name="ID_PROFESION" size="1" class="combobox" required>
                  <option value='null'>==========</option>
                  <?
                    $cons = $conexion1->query("SELECT * FROM cat_escolaridad");
                    $num=mysqli_num_rows($cons);  

                    for($x=0; $x<$num; $x++)
                    {
                      $res=mysqli_fetch_array($cons);
                      $idEscolaridad=$res["idEscolaridad"];
                      $descripcion=$res["descripcion"];
                          
                      echo "<option value='$idEscolaridad'>$descripcion</option>";
                      
                      
                    }


                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><input type="text" name="DESCRIPCION_PROFESION" size="30" class="validaLetras" title="Se requiere de una descripción" placeholder="DESCRIPCION DE LA PROFESION" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
              </tr>
            </tbody>
            <thead>
              <tr align="center">
                <th>SEXO</th>
                <th>FECHA DE INGRESO</th>
                <th>DEPARTAMENTO</th>
                <th>DEPENDENCIA</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><div class="ui-widget">
                  <select name="SEXO" size="1" class="combobox" required>
                  <option value='null'>==========</option>
                  <?
                    $cons = $conexion1->query("SELECT * FROM cat_sexo");
                    echo "es el sexo: ".$num=mysqli_num_rows($cons);  

                    for($x=0; $x<$num; $x++)
                    {
                      $res=mysqli_fetch_array($cons);
                      $CIDSEXO=$res["CIDSEXO"];
                      $DESCRIPCION=$res["DESCRIPCION"];
                          
                      echo "<option value='$CIDSEXO'>$DESCRIPCION</option>";
                      
                      
                    }


                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><input type="text" name="FECHA_INGRESO" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" title="Formato incorrecto, debe ser de la forma siguiente dd-mm-yyyy" maxlength="10" class="validaFech" value="<?echo $ing;?>" onKeyUp = "this.value=formateafecha(this.value);" <?echo "value='$ing'";?> id="datepicke" class="validaFech" required></td>
                <td><div class="ui-widget">
                  <select name="ID_DEPENDENCIA" class="combobox" size="1" required>
                  <option value='null'>==========</option>
                  <?
                    $cons = $conexion1->query("SELECT * FROM cat_dependencia");
                    $num=mysqli_num_rows($cons);  

                    for($x=0; $x<$num; $x++)
                    {
                      $res=mysqli_fetch_array($cons);
                      $idCatDep=$res["idCatDep"];
                      $nombreDependencia=$res["nombreDependencia"];
                          
                      echo "<option value='$idCatDep'>$nombreDependencia</option>";
                      
                      
                    }


                      echo"</select>";
                  ?>
                </div>
                </td>
                <td><div class="ui-widget">
                  <select name="ID_DEPARTAMENTO" class="combobox" size="1" required>
                  <option value='null'>==========</option>
                  <?
                    $cons = $conexion1->query("SELECT * FROM cat_departamento");
                    $num=mysqli_num_rows($cons);  

                    for($x=0; $x<$num; $x++)
                    {
                      $res=mysqli_fetch_array($cons);
                      $idDepartamento=$res["idDepartamento"];
                      $nombreDepartamento=$res["nombreDepartamento"];
                          
                      echo "<option value='$idDepartamento'>$nombreDepartamento</option>";
                      
                      
                    }


                      echo"</select>";
                  ?>
                </div>
                </td>
                
              </tr>
            </tbody>
            <thead>
              <th>ROLES A DESEMPEÑAR:</th>
              
            </thead>
            <tbody>
              <tr align="center">
                <td>
                  <select multiple name="ROLES[]" required>
                    <?
                      $cons = $conexion1->query("SELECT * FROM cat_roles_sistema WHERE NIVEL=2");
                      $num=mysqli_num_rows($cons);  

                      for($x=0; $x<$num; $x++)
                      {
                        $res=mysqli_fetch_array($cons);
                        $ID_ROL=$res["ID_ROL"];
                        $NOMBRE=$res["NOMBRE"];
                        echo "<option value='$ID_ROL'>$NOMBRE</option>";
                      }
                    ?> 
                    
                </select>
                <br>
                Selecciona varios ROLES dejando presionada la tecla CTRL(control)
                </td>
              </tr>
            </tbody>
          </table>
          <button class="submit" type="submit">GUARDAR</button>
        </div>
      </div>
    </form>
  </body>
</html>