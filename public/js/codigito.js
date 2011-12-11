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
                            ajaxselectivo(url,dat,"listadoseccionesajax",".setenta","modificar");
                            break;
                        case 'del':
                            var dat="secc="+secc;
                            var url="/admin/eliminarseccionajax/";
                            ajaxselectivo(url,dat,"listadoseccionesajax",".setenta","modificar");
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
                            ajaxselectivo(url,dat,"listadocursosajax",".setenta","listar");
                            break;
                        case 'del':
                            var dat="cur="+cur;
                            var url="/admin/eliminarcursoajax/";
                            ajaxselectivo(url,dat,"listadocursosajax",".setenta","listar");
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

function ajaxselectivo(urls,datos,loadtable,divposicion,opt){
    $.ajax(
    {
        dataType: "html",
        type: "POST",
        // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
        url: urls,
        data: datos,
        success: function(requestData){ //Llamada exitosa
            if(opt=="listar"){
             window.location.reload(true);
            }
            if(opt=="modificar"){
                if(requestData=="1"){
                $(divposicion).load(loadtable);
                }
                else{
                    window.location="/";
                }
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
        validaTexto: function(opt){
/*Recorre todos los elementos encapsulados*/
this.each(function(){
/*Aquí se cambia el contexto, por lo que 'this' se refiere al elemento DOM por el que se está pasando*/
var $this = a(this); //Convertimos a jQuery

/*Cuando pierde el foco, si está vacío, pone el texto por defecto y cambia el color*/
$this.blur(function(){
    if(a.trim($this.val()).length!==0){
        // $this.css("color",disabledColor).val(texto);
        if(opt=="usuario"){
            $.get("listarnombreusuario/?usunombre="+a.trim($this.val()), function(data){

            if(data=='existe'){
                $this.val("");
                alert("El Nombre de Usuario ya existe");
            }
            });
        }
        else if(opt=="dni"){
            $.get("buscardniusuario/?usudni="+a.trim($this.val()), function(data){

            if(data=='existe'){
                $this.val("");
                alert("El Nro de Dni ya existe");
            }
            });
        }
    }
});
});
}
});
})(jQuery);

function buscaapoderado(){
    $.fx.speeds._default = 1000;
$("#buscaap").html(" ");
document.getElementById("idapo").value="";
document.getElementById("nombreapo").value="";
document.getElementById("dniapo").value="";
    $(function() {
        $( "#dialog-form" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "Drop",
            resizable: false,
            height: 450,
            width: 'auto',
            modal: true,
            buttons:{
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
        //Invoca al panel Informativo
        $( "#dialog-form" ).dialog( "open" );
    });
}

function modaldocente(idcurso){
    $.fx.speeds._default = 1000;
$("#buscaap").html(" ");
document.getElementById("idcurso").value=idcurso;
    $(function() {
        $( "#dialog-form" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "Drop",
            resizable: false,
            height: 450,
            width: 'auto',
            modal: true,
            buttons:{
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
        $( "#dialog-form" ).dialog( "open" );
    });
}

function buscardocente(opcion,obj){
// alert("valor : "+obj.value);
    var idcurso=document.getElementById("idcurso").value;
    var apodera='nada'
    $.getJSON("obtenerdocenteajax/?parametro="+obj.value+"&opt="+opcion, function(data){
        $("#buscaap").html("");
                var docente = data;var fila;
    if(docente!=null){
         if(docente.length>0){
             for (var x = 0 ; x < docente.length ; x++) {
                fila+='<tr>\n\
                            <td>\n\
                                <center>'+docente[x].iUsuIdUsuario+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>'+docente[x].tDocEspecialidad+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>'+docente[x].vUsuNombre+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>'+docente[x].vUsuApellidoPat+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>'+docente[x].vUsuApellidoMat+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>'+docente[x].cUsuDni+'</center>\n\
                            </td>\n\
                            <td>\n\
                                <center>\n\
                                    <a style="cursor:pointer" alt="Seleccionar" onclick="inscribedocente(\''+docente[x].iUsuIdUsuario+'\''+',\'ins\','+idcurso+');" >\n\
                                        <span class="ui-icon ui-icon-check"></span>\n\
                                    </a>\n\
                                </center>\n\
                            </td>\n\
                        </tr>';
            }
            $("#buscaap").html(fila);
            }
         }else{
             $("#buscaap").html("<td colspan='6' ><center>No existe ningun registro con los datos solicitados</center></td>");
         }
    });
}

function inscribedocente(idusuario,option,idcurso){
// alert(idcurso+option+idusuario);
    var dat="idusuario="+idusuario+"&"+"idcurso="+idcurso+"&opt="+option;
    var url="/admin/asignadocentecursoajax/";
    ajaxselectivo(url,dat,"listarcursodocenteajax",".recagatab","modificar");
    if(option=='ins'){
// var idcurso = document.getElementById("idcurso").value;

        $("#dialog-form" ).dialog("close");
        $("#dialog").html("<p><h4>El docente ha sido inscrito satisfactoriamente</h4></p>");
        $("#dialog").dialog("open");
    }
    else{
    $("#dialog").html("<p>El docente se ha quitado del curso</p>");

    $("#dialog").dialog("open");
        
    }
}

function buscarapoderado(opcion,obj){
// alert("valor : "+obj.value);
    var apodera='nada'
    $.getJSON("obtenapoderadoajax/?parametro="+obj.value+"&opt="+opcion, function(data){
        $("#buscaap").html("");
                var apodera = data;var fila;
// alert(apodera.length);
// alert(apodera);
    if(apodera!=null){
         if(apodera.length>0){
             for (var x = 0 ; x < apodera.length ; x++) {
                fila+='<tr ><td>'+apodera[x].iApodIdApoderado+'</td><td>'+apodera[x].vUsuNombre+'</td><td>'+apodera[x].vUsuApellidoPat+'</td><td>'+apodera[x].vUsuApellidoMat+'</td><td>'+apodera[x].cUsuDni+'</td><td><center><a style="cursor:pointer" alt="Seleccionar" onclick="selecapoderado(\''+apodera[x].iApodIdApoderado+'\',\''+apodera[x].vUsuApellidoPat+' '+apodera[x].vUsuApellidoMat+' '+apodera[x].vUsuNombre+' '+'\',\''+apodera[x].cUsuDni+'\');" ><span class="ui-icon ui-icon-check"></span></a></center> </td></tr>';
            }
            $("#buscaap").html(fila);
            }
         }else{
             $("#buscaap").html("<td colspan='6' >No existe ningun registro con los datos solicitados</td>");
         }
    });
}

function selecapoderado(id,nombre,dni){
// alert(id+nombre+dni);
    document.getElementById("idapoderado").value=id;
    document.getElementById("idapo").value=id;
    document.getElementById("nombreapo").value=nombre;
    document.getElementById("dniapo").value=dni;
    $("#dialog-form").dialog( "close" );
// $("#nombre").val=id;

}


function infoDocenteCurso(idcurso){
// alert(idcurso)
        $.getJSON("obtenerdocentesporcursoajax/?idcurso="+idcurso, function(data){
            var docente=data;
            var datoshtml;
            if(docente!=null){
                if(docente.length>0){
                    for(var x = 0 ; x<docente.length ; x++)
                        {
                            datoshtml='<ul style="list-style-type:none"><li><h3>Docente : '+docente[x].vUsuApellidoPat+' '+docente[x].vUsuApellidoMat+' '+docente[x].vUsuNombre+'</h3></li><li><h3>Especialidad : '+docente[x].tDocEspecialidad +'</h3></li></ul>';
                        }
                        $("#dialog").html(datoshtml);
                        setTimeout('$("#dialog").dialog("close");',2000);
                }
            }else{
              $("#dialog").html("<p><h4>No se encuentra datos del docente</h4></p>");
             
            }
             $( "#dialog" ).dialog( "open" );
        });
}
