        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">

<?php
unset($edicion);
require_once '../../class/catalogos.class.php';
$edicion = new catalogos(); //Usa la clase
$combooficialias1 = $edicion->cat_oficialias();
$combootomos1 = $edicion->cat_tomos();
$combooanos1 = $edicion->cat_anos();
$combooactos1 = $edicion->cat_actos();
$combootomobis1 = $edicion->cat_tbis();
$comboomes1 = $edicion->cat_meses();

//print_r($combooactos1);
//print_r($combootomobis1);
$ID=filter_input(INPUT_POST, 'ID_LIBRO');
$sql="SELECT * FROM drcmichoacan.cat_libros c where ID_LIBRO={$ID}  limit 1;";

        $editarLibro=$edicion->execute_single_query($sql);

        //$editarLibro=$datos_registro->execute_single_query("SELECT * FROM drcmichoacan.cat_libros c where Id_LIBRO=4380 limit 1;");
        //print_r($editarLibro);

?>

<form role="form" id="editBook" name="editBook">

<!--************************************************************************************************+-->
                <div class="row">
                    <div class="col-md-3">                        
                        <div class="ui-widget" style="height:500px; position:absolute; left: 5px; top: 0px;">
                            <select  style="width:240px;" id="comboboxacto" required="" class="actoedit">
                                <option value="">========</option>
                                <?php
                                foreach ($combooactos1 as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$editarLibro['ACTO']) echo "selected";?> value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                    <?php
                                }
                                ?>
                            </select><br>
                            <label>ACTO</label>
                        </div>
                    </div>



                    <div class="col-md-5">
                        <div class="ui-widget" style="height:500px; position:absolute; left: 75px; top: 0px;">
                            <select style="width:450px;" id="comboboxoficialia"  required="" class="juzgadoedit">

                                <option value="0">ESCRIBE O SELECCIONA UNA OFICIALIA</option>
                                <?php
                                foreach ($combooficialias1 as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$editarLibro['JUZGADO']) echo "selected";?> value="<?php echo $item[0] ?>"><?php echo $item[0] . " " . $item[1] . " " . $item[2]; ?></option>
                                    <?php
                                }
                                ?>
                            </select><br>
                            <label>MUNICIPIO OFICIALIA</label>
                        </div>
                    </div>
                </div><br>



<!--************************************************************************************************-->
                <div class="row">
                    <div class="col-md-1">
                        <div class="ui-widget" style="height:500px; position:absolute; left: 5px; top: 40px;">
                            <select style="width:70px;"   id="comboboxanos" required="">

                                <option  value="0">==</option>
                                <?php
                                foreach ($combooanos1 as $item) {
                                    ?>
                                    <option <?php if ($item==$editarLibro['ANO']) echo "selected";?> value="<?php echo $item ?>"><?php echo $item; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>A&Ncaron;O: </label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="ui-widget" style="height:500px; position:absolute; left: 85px; top: 40px;">
                            <select style="width: 70px" id="comboboxtomos" required="" >
                                <option value="0">==</option>
                                <?php
                                foreach ($combootomos1 as $item) {
                                    ?>
                                    <option <?php if ($item==$editarLibro['TOMO']) echo "selected";?> value="<?php echo $item ?>"><?php echo $item; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>TOMO: </label>
                        </div>                        
                    </div>
                    <div class="col-md-1">
                        <div class="ui-widget" style="height:500px; position:absolute; left: 155px; top: 40px;">
                            <select style="width: 70px"   id="comboboxtbis" >
                                <option value="0">==</option>
                                <?php
                                foreach ($combootomobis1 as $item) {
                                    ?>
                                    <option <?php if ($item['0']==$editarLibro['TBIS']) echo "selected";?> value="<?php echo $item['0']; ?>"><?php echo $item[1]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label>TBIS: </label>
                        </div>
                    </div>
                </div>

<!--************************************************************************************************-->

                <div class="row">                
                    <div class="col-md-2">
                        <div class="form-group" style="height:500px; position:absolute; left: 5px; top: 100px;">

                            <input style="width: 150px" type="text" class="form-control" id="ACTA_INICIAL"  value="<?php  echo $editarLibro['ACTA_INICIAL'] ?>"
                                   placeholder="INICIAL">
                            <label for="ACTA_INICIAL">ACTA INICIAL</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="height:500px; position:absolute; left: 35px; top: 100px;">
                            <input style="width: 150px" type="text" class="form-control" id="ACTA_FINAL"  value="<?php  echo $editarLibro['ACTA_FINAL'] ?>"
                                   placeholder="FINAL">
                            <label for="ACTA_FINAL">ACTA FINAL</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="height:500px; position:absolute; left: 65px; top: 100px;">
                            <input style="width: 150px" type="text" class="form-control" id="FOJAS" value="<?php  echo $editarLibro['FOJAS'] ?>"
                                   placeholder="FOJAS" required="">
                            <label for="FOJAS">FOJAS</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="ui-widget" style="height:500px; position:absolute; left: 105px; top: 100px;">
                        <select style="width:200px" id="MES_FINAL" class="mesfinaledit">             
                            <?php
                            foreach ($comboomes1 as $item) {
                                ?>
                                <option  <?php if($editarLibro["MES_FINAL"]==$item) echo "selected"  ?>  value="<?php echo $item ?>"><?php echo $item; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>MES FINAL </label>
                    </div>
                    </div>
                </div>


<!--************************************************************************************************+-->

                    <div class="row">                    
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 5px; top: 220px;">                            
                            <label class="checkbox-inline">
                                <input type="checkbox" id="ENCUADERNADO" value="<?php echo $editarLibro['ENCUADERNADO'] ?>">ENCUADERNADO
                            </label>
                        </div>
                        <div class="col-md-3" style="left: 230px; top: 170px;">
                            <!--<label class="checkbox-inline">-->
                                <input type="checkbox" id="VERIFICADO_ARCHIVO" value="<?php echo $editarLibro['VERIFICADO_ARCHIVO'] ?>"> VERIFICADO EN ARCHIVO
                            <!--</label>-->
                        </div>

                        <div class="col-md-3" style="left: 220px; top: 170px;">    
                            <!--<label class="checkbox-inline">-->
                                <input type="checkbox" id="VERIFICADO_OFICIALIA" value="<?php echo $editarLibro['VERIFICADO_OFICIALIA'] ?>"> VERIFICADO EN OFICIALIA
                            <!--</label>-->
                        </div>
                    </div>    


<!--************************************************************************************************+-->

                    <br>

                    <div class="row">                    
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 5px; top: 285px;">                            
                            <label class="checkbox-inline">
                                <input type="checkbox" id="DIGITALIZADO" value="<?php echo $editarLibro['DIGITALIZADO'] ?>">DIGITALIZADO
                            </label>
                        </div>
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 150px; top: 285px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="INDEXADO" value="<?php echo $editarLibro['INDEXADO'] ?>"> INDEXADO
                            </label>
                        </div>
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 295px; top: 285px;">                           
                            <label class="checkbox-inline">
                                <input type="checkbox" id="CAPTURADO" value="<?php echo $editarLibro['CAPTURADO'] ?>"> CAPTURADO
                            </label>
                        </div>
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 440px; top: 285px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="VERIFICADO" value="<?php echo $editarLibro['VERIFICADO'] ?>"> VERIFICADO
                            </label>
                        </div> 
                        <div class="col-md-2" style="width:85px; height:500px; position:absolute; left: 585px; top: 285px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="LIBERADO"  value="<?php echo $editarLibro['LIBERADO'] ?>" >LIBERADO
                            </label>
                        </div>
                    </div>     
                    
<!--************************************************************************************************+-->                    

                    <br>
                    <div class="row">                    
                        <div class="col-md-2" style="width:200px; height:500px; position:absolute; left: 5px; top: 340px;">                            
                            <label class="checkbox-inline">
                                <input type="checkbox" id="NO_LOCALIZADO" value="<?php echo $editarLibro['NO_LOCALIZADO'] ?>">NO LOCALIZADO
                            </label>
                        </div>
                        <div class="col-md-2" style="width:85px; height:1000px; position:absolute; left: 200px; top: 335px;">
                            <label class="checkbox-inline">
                                <textarea id="OBSERVACIONES" class="OBSERVACIONES" placeholder="OBSERVACIONES..." cols="70" rows="1"><?php echo $editarLibro['OBSERVACIONES'] ?></textarea>
                            </label>
                        </div>

                    </div>    


</form>

    
 
