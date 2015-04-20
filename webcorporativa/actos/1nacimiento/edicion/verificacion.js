$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';     
    
    //Datos del registrado
   // $('#primer_apellido_registrado').editable();
	
	
    $('#segundo_apellido_registrado').editable();
    $('#nombres_registrado').editable();

    //Datos del padre
    $('#primer_apellido_padre').editable();
    $('#segundo_apellido_padre').editable();
    $('#nombres_padre').editable();

    //Datos de la madre
    $('#primer_apellido_madre').editable();
    $('#segundo_apellido_madre').editable();
    $('#nombres_madre').editable();    
    
    //sexo_registrado editable
    $('#sexo_registrado').editable({
        type: 'select',
        title: 'Select status',
        placement: 'right',
        value: 1,
        source: [
            {value: 1, text: 'Indeterminado'},
            {value: 2, text: 'Masculino'},
            {value: 3, text: 'Femenino'},
            {value: 4, text: 'Ambos'}
        ]
        /*
        //uncomment these lines to send data on server
        ,pk: 1
        ,url: '/post'
        */
    });


    //sexo_registrado editable
    $('#status_registrado').editable({
        type: 'select',
        title: 'Select status',
        placement: 'right',
        value: 1,
        source: [
            {value: 1, text: 'Indeterminado'},
            {value: 2, text: 'Vivo'},
            {value: 3, text: 'Muerto'}
        ]
    });



$(function(){
    $('#date').combodate();    
});



$(function(){
    $('#datetime12').combodate();  
});


               /* $( "#valores" ).click(function() {
                    //alert(dato);

                                     
                });*/


});