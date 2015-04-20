<script>
    var index = [];
    /**************************************************/
    $.pad = function (n, width, z) {
        z = z || '0';
        n = n + '';
        return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    };
    /**************************************************/
    $.fn.viewFile = function (f) {
        var PDF = f.slice(2);
        //console.log('http://10.24.163.174/digitalizacion' + PDF);
        var dialogView = $('<div style="margin:0px;padding:0px;text-align:center;overflow-x:hidden;overflow-x:hidden; "><embed src="http://10.24.163.174/digitalizacion' + PDF + '" width="100%" height="100%"></div>');
        dialogView.dialog({
            resizable: false,
            width: 965,
            height: 500,
            modal: true,
            title: f,
            close: function () {
                $(this).dialog("destroy");
            }
        }).css("overflow-x", "hidden").css("overflow-x", "hidden");
    };
    /**************************************************/
    $.fn.selectedAll = function (i) {
        $("#btnRename,#btnCancel").removeClass("disabled");
        $(this).addClass("selectable");
        $("#suggestedName").html("");
        index = [];
        $(this).children("li").each(function () {
            $(this).addLi($(this).attr("id"), i);
            i++;
        }).addClass("ui-selected");
        //console.log(index);
    };
    /**************************************************/
    $.fn.addLi = function (label_, prefix_) {
        var a = label_.split("&");
        var oldName = a.shift().split("/");
        var oldName = oldName.pop();
        var ext = oldName.split(".");
        var prefix = $.pad(prefix_, 5) + $("#bis").val() + "." + ext.pop();
        var label__ = a.pop() + prefix;
        label__ = label__.split("/");
        label__ = label__.pop();
        index.push(label_ + prefix);
        if (oldName === label__) {
            style = "color:red";
        } else if (oldName !== label__) {
            style = "color:green";
        }
        $("#suggestedName").append('<li class="list-group-item ui-widget-content" style="' + style + '">' + oldName + ' ==> ' + label__ + '</li>');
    };
    $.fn.onSelectable = function () {
        $("#btnRename,#btnCancel,#btnAll").removeClass("disabled");
        $("#selectable").selectable("enable").addClass("selectable");
    };
    /**************************************************/
    $("#selectable").selectable({
        disabled: true,
        unselected: function (event, ui) {
            index.splice($.inArray(ui.unselected.id, index));
            $.inArray(ui.unselected.id, index);
        },
        stop: function () {
            index = [];
            $("#suggestedName").html("");
            i = $("#actInicial").val();
            $(".ui-selected", this).each(function () {
                $(this).addLi($(this).attr("id"), i);
                i++;
            });
        }
    });
    /**************************************************/
    $.fn.offSelectable = function () {
        $("#actInicial").val("");
        $("#bis option:first").prop("selected", "selected");
        $("#btnRename,#btnCancel,#btnAll").addClass("disabled");
        index = [];
        $("#selectable").selectable("option", "disabled", true).removeClass("selectable");
        $("#selectable > li").removeClass("ui-selected");
        $("#suggestedName").html("");
    };
    /**************************************************/
    $("body").mousemove(function () {
        if ($("#actInicial").val() !== "") {
            $(this).onSelectable();
        }
    });
    /**************************************************/
    $("#actInicial").keydown(function (event) {
        if (event.key === "Backspace" && !$.isEmptyObject(index)) {
            $(this).offSelectable();
        }
    });
    /**************************************************/
    $.fn.btnNoOk = function () {
        this.dialog("close").remove();
    };
    $("#btnRename").click(function () {
        //creamos un nuevo objeto DOM
        var d = $("<div/>");
        //verificamos que no la variable index tenga actas seleccionadas
        if (!$.isEmptyObject(index)) {
            d.dialog({//abrimos el dialog para realizar el renombre bajo autorizacion del usuario
                title: "RENOMBRAR",
                modal: true,
                buttons: [{
                        id: "btnYes",
                        text: "SI",
                        click: function () {
                            var successControl = 1;
                            $("#btnYes,#btnNo").button("disable");
                            $(this).loadLogo("loading", $("#logo"));
                            $.each(index, function (key, value) {//recorremos index para obtener los archivos a renombrar
                                //realizamos una llamada ajax con parametros post para renombrar
                                var path = $("#path").val().slice(2);
                                /***RENOMBRAMOS DE UNA EN UNA****/
                                $.post("class/path.php", {
                                    func: "rename",
                                    path: path,
                                    fileName: value,
                                    book: JSON.stringify(book),
                                    ID_USUARIO: $("#ID_USUARIO").val()
                                }, function (data) {
                                    //data.success === "true"
                                    console.log(data);
                                    if (data.success === "true") {
                                        if (successControl === index.length) {//esta condicion nos ayuda a recargar nuevamente la visualizacion pero hasta el final del each
                                            $(this).loadLogo("charged", $("#logo"));
                                            loadViewDir(ruta, actInicial, actFinal);
                                            //avisamos que se ha renombrado con exito
                                            d.dialog("close").remove();
                                            d.dialog({
                                                modal: true,
                                                title: "RENOMBRAR",
                                                buttons: {
                                                    Ok: function () {
                                                        $(this).btnNoOk();
                                                    }
                                                }
                                            }).html("").append("SE HA RENOMBRADO CON EXITO.");
                                            /**********EN EL SIGUIENTE POST SE REALIZA LA INSERSION FINAL**************/
                                            var ACTA_INICIAL_DIGITALIZA = index[0].split("/");
                                            ACTA_INICIAL_DIGITALIZA = ACTA_INICIAL_DIGITALIZA.pop();
                                            ACTA_INICIAL_DIGITALIZA = ACTA_INICIAL_DIGITALIZA.slice(17, 22);

                                            var ultima = index.length - 1;
                                            var ACTA_FINAL_DIGITALIZA = index[ultima].split("/");
                                            ACTA_FINAL_DIGITALIZA = ACTA_FINAL_DIGITALIZA.pop();
                                            ACTA_FINAL_DIGITALIZA = ACTA_FINAL_DIGITALIZA.slice(17, 22);

                                            console.log("INICIAL: " + ACTA_INICIAL_DIGITALIZA + " FINAL: " + ACTA_FINAL_DIGITALIZA);
                                            $.post("class/path.php", {
                                                func: "bitacora",
                                                path: path,
                                                ID_LIBRO: book.ID_LIBRO,
                                                ID_USUARIO: $("#ID_USUARIO").val(),
                                                NO_IMAGENES_SALIDA: index.length,
                                                NO_IMAGENES_DIGITALIZADAS: index.length,
                                                ACTA_INICIAL_DIGITALIZA: ACTA_INICIAL_DIGITALIZA,
                                                ACTA_FINAL_DIGITALIZA: ACTA_FINAL_DIGITALIZA,
                                                NO_IMAGENES_INDEXADAS: index.length
                                            }, function (data) {
                                                console.log(data);
                                            }, "json");//, "json"
                                        }
                                        successControl++;
                                    } else if (data.success === "false") {
                                        $(this).loadLogo("charged", $("#logo"));
                                        //falta validacion en caso de no poder renombrar
                                    }
                                }, "json"); //, "json"
                            });
                        }
                    }, {
                        id: "btnNo",
                        text: "NO",
                        click: function () {
                            $(this).btnNoOk();
                        }
                    }
                ]
            }).append("<b>IMAGENES A RENOMBRAR:</b> " + index.length + "<br/><b>¿DESEA CONTINUAR?</b>").css("text-align", "center");
        } else {
            d.dialog({modal: true, title: "ADVERTENCIA", buttons: {"OK": function () {
                        $(this).btnNoOk();
                    }}}).html("").append("NO SE HA SELECCIONADO NINGUNA IMAGEN").css("text-align", "center");
        }
    });</script>
<div class="col-md-12">
    <?php
    include_once '../../class/path.php';
    $explorer = new path(filter_input(INPUT_GET, "ruta") . "/");
    $result = $explorer->directoryList(2, "PDF,TIFF,TIF");

//var_dump($result);
    $path = $explorer->directory();
    if (empty($result)) {
        $disbled = false;
    } else {
        $disbled = true;
    }
//                $explorer->backupDir();
    ?>

    <div class="row <?php
    if (!$disbled) {
        echo "ui-state-disabled";
    }
    ?>" id="panel">
        <div class="col-md-12">
            <div class="well">
                <span class="label label-success">RENOMBRAR</span> <span class="label label-danger">RENOMBRAR CON PRECAUCION</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Directorio principal:</b> <input type="text" value="<?php echo str_replace("/", "\\", $path); ?>" readonly="" style="width: 250px" /><input type="hidden" value="<?php echo $path; ?>" id="path"><p class="navbar-text pull-right btn-group btn-group-sm" style="margin-top: -6px"><button type="button" onclick="loadViewDir(ruta, actInicial, actFinal);" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button><button type="button" class="btn btn-default disabled <?php
                            if (!$disbled) {
                                echo "disabled";
                            }
                            ?>" id="btnAll" onclick="$('#selectable').selectedAll($('#actInicial').val());"><span class="glyphicon glyphicon-th-list"></span> Todo</button>
                        </p>
                    </h3>
                </div>
                <ul class="list-group">
                    <ol id="selectable" class="" style="list-style-type: none; margin: 0; padding: 0; width: 100%;">
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $fileResult = explode("/", $result[$i]);
                            ?>
                            <script></script>
                            <li class="list-group-item ui-widget-content" id="<?php echo $result[$i] . "&" . $path . substr(str_replace("/", "", $path), 2); ?>"><?php echo array_pop($fileResult); ?><div style="text-align: right; float: right; margin-top: -7px"><button type="button" class="btn btn-default" onclick="$(this).viewFile('<?php echo $result[$i]; ?>')"><span class="glyphicon glyphicon-search"></span></button></div></li>
                        <?php } ?>
                    </ol>
                </ul>
                <div class="panel-footer" id="filesList">
                    <div id="pag"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Nombre sugerido:</b>
                        <p class="navbar-text pull-right btn-group btn-group-sm" style="margin-top: -6px" class="pull-right">
                            <input type="number" min="1" max="1000" value="" placeholder="ACTA INICIAL" name="actInicial" id="actInicial">
                            BIS: 
                            <select id="bis" onchange="$('#selectable').removeClass('selectable');
                                    $('#selectable > li').removeClass('ui-selected');
                                    $('#suggestedName').html('')">
                                <option selected="" value="">-</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </p>
                    </h3>

                </div>
                <ul class="list-group" id="suggestedName">
                    <!--aqui se agregar los nombre sugeridos con append de jquery-->
                </ul>
                <div class="panel-footer">
                    <div class="btn-group-lg ">
                        <a class="btn btn-primary" id="btnSearch" onclick="$(this).dialogBuscarLibro($.searchFail, $.searchSuccess);"><span class="glyphicon glyphicon-book"></span> BUSCAR LIBRO </a> 
                        <a class="btn btn-danger disabled" id="btnCancel" onclick="$(this).offSelectable();"><span class="glyphicon glyphicon-floppy-remove   "></span> CANCELAR</a>
                        <!--<div style="text-align: right">-->
                        <a class=" btn btn-success disabled <?php
                        if (!$disbled) {
                            echo "";
                        }
                        ?>" id="btnRename"><span class="glyphicon glyphicon-floppy-disk"></span> RENOMBRAR</a>
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>