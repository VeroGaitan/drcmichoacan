<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DRC - Michoacan - Inicio de Sesion</title>
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui-1.11.3.custom/jquery-ui.css" media="screen">
        <link href="css/bootstrap.css" rel="stylesheet">
        <script>
            $(document).ready(function () {
                $(this).disableFunctions();
                $("#formLogin").submit(function () {
                    $.getJSON("class/log.class.php", {user: $("#usuario").val(), pass: $("#password").val()}).done(function (jsonRequest) {
                        console.log(jsonRequest);
//                        accede quien tenga STATUS_ACTIVO = 1, fecha menor a hoy o nula, 
                        if (!jsonRequest.logInFail) {
                            fDown = jsonRequest.FECHA_BAJA_USUARIO.split(" ");
                            if ((jsonRequest.STATUS === "1") && (($.datepicker.formatDate('yy-mm-dd', new Date(fDown[0])) >= $.datepicker.formatDate('yy-mm-dd', new Date())) || $.datepicker.formatDate('yy-mm-dd', new Date(fDown[0])) === "")) {
                                window.location = "inicio.php";
                            } else {
                                msjDialog("ALGO SALIO MAL, INTENTA MAS TARDE!");
                            }
                        } else {
                            $("#usuario,#password").val("");
                            $("#usuario").focus();
                            msjDialog("EL USUARIO O LA CONTRASEÑA QUE INGRESASTE SON INCORRECTOS.");
                        }
                    });
                });

                function msjDialog(msj) {
                    $("<div/>").dialog({
                        title: "ACCESO DENEGADO",
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
                    }).prepend(msj).css("text-align","center").prev(".ui-dialog-titlebar").hide();
                }
            });
        </script>
    </head>
    <body class="login-body" style="padding-bottom: 70px">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-12" align="center">
                    <h2 style="text-align: center">Direcci&oacute;n del Registro Civil del Estado de Michoac&aacute;n</h2>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-12" align="center">
                    <img src="images/fondo_main.png" width="400" height="100" class="img-responsive"  />
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-offset-3 col-md-6" style="margin-top: 40px;">      
                    <form role="form" id="formLogin" onsubmit="return false">
                        <div class="form-group">
                            <input style="background-color: honeydew" id="usuario" type="text" class="form-control input-group-lg" placeholder="Usuario" autofocus required="" value="">
                        </div>
                        <div class="form-group">
                            <input style="background-color: honeydew" id="password" type="password" class="form-control input-group-lg" placeholder="Contraseña" required="" value="">
                        </div>
                        <div class="form-group">
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>¡IMPORTANTE!</strong> 
                                <p style="text-align: justify">Las claves de acceso son personales, todo usuario registrado en el sistema  sera responsable de proteger su nombre de usuario y contraseña.
                                    EL usuario es responsable por las acciones que se lleven a cabo en el sistema,  es decir son responsables de la veracidad de la informacion registrada y modificada.</p>
                            </div>
                            <input id="btnSubmit" class="btn btn-primary btn-block" type="submit" value="INGRESAR AL SISTEMA" />
                        </div>
                    </form>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
                <p style="font-size:10px;text-align: center; margin-bottom: 0px">Valent&iacute;n G&oacute;mez Farias No 525,Col Industrial,Morelia Michoac&aacute;n  CP:58000 TEL: (443) 113- 42- 00</p>
                <p style="font-size:10px;text-align: center; margin-bottom: 0px"><b>Pagina Oficial: </b><a href="http://registrocivil.michoacan.gob.mx/" target="_blank">Pagina Oficial del Registro Civil del Estado de Michoac&aacute;n</a><br/></p>
            </nav>
        </div>
    </body>
</html>


