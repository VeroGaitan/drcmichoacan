(function($) {
    $.widget("custom.combobox", {
        _create: function() {
            this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
            this.element.hide();
            $wi = this.element.css("width");
            this._createAutocomplete($wi);
            this._createShowAllButton();


        },
        _createAutocomplete: function(wi) {
            var selected = this.element.children(":selected"),
                    value = selected.val() ? selected.text() : "";
            this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .css("width", wi)
                    .addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        tooltipClass: "ui-state-highlight"
                    });
            this._on(this.input, {
                autocompleteselect: function(event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select", event, {
                        item: ui.item.option
                    });
                },
                autocompletechange: "_removeIfInvalid"
            });
        },
        _createShowAllButton: function() {
            var input = this.input,
                    wasOpen = false;
            $("<a>")
                    .attr("tabIndex", -1)
                    .attr("title", "MOSTRAR DATOS")
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .mousedown(function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .click(function() {
                        input.focus();
// Close if already visible
                        if (wasOpen) {
                            return;
                        }
// Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");
                    });
        },
        _source: function(request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option").map(function() {
                var text = $(this).text();
                if (this.value && (!request.term || matcher.test(text)))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },
        _removeIfInvalid: function(event, ui) {
// Selected an item, nothing to do
            if (ui.item) {
                return;
            }
// Search for a match (case-insensitive)
            var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
            this.element.children("option").each(function() {
                if ($(this).text().toLowerCase() === valueLowerCase) {
                    this.selected = valid = true;
                    return false;
                }
            });
// Found a match, nothing to do
            if (valid) {
                return;
            }
// Remove invalid value
            this.input
                    .val("")
                    .attr("title", value + " NO EXISTE")
                    .tooltip("open");
            this.element.val("");
            this._delay(function() {
                this.input.tooltip("close").attr("title", "");
            }, 2500);
            this.input.autocomplete("instance").term = "";
        },
        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });
})(jQuery);
$(function() {
    $("#comboboxoficialia").combobox();
    $("#comboboxacto").combobox();
    $("#comboboxanos").combobox();
    $("#comboboxanos2").combobox();
    $("#comboboxtomos").combobox();
    $("#comboboxtbis").combobox();
    $("#MES_FINAL").combobox();
    $("#etapas").combobox(); 
    

    //Para proyecto: Caputra historia 
    $( "#ID_PAIS_REG" ).combobox();
    $( "#ID_ESTADO" ).combobox();
    $( "#ID_MUNICIPIO" ).combobox();
    $( "#ID_LOCALIDAD" ).combobox();    
    $( "#ID_SEXO" ).combobox();
    $( "#ID_REGISTRADO" ).combobox();
    $( "#ID_COMPARECE" ).combobox();     
    $( "#NACIONALIDAD_PADRE" ).combobox();
    $( "#NACIONALIDAD_MADRE" ).combobox();
    
    //Defuncion
    $("#tiempoEdad").combobox();
    $("#tiempo_ins").combobox();
    $("#nacionalidad_difunto").combobox();
    $("#nacionalidad_conyugue").combobox();
    $("#nacionalidad_padre").combobox();
    $("#nacionalidad_madre").combobox();
    $("#estado_certificado_ins").combobox();
    $("#ID_PAIS_INS").combobox();
    $("#tiempoEdad_ins").combobox();
    $("#sexo_ins").combobox();
    $("#estado_certificado").combobox();
    $("#edo_civil_difunto").combobox();  

    
    //Para administrador de usuarios
    $( ".combobox" ).combobox();
    
    
    $( "#compareciente_ins" ).combobox();   

});