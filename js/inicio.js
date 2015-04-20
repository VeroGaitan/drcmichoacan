	
$(document).ready(function() {


 $.ajax({
        url: 'class/permisos.php',
        success: function(resultado){   
                var datos=JSON.parse(resultado);
                var permisos=[];              
              
                $.each( datos, function( index, value ) {
                    if(datos[index].ID_PERMISO!=undefined)
                        permisos[index]=datos[index].ID_PERMISO;
                        //alert(permisos[index]);                  
                });

                if(permisos.length!=0){

                                    $.each( datos, function( i, val ) {
                                        switch (permisos[i]) {
                                          case '1': $("#menu").append("<li><a href='#' onclick='contenidoCertificacion();return false;'>Certificaci&oacute;n</a></li><ul id='submenu1'></ul>");
                                            break;
                                          case '2': $("#submenu1").append("<li><a href='#' onclick='contenidoCNacimientos();return false;'>Nacimientos</a></li>");
                                            break;
                                          case '3': $("#submenu1").append("<li><a href='#' onclick='contenidoCReconocimientos();return false;'>Reconocimientos</a></li>");
                                            break;
                                          case '4': $("#submenu1").append("<li><a href='#' onclick='contenidoCAdopcion();return false;'>Adopci&oacute;n</a></li>");
                                            break;
                                          case '5': $("#submenu1").append("<li><a href='#' onclick='contenidoCMatrimonio();return false;'>Matrimonio</a></li>");
                                            break;
                                          case '6': $("#submenu1").append("<li><a href='#' onclick='contenidoCDivorcio();return false;'>Divorcio</a></li>");
                                            break;
                                          case '7': $("#submenu1").append("<li><a href='#' onclick='contenidoCDefuncion();return false;'>Defunci&oacute;n</a></li>");
                                            break;
                                          case '8': $("#submenu1").append("<li><a href='#' onclick='contenidoCSentencias();return false;'>Sentencias</a></li>");
                                            break;
                                          case '9': $("#menu").append("<li><a href='#' onclick='contenidoDigitalizacion();return false;'>Digitalizaci&oacute;n </a></li><ul id='submenu2'></ul>");
                                            break;  
                                          case '10': $("#submenu2").append("<li><a href='#' onclick='contenidoDNacimientos();return false;'>Nacimientos</a></li>");
                                            break;
                                          case '11': $("#submenu2").append("<li><a href='#' onclick='contenidoDReconocimientos();return false;'>Reconocimientos</a></li>");
                                            break;
                                          case '12': $("#submenu2").append("<li><a href='#' onclick='contenidoDAdopcion();return false;'>Adopci&oacute;n</a></li>");
                                            break;
                                          case '13': $("#submenu2").append("<li><a href='#' onclick='contenidoDMatrimonio();return false;'>Matrimonio</a></li>");
                                            break;
                                          case '14': $("#submenu2").append("<li><a href='#' onclick='contenidoDDivorcio();return false;'>Divorcio</a></li>");
                                            break;
                                          case '15': $("#submenu2").append("<li><a href='#' onclick='contenidoDDefuncion();return false;'>Defunci&oacute;n</a></li>");
                                            break;
                                          case '16': $("#submenu2").append("<li><a href='#' onclick='contenidoDSentencias();return false;'>Sentencias</a></li>");
                                            break;
                                          case '17': $("#menu").append("<li><a href='#' onclick='contenidoProyectoCaptura();return false;'>Proyecto de Captura</a></li><ul id='submenu3'></ul>");
                                            break;  
                                          case '18': $("#submenu3").append("<li><a href='#' onclick='contenidoPCNacimientos();return false;'>Nacimientos</a></li>");
                                            break;
                                          case '19': $("#submenu3").append("<li><a href='#' onclick='contenidoPCReconocimientos();return false;'>Reconocimientos</a></li>");
                                            break;
                                          case '20': $("#submenu3").append("<li><a href='#' onclick='contenidoPCAdopcion();return false;'>Adopci&oacute;n</a></li>");
                                            break;
                                          case '21': $("#submenu3").append("<li><a href='#' onclick='contenidoPCMatrimonio();return false;'>Matrimonio</a></li>");
                                            break;
                                          case '22': $("#submenu3").append("<li><a href='#' onclick='contenidoPCDivorcio();return false;'>Divorcio</a></li>");
                                            break;
                                          case '23': $("#submenu3").append("<li><a href='#' onclick='contenidoPCDefuncion();return false;'>Defunci&oacute;n</a></li>");
                                            break;
                                          case '24': $("#submenu3").append("<li><a href='#' onclick='contenidoPCSentencias();return false;'>Sentencias</a></li>");
                                            break;
                                          case '25': $("#submenu3").append("<li><a href='#' onclick='contenidoPCReportes();return false;'>Reportes de Proyecto de Captura</a></li>");
                                            break;
                                          case '26': $("#menu").append("<li><a id='archivo' href='#' onclick='contenidoArchivo();return false;'>Archivo</a></li><ul id='submenu4'></ul>");
                                            break;
                                          case '27': $("#menu").append("<li><a href='#' onclick='contenidoCaptura();return false;'>Captura</a></li>");
                                            break;
                                          case '28': $("#menu").append("<li><a href='#' onclick='contenidoVerificacion();return false;'>Verificaci&oacute;n</a></li>");
                                            break;                                            
                                          case '29': $("#menu").append("<li><a href='#' onclick='contenidoIndexacion();return false;'>Indexaci&oacute;n</a></li>");
                                            break;
                                          case '30': $("#menu").append("<li><a href='#' onclick='contenidoLiberacion();return false;'>Liberaci&oacute;n</a></li>");
                                            break;
                                          case '31': $("#menu").append("<li><a href='#' onclick='contenidoCajero();return false;'>Cajero</a></li>");
                                            break;
                                          case '32': $("#menu").append("<li><a href='#' onclick='contenidoReportes();return false;'>Reportes</a></li>");
                                            break;
                                          case '33': $("#submenu4").append("<li><a href='#' onclick='contenidoANuevoLibro();return false;'>Nuevo Libro</a></li>");
                                            break;
                                          case '34': $("#submenu4").append("<li><a href='#' onclick='contenidoABuscar();return false;'>Buscar</a></li>");
                                            break;
                                          case '35': $("#submenu4").append("<li><a href='#' onclick='contenidoAInventario();return false;'>Inventario</a></li>");
                                            break; 
                                          /*case '36': $("#submenu4").append("<li><a href='#' onclick='contenidoAEditarLibro();return false;'>Editar Libro</a></li>");
                                            break;*/      
                                          case '37': $("#submenu4").append("<li><a href='#' onclick='gestionLibros();return false;'>Gestion de Libros</a></li>");
                                            break;                                                                                                                                                                                                                                                                                                                                                        
                                          default:
                                            alert("permiso no definido en el menu");                            
                                        }

                                    });

                }else{
                  alert("No tienes permisos");
                }
                $("#menu").append("<li><a href='class/logout.php'><i class='fa fa-sign-in'></i>Salir</a></li>");  
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

            /*$('#archivo').click(function() {
                   alert("click a enlace archivo");
              });*/
            /*$('#archivo').on('click', function() {
                    alert("click a enlace archivo");
              });*/
            /*$( "#archivo" ).bind( "click", function() {
                alert("click a enlace archivo");
            });*/

            //$('#archivo').click(function(){ $('#contenido').html("hola que hace??"); return false; });

});//END Ready Function

function contenidoCertificacion(){$('#contenido').html("Aqui va el contenido de CERTIFICACION");}
function contenidoCNacimientos(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE NACIMIENTOS");}
function contenidoCReconocimientos(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE RECONOCIMIENTOS");}
function contenidoCAdopcion(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE ADOPCIONES");}
function contenidoCMatrimonio(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE MATRIMONIOS");}
function contenidoCDivorcio(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE DIVORCIO");}
function contenidoCDefuncion(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE DEFUNCION");}
function contenidoCSentencias(){$('#contenido').html("Aqui va el contenido de CERTIFICACION DE CENTENCIAS");}
function contenidoDigitalizacion(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION");}
function contenidoDNacimientos(){$('#contenido').html("Aqui va el contenido de DIGITALIZACON DE NACIMIENTOS");}
function contenidoDReconocimientos(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE RECONOCIMIENTOS");}
function contenidoDAdopcion(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE ADOPCIONES");}
function contenidoDMatrimonio(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE MATRIMONIOS");}
function contenidoDDivorcio(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE DIVORCIOS");}
function contenidoDDefuncion(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE DEFUNCIONES");}
function contenidoDSentencias(){$('#contenido').html("Aqui va el contenido de DIGITALIZACION DE SENTENCIAS");}
function contenidoProyectoCaptura(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA");}
function contenidoPCNacimientos(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE NACIMIENTOS");
$('#contenido').load('webcorporativa/actos/1nacimiento/nacimientos.php');
}
function contenidoPCReconocimientos(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE RECONOCIMIENTOS");}
function contenidoPCAdopcion(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE ADOPCIONES");}
function contenidoPCMatrimonio(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE MATRIMONIOS");}
function contenidoPCDivorcio(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE DIVORCIOS");}
function contenidoPCDefuncion(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE DEFUNCIONES");}
function contenidoPCSentencias(){$('#contenido').html("Aqui va el contenido de PROYECTO DE CAPTURA DE SENTENCIAS");}
function contenidoPCReportes(){$('#contenido').html("Aqui va el contenido REPORTES - PROYECTO DE CAPTURA");}
function contenidoArchivo(){$('#contenido').load('webcorporativa/libros/index.php');}
function contenidoCaptura(){$('#contenido').html("Aqui va el contenido de CAPTURA");}
function contenidoVerificacion(){$('#contenido').html("Aqui va el contenido de VERIFICACION");}
function contenidoIndexacion(){$('#contenido').html("Aqui va el contenido de INDEXACION");}
function contenidoLiberacion(){$('#contenido').html("Aqui va el contenido de LIBERACION");}
function contenidoCajero(){$('#contenido').html("Aqui va el contenido de CAJERO");}
function contenidoReportes(){$('#contenido').html("Aqui va el contenido de REPORTES GENERALES");}
function contenidoANuevoLibro(){
		
	$('#contenido').load('webcorporativa/libros/nuevoLibro.php');
	}
	
	
	
function contenidoABuscar(){
  $('#contenido').load('webcorporativa/libros/buscarLibro.php');
}
function contenidoAInventario(){$('#contenido').html("Aqui va el contenido de INVENTARIO DE ARCHIVO");}
function contenidoAEditarLibro(){
  $('#contenido').load('webcorporativa/libros/editarLibro.php');
}
function gestionLibros(){
  $('#contenido').load('webcorporativa/libros/gestionLibros.php');
}




function borrarContenidoMenu(){
  var ul = document.getElementById("menu");   // Get the <ul> element with id="myList"
  while(ul.firstChild) ul.removeChild(ul.firstChild);// Remove <ul>'s first child
}



