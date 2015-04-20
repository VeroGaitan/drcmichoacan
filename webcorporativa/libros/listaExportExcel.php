
<?php

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=reporte.xls");
header("Pragma: no-cache");
header("Expires: 0");
//echo $_POST['datos_a_enviar'];


require_once '../../class/libros.class.php';
$ACTO=filter_input(INPUT_POST, 'ACTO');
$JUZGADO=filter_input(INPUT_POST, 'JUZGADO');
$ANO=filter_input(INPUT_POST, 'ANO');
$PROCESO_ACTUAL=filter_input(INPUT_POST, 'PROCESO_ACTUAL');

$clase = new libros();          
$resultadoLibrosPara=$clase->libro_en_proceso_para(filter_input(INPUT_POST, 'ACTO'),filter_input(INPUT_POST, 'JUZGADO'),substr(filter_input(INPUT_POST, 'JUZGADO'), 0, 3),substr(filter_input(INPUT_POST, 'JUZGADO'), 4, 2),filter_input(INPUT_POST, 'ANO'),filter_input(INPUT_POST, 'PROCESO_ACTUAL'));
unset($clase);
//print_r($resultadoLibrosPara);

if($resultadoLibrosPara<>0){
?>


                    <table>
                                <thead>
                                <tr>
                                <th class="nosort"><h3>ACTO</h3></th>
                                <th><h3>CLAVE</h3></th>   
                                <th><h3>MUNICIPIO</h3></th>
                                <th><h3>OFICIALIA</h3></th>
                                <th><h3>AÑO</h3></th>
                                <th><h3>TOMO</h3></th>
                                <th><h3>TBIS</h3></th>
                                <th><h3>ACTA INICIAL</h3></th>
                                <th><h3>ACTA FINAL</h3></th>

                                </thead>

                        <tbody>
                        <?php
                            foreach ($resultadoLibrosPara as $myItem) {
                        ?> 
                                    <tr>
                                    <td><?php echo ($myItem[2]) ?></td>
                                    <td><?php echo ($myItem[3]) ?></td>
                                    <td><?php echo ($myItem[4]) ?></td>
                                    <td><?php echo $myItem[5] ?></td>
                                    <td><?php echo ($myItem[6]) ?></td>
                                    <td><?php echo ($myItem[7]) ?></td>
                                    <td><?php echo ($myItem[8]) ?></td>
                                    <td><?php echo ($myItem[10]) ?></td>
                                    <td><?php echo ($myItem[11]) ?></td>
                                    </tr>
                                    <?php }
                                    ?>
                        </tbody>
                    </table>


  
<?php
 }else{
    echo "NO EXISTEN LIBROS";
 }
?>
            











