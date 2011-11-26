//funcion que carga las regiones de un pais realizando una llamada ajax
function cargarSeccionesGrado()
{ 
    //Usando JQUERY, obtengo el value del option seleccionado de la lista paises. 	
    var codgrad = $("#cbogrados").val(); 
    $.ajax( 
    {
        dataType: "html",
        type: "POST",
        // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest        
        url: "/admin/ajaxcontrol/", 
        //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
        data: "codgrad=" + codgrad, 
        beforeSend: function(data){ 
            //Usando JQUERY, Mostramos el mensaje cargando en la lista regiones. (un efecto visual)            
            $("#cboseccion").html('<option>Cargando...</option>');
        //También puedes poner aqui el gif que indica cargando...
        },
        //Llamada exitosa          
        success: function(requestData){ 	
            //Usando JQUERY, Cargamos las secciones del grado
            $("#cboseccion").html(requestData);
        },
        error: function(requestData, strError, strTipoError){
            //En caso de error mostraremos un alert       
            alert("Error " + strTipoError +': ' + strError); 
        },
        //fin de la llamada ajax.    
        complete: function(requestData, exito){
        ; 
        // En caso de usar una gif (cargando...) aqui quitas la imagen
        }
    });
}

function ActualizaSeccion(secc,estado,e){
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
                            $.ajax( 
                            {
                                dataType: "html",
                                type: "POST",
                                // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest        
                                url: "/admin/actualizarseccionajax/", 
                                data: "secc=" + secc+"&"+"est="+estado, 
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
function ajaxselectivo(urls,parametros)
{
    $.ajax( 
    {
        dataType: "html",
        type: "POST",
        // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest        
        url: "/admin/actualizarseccionajax/", 
        data: "secc=" + secc+"&"+"est="+estado, 
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