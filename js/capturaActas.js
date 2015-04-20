/*---------------------------------------------------------------
 * ME PERMITE CARGAR LA LISTA DE ESTADOS DEL PAIS DE MEXICO POR DEFAULT CUANDO SE EJECUTA EL ARCHIVO
 * FUNCION: listaEstadosMexico()
 ----------------------------------------------------------------*/    
    function listaEstadosMexico(){
        //Lista de estados del pais de Mexico
        $.ajax({
            type: "POST",
            url: "../../../class/filtros.php",
            data: {
                ACTION: "1",
                ID_PAIS: $("#ID_PAIS_REG").val()
            },
           error: function(data) {
                alert(data);               
            },
            success: function(data) {
                //alert(data);
                $("#ID_ESTADO").html(data);                             
            }
        });//END Ajax
        
    /*$.post("consultasCapturaNacimientos.php", { ACTION: "1", ID_PAIS : $("#ID_PAIS_REG").val()}, function(data) {
        $("#ID_ESTADO").html(data);
    });*/                        
    }    
    
/*---------------------------------------------------------------
 * ME PERMITE CONSTRUIR LOS SELECT REALIZANDO LOS FILTROS CORRESPONDIENTES PARA PAIS, ESTADO, MUNICIPIO, LOCALIDAD
 * FUNCION: filtrarOptions()
 ----------------------------------------------------------------*/    
    function filtrarOptions(){
          
    $("#ID_PAIS_REG").combobox({ 
        select: function (event, ui) { 
            var id_pais=$("#ID_PAIS_REG").val();
            if(id_pais!=="00"){    
                
                $.ajax({
                    type: "POST",
                    url: "../../../class/filtros.php",
                    data: {
                        ACTION: "1",
                        ID_PAIS: $("#ID_PAIS_REG").val()
                    },
                   error: function(data) {
                        alert(data);               
                    },
                    success: function(data) {
                        $("#ID_ESTADO").html(data);                             
                    }
                });//END Ajax                              
              
            /*
            $.post("consultasCapturaNacimientos.php", { ACTION: "1", ID_PAIS : id_pais}, function(data) {
                //alert(data);//Regresa la consulta y la estructura de option
                $("#ID_ESTADO").html(data);  
            });
            */
           
            }else{
                $("#ID_ESTADO").html("<option value=''>========</option><option value='00'>OTRO</option>");
            }            
               //Validar que coincida la nacionalidad con el pais.
                if($(".ID_PAIS_REG").val() !== $(".nacionalidad_difunto").val()){
                   $("#nacionalidad_difunto").css("border-color","#FF0000");
                   $("#ID_PAIS_REG").css("border-color","#FF0000");
                }else{
                  $("#nacionalidad_difunto").css("border-color","#FFFFFF");
                  $("#ID_PAIS_REG").css("border-color","#FFFFFF");
                } 
        } 
    });
    
    $("#ID_ESTADO").combobox({
        select: function (event, ui) {         
            var id_estado=$("#ID_ESTADO").val();
            if(id_estado!=="00"){
            $("#ID_ESTADO_OCULTO").hide(); 
                $.ajax({
                    type: "POST",
                    url: "../../../class/filtros.php",
                    data: {
                        ACTION: "2",
                        ID_ESTADO : id_estado
                    },
                   error: function(data) {
                        alert(data);               
                    },
                    success: function(data) {
                        //alert(data);//Regresa la consulta y la estructura de option                         
                        $("#ID_MUNICIPIO").html(data);                            
                    }
                });//END Ajax               
            
            /*
            $.post("consultasCapturaNacimientos.php", { ACTION: "2", ID_ESTADO : id_estado}, function(data) {
                //alert(data);//Regresa la consulta y la estructura de option                                                                                         
                $("#ID_MUNICIPIO").html(data);                    
            });
            */
           
            }else{
                $("#ID_MUNICIPIO").html("<option value=''>========</option><option value='00'>OTRO</option>");
                $("#ID_ESTADO_OCULTO").show();
            }
        }
    });
    
    $("#ID_MUNICIPIO").combobox({
        select: function (event, ui) {         
            var id_estado=$("#ID_ESTADO").val();
            var id_municipio=$("#ID_MUNICIPIO").val();
            if(id_estado!=="00" && id_municipio!=="00"){
            $("#ID_MUNICIPIO_OCULTO").hide();
                $.ajax({
                    type: "POST",
                    url: "../../../class/filtros.php",
                    data: {
                        ACTION: "3",
                        ID_MUNICIPIO : id_municipio ,
                        ID_ESTADO : id_estado
                    },
                   error: function(data) {
                        alert(data);               
                    },
                    success: function(data) {
                        //alert(data);//Regresa la consulta y la estructura de option
                        $("#ID_LOCALIDAD").html(data);                            
                    }
                });//END Ajax                            
                    /*
                   $.post("consultasCapturaNacimientos.php", { ACTION: "3", ID_MUNICIPIO : id_municipio ,ID_ESTADO : id_estado}, function(data) {
                        //alert(data);//Regresa la consulta y la estructura de option
                        $("#ID_LOCALIDAD").html(data);                    
                    });
                    */            
            }else{
                $("#ID_LOCALIDAD").html("<option value=''>========</option><option value='00'>OTRO</option>");
                $("#ID_MUNICIPIO_OCULTO").show();
                
            }
        }
    });
    
    $("#ID_LOCALIDAD").combobox({
        select: function (event, ui) {
            var id_localidad=$("#ID_LOCALIDAD").val();
            if(id_localidad==="00"){
                $("#ID_LOCALIDAD_OCULTO").show();                
            }else{
                $("#ID_LOCALIDAD_OCULTO").hide(); 
            }             
        }
    }); 



    }//END filtrarOptions()  
    
    