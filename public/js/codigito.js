function ActDelSeccion(secc,estado,e,opt){
    e.preventDefault();
    $.fx.speeds._default = 1000;
         
    $(function() {
        $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            resizable: false,
            height:140,
            modal: true,
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
            autoOpen: false,
            show: "blind",
            hide: "explode",
            resizable: false,
            height:145,
            modal: true,
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

function verificarusuario(nameclass,geturl)
{
    
}

(function(a){
a.fn.extend({
        validaTexto: function(texto,id){
		/*Recorre todos los elementos encapsulados*/
		this.each(function(){
		    /*Aquí se cambia el contexto, por lo que 'this' se refiere al elemento DOM por el que se está pasando*/
		    var $this = a(this); //Convertimos a jQuery
		    /*Esto es para la primera vez*/
//		    $this.css("color","red").val(texto);
		    /*Cuando recibe el foco, si está el texto por defecto, lo borra y cambia el color*/
//		    $this.focus(function(){
//		    	if($this.val() == texto){
//                            alert("Valor");
////		    		$this.val("").css("color",activeColor);
//		    	}
//		    });
		    /*Cuando pierde el foco, si está vacío, pone el texto por defecto y cambia el color*/
		    $this.blur(function(){
		    	if(a.trim($this.val()).length!==0){
//		    		$this.css("color",disabledColor).val(texto);
$.get("listarnombreusuario/?usunombre="+a.trim($this.val()), function(data){

        if(data=='existe'){
            document.getElementById(id).disabled=true;
            alert("usuario ya existe");
        }
        });
		    	}
		    });
		});
	}
});
})(jQuery);

function buscaapoderado(){
    $.fx.speeds._default = 1000;
         
    $(function() {
        $( "#dialog-form" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            resizable: false,
            height: 450,
            width: 'auto',
            modal: true
//            buttons:{
//                "Aceptar": function(){
//                    $( this ).dialog( "aceptar" );
//                    //aca ira ajax
//                    switch(opt){
//                        case 'act':
//                            var dat="cur="+cur+"&"+"est="+estado;
//                            var url="/admin/actualizarcursoajax/";
//                            ajaxselectivo(url,dat,"listadocursosajax",".setenta");
//                            break;
//                        case 'del':
//                            var dat="cur="+cur;
//                            var url="/admin/eliminarcursoajax/";
//                            ajaxselectivo(url,dat,"listadocursosajax",".setenta");
//                            break;
//                    }
//                },
//                Cancelar: function(){
//                    $( this ).dialog( "cerrar" );
// 
//                }
//            }
        });
        //Invoca al panel Informativo
        $( "#dialog-form" ).dialog( "open" );
    });
}

function buscarapoderado(opcion,obj){    
//    alert("valor : "+obj.value);
    $.getJSON("obtenapoderadoajax/?parametro="+obj.value+"&opt="+opcion, function(data){
        $("#buscaap").html("Listando...");
                var apodera = data;var fila;
         if(apodera=='nada'){
             $("#buscaap").html("No se encontro informacion del apoderado");
         }else{
             for (var x = 0 ; x < apodera.length ; x++) {
                fila+='<tr ><td>'+apodera[x].iApodIdApoderado+'</td><td>'+apodera[x].vUsuNombre+'</td><td>'+apodera[x].vUsuApellidoPat+'</td><td>'+apodera[x].vUsuApellidoMat+'</td><td>'+apodera[x].cUsuDni+'</td><td><a style="cursor:pointer" alt="Seleccionar" onclick="selecapoderado(\''+apodera[x].iApodIdApoderado+'\',\''+apodera[x].vUsuApellidoPat+' '+apodera[x].vUsuApellidoMat+' '+apodera[x].vUsuNombre+' '+'\',\''+apodera[x].cUsuDni+'\');" ><span  class="ui-icon ui-icon-check"></span></a></td></tr>';
            }        
            $("#buscaap").html(fila);            
         }

    });
}

function selecapoderado(id,nombre,dni){
//    alert(id+nombre+dni);
    document.getElementById("nombre").value=id;
    document.getElementById("appaterno").value=nombre;
    document.getElementById("apmaterno").value=dni;
//    $("#nombre").val=id;

}
//
//$(document).ready(function() {
//    $('#usernameLoading').hide();
//    $('#username').blur(function(){
//        $('#usernameLoading').show();
//        $.post("check.php", {
//            username: $('#username').val()
//        }, function(response){
//            $('#usernameResult').fadeOut();
//            setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
//        });
//        return false;
//    });
//});
//function finishAjax(id, response) {
//    $('#usernameLoading').hide();
//    $('#'+id).html(unescape(response));
//    $('#'+id).fadeIn();
//} //finishAjax 