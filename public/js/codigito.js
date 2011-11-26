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
                                    ajaxselectivo(url,dat);
                                    break;
                                case 'del':
                                   var dat="secc="+secc;
                                   var url="/admin/eliminarseccionajax/";
                                    ajaxselectivo(url,dat);        
                                    break;                       
                            }
                    },
                    Cancelar: function(){
                        $( this ).dialog( "close" );
 
                    }
                }                        
            });
            //Invoca al panel Informativo
//            $(".actsecc" ).click(function() {
                //                event.preventDefault();
               $( "#dialog-confirm" ).dialog( "open" );
//                return false;
//            });
        });

}
function ajaxselectivo(urls,datos)
{
    $.ajax( 
    {
        dataType: "html",
        type: "POST",
        // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest        
        url: urls, 
        data: datos, 
        success: function(requestData){ 	//Llamada exitosa
           if(requestData=="1"){
            $(".setenta").load("listadosecciones");     
           }
          else{
              window.location="/";
          } 
        },
        error: function(requestData, strError, strTipoError){
            alert("Error " + strTipoError +': ' + strError); //En caso de error mostraremos un alert
        },
        complete: function(requestData, exito){
        //fin de la llamada ajax.
        // En caso de usar una gif (cargando...) aqui quitas la imagen
        }
    });    
}