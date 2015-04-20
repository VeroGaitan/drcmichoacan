
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dirección del Registro Civil del Estado de Michoacán</title>
 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    
   <script src="js/jquery-1.11.1.min.js" ></script>
        <script>
            $(document).ready(function () {
                function cargadorHTML(str) {
                    var ext = ".php";
                    if(str[1]=='http://registrocivil.michoacan.gob.mx/')
                    {
                        ext='';
                    }
                    $("#cargador_de_pagina").load(str[1] + ext);
                }
                $("#menu > ul > li > a").click(function () {
                    cargadorHTML($(this).attr("href").split("#"));
                });
                  $("#dropdown-menu > li > a").click(function () {
                    cargadorHTML($(this).attr("href").split("#"));
                });
            });
        </script>
         </head>
   <body>
 <div id="menu">
     <ul class="nav nav-tabs nav-justified">
         
         <li><a href="#archivo" target="cargador_de_pagina">Archivo</a></li>        
         <li><a href="#index">Administrador</a></li>
         <li><a href="#pagina1">Lider</a></li>
         <li><a href="#index">Supervici&oacute;n</a></li>
          <li><a href="#index">Analista</a></li>
         <li><a href="#index">Liberaci&oacute;n</a></li>
         <li><a href="#pagina3">Indexaci&oacute;n</a></li>
         <li><a href="#pagina3">Digitalizaci&oacute;n</a></li>
         <li><a href="#index">Captura</a></li> 
          <li><a href="#index">Archivista</a></li>
          <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Proyecto <span class="caret"></span>
    </a>
               
                
    <ul class="dropdown-menu"  id="dropdown-menu">
          <li><a href="#index">Lider</a></li>
         <li><a href="#index">Supervici&oacute;n</a></li>
          <li><a href="#index">Analista</a></li>
         <li><a href="#index">Liberaci&oacute;n</a></li>
         <li><a href="#pagina3">Indexaci&oacute;n</a></li>
         <li><a href="#pagina3">Digitalizaci&oacute;n</a></li>
         <li><a href="#index">Captura</a></li> 
    </ul>
            
             
  </li>
  </ul>
     </div>   
        <div size="100%" id="cargador_de_pagina">
            
        </div>
       
    </body>
</html>

