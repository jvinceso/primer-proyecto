function pinta(){
$(function() {
    // let's loop to build tooltips and x labels.
    var thelabels = new Array(30);
    for (var i = 0; i < thelabels.length; i++) {
        thelabels[i] = (i % 6 === 0) ? (i + 1) + " september" : "";
    }

    // build the chart with no data but only x axis labels using the "google analytics" template.
    $("#chart").chart({
        template: "google_analytics",
        labels: thelabels
    });

    // start a loop that sets new data in the chart every 5 seconds.
    loop();
});

function loop() {
    var thevalues = new Array(31);
    var thevalues2 = new Array(31);
    for (var i = 0; i < thevalues.length; i++) {
        thevalues[i] = Math.floor(Math.random() * (i > 0 ? thevalues[i - 1] * 1.5 + 10 : 100) + 10);
        thevalues2[i] = Math.floor(Math.random() * (i > 0 ? thevalues2[i - 1] * 1.5 + 100 : 1000) + 100);
    } /* Note how we simply call again .chart with only the updated values */
    $("#chart").chart({
        values: {
            serie1: thevalues,
            serie2: thevalues2
        }
    });
    setTimeout('loop()', 5000);
}

};


/* Here is a simple update function generating new random data for the plot */







// this is a reausable template definition.
$.elycharts.templates['google_analytics'] = {
    type: "line",
    margins: [10, 15, 25, 15],
    /* Define how to draw tooltips starting from series data */
    /* this can be an array with the tooltips content or a function to generate them on the fly */
    tooltips: function(env, serie, index, value, label) {
        return "<div class='label'><p class='date'>September " + index + "</p><p><span class='visits'>Visits:</span> " + env.opt.values['serie1'][index] + "</p><p><span class='hits'>Hits:</span> " + env.opt.values['serie2'][index] + "</p></div>";
    },
    defaultSeries: {
        plotProps: {
            "stroke-width": 4
        },
        dot: true,
        rounded: false,
        dotProps: {
            stroke: "white",
            size: 5,
            "stroke-width": 1,
            opacity: 0 // dots invisible until we hover it
        },
        startAnimation: { // use an animation to start plotting the chart
            active: true,
            type: "avg", // start from the average line.
            speed: 1000, // animate in 1 second.
            easing: ">"
        },
        stepAnimation: { // defines an animation for data updates
            speed: 2000,
            delay: 0,
            easing: '<>'
        },
        highlight: {
            scaleSpeed: 0, // do not animate the dot scaling. instant grow.
            scaleEasing: '',
            scale: 1.2, // enlarge the dot on hover
            newProps: {
                opacity: 1 // show dots on hover
            }
        },
        tooltip: {
            height: 45,
            width: 80,
            padding: [3, 3],
            offset: [-15, -10],
            frameProps: {
                opacity: 0.95,
                /* fill: "white", */
                stroke: "#000"

            }
        }
    },
    series: {
        serie1: {
            fill: true,
            fillProps: {
                opacity: .1
            },
            color: "#26B"
        },
        serie2: {
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

    },
    defaultAxis: {
        labels: true,
        labelsProps: {
            fill: "#49B",
            "font-size": "10px"
        },
        labelsAnchor: "start",
        labelsMargin: 5,
        labelsDistance: -8
    },
    axis: {
        l: { // left axis
            labels: true,
            labelsDistance: 0,
            labelsSkip: 1,
            labelsAnchor: "start",
            labelsMargin: 15,
            labelsProps: {
                fill: "#AAA",
                "font-size": "11px",
                "font-weight": "bold"
            }
        },
        r: { // left axis
            labels: true,
            labelsDistance: 0,
            labelsSkip: 1,
            labelsAnchor: "end",
            labelsMargin: 15,
            labelsProps: {
                fill: "#AAA",
                "font-size": "11px",
                "font-weight": "bold"
            }
        }
    },
    features: {
        mousearea: {
            type: 'axis'
        },
        tooltip: {
            positionHandler: function(env, tooltipConf, mouseAreaData, suggestedX, suggestedY) {
                return [mouseAreaData.event.pageX, mouseAreaData.event.pageY, true]
            }
        },
        grid: {
            draw: true, // draw both x and y grids
            forceBorder: [true, false, true, false], // force grid for external border
            ny: 2, // use 10 divisions for y grid
            nx: 5, // 10 divisions for x grid
            props: {
                stroke: "#CCC" // color for the grid
            }
        }
    }
}