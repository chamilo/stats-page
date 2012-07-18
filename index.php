<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="css/jquery.jqplot.css">
    <link rel="stylesheet" href="css/style.css">
    <!--[if IE]>
    <script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
    <script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="js/plugins/jqplot.pointLabels.min.js"></script>
    <script type="text/javascript" src="js/plugins/jqplot.pieRenderer.min.js"></script>
</header>
<body>

<h1>Chamilo Stats</h1>

<div id="Chart1" class="chart-section">
    <h2>Installation per Chamilo version</h2>

    <div id="chart-install" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie1" class="pie" style="height: 400px; width: 400px"></div>

</div>
<div id="Chart2" class="chart-section">
    <h2>Courses per Chamilo version</h2>

    <div id="chart-courses" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie2" class="pie" style="height: 400px; width: 400px"></div>
</div>
<div id="Chart3" class="chart-section">
    <h2>Users per Chamilo version</h2>

    <div id="chart-users" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie3" class="pie" style="height: 400px; width: 400px"></div>
</div>
</body>

<footer>
    <script type="text/javascript">
        //Required functions
        <?php include_once('./connection.php');?>
        //First chart - Installation
        var data1 = [<?php echo chart(0, 'values');?>];
        var ticks1 = [<?php echo chart(0, 'ticks');?>];
        $.jqplot.config.enablePlugins = true;
        plot1 = $.jqplot('chart-install', [data1], {
            animate:!$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels:{ show:true }
            },
            axes:{
                xaxis:{
                    renderer:$.jqplot.CategoryAxisRenderer,
                    ticks:ticks1
                }
            },
            highlighter:{ show:false }
        });
        //Pie chart Installation
        var chart1 = $.jqplot("chart-pie1", [
            [<?php echo chart(0, 'pie');?>]
        ], {
            seriesDefaults:{
                renderer:$.jqplot.PieRenderer,
                trendline:{ show:false },
                rendererOptions:{ sliceMargin:4, padding:8, showDataLabels:true }
            },
            legend:{ show:true }
        });
    </script>
    <script type="text/javascript">
        //Second chart courses
        var data2 = [<?php echo chart(1, 'values');?>];
        var ticks2 = [<?php echo chart(1, 'ticks');?>];
        $.jqplot.config.enablePlugins = true;
        plot1 = $.jqplot('chart-courses', [data2], {
            animate:!$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels:{ show:true }
            },
            axes:{
                xaxis:{
                    renderer:$.jqplot.CategoryAxisRenderer,
                    ticks:ticks2
                }
            },
            highlighter:{ show:false }
        });
        //Pie chart courses
        var chart2 = $.jqplot("chart-pie2", [
            [<?php echo chart(1, 'pie');?>]
        ], {
            seriesDefaults:{
                renderer:$.jqplot.PieRenderer,
                trendline:{ show:false },
                rendererOptions:{ sliceMargin:4, padding:8, showDataLabels:true }
            },
            legend:{ show:true }
        });
    </script>
    <script type="text/javascript">
        //Third chart users
        var data3 = [<?php echo chart(2, 'values');?>];
        var ticks3 = [<?php echo chart(2, 'ticks');?>];
        $.jqplot.config.enablePlugins = true;
        plot1 = $.jqplot('chart-users', [data3], {
            animate:!$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels:{ show:true }
            },
            axes:{
                xaxis:{
                    renderer:$.jqplot.CategoryAxisRenderer,
                    ticks:ticks3
                }
            },
            highlighter:{ show:false }
        });
        //Pie chart users
        var chart3 = $.jqplot("chart-pie3", [
            [<?php echo chart(2, 'pie');?>]
        ], {
            seriesDefaults:{
                renderer:$.jqplot.PieRenderer,
                trendline:{ show:false },
                rendererOptions:{ sliceMaergin:4, padding:8, showDataLabels:true }
            },
            legend:{ show:true }
        });
    </script>
</footer>

</html>
