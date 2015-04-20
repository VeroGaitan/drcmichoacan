/* ------------------------------------------------------------------
   FUNCION verificarUsuario
   ------------------------------------------------------------------ */

function verificarUsuario(){

if($('#usuario').val()=='' || $('#password').val()==''){
  $("#res").html("campos vacios");
  alert("Campos vacios");

}else{
    var usuario = $('#usuario').val();
    var password = $('#password').val();
    var passwordEncriptado=hex_md5(password);
    //alert(passwordEncriptado)
    
    $.ajax({
        url: 'class/nueva_sesion.class.php',
        type: 'POST',
        dataType: 'JSON',
        data:{
          usuario: usuario,
          password: passwordEncriptado
        },
        success: function(resultado){
                var datos=JSON.parse(resultado);
                var permisos='';
                //alert(datos.estado);
                if (datos.estado == 'existe') {
                  window.location = 'inicio.php';
                   return;
                } else if (datos.estado == 'noExiste') {
                  //alert("No existe");
                  $('#res').html('El usuario no existe');
                  return;
                }else if (datos.estado == 'statusnoactivo') {
                  $('#res').html('Estado Inactivo');
                  return;
                }else if (datos.estado == 'fechabaja') {
                  $('#res').html('Tu fecha esta dada de baja');
                  return;
                }else{
                  $('#res').html(' no definido');                 
                  return;
                }
                



              return;


        },
        error: function( xhr, status, errorThrown ) {
              alert( "Ocurrio un error al conectarse al servidor" + estado);
              console.log( "Error: " + errorThrown );
              console.log( "Status: " + status );
              console.dir( xhr );
              return;
        }
    });//END Ajax


  }

}//END funcion verificarUsuario



/* ------------------------------------------------------------------
   FUNCION ready
   ------------------------------------------------------------------ */

$(document).ready(function(){

                $( "#iniciar_sesion" ).click(function() {
                    //alert("click a boton iniciar_sesion");
                    //$('#res').html("boton iniciar_sesion");
                    verificarUsuario();
                                     
                });
             

});