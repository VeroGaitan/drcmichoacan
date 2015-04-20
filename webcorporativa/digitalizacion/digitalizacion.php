<script>
//    $(document).mousedown(function (e) {
//        if (e.button === 2) {
//            console.log("right");
//        }
//    });

    //llamada a dialog para buscar libro
    var ruta = actInicial = actFinal = null;

    /**************************************************/
    $.searchFail = function () {
        console.log(book);
        var json = null;
        var d = $("<div/>");
        //abrimos ventana modal para las acciones en caso de no encontrar el libro
        d.dialog({
            modal: true,
            resizable: false,
            width: 700,
            title: "¡LIBRO NO ENCONTRADO!",
            buttons: [
                {
                    id: "btnYes",
                    text: "SI",
                    click: function () {
                        //al decir que si ocultamos los botones SI y NO
                        $("#btnYes,#btnNo").hide();
                        //cambiamos el contenido para solicitar la acta inicial y la acta final
                        var html = "<b>ACTO:</b> " + book.ACTO +
                                " <b>MUNICIPIO-OFICIALIA:</b> " + book.JUZGADO +
                                " <b>AÑO:</b> " + book.ANO +
                                " <b>TOMO:</b> " + book.TOMO +
                                " <b>TBIS:</b> " + book.TBIS +
                                "<br/>\n\
                <b>*Campos obligatorios</b><hr/>\n\
<form id=\"frmNumAct\">\n\
<input placeholder=\"*ACTA INICIAL\" type=\"text\" id=\"actInicial-notnull\"/> - \n\
<input placeholder=\"*ACTA FINAL\" type=\"text\" id=\"actFinal-notnull\" /></form>";
                        $("#alertBook").html("").append(html);
                        //creamos el boton guardar y lo agragamos al dialog
                        var buttonSet = $(this).parent().find('.ui-dialog-buttonset');
                        var newButton = $('<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">GUARDAR</button>');
                        buttonSet.append(newButton);
                        //creamos el evento click del boton GUARDAR
                        newButton.button().click(function () {
                            if (validateForm($("#frmNumAct"))) {
                                if ($("#actFinal").val() <= $("#actInicial").val()) {
                                    $("<div/>").dialog({modal: true, buttons: {"Ok": function () {
                                                $(this).dialog("close");
                                            }}}).append("LA ACTA FINAL NO PUEDE SER MENOR A LA ACTA INICIAL.").prev(".ui-dialog-titlebar").hide();
                                } else {
                                    actInicial = $("#actInicial-notnull").val();
                                    actFinal = $("#actFinal-notnull").val();
                                    $.post("webcorporativa/digitalizacion/dialogBuscarLibro.php", {
                                        funct: "registrarLibro",
                                        acto: book.ACTO,
                                        anio: book.ANO,
                                        juzgado: book.JUZGADO,
                                        tbis: book.TBIS,
                                        tomo: book.TOMO,
                                        actInicial: actInicial,
                                        actFinal: actFinal
                                    },
                                    function (jsonRequest) {
                                        console.log(jsonRequest);
                                        ruta = jsonRequest.R;
                                        json = jsonRequest;
                                        if (jsonRequest.success === "true") {
                                            newButton.addClass("ui-state-disabled").attr('disabled', 'disabled');
                                            var rut = jsonRequest.R.replace(new RegExp("/", "g"), "\\");
                                            $("#alertBook").html("¡LISTO! EL LIBRO SE HA CREADO.<hr/><div class=\"input-group input-group-lg\"><span class=\"input-group-addon\">RUTA: </span><input type=\"text\" class=\"form-control\" value=\"" + rut + "\" ></div>");
                                            loadViewDir(ruta.slice(3), actInicial, actFinal);
                                        } else if (jsonRequest.success === "false") {
                                            //falta validacion
                                        }
                                    }, "json"); //
                                }
                            }
                        });
                    }
                }, {
                    id: "btnNo",
                    text: "NO",
                    click: function () {
                        $(this).dialog("close");
                    }
                }
            ],
            close: function () {
                $(this).dialog("destroy").enableMenu();
            }
        })
                .append("\
<div id=\"alertBook\" style=\"text-align:center\"class=\"\">\n\
<b>ACTO:</b> " + book.ACTO + " <b>MUNICIPIO-OFICIALIA:</b> " + book.JUZGADO + " <b>AÑO:</b> " + book.ANO + " <b>TOMO:</b> " + book.TOMO + " <b>TBIS:</b> " + book.TBIS + "\n\
<hr/>\n\
El libro no existe, ¿Desea darlo de alta? \n\
</div>")
                .disableMenu();

    };




    /**************************************************/
    $.searchSuccess = function () {
        console.log("SUCCESS");
        console.log(book);
        ruta = book.RUTA.slice(3);
        actInicial = book.ACTA_INICIAL;
        actFinal = book.ACTA_FINAL;
        loadViewDir(ruta, actInicial, actFinal);
    };
    /**************************************************/
    var loadViewDir = function (r, i, f) {
        $(this).loadLogo("loading", $("#logo"));
        console.log(load = "webcorporativa/digitalizacion/viewDir.php?ruta=" + r + "&actInicial=" + i + "&actFinal=" + f);
        $("#viewDir").load(load,
                function () {
                    $(this).loadLogo("charged", $("#logo"));
                    $(this).show();
                });
    };
    /**************************************************/
    $(document).dialogBuscarLibro($.searchFail, $.searchSuccess);
</script>  
<div id="viewDir" style="display: none"></div>
