
        <script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>  
        <link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
        <script type="text/javascript" src="js/TinyTableV3.js"></script>          
        <link rel="stylesheet" href="css/TinyTableV3.css">

<?PHP
unset($datos_registro);
unset($clase);
unset($listaLibros);
unset($edicion);
unset($editarLibro);


//CODIGO PARA DATOS DE REGISTRO
//DATOS DE LA OFICIALIA
require '../../class/catalogos.class.php';
$datos_registro = new catalogos(); //Usa la clase
$combooficialias = $datos_registro->cat_oficialias();
$combootomos = $datos_registro->cat_tomos();
$combooanos = $datos_registro->cat_anos();
$combooactos = $datos_registro->cat_actos();
$combootomobis = $datos_registro->cat_tbis();
$comboomes = $datos_registro->cat_meses();
//print_r($combooficialias);
?>

    <div class="container">

     <div id="resultSearch">
        <form role="form" id="newBook" name="newBook">
            <div class="row">

                <div class="col-md-3">
                    <div class="ui-widget" style="height:500px; position:absolute; left: 5px; top: 0px;">

                        <select style="width: 240px" id="comboboxacto" required=""  class="acto">
                            <option value="">========</option>
                            <?php
                            foreach ($combooactos as $item) {
                                ?>
                                <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                        <label>ACTO </label>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="ui-widget" style="height:500px; position:absolute; left: 10px; top: 0px;">

                        <select id="comboboxoficialia" style="width:430px;"required="" class="juzgado">

                            <option value="0">ESCRIBE O SELECCIONA UNA OFICIALIA</option>
                            <?php
                            foreach ($combooficialias as $item) {
                                ?>
                                <option value="<?php echo $item[0] ?>"><?php echo $item[0] . " " . $item[1] . " " . $item[2]; ?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                        <label>MUNICIPIO OFICIALIA</label>

                    </div>
                </div>
                <div class="col-md-1">
                <div class="ui-widget" style="height:500px; position:absolute; left: 10px; top: 0px;">
                    <select  style="width:70px;"   id="comboboxanos" required="">

                        <option value="0">==</option>
                        <?php
                        foreach ($combooanos as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                    <label>A&Ncaron;O: </label>
                </div>
                </div>
                <div class="col-md-1">
                     <div class="ui-widget" style="height:500px; position:absolute; left: 20px; top: 0px;">
                    <select style="width: 70px" id="comboboxtomos" required="" >
                        <option value="0">==</option>
                        <?php
                        foreach ($combootomos as $item) {
                            ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                        <label>TOMO: </label>
                    </div>
                    
                </div>
                <div class="col-md-2">
                     <div class="ui-widget" style="height:500px; position:absolute; left: 30px; top: 0px;">
                    <select style="width: 70px"   id="comboboxtbis" >
                        <option value="0">==</option>
                        <?php
                    foreach ($combootomobis as $item) {
                        ?>
                            <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                        <?php
                    }
                        ?>
                    </select><br>
                    <label>TBIS: </label>
                </div>
                </div><br><br><br>


                <div class="col-md-4 ">
                    <button  id="buscarLibro" type="button"><span class="glyphicon glyphicon-floppy-open"></span>BUSCAR</button>
                </div>

            </div>
        
        </form>
        </div><!--END DIV resultSearch-->

        <div id="vacio" value="noExiste" style=""></div>  
        <div id="dialog-editar" style=""></div>         

</div><!--END DIV CONTAINER-->


        <script type="text/javascript">
            var ENCUADERNADO="0", VERIFICADO_ARCHIVO="0", VERIFICADO_OFICIALIA="0", DIGITALIZADO="0", INDEXADO="0", CAPTURADO="0", VERIFICADO="0", LIBERADO ="0", NO_LOCALIZADO="0"; 
          

               $("#buscarLibro").click(function() {
                     listaLibros();
                });


                function listaLibros(){
                    //alert($(".acto").val());
                    //alert($(".juzgado").val());
                        $.ajax({
                            type: "POST",
                            url: "webcorporativa/libros/listaLibros.php",
                            data: {
                                ACTION:"3",
                                ACTO:$(".acto").val(),
                                JUZGADO:$(".juzgado").val(),
                                ANO:$("#comboboxanos").val(),
                                TOMO:$("#comboboxtomos").val(),
                                TBIS:$("#comboboxtbis").val()                                            
                            },            
                            timeout: 28000,
                            error: function(data) {   
                                        $("#resultSearch").html(data);

        //                        $('<div id="dialog" title="ALERTA"><p><span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>Al parecer algo salio mal, intentalo nuevamente o llama a nuestra linea de actas foraneas 555-555-55-55<p></div>').dialog({
        //                            modal: true,
        //                            buttons: {Ok: function() {
        //                                    $(this).dialog("close");
        //                                    $(this).remove();
        //                                }}
        //                        });
                            },
                            success: function(data) { 
                                //alert(data);
                                                           
                                        if(data === $("#vacio").val()){
                                                alert("El libro no existe");  
                                                <?php unset($datos_registro); ?>
                                                <?php unset($clase); ?>
                                                <?php unset($listaLibros); ?>
                                                <?php unset($edicion); ?>
                                                <?php unset($editarLibro); ?> 
                                                //return; 
                                        }else{
                                            $("#resultSearch").html(data);
                                        }
                                        
                                                              
                            }
                        });//END Ajax
                }//END listaLibros()



//******************************************************************************

                        function editarLibros(ID_LIBRO) {
                            //alert(ID_LIBRO);                                                                                  
                                $.ajax({
                                    type: "POST",
                                    url: "webcorporativa/libros/editarLibro.php",
                                    data: {
                                        ID_LIBRO: ID_LIBRO                         
                                    },
                                    timeout: 28000,
                                    error: function(data) {
                                        alert(data);
                                        alert("afasdas");

                                    },
                                    success: function(data) {
                                        //alert(data);
                                        
                                        $("#dialog-editar").html(data);                                                                                                                                                                                        
                                         muestraActivos();     

                                                   $("#dialog-editar").dialog({
                                                    autoOpen: true,
                                                    title: 'Editar Libro',
                                                    resizeable: false,
                                                    modal: true,
                                                    width: 900,
                                                    height: 500,

                                                         buttons: [
                                                            {
                                                            text: "Cancelar",
                                                                click: function() {
                                                                    $( this ).dialog( "close" );
                                                                }                           
                                                            },
                                                            {
                                                            text: "Guardar",
                                                                click: function() {  

                                                                    guardarLibroEditado(ID_LIBRO);                                                                    
                                                                    $( this ).dialog( "close" );                                                                    
                                                                    ENCUADERNADO="0", VERIFICADO_ARCHIVO="0", VERIFICADO_OFICIALIA="0", DIGITALIZADO="0", INDEXADO="0", CAPTURADO="0", VERIFICADO="0", LIBERADO ="0", NO_LOCALIZADO="0";                            
                                                                    
                                                                    
                                                                }                           
                                                            }                            
                                                        ]


                                                    });
                                    

                                    }

                                });//END Ajax  
                        }//END editarLibros()



                    function guardarLibroEditado(ID_LIBRO){
                    //alert("Entra A Guardar DE LISTA LIBRO");
//alert($(".actoedit").val()+" "+$(".juzgadoedit").val()+" "+$("#comboboxanos").val()+" "+$("#ACTA_INICIAL").val()+" "$("#ACTA_FINAL").val()+" "+$("#MES_FINAL").val());
//alert($(".mesfinaledit").val());
                    verificaActivos();    

                    $.ajax({
                        type: "POST",
                        url: "webcorporativa/libros/caseLibro.php",
                        data: {
                            ACTION: "3",
                            ID_LIBRO: ID_LIBRO, 
                            ACTO: $(".actoedit").val(), 
                            JUZGADO: $(".juzgadoedit").val(),
                            ANO: $("#comboboxanos").val(),
                            TOMO: $("#comboboxtomos").val(),
                            TBIS: $("#comboboxtbis").val(),
                            ACTA_INICIAL: $("#ACTA_INICIAL").val(),
                            ACTA_FINAL: $("#ACTA_FINAL").val(),
                            MES_FINAL: $("#MES_FINAL").val(),
                            FOJAS: $("#FOJAS").val(),                                                       
                            ENCUADERNADO: ENCUADERNADO,
                            VERIFICADO_ARCHIVO: VERIFICADO_ARCHIVO,
                            VERIFICADO_OFICIALIA: VERIFICADO_OFICIALIA,
                            DIGITALIZADO: DIGITALIZADO,
                            INDEXADO: INDEXADO,
                            CAPTURADO: CAPTURADO,
                            VERIFICADO: VERIFICADO,
                            LIBERADO: LIBERADO,
                            NO_LOCALIZADO: NO_LOCALIZADO,
                            OBSERVACIONES: $(".OBSERVACIONES").val()
                        },
                        timeout: 28000,
                        error: function(data) {
                            alert(data);

                        },
                        success: function(data) {
                            //alert(data);
                            //listaLibros()
                            actualizaTabla();
                            var datos=JSON.parse(data);                                                     
                            if(datos.estado =='updateExitoso'){
                                alert("ACTUALIZACION EXITOSA");                                
                            }
                            
                        },
                        complete: function(){ //A function to be called when the request finishes (after success and error callbacks are executed) - from jquery docs                                       
                            
                        }                        
                    });


                }//END GuardarLibroEditado()   



                    function muestraActivos(){
                                 if(document.getElementById("ENCUADERNADO").value=="1"){                               
                                    document.getElementById("ENCUADERNADO").checked=true;
                                 }
                                  if(document.getElementById("VERIFICADO_ARCHIVO").value=="1"){                                    
                                    document.getElementById("VERIFICADO_ARCHIVO").checked=true;
                                 }
                                  if(document.getElementById("VERIFICADO_OFICIALIA").value=="1"){                                  
                                    document.getElementById("VERIFICADO_OFICIALIA").checked=true;
                                 }
                                 if(document.getElementById("DIGITALIZADO").value=="1"){                                    
                                    document.getElementById("DIGITALIZADO").checked=true;
                                 }
                                  if(document.getElementById("INDEXADO").value=="1"){                                    
                                    document.getElementById("INDEXADO").checked=true;
                                 }
                                 if(document.getElementById("CAPTURADO").value=="1"){                                    
                                    document.getElementById("CAPTURADO").checked=true;
                                 }
                                  if(document.getElementById("VERIFICADO").value=="1"){                                   
                                    document.getElementById("VERIFICADO").checked=true;
                                 }
                                  if(document.getElementById("LIBERADO").value=="1"){                                    
                                    document.getElementById("LIBERADO").checked=true;
                                 }
                                  if(document.getElementById("NO_LOCALIZADO").value=="1"){                                    
                                    document.getElementById("NO_LOCALIZADO").checked=true;
                                 }                                 
                    }//END muestraActivos()    



                    function verificaActivos(){
                         if(document.getElementById("ENCUADERNADO").checked){
                            ENCUADERNADO="1";                           
                         }
                          if(document.getElementById("VERIFICADO_ARCHIVO").checked){
                            VERIFICADO_ARCHIVO="1";                            
                         }
                          if(document.getElementById("VERIFICADO_OFICIALIA").checked){
                            VERIFICADO_OFICIALIA="1";
                         }
                         if(document.getElementById("DIGITALIZADO").checked){
                            DIGITALIZADO="1";
                         }
                          if(document.getElementById("INDEXADO").checked){
                            INDEXADO="1";
                         }
                         if(document.getElementById("CAPTURADO").checked){
                            CAPTURADO="1";
                         }
                          if(document.getElementById("VERIFICADO").checked){
                            VERIFICADO="1";
                         }
                          if(document.getElementById("LIBERADO").checked){
                            LIBERADO="1";
                         }  
                          if(document.getElementById("NO_LOCALIZADO").checked){
                            NO_LOCALIZADO="1";
                         }                          
                    }//END verificarActivos()   

//*******************************************************************************
                function actualizaTabla(){
                    //alert("ACTUALIZA")
                        $.ajax({
                            type: "POST",
                            url: "webcorporativa/libros/listaLibros.php",
                            data: {
                                ACTION: $("#action").val(),
                                ACTO: $("#acto").val(),
                                JUZGADO: $("#juzgado").val(),
                                ANO: $("#ano").val(),
                                TOMO: $("#tomo").val(),
                                TBIS: $("#tbis").val()                                            
                            },            
                            timeout: 28000,
                            error: function(data) {                       
                                $("#resultSearch").html(data);
                            },
                            success: function(data) {                         
                                $("#resultSearch").html(data);
                                //$("#newBook").hidden();
                                //$("button").button();
                          
                            }
                        });//END Ajax
                }//END actualizaTabla()



        </script>




