<?php
require_once './class/sesion.class.php';
$session = new session();
$sessionData = array("ID_USUARIO", "NOMBRE_USUARIO");
if (!$session->verifySession($sessionData)) {
    header("location:index.php");
}
if (filter_input(INPUT_GET, "logOut")) {
    $session->closeSession("index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DRC - Michoacan - Inicio de Sesion</title>
        <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui-1.11.3.custom/jquery-ui.css" media="screen">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/selectable.css" media="screen"> 
        <script>
            $(document).ready(function () {
                $(this).disableFunctions();
                $(this).buildMenu($("#nav"), $("#ID_USUARIO").val());
                $("#logOut").closeSession("inicio.php?logOut=true");
                $("body").userActivity("180000");
            });
        </script>
    </head>
    <body style="padding-bottom: 70px; padding-top: 50px">
        <div class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <!-- El logotipo y el icono que despliega el menú se agrupan
                     para mostrarlos mejor en los dispositivos móviles -->
                <div class="navbar-header">
                    <button type="button" id="navbarToggle" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Desplegar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://registrocivil.michoacan.gob.mx/"><img class="img-thumbnail" src="images/logorcivil.png" width="40px" style="padding: 0px; margin-top: -12px" id="logo"/></a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav" id="nav">
                        
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class=""><a href="#" id="logOut"><span class="glyphicon glyphicon-log-out"></span> <b>CERRAR SESION</b></a></li>
                    </ul>
                    <p class="navbar-text pull-right"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["NOMBRE_USUARIO"]; ?> [<?php echo $_SESSION["ID_USUARIO"] ?>]<input type="hidden" id="ID_USUARIO" value="<?php echo $_SESSION["ID_USUARIO"]; ?>"></p>
                </div>
            </nav>
            <div class="row">
                <div id="msjInactive" style="display: none;"><div class="alert alert-warning" style="text-align: center; font-weight: bold; margin: 0px;"></div></div>
            </div>
            <div class="row-fluid" style="margin-top: 15px">
                <div class="panel panel-default" id="loadParent" style="display: none;">
                    <div class="panel-heading" id="loadTitle">
                        <h4 class="panel-title"></h4> 
                    </div>
                    <div class="panel-body" id="loadCont">
                        <!--                        Contenido del panel-->
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
                <p style="font-size:10px;text-align: center; margin-bottom: 0px">Valent&iacute;n G&oacute;mez Farias No 525,Col Industrial,Morelia Michoac&aacute;n  CP:58000 TEL: (443) 113- 42- 00</p>
                <p style="font-size:10px;text-align: center; margin-bottom: 0px"><b>Pagina Oficial: </b><a href="http://registrocivil.michoacan.gob.mx/" target="_blank">Registro Civil del Estado de Michoac&aacute;n</a><br/></p>
            </nav>
        </div>
    </body>
</html>


