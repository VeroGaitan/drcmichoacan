
<script type="text/javascript" src="js/combobox-autocomplete.jquery.js"></script>  
<link type="text/css" rel="stylesheet" href="css/combobox-autocomplete.jquery.css" media="screen">
<script type="text/javascript" src="js/TinyTableV3.js"></script>          
<link rel="stylesheet" href="css/TinyTableV3.css">
<?PHP
unset($datos_registro);

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
    <form role="form" id="newBook" name="newBook">
        <div class="row">

            <div class="col-md-3">
                <div class="ui-widget" style="position:absolute;">

                    <select style="width: 240px" id="comboboxacto" required="" >
                        <option value="">========</option>
<?php
foreach ($combooactos as $item) {
    ?>
                            <option value="<?php echo $item['0'] ?>"><?php echo $item[1]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>ACTO </label>
                </div>
            </div>

            <div class="col-md-5">
                <div class="ui-widget" style="position:absolute;"   >

                    <select id="comboboxoficialia" style="width:450px;" required="" >                           
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
                <div class="ui-widget" style="position:absolute; left: 30px;"  >
                    <select style="width: 70px"   id="comboboxanos" required="">

                        <option value="0">==</option>
<?php
foreach ($combooanos as $item) {
    ?>
                            <option value="<?php echo $item ?>"><?php echo $item; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>A&Ncaron;O: </label>
                </div>
            </div>

            <br><br><br><br>           

            <div class="col-md-4">
                <div class="ui-widget">
                    <label>LIBROS PARA </label>
                    <select style="width: 200px"   id="PROCESO_ACTUAL" required="">
                        <option value="">==</option>
                        <option value="CAPTURADO">Capturar</option>                       
                        <option value="VERIFICADO">Verificar y Liberar</option>
                        <option value="DIGITALIZADO">Digitalizar e Indexar</option>
                    </select>
                </div>
            </div> 

            <div class="col-md-4 ">
                <button  id="buscarPara" type="button"   ><span class="glyphicon glyphicon-floppy-open"></span>BUSCAR</button>
            </div>

        </div>





    </form>

    <div id="resultSearch" style=""></div>

</div><!--END DIV CONTAINER-->


<script type="text/javascript">

    $("#buscarPara").click(function () {
        librosEncontradosPara();
    });


    function librosEncontradosPara() {
        //alert("listaLibros")
        $.ajax({
            type: "POST",
            url: "webcorporativa/libros/listaLibrosPara.php",
            data: {
                ACTO: $("#comboboxacto").val(),
                JUZGADO: $("#comboboxoficialia").val(),
                ANO: $("#comboboxanos").val(),
                PROCESO_ACTUAL: $("#PROCESO_ACTUAL").val()
            },
            timeout: 28000,
            error: function (data) {
                $("#resultSearch").html(data);
            },
            success: function (data) {
                $("#resultSearch").html(data);

            }
        });//END Ajax
    }//END listaLibros()


</script>




