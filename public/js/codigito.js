function ActDelSeccion(secc,estado,e,opt){
    e.preventDefault();
        $.fx.speeds._default = 1000;
         
        $(function() {
            $( "#dialog-confirm" ).dialog({
                autoOpen: false,show: "blind",hide: "explode",
                resizable: false,height:140,modal: true,
                buttons:{
                    "Aceptar": function(){
                        $( this ).dialog( "close" );
                            //aca ira ajax
                            switch(opt){
                                case 'act':
                                    var dat="secc="+secc+"&"+"est="+estado;
                                    var url="/admin/actualizarseccionajax/";
                                    ajaxselectivo(url,dat,"listadoseccionesajax",".setenta");
                                    break;
                                case 'del':
                                   var dat="secc="+secc;
                                   var url="/admin/eliminarseccionajax/";
                                    ajaxselectivo(url,dat,"listadoseccionesajax",".setenta");
                                    break;
                            }
                    },
                    Cancelar: function(){
                        $( this ).dialog( "close" );
 
                    }
                }
            });
            //Invoca al panel Informativo
               $( "#dialog-confirm" ).dialog( "open" );
        });

}

function ActDelCurso(cur,estado,e,opt){
    e.preventDefault();
        $.fx.speeds._default = 1000;
         
        $(function() {
            $( "#dialog-confirm" ).dialog({
                autoOpen: false,show: "blind",hide: "explode",
                resizable: false,height:145,modal: true,
                buttons:{
                    "Aceptar": function(){
                        $( this ).dialog( "close" );
                            //aca ira ajax
                            switch(opt){
                                case 'act':
                                    var dat="cur="+cur+"&"+"est="+estado;
                                    var url="/admin/actualizarcursoajax/";
                                    ajaxselectivo(url,dat,"listadocursosajax",".setenta");
                                    break;
                                case 'del':
                                   var dat="cur="+cur;
                                   var url="/admin/eliminarcursoajax/";
                                    ajaxselectivo(url,dat,"listadocursosajax",".setenta");
                                    break;
                            }
                    },
                    Cancelar: function(){
                        $( this ).dialog( "close" );
 
                    }
                }
            });
            //Invoca al panel Informativo
               $( "#dialog-confirm" ).dialog( "open" );
        });

}

function ajaxselectivo(urls,datos,loadtable,divposicion)
{
    $.ajax(
    {
        dataType: "html",
        type: "POST",
        // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
        url: urls,
        data: datos,
        success: function(requestData){ //Llamada exitosa
           if(requestData=="1"){
            $(divposicion).load(loadtable);
           }
          else{
              window.location="/";
          }
        },
        error: function(requestData, strError, strTipoError){
            alert("Error " + strTipoError +': ' + strError); //En caso de error mostraremos un alert
        },
        complete: function(requestData, exito){
        }
    });
}