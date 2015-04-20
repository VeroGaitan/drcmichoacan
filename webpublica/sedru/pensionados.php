<?php

ini_set('max_execution_time', 300);
$mysqli = new mysqli("curp.michoacan.gob.mx", "consultasweb", "Rcivil2014", "imss");
$pensionados = $mysqli->query("SELECT * FROM imss.sedru_1 s;");
$_pensionados=$pensionados->fetch_all(MYSQL_BOTH);
//print_r($_pensionados)
?>
  
                          <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
      <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>  
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
        <script type="text/javascript" src="js/TinyTableV3.js"></script>          
        <link rel="stylesheet" href="css/TinyTableV3.css">
        
            

        
            <div class="row">
                <div class="col-md-12">
                                       <div id="tableheader">
                        <div class="search">

                            <select id="columns" onchange="sorter.search('query')"></select>
                            <input type="text" id="query" onkeyup="sorter.search('query')" />
                        </div>
                        <span class="details">
                            <div> <div class="btn-group-lg " >
                     <a class="btn btn-success"  id="btnRename"  onclick="javascript: location='webpublica/sedru/listaExportExcel.php'"><span class="glyphicon glyphicon-floppy-disk"></span> Descargar</a>
                    </div></div>
                            <div>Elementos <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                            <div><a href="javascript:sorter.reset()">Restablecer</a></div>
                        </span>
                    </div>
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
                                    
                                       <?php
                                       } 
                                       else {
                                           echo "CORRECTO";
                                           ?>
<!--                                        <td>
                                        <button id="editar">VER ACTA</button> 
                                    </td>-->
                                       <?php
                                       } ?>
                                   </td>                                                             
                                    </tr>
                                    <?php 
                                    
}
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

                     

                </script>   
                                                             
                 
                   


       