
        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">

<?php
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


            <div class="row">
                <div class="col-md-12">                                              
                    <div id="tableheader">
                        <div class="search">

                            <select id="columns" onchange="sorter.search('query')"></select>
                            <input type="text" id="query" onkeyup="sorter.search('query')" />
                        </div>
                        <span class="details">
                            <div>                            
                            <form action="webcorporativa/libros/listaExportExcel.php" method="post" target="_blank" id="FormularioExportacion">
                                <button class="botonExcel" type="button" title="Exportar a Excel"><img src="images/xls.png" alt="Exportar a excel" title="Exportar a Excel"></button>
                                <!--<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />-->
                                <input id="ACTO" name="ACTO" type="hidden" value="<?php echo $ACTO ?>" >
                                <input id="JUZGADO" name="JUZGADO" type="hidden" value="<?php echo $JUZGADO ?>" >
                                <input id="ANO" name="ANO" type="hidden" value="<?php echo $ANO ?>" >
                                <input id="PROCESO_ACTUAL" name="PROCESO_ACTUAL" type="hidden" value="<?php echo $PROCESO_ACTUAL ?>" >
                            </form>
                            </div>                            
                            <div>Elementos <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                            <div><a href="javascript:sorter.reset()">Restablecer</a></div>
                        </span>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
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


       
                    <div id="tablefooter">
                        <div id="tablenav">
                            <div>
                                <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1, true)" />
                                <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                                <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                                <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1, true)" />
                            </div>
                            <div>
                                <select id="pagedropdown"></select>
                            </div>
                            <div>
                                <a href="javascript:sorter.showall()">Ver Todo</a>
                            </div>
                        </div>
                        <div id="tablelocation">
                            <div>
                                <select onchange="sorter.size(this.value)">
                                    <option value="5">5</option>
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>Elementos por pagina</span>
                            </div>
                            <div class="page">Pagina <span id="currentpage"></span> de <span id="totalpages"></span></div>
                        </div>
                    </div>

                </div>
            </div><!--END div row-->
    





                <script type="text/javascript">

                                    var sorter = new TINY_TABLE.table.sorter('sorter', 'table', {
                                        headclass: 'head',
                                        ascclass: 'asc',
                                        descclass: 'desc',
                                        evenclass: 'evenrow',
                                        oddclass: 'oddrow',
                                        evenselclass: 'evenselected',
                                        oddselclass: 'oddselected',
                                        paginate: true,
                                        size: 10,
                                        colddid: 'columns',
                                        currentid: 'currentpage',
                                        totalid: 'totalpages',
                                        startingrecid: 'startrecord',
                                        endingrecid: 'endrecord',
                                        totalrecid: 'totalrecords',
                                        hoverid: 'selectedrow',
                                        pageddid: 'pagedropdown',
                                        navid: 'tablenav',
                                        //sortcolumn: 1,
                                        //sortdir: 1,
                                        init: true
                                    });


                        $("#exportarExcel").click(function() {                               
                                $.ajax({
                                    type: "POST",
                                    url: "webcorporativa/libros/listaLibrosPara.php",
                                    data: {
                                        ACTO: $("#ACTO").val(),
                                        JUZGADO: $("#JUZGADO").val(),
                                        ANO: $("#ANO").val(),
                                        PROCESO_ACTUAL: $("#PROCESO_ACTUAL").val()                                      
                                    },            
                                    timeout: 28000,
                                    error: function(data) {                       
                                        $("#resultSearch").html(data);
                                    },
                                    success: function(data) {                         
                                        //$("#resultSearch").html(data);
                                  
                                    }
                                });//END Ajax                               
                        });



                        $(".botonExcel").click(function(event) {
                             //$("#datos_a_enviar").val( $("<div>").append( $("#table").eq(0).clone()).html());
                             $("#FormularioExportacion").submit();
                        });



                </script>

<?php
 }else{
    echo "NO EXISTEN LIBROS";
}
?>
            