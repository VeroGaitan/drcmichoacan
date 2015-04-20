<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">    

    <title>Nacimientos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->
        <link href="css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="js/jquery-2.0.3.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>  
        <!-- x-editable (bootstrap version) -->
        <link href="css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="js/bootstrap-editable.min.js"></script>
        <!-- verificacion.js -->
        <script src="verificacion.js"></script>
  </head>

  <body>
    <div class="container">
    <form class="form-horizontal">
      <h2 align="center">VERIFICACI&Oacute;N DE ACTA DE NACIMIENTO</h2>

                <h4 align="center">DATOS DE IDENTIFICACI&Oacute;N DEL ACTA</h4>
                <table  class="table table-condensed" border="0" align="center">
                        <tr align="left" class="warning">
                            <th>CRIP:</th>
                            <th>OFICIAL&Iacute;A:</th>
                            <th>N&deg; ACTA:</th>
                            <th>FECHA DE REGISTRO:</th>
                            <th>TOMO:</th>
                            <th>TOMO BIS:</th>                                    
                        </tr>
                        <tr>
                            <td><span>No modificable</span>-<span>No modificable</span></td>
                            <td><span class="uneditable-input">No modificable</span></td>
                            <td></td>
                            <td><input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="date" value="09-01-2013"></td>
                            <td></td>
                            <td></td>
                        </tr>
                </table>

                <h4 align="center">DATOS DE IDENTIFICACI&Oacute;N DEL REGISTRADO</h4>
                <table  class="table table-condensed" border="1" align="center">
                        <tr align="left">
                            <th>PRIMER APELLIDO:</th>
                            <th>SEGUNDO APELLIDO:</th>
                            <th>NOMBRE:</th>
                            <th>FECHA Y HORA DE NACIMIENTO:</th>                              
                        </tr>
                        <tr>
                            <td><a href="#" id="primer_apellido_registrado" data-type="text" data-placement="right" data-title="primer_apellido_registrdo">Ortiz</a></td>
                            <td><a href="#" id="segundo_apellido_registrado" data-type="text" data-placement="right" data-title="segundo_apellido_registrado">Patricio</a></td>
                            <td><a href="#" id="nombres_registrado" data-type="text" data-placement="right" data-title="nombres_registrado">Brenda Janet</a></td>
                            <td><input type="text" id="datetime12" data-format="DD-MM-YYYY h:mm a" data-template="DD / MM / YYYY     hh : mm a" name="datetime" value="21-12-2012 8:30 pm">
</td>
                        </tr>
                        <tr>
                            <th>SEXO:</th>
                            <th>STATUS DE REGISTRO:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><a href="#" id="sexo_registrado"></a></td>
                            <td><a href="#" id="status_registrado"></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <th>PA&Iacute;S DE NACIMIENTO:</th>
                            <th >ENTIDAD DE NACIMIENTO:</th>
                            <th>MUNICIPIO DE NACIMIENTO:</th>
                            <th>LOCALIDAD:</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                        </tr>  
                </table>


                <h4 align="center">DATOS DEL PADRE</h4>
                <table class="table table-condensed" align="center" border="1">
                        <tr>
                            <th>PRIMER APELLIDO:</th>
                            <th>SEGUNDO APELLIDO:</th>
                            <th>NOMBRE:</th>
                            <th>EDAD:</th>
                            <th>NACIONALIDAD:</th>
                        </tr>
                        <tr>
                            <td><a href="#" id="primer_apellido_padre" data-type="text" data-placement="right" data-title="primer_apellido_padre">Ortiz</a></td>
                            <td><a href="#" id="segundo_apellido_padre" data-type="text" data-placement="right" data-title="segundo_apellido_padre">Mendoza</a></td>
                            <td><a href="#" id="nombres_padre" data-type="text" data-placement="right" data-title="nombres_padre">Luis</a></td>
                            <td></td>
                            <td></td>
                        </tr>
                </table> 

                <h4 align="center">DATOS DE LA MADRE</h4>
                <table class="table table-condensed" align="center" border="1">
                        <tr>
                            <th>PRIMER APELLIDO:</th>
                            <th>SEGUNDO APELLIDO:</th>
                            <th>NOMBRE:</th>
                            <th>EDAD:</th>
                            <th>NACIONALIDAD:</th>
                        </tr>
                        <tr>
                            <td><a href="#" id="primer_apellido_madre" data-type="text" data-placement="right" data-title="primer_apellido_madre">Patricio</a></td>
                            <td><a href="#" id="segundo_apellido_madre" data-type="text" data-placement="right" data-title="segundo_apellido_madre">Vital</a></td>
                            <td><a href="#" id="nombres_madre" data-type="text" data-placement="right" data-title="nombres_madre">Maria Guadalupe</a></td>
                            <td></td>
                            <td></td>
                        </tr>
                </table> 				

                <h4 align="center">NOTA MARGINAL</h4>
                <table align="center" border="0">
                        <tr>
                            <td><textarea class="input-xxlarge" align="right" rows="2" cols="1000"></textarea></td>
                        </tr>
                </table>  

				
					<button id="valores">Valores</button>
        </form>  

    </div>
  </body>
</html>