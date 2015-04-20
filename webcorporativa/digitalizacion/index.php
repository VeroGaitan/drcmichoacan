<?php
include 'class/path.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digitalización e Indexación</title>
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui-1.11.3.custom/jquery-ui.css" media="screen">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/selectable.css" media="screen">
        <script>

            var oldTab = null;
            $.fn.menu = function (tab) {
                /********* declaracion de variables ***********/
                var idBtn = $("#" + tab);
                var idContainer = tab.substr(3);
                /**********************************************/
                if (oldTab !== null) {
                    $("#" + oldTab).parent().removeClass("active");
//                    $("#" + oldTab).bind("click");
                    $("#" + oldTab.substr(3)).toggleClass("hide");
                }
                idBtn.parent().addClass("active");
//                idBtn.unbind("click");
                $("#" + tab.substr(3)).toggleClass("hide");
                oldTab = tab;
            };

            $.fn.viewFile = function (file) {
                var dialogView = $('<div title="' + file + '" style="margin:0px;padding:0px;text-align:center"><embed src="' + file + '" width="950" height="500"></div>');
                dialogView.dialog({
                    resizable: false,
                    width: 965,
                    position: "top",
                    modal: true,
                    close: function () {
                        $(this).dialog("destroy");
                    }
                });
            };
            $.fn.selectedAll = function (index) {
                $(this).children().each(function () {
                    $(this).addClass("ui-selected");
                    $.inArray($(this).attr("id"));
                    if (($.inArray($(this).attr("id"), index)) === -1) {
                        index.push($(this).attr("id"));
                    }
                    console.log(index);
                });
            };
            $(document).ready(function () {
                $('*').attr('unselectable', 'on');
                $('*').css('MozUserSelect', 'none');
                $('*').css('KhtmlUserSelect', 'none');

                var index = [];

//                $('#SearchBook').toggleClass("hide").dialog({
//                    modal: true,
//                    width: 600,
//                    close: function () {
//                        $(this).toggleClass("hide").dialog("destroy");
//                    }
//                });

                $("#btnsMenu > ul > li > a").click(function () {
                    $(this).menu($(this).attr('id'));
                });


                $("#selectable").selectable({
                    unselected: function (event, ui) {
                        index.splice($.inArray(ui.unselected.id, index));
                        $.inArray(ui.unselected.id, index);
                    },
                    stop: function () {
                        $(".ui-selected", this).each(function () {
                            if (($.inArray($(this).attr("id"), index)) === -1) {
                                index.push($(this).attr("id"));
                            }
                            console.log(index);
                        });

                    }

                });


                $("#btnAll").click(function () {
                    $("#selectable").selectedAll(index);
                });

                $("#btnRename").click(function () {

                });
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-md-12 hide" id="SearchBook" title="Buscar Libro">
                <form id="formSearchBook" role="form">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-3">
                                <input type="text" name="acto" id="acto" value="" class="form-control" placeholder="Acto" required="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="anio" id="anio" value="" class="form-control" placeholder="Año" required="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tomo" id="tomo" value="" class="form-control" placeholder="Tomo" required="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tomobis" id="tomobis" value="" class="form-control" placeholder="Tomo bis" required="">
                            </div>
                        </div>
                        <hr/>
                        <hr/>
                        <div class="col-xs-12" style="text-align: right">
                            <input type="submit" class="btn btn-primary" value="Buscar libro">
                        </div>              
                    </fieldset>
                </form>
            </div>
            <div class="col-md-12 hide" id="generateRoute">generateRoute</div>
            <div class="col-md-12" id="Explorer">
                <?php
//                $explorer = new path("http://10.24.163.185/drcmichoacan/images/");

                $explorer = new path("./documentos/");
                $result = $explorer->directoryList(2, "pdf,css");
                if (empty($result)) {
                    $disbled = false;
                } else {
                    $disbled = true;
                }
//                $explorer->backupDir();
                ?>
                <script>
                    //$("#panel").attr();
                </script>
                <div class="row <?php if (!$disbled) echo "ui-state-disabled"; ?>" id="panel">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><b>Directorio principal:</b> <?php $explorer->directory(); ?>"<p class="navbar-text pull-right btn-group btn-group-sm" style="margin-top: -7px"><button type="button" class="btn btn-default <?php
                                        if (!$disbled) {
                                            echo "disabled";
                                        }
                                        ?>" id="btnAll"><span class="glyphicon glyphicon-th-list"></span> Todo</button></p></h3>
                            </div>
                            <ul class="list-group">
                                <ol id="selectable" class="selectable">
                                    <?php
                                    for ($i = 0; $i <= count($result) - 1; $i++) {
                                        $fileResult = explode("/", $result[$i]);
                                        ?>
                                        <li class="list-group-item ui-widget-content" id="A<?php echo $i; ?>"><?php echo $fileResult[2]; ?><div style="text-align: right; float: right; margin-top: -7px"><button type="button" class="btn btn-default" onclick="$(this).viewFile('<?php echo $result[$i]; ?>')"><span class="glyphicon glyphicon-search"></span></button></div></li>
                                    <?php } ?>
                                </ol>
                            </ul>
                            <div class="panel-footer" id="filesList">
                                <!--                                <ul class="list-group pagination pagination-lg" style="text-align: center; width: 100%">
                                                                    <li><a href="#">&laquo;</a></li>
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#">2</a></li>
                                                                    <li><a href="#">3</a></li>
                                                                    <li><a href="#">4</a></li>
                                                                    <li><a href="#">5</a></li>
                                                                    <li><a href="#">&raquo;</a></li>
                                                                </ul>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title"><b>Nombre sugerido</b></h3></div>
                            <ul class="list-group">
                                <?php
                                for ($i = 0; $i <= count($result) - 1; $i++) {
                                    ?>
                                    <li class="list-group-item ui-widget-content" id="B<?php echo $i; ?>">mi_nombre_nuevo_0000<?php echo $i; ?></li>
                                <?php } ?>
                            </ul>
                            <div class="panel-footer" >
                                <div class="btn-group-lg " >
                                    <a class="btn btn-primary <?php
                                    if (!$disbled) {
                                        echo "disabled";
                                    }
                                    ?>" id="btnUndo"><span class="glyphicon glyphicon-refresh"></span> Deshacer </a> 
                                    <a class="btn btn-danger <?php
                                    if (!$disbled) {
                                        echo "disabled";
                                    }
                                    ?>" id="btnCancel"><span class="glyphicon glyphicon-floppy-remove   "></span> Cancelar</a>
                                    <a class="btn btn-success <?php
                                    if (!$disbled) {
                                        echo "disabled";
                                    }
                                    ?>" id="btnRename"><span class="glyphicon glyphicon-floppy-disk"></span> Renombrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
