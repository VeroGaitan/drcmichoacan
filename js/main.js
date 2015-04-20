var book = null;
var frmData = null;
(function () {
    var inactiveStatus = oldCont = oldLogo = null;
    $.fn.extend({
        loadLogo: function (l) {
            if (l === "loading") {
                oldLogo = $("#logo").attr("src");
                $("#logo").attr("src", "images/wait.gif");
            } else if (l === "charged") {
                $("#logo").attr("src", oldLogo);
            }
        },
        contentLoaded: function (str, title) {
            if (str !== "#" && str !== oldCont) {//
                $(this).loadLogo("loading");
                $("#loadTitle").html(title);
                $("#loadCont").load(str, function () {
                    $(this).loadLogo("charged");
                    $("#loadParent").show();
                });
            }
        },
        disableMenu: function () {
            $("#nav > li").toggleClass("disabled");
        },
        enableMenu: function () {
            $("#nav > li").toggleClass("disabled");
        },
        dialogBuscarLibro: function (failFn, successFn) {
            var option = null;
            //espeficiamos la ruta de la estructura del dialog (form)
            var f = "webcorporativa/digitalizacion/dialogBuscarLibro.php";
            //creamos un nuevo objeto DOM
            if ($("#dialogFrmBuscarLibro").length === 0) {
                var frmSearchBook = $("<div/>").attr("id", "dialogFrmBuscarLibro");
                //cargamos en el nuevo objeto la estructura del dialog
                frmSearchBook.load(f, function () {
                    //lo abrimos en forma de dialog
                    frmSearchBook.dialog({
                        //establecemos atributos
                        title: "BUSCAR LIBRO",
                        modal: true,
                        width: 650,
                        heigth: 700,
                        resizable: false,
                        //creamos botones...
                        buttons: {
                            "BUSCAR": function () {
                                //validamos que los campos del formulario no esten vacios... esta funcion pretendo mejorarla con otra clase ya hecha pero se deja asi para su uso rapido 15/03/2015
                                if (validateForm($("#frmSearchBook"))) {
                                    console.log(frmData = $("#frmSearchBook").serialize());
                                    //llamada tipo ajax con parametros post
                                    $.post(
                                            f,
                                            $("#frmSearchBook").serialize() + "&funct=search",
                                            function (jsonRequest) { //funcion que recibe datos del tipo json
                                                console.log(book = jsonRequest);
                                                if (jsonRequest.search === "fail") {
                                                    //searchFail nos da opciones a realizar algo en espefico al fallar la busqueda segun donde usemos el dialog
                                                    //recibe un parametro identificador
                                                    failFn();
                                                } else {
                                                    successFn();
                                                }
                                                frmSearchBook.dialog("close");
                                            }, "json");
                                }
                            }
                        },
                        close: function () {
                            //acciones a tomar al cerrar el dialog
                            $(this).dialog("destroy").enableMenu(); //esta funcion habilita el nuevamente el menu
                        }
                    }).disableMenu(); //esta funcion deshabilita el menu mientras el dialog esta operando
                });
            }
        },
        /***************FUNCION PARA CERRAR CESION*****************************/
        closeSession: function (goTo) {
            // this.click(function () {
            if ($("#dialogOut").dialog("isOpen") !== true) {
                btn = $(this);
                btn.parent().addClass("disabled");
                $("<div/>").dialog(
                        {
                            width: 400,
                            heigth: 200,
                            resizable: false,
                            buttons: {
                                "SI": function () {
                                    window.location = goTo;
                                },
                                "NO": function () {
                                    $(this).dialog("close");
                                }
                            },
                            title: "CERRAR SESION",
                            modal: true,
                            close: function () {
                                btn.parent().removeClass("disabled");
                                $(this).dialog("destroy").remove();
                            }
                        })
                        .append("¿DESEAS CERRAR LA SESION ACTUAL?")
                        .attr("id", "dialogOut")
                        .css("text-align", "center")
                //.prev(".ui-dialog-titlebar")
                //.hide();
            }
            //});
        },
        disableFunctions: function () {
            $('*').attr('unselectable', 'on');
            $('*').css('MozUserSelect', 'none');
            $('*').css('KhtmlUserSelect', 'none');
            this.bind("contextmenu", function () {
                return false;
            });
        },
        buildMenu: function (nav, ID_USUARIO) {
            $.ajax({
                type: "GET",
                url: "class/menuPrincipal.class.php",
                data: {
                    ID_USUARIO: ID_USUARIO
                }
            }).done(function (myMenu) {
                nav.prepend(myMenu);
            });
        },
        userActivity: function (downtime) {
            //downtime en milisegundos
            if (downtime !== "disabled") {
                var b = this;
                b.mousemove(function (event) {
                    x = event.screenX, y = event.screenY;
                    b.mouseActive();
                }).mousemove(function (event) {
                    setTimeout(function () {
                        if ((x === event.screenX) && (y === event.screenY)) {
                            b.mouseInactive();
                        }
                    }, downtime);
                });
            }
        },
        mouseActive: function () {

            if (inactiveStatus) {
                var b = $("#msjInactive");
                b.countdown('stop').hide("blind", "fast");
                inactiveStatus = false;
            }
        },
        mouseInactive: function () {
            inactiveStatus = true;
            var b = $("#msjInactive");
            b.countdown($.datepicker.formatDate('yy-mm-dd', new Date()) + " " + new Date().getHours() + ":" + (new Date().getMinutes() + 2) + ":" + new Date().getSeconds(), function (event) {
                $(this).show("blind", "fast");
                $(this).children().text("HAZ ESTADO INACTIVO DURANTE 3 MINUTOS, LA SESION SE CERRARA EN: " + event.strftime('%H:%M:%S'));
            }).on('finish.countdown', function () {
                window.location = "inicio.php?logOut=true";
            });
        },
        dialogMsj: function (title, text) {
            $("<div>").dialog({
                title: title,
                modal: true,
                buttons: {
                    "Ok": function () {
                        $(this).dialog("close");
                    }
                },
                close: function () {
                    $(this).remove();
                }
            }).html(text);
        }
    });
})(jQuery);