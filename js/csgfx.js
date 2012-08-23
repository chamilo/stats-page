/**
 * Created with JetBrains PhpStorm.
 * User: albert1t0
 * Date: 21/08/12
 * Time: 11:23 AM
 * To change this template use File | Settings | File Templates.
 */


function csbarplot(container, data, ticks) {
    return $.jqplot(container, [data], {
        animate:!$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions:{
                varyBarColor:true
            },
            pointLabels:{ show:true }
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.CategoryAxisRenderer,
                ticks:ticks
            }
        },
        highlighter:{ show:false },
        cursor:{show:false}
    });
}

function cspieplot(container, pie) {
    return $.jqplot(container, [pie], {
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer,
            trendline:{ show:false },
            rendererOptions:{ sliceMargin:4, padding:8, showDataLabels:true }
        },
        legend:{ show:true },
        highlighter:{ show:false },
        cursor:{show:false}
    });
}

function cshbarplot(container, data, ticks, portal, color) {
    return $.jqplot(container, [data], {
        seriesColors:[ color],
        animate:!$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions:{
                varyBarColor:false
            },
            pointLabels:{show:false}
        },
        axesDefaults:{
            tickRenderer:$.jqplot.CanvasAxisTickRenderer,
            tickOptions:{
                angle:'-30',
                fontSize:'8pt'
            }
        },
        axes:{
            xaxis:{
                label:'Year-Month',
                renderer:$.jqplot.CategoryAxisRenderer,
                ticks:ticks
            },
            yaxis:{
                tickOptions:{
                    formatString:'%d'
                },
                min:0
            }
        },
        highlighter:{
            show:true,
            showMarker:false,
            tooltipAxes:'y',
            formatString:portal + ': %d'
        },
        cursor:{show:false}
    });
}