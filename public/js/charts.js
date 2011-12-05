//Mod Graficas
function graficaravances(){
    $("#chart").chart({
     type : "line",
     labels : ["Unidad 1", "Unidad 2", "Unidad 3", "Unidad 4"],
     tooltips : {
      serie1 : ["a", "b", "c", "d"],
      serie2 : ["a", "b", "c", "d"]
     },
     values : {
      serie1 : [4, 17, 13, 16],
      serie2 : [5, 8, 12, 15]
     },
     margins : [5, 5, 10, 25],
     series : {
      serie1 : {
       color : "red"
      },
      serie2 : {
       color : "blue"
      }
     },
     defaultAxis : {
      labels : true
     },
     features : {
      grid : {
       draw : true,
       forceBorder : true
      }
     }    
    });      
}

function putserie(){
    
}
//function loop() {
//    var thevalues = new Array(31);
//    var thevalues2 = new Array(31);
//    for (var i = 0; i < thevalues.length; i++) {
//        thevalues[i] = Math.floor(Math.random() * (i > 0 ? thevalues[i - 1] * 1.5 + 10 : 100) + 10);
//        thevalues2[i] = Math.floor(Math.random() * (i > 0 ? thevalues2[i - 1] * 1.5 + 100 : 1000) + 100);
//    } /* Note how we simply call again .chart with only the updated values */
//    $("#chart").chart({
//        values: {
//            serie1: thevalues,
//            serie2: thevalues2
//        }
//    });
//    setTimeout('loop()', 5000);
//}
function ActualizaChart()
{
    var thevalues3 = obtenerdatosjson();
//    for (var i = 0; i < thevalues3.length; i++) {
//        thevalues3[i] = Math.floor(Math.random() * (i > 0 ? thevalues3[i - 1] * 1.5 + 5 : 10) + 10);
//    }    
    $("#chart").chart({
        values: {
            thevalues3: thevalues3
        },
        serie3: {
            axis: 'r',
            color: "#F80",
            plotProps: {
                "stroke-width": 2
            },
            dotProps: {
                stroke: "white",
                size: 3,
                "stroke-width": 1
            }
        }        
    });    
}
function Verificacheck(){
    var check=document.formchecks.check_list;
    for (i = 0; i < check.length; i++){
        if(check[i].checked==true) 
         {
             ActualizaChart();
         }
    }    
}

function obtenerdatosjson(){
    var arrayjson=new Array();
    $.getJSON("/js/notasseccion.json", function(data){
        var notas=data;
        for(i=0;i<notas.length;i++){
            arrayjson[i]=notas[i].nota;
        }
//        return arrayjson;
$("#chart").chart({
        values: {
            serie14: arrayjson
        }    
        
    }); 
    });    
}