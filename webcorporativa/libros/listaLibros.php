
<?php

require_once '../../class/libros.class.php';
#Variables de busqueda
$action=filter_input(INPUT_POST,'ACTION');
$acto=filter_input(INPUT_POST, 'ACTO');
$juzgado=filter_input(INPUT_POST, 'JUZGADO');
$ano=filter_input(INPUT_POST, 'ANO');
$tomo=filter_input(INPUT_POST, 'TOMO');
$tbis=filter_input(INPUT_POST, 'TBIS');


$clase = new libros();
//$clase = new libros();
if(filter_input(INPUT_POST,'ACTION')==2){
    $listaLibros=$clase->gestiona_libropordatos(filter_input(INPUT_POST, 'ACTO'),filter_input(INPUT_POST, 'JUZGADO'),filter_input(INPUT_POST, 'ANO1'),filter_input(INPUT_POST, 'ANO2'),filter_input(INPUT_POST, 'ETAPA'));
}
if(filter_input(INPUT_POST,'ACTION')==3){
    /*echo filter_input(INPUT_POST, 'ACTO')." -- ";
    echo filter_input(INPUT_POST, 'JUZGADO')." -- ";
    echo filter_input(INPUT_POST, 'ANO')." -- ";
    echo filter_input(INPUT_POST, 'TOMO')." -- ";
    echo filter_input(INPUT_POST, 'TBIS')." -- ";*/
    $listaLibros=$clase->muestra_libropordatos(filter_input(INPUT_POST, 'ACTO'),filter_input(INPUT_POST, 'JUZGADO'),filter_input(INPUT_POST, 'ANO'),filter_input(INPUT_POST, 'TOMO'),filter_input(INPUT_POST, 'TBIS'));
}

if($listaLibros<>0){
//print_r($listaLibros);
?>   
        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">

            <input id="action" type="hidden" value="<?php echo $action ?>" >
            <input id="acto" type="hidden" value="<?php echo $acto ?>" >
            <input id="juzgado" type="hidden" value="<?php echo $juzgado ?>">
            <input id="ano"type="hidden" value="<?php echo $ano ?>" >
            <input id="tomo" type="hidden" value="<?php echo $tomo ?>" >
            <input id="tbis" type="hidden" value="<?php echo $tbis ?>" >
            
            
    <form role="form" id="resultBook" name="resultBook">
        
            <div class="row">
                <div class="col-md-12">                                              
                    <div id="tableheader">
                        <div class="search">

                            <select id="columns" onchange="sorter.search('query')"></select>
                            <input type="text" id="query" onkeyup="sorter.search('query')" />
                        </div>
                        <span class="details">
                            <div><button  align="right" id="regresarBusqueda" type="button">Regresar a la Busqueda</button></div>
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
                                <th><h3>DIG</h3></th>
                                <th><h3>IND</h3></th>
                                <th><h3>CAP</h3></th>
                                <th><h3>VER</h3></th>
                                <th><h3>LIBR</h3></th>
                                <th><h3>EDITAR</h3></th>
                                </thead>

                        <tbody>
                        <?php
                            foreach ($listaLibros as $myItem) {
                        ?> 
                                    <tr>
                                    <td><?php echo ($myItem[1]) ?></td>
                                    <td><?php echo ($myItem[2]) ?></td>
                                    <td><?php echo ($myItem[2]) ?></td>
                                    <td><?php echo $myItem[2] ?></td>
                                    <td><?php echo ($myItem[3]) ?></td>
                                    <td><?php echo ($myItem[4]) ?></td>
                                    <td><?php echo ($myItem[5]) ?></td>
                                    <td><?php echo ($myItem[6]) ?></td>
                                    <td><?php echo ($myItem[7]) ?></td>
                                    <td><?php echo ($myItem[8]) ?></td>
                                    <td><?php echo ($myItem[9]) ?></td>
                                    <td><?php echo ($myItem[10]) ?></td>
                                    <td><?php echo ($myItem[11]) ?></td>
                                    <td><?php echo ($myItem[12]) ?></td>
                                    <td>
                                        <button id="editar" onclick="editarLibros(<?php echo $myItem[0] ?>)">Editar</button> 
                                    </td>
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

            
            <div id="ataNuevoLibro"></div>
            
    </form>

    

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

                                     $("#dialog-editar").dialog({autoOpen: false});


                        $("#regresarBusqueda").click(function() {
                                //alert(regresarBusqueda);
                                $('#resultSearch').load('webcorporativa/libros/buscarLibro.php');
                        });

                </script>            
 

<?php
}else{
 
#CATALOGOS  
require '../../class/catalogos.class.php';
$datos_registro = new catalogos(); //Usa la clase
$combooficialias = $datos_registro->cat_oficialias();
$combootomos = $datos_registro->cat_tomos();
$combooanos = $datos_registro->cat_anos();
$combooactos = $datos_registro->cat_actos();
$combootomobis = $datos_registro->cat_tbis();
$comboomes = $datos_registro->cat_meses();
//unset($datos_registro);
//print_r($datos_registro);    


?>    
                
                
        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
        
        <h3 align="center">EL LIBRO NO EXISTE, ¿DESEA DARLO DE ALTA EN EL SISTEMA?</h3>
        <div class="container">
        <form role="form" id="newBook" name="newBook">
            <div class="row">

                
                    <div class="col-md-3">                        
                        <div class="ui-widget" style="position:absolute; left: 5px; top: 0px;">
                            <select  style="width:240px;" id="comboboxacto" required="" class="acto">
                                <option value="">========</option>
                                <?php
                                foreach ($combooactos as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$acto) echo "selected";?> value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                    <?php
                                }
                                ?>
                            </select><br>
                            <label>ACTO</label>
                        </div>
                    </div>

                
                

                    <div class="col-md-5">
                        <div class="ui-widget" style="position:absolute; left: 10px; top: 0px;">
                            <select style="width:450px;" id="comboboxoficialia"  required="" >

                                <option value="0">ESCRIBE O SELECCIONA UNA OFICIALIA</option>
                                <?php
                                foreach ($combooficialias as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$juzgado) echo "selected";?> value="<?php echo $item[0] ?>"><?php echo $item[0] . " " . $item[1] . " " . $item[2]; ?></option>
                                    <?php
                                }
                                ?>
                            </select><br>
                            <label>MUNICIPIO OFICIALIA</label>
                        </div>
                    </div>
                
                
                
                    <div class="col-md-1">
                        <div class="ui-widget">
                            <select  id="comboboxanos" required="">

                                <option  value="0">==</option>
                                <?php
                                foreach ($combooanos as $item) {
                                    ?>
                                    <option <?php if ($item==$ano) echo "selected";?> value="<?php echo $item ?>"><?php echo $item; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>A&Ncaron;O: </label>
                        </div>
                    </div>
                
                
                    <div class="col-md-1">
                        <div class="ui-widget">
                            <select id="comboboxtomos" required="" >
                                <option value="0">==</option>
                                <?php
                                foreach ($combootomos as $item) {
                                    ?>
                                    <option <?php if ($item==$tomo) echo "selected";?> value="<?php echo $item ?>"><?php echo $item; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>TOMO: </label>
                        </div>                        
                    </div>
                
                
                    <div class="col-md-1">
                        <div class="ui-widget">
                            <select id="comboboxtbis" >
                                <option value="0">==</option>
                                <?php
                                foreach ($combootomobis as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$tbis) echo "selected";?> value="<?php echo $item['0']; ?>"><?php echo $item[1]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>TBIS: </label>
                        </div>
                    </div>
                
                
            </div>
            <div class="row">                
                <div class="col-md-2">
                    <div class="ui-widget">

                        <input type="text" class="form-control" id="ACTA_INICIAL" 
                               placeholder="INICIAL">
                        <label for="ACTA_INICIAL">ACTA INICIAL</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ui-widget">

                        <input type="text" class="form-control" id="ACTA_FINAL" 
                               placeholder="FINAL">
                        <label for="ACTA_FINAL">ACTA FINAL</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ui-widget">

                        <input type="text" class="form-control" id="FOJAS" 
                               placeholder="FOJAS" required="">
                        <label for="FOJAS">FOJAS</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <select style="width:75%" id="MES_FINAL" >             
                        <?php
                        foreach ($comboomes as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>MES FINAL </label>

                </div>
                <div class="col-md-4"><div class="radio">
                        <label>
                            <input class="form-group" id="encuadernado" type="checkbox">ENCUADERNADO
                        </label>
                        <label>
                            <input id="verificado_archivo" type="checkbox">VERIFICADO EN ARCHIVO
                        </label>
                    </div>
                </div>

            </div>




            <div class="row hidden">
                <div class="col-md-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea1" value="opcion_1">VERIFICADO EN OFICIALIA
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea1" value="opcion_1">DIGITALIZADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea2" value="opcion_2"> INDEXADO
                    </label>
                    <img src="" alt=""/>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> CAPTURADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> VERIFICADO
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkboxEnLinea3" value="opcion_3"> LIBERADO
                    </label>

                </div>  
            </div>
            
            <div class="row">
                  <div class="col-md-8">
                    <input type="hidden" class="form-control"></div>
                <div class="col-md-1 " align="left"><button  id="aceptarGuardar" type="button"   >Aceptar</button></div>
                <div class="col-md-3 "><button  align="right" id="regresarBusqueda" type="button">Regresar a la Busqueda</button></div>

            </div>

        </form>
                        
        <div id="resultado"></div>

    </div><!--END DIV CONTAINER-->

        
   
        <script type="text/javascript">
            
            $("#aceptarGuardar").click(function() {                
                $.ajax({
                    type: "POST",
                    url: "webcorporativa/libros/caseLibro.php",
                    data: {
                    ACTION: "1",
                    ACTO: $(".acto").val(),
                    JUZGADO: $("#comboboxoficialia").val(),
                    ANO: $("#comboboxanos").val(),
                    TOMO: $("#comboboxtomos").val(),
                    TBIS: $("#comboboxtbis").val(),
                    ACTA_INICIAL: $("#ACTA_INICIAL").val(),
                    ACTA_FINAL: $("#ACTA_FINAL").val(),
                    FOJAS: $("#FOJAS").val(),
                    MES_FINAL: $("#MES_FINAL").val(),
                    ENCUADERNADO: $("#encuadernado").val(),
                    VERIFICADO_ARCHIVO: $("#verificado_archivo").val()                          
                    },            
                    timeout: 28000,
                    error: function(data) {
                    $("#resultado").html(data);
                    },
                    success: function(data) {
                        alert(data);
                        //console.log(data);
                        //$("#resultado").html(data);                
                    }
              });//END Ajax
            });//END aceptarGuardar
            
                         $("#regresarBusqueda").click(function() {                                
                                $('#resultSearch').load('webcorporativa/libros/buscarLibro.php');
                        });
            
        </script>

     
        
        
        
        
        
<?php
}
?>













