
<?php
$ID_LIBRO=1;
$ID_ACTO=1;
$ID_ESTADO=16;
$ID_MUNICIPIO=053;
$ID_OFICIALIA=01;
$ANO=1950;
$TOMO=001;
$TBIS=00;
$ACTA=00001;
$IMAGEN;   
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.


-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script type="text/javascript" src="../../../js/jquery-1.11.2.js"></script>
        <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>        
        <script type="text/javascript" src="../../../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="../../../js/main.js"></script>
        <script type="text/javascript" src="../../../js/validCampoFranz.js"></script>
        
        <link type="text/css" rel="stylesheet" href="../../../css/jquery-ui-1.11.3.custom/jquery-ui.css" media="screen">
        <link href="../../../css/bootstrap.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../../../css/selectable.css" media="screen">
        
        <style>
            body{
            overflow-x: hidden;
            overflow-y: hidden;                     
            }
            
          div#indice {
              background-color: #ffffff;
            height: 100%;
            left: 0%;
            position: absolute;
            top: 0%;
            width: 80px;
            overflow-x: hidden;
            overflow-y: scroll;

          }
          
          div#contenido{
            background-color: #39b3d7;
            height: 100%;
            left: 68px;
            position: absolute;
            top: 0%;
            width: 95%;
            overflow: scroll;
          }  
          
          div#formulario{
            background-color: #fdd49a;
            height: 50%;
            left: 0%;
            position: absolute;
            top: 0%;
            width: auto;
            overflow-x: hidden;
            overflow-y: scroll;
          }     
          
          div#imagen{
            background-color: #ebebeb;
            height: 50%;
            left: 0%;
            position: absolute;
            top: 50%;
            width: auto;
            overflow-x: hidden;
            overflow-y: scroll;            
          }             

          div div {
            position: relative;
            height: 100%;
            width: 90%;
          }

          p.enlace {
            position: absolute;
            bottom: 5px;
            right: 5px;
          }            
            
        ::-webkit-scrollbar {
              width: 7px;
        }

        ::-webkit-scrollbar-track {
              background-color: #ebebeb;
        } 

        ::-webkit-scrollbar-thumb {
              background-color: rgba(0, 0, 0, 0.2);
        } 


       
        </style>
        


    </head>
    <body>
        <!--
        <div class="btn-group-vertical" role="toolbar">
          <div class="btn-group btn-group-xs">
            <button type="button" class="btn btn-default">12345</button>
            <button type="button" class="btn btn-default">67891</button>
            <button type="button" class="btn btn-default">11213</button>
            <button type="button" class="btn btn-default">694</button>
            <button type="button" class="btn btn-default">17181</button>
            <button type="button" class="btn btn-default">2021</button>
            <button type="button" class="btn btn-default">36817</button>
            <button type="button" class="btn btn-default">12345</button>
            <button type="button" class="btn btn-default">67891</button>
            <button type="button" class="btn btn-default">11213</button>
            <button type="button" class="btn btn-default">694</button>
            <button type="button" class="btn btn-default">17181</button>
            <button type="button" class="btn btn-default">2021</button>
            <button type="button" class="btn btn-default">36817</button>
            <button type="button" class="btn btn-default">12345</button>
            <button type="button" class="btn btn-default">67891</button>
            <button type="button" class="btn btn-default">11213</button>
            <button type="button" class="btn btn-default">694</button>
            <button type="button" class="btn btn-default">17181</button>
            <button type="button" class="btn btn-default">2021</button>
            <button type="button" class="btn btn-default">36817</button>           
          </div>
        </div>        
        -->
              
       
        <div id="indice">
 
            <ul class="nav nav-tabs nav-stacked">
              <li><a href="#Apartado1">12345</a></li>
              <li><a href="#Apartado2">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>
              <li><a href="#">12345</a></li>          
            </ul> 
               
        </div>

        <div id="contenido">
            
           
                <div id="formulario">
                    <button id="mostrarImagen">mostrar imagen</button>
                    <h2>FORMULARIO</h2>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>                  
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                </div>
            
                <div id="imagen">
                    <button id="ocultarImagen">ocultar imagen</button>

                    <h2>IMAGEN</h2>
                    
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>                  
                    <p>Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto 
                    Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto.                   
                    </p>                    
                </div>-->
           
            
            
            
        </div>  
        
        <script>  

         

                $("#ocultarImagen").click(function(){
                    $("#formulario").css("height", "100%");
                    $("#imagen").hide();
                });

                $("#mostrarImagen").click(function(){
                    $("#formulario").css("height", "50%");
                    $("#imagen").show();
                });
        

            
            $("#indice").mCustomScrollbar({
                axis:"x", // horizontal scrollbar
                setLeft: 0,
                setTop: 0,
                setWidth: false,
                setHeight: false
            });            
            
            
                //$("#indice").on( "scroll", handler );
                
                $( "#indice" ).scroll(function() {
                    //$( "#log" ).append( "<div>Handler for .scroll() called.</div>" );
                    //alert("dasd");
                });
            
        </script>
        
    </body>
</html>
