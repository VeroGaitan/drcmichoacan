<?php
  //aqui vamos hacer la conexion y consulta de ruta
  require_once '../../class/mysqli.class.php';

  //Se declaran las variables de conexion
  $conexion1 = new conexionmysqli('rcivil');

 $ID_USUARIO=$_POST["id"];

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


 
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    
    
    <script type="text/javascript">


$(document).ready(function(){
    $("#PASSWORD").keypress(function(){
      $("#PASSWORD").css("background-color", "yellow");
      $("#REPETIR_PASSWORD").css("background-color", "yellow");
      $("#guardar").hide();
   });

  $("#REPETIR_PASSWORD").keyup(function(){
    if ($("#PASSWORD").val() == $("#REPETIR_PASSWORD").val()) {
      $("#PASSWORD").css("background-color", "#99E699");
      $("#REPETIR_PASSWORD").css("background-color", "#99E699");
      $("#guardar").show();
    }else{
      $("#PASSWORD").css("background-color", "yellow");
      $("#REPETIR_PASSWORD").css("background-color", "yellow");
      $("#guardar").hide();
    }
      
   });  

});

</script>

  </head>
  <body>
    <form class="contact_form"  action="cambiar_clave1.php" method="POST">
     
     <input type="hidden" name="ID_USUARIO" value="<?echo $ID_USUARIO;?>">
      
      <div class="rows">
        <div class="col-md-12" align="center">
          <table>
            <thead>
              <tr align="center">
                <th>CONTRASEÑA</th>
                <th>REPETIR CONTRASEÑA</th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td><input type="password" name="PASSWORD" id="PASSWORD" size="30" autofocus></td>
                <td><input type="password" name="REPETIR_PASSWORD" id="REPETIR_PASSWORD" size="30"></td>
              </tr>
            </tbody>
          </table>
          <br>
          <button class="submit" id="guardar" type="submit" hidden>GUARDAR</button>         
        </div>
      </div>
    </form>
  </body>
</html> 