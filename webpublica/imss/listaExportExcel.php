
<?php

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=reporte.xls");
header("Pragma: no-cache");
header("Expires: 0");
//echo $_POST['datos_a_enviar'];
$mysqli = new mysqli("curp.michoacan.gob.mx", "consultasweb", "Rcivil2014", "nacimientos");
$pensionados = $mysqli->query("SELECT * FROM registro_civil_dbo.v_defunciones_curp v ;");
$_pensionados=$pensionados->fetch_all(MYSQL_BOTH);

?>
  
                    <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
                                <thead>
                                <tr>
                               <th class="nosort"><h3>MUNICIPIO</h3></th>   
                                <th class="nosort"><h3>OFICIALIA</h3></th>
                                <th class="nosort"><h3>FECHA REGISTRO</h3></th>
                                <th class="nosort"><h3>TOMO</h3></th>
                                <th class="nosort"><h3>ACTA</h3></th>
                                <th class="nosort"><h3>CURP</h3></th>
                                <th class="nosort"><h3>NOMBRE</h3></th>
                                <th class="nosort"><h3>PRIMER APELLIDO</h3></th>
                                <th class="nosort"><h3>SEGUNDO APELLIDO</h3></th>
                                <th class="nosort"><h3>FECHA DE DEFUNCION</h3></th>
                                <th><h3>VER</h3></th>
                                </thead>

                        <tbody>
                            <?php foreach ($_pensionados as $myItem) {
                        ?> 
                                    <tr>
                                    <td><?php echo ($myItem['MUN_OFI']) ?></td>
                                    <td><?php echo ($myItem['OFICIALIA']) ?></td>
                                    <td><?php echo ($myItem['FECHA_REG']) ?></td>
                                    <td><?php echo $myItem['TOMO'] ?></td>
                                    <td><?php echo ($myItem['ACTA']) ?></td>
                                    <td><?php echo ($myItem['CURP']) ?></td>
                                    <td><?php echo ($myItem['NOMBRE']) ?></td>
                                    <td><?php echo ($myItem['PRIMER_AP']) ?></td>
                                    <td><?php echo ($myItem['SEGUNDO_AP']) ?></td>
                                   <td><?php echo ($myItem['FECHA_DEFUN']) ?></td>
                                                                    <td>
                                        <button id="editar">VER ACTA</button> 
                                    </td>
                                    </tr>
                                    <?php 
                                    
}
                                    ?>
                         </tbody>
                    </table>


       
                  