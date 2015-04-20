function verificarUsuario(){
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
            alert("as");
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
              console.log( "Error: " + errorThrown );
              console.log( "Status: " + status );
              console.dir( xhr );
              return;
        }
    }).done(function(){
        alert("adddd");
    });//END Ajax

}//END funcion verificarUsuario
