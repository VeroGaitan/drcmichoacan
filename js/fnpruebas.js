(function () {
$.fn.name = function () {
    
    $("<div/>").dialog({
        modal: true,
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
};

$.fn.name1 = function () {
    $("<div/>").dialog({
        modal: true,
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
};

});
function names() {
    alert("HOLA");
   
}




