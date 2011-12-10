var selectedDate = new Date();
 
$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
		
    var calendar = $("#calendar").fullCalendar({
        allDayText:"Todo El Dia",
        monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio",
        "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        monthNamesShort: ["Ene","Feb","Mar","Abr","May","Jun",
        "Jul","Ago","Sep","Oct","Nov","Dic"],
        dayNames: ["Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado"],
        dayNamesShort: ["Dom","Lun","Mar","Mi&eacute;","Jue","Vie","S&aacute;b"],
        dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","S&aacute;"],   
        buttonText: {
            today:"Hoy",
            month:"Mes",
            week:"Semana",
            day:"Dia"
        },
        theme: true,                        
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay"
                                
        },
        //                        defaultView: "agendaDay",
        editable: true,                        
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            allDayDefault:false;
            var title=$("#evento").val("");
            $.fx.speeds._default = 250;
            $(function() {
                $( "#dialog-form" ).dialog({
                    show: "blind",
                    hide: "drop",
                    resizable: false,
                    height: "auto",
                    width: "auto",
                    buttons:{
                        Ok:function(){ 
                            var title=$("#evento").val();
                            if(title){
                                calendar.fullCalendar("renderEvent",{
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: false
                                },
                                true);    
                                var unixini = Math.round(start/1000);
                                var unixfin = Math.round(end/1000);

                            
                                alert("Inicio : "+start+" "+" Fin "+end+"Unix INI : "+unixini+" "+" UnixFin "+unixfin);  
                                $.getJSON("registraevento/",{
                                    fechaini:unixini,
                                    fechafin:unixfin,
                                    vdoc:0,
                                    valum:0,
                                    vapod:0,
                                    titulo:title,
                                    contenido:"contenido",
                                    url:0,
                                    iduser:'.$usuario_id.',
                                    Cursos_iCursIdCursos:0
                                });
                                $( this ).dialog( "close" );
                            }else{
                                alert("Ingrese Titulo");
                            }
                        },
                        Cancelar: function(){
                            $( this ).dialog( "close" );
                        }
                    }
                });
                $( "#dialog-form" ).dialog( "open" );
            });
            calendar.fullCalendar("unselect");
        },
        //			editable: true,
        eventClick: function(event, element) {
            var conf = confirm("Realmente Desea Actualizarlo");
            if (conf) {
                var title=prompt("Nuevo Titulo :");
                if(title)
                    event.title=title;
                $("#calendar").fullCalendar("updateEvent", event);
            }else if(confirm("Desea Borrarlo")){
                $("#calendar").fullCalendar( "removeEvents" ,event.id );
            }
                            

        },
        events: "listareventos/?iduser='.$usuario_id.'"
    });    
});  