function aleatorio(inferior,superior){
    numPosibilidades = superior - inferior
    aleat = Math.random() * numPosibilidades
    aleat = Math.floor(aleat)
    return parseInt(inferior) + aleat
}
function dame_color_aleatorio(){
    hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F")
    color_aleatorio = "#";
    for (i=0;i<6;i++){
        pos = aleatorio(0,hexadecimal.length)
        color_aleatorio += hexadecimal[pos]
    }
    return color_aleatorio
}

function dibujaporsexo()
{var sex="M";
    $('#exampleSimple').show();
    $('#exampleSimple').html('');
//    var cantidad=$.post("countalumnosbysexoseccion", {sexo:sex});
    $.getJSON("countalumnosbysexoseccion", {},function(data){
        var cont=data;
        var arrayOfData=new Array();
        for(x=0 ; x<cont.length;x++){
            arrayOfData[x]=([cont[x].contador,cont[x].Sexo,dame_color_aleatorio()]);
        }        
        console.log(arrayOfData);
        $('#exampleSimple').jqbargraph({
            data: arrayOfData,
            legend: true 
        });
    });
    
     
//    $.post("countalumnosbysexoseccion/", sexo:'M');
}




//----


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
            arrayjson[i]=notas[i].nota+Math.random()+5*10 ;
        }
// return arrayjson;
$("#chart").chart({
        values: {
            arrayjson: arrayjson
        },
    tooltips: function(env, arrayjson, index, value, label) {
        return "<div class='label'><p class='date'>Unidad " + index + "</p><p><span class='visits'>Visits:</span> " + env.opt.values['arrayjson'][index] + "</p></div>";
    }        
        
    });
    });
}

function ActualizaChart()
{
    var thevalues3 = obtenerdatosjson();
// for (var i = 0; i < thevalues3.length; i++) {
// thevalues3[i] = Math.floor(Math.random() * (i > 0 ? thevalues3[i - 1] * 1.5 + 5 : 10) + 10);
// }
    $("#chart").chart({
        values: {
            thevalues3: thevalues3
        },
        thevalues3: {
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



function graficasalgo()
{
    $.ajax({
        url: 'reports.php?r=1', 
        dataType: 'json', 
        success: function(data){
            $.plot( plotarea , data, options );
        }
    });
    
    
}