<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=reporte.xls");
header("Pragma: no-cache");
header("Expires: 0");
ini_set('max_execution_time', 300);
$mysqli = new mysqli("curp.michoacan.gob.mx", "consultasweb", "Rcivil2014", "imss");
$pensionados = $mysqli->query("SELECT * FROM imss.sedru_1 s;");
$_pensionados=$pensionados->fetch_all(MYSQL_BOTH);
//print_r($_pensionados)
?>
  
                   
                    <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
                                <thead>
                                <tr>
                               <th class="nosort"><h3>NOMBRE</h3></th>   
                                <th class="nosort"><h3>FECHA DEFUNCION</h3></th>
                                <th class="nosort"><h3>FECHA REGISTRO</h3></th>
                                <th class="nosort"><h3>OFICALIA</h3></th>
                                <th class="nosort"><h3>LIBRO</h3></th>
                                <th class="nosort"><h3>TOMO</h3></th>
                                <th class="nosort"><h3>NO ACTA</h3></th>
                                <th class="nosort"><h3>LOCALIDAD</h3></th>
                                <th class="nosort"><h3>MUNICIPIO</h3></th>
                                <th class="nosort"><h3>CURP</h3></th>
                                <th><h3>VER</h3></th>
                                </thead>

                        <tbody>
                            <?php foreach ($_pensionados as $myItem) {
                        ?> 
                                    <tr>
                                    <td><?php echo ($myItem['NOMBRE']) ?></td>
                                    <td><?php echo ($myItem['FECHA_DEFUN']) ?></td>
                                    <td><?php echo ($myItem['FECHA_REG']) ?></td>
                                    <td><?php echo $myItem['OFICIALIA'] ?></td>
                                    <td><?php echo ($myItem['LIBRO']) ?></td>
                                    <td><?php echo ($myItem['TOMO']) ?></td>
                                    <td><?php echo ($myItem['NO_ACTA']) ?></td>
                                    <td><?php echo ($myItem['LOCALIDAD']) ?></td>
                                    <td><?php echo ($myItem['MUNICIPIO']) ?></td>
                                   <td><?php if($myItem['CONSEC']=='') 
                                       {
                                       echo 'NO LOCALIZADO EN BD';
                                       ?>
                                        <td>
                                        
                                    </td>
                                       <?php
                                       } 
                                       else {
                                           echo "CORRECTO";
                                           ?>
                                        <td>
                                        <button id="editar">VER ACTA</button> 
                                    </td>
                                       <?php
                                       } ?>
                                   </td>
                                                                   
                                    </tr>
                                    <?php 
                                    
}
                                    ?>
                         </tbody>
                    </table>


       