<html5>
    <header>
        <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css">
        <!--[if IE]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
        <script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script type="text/javascript" src="js/plugins/jqplot.pointLabels.min.js"></script>
    </header>
    <body>

    <h1>Chamilo Stats</h1>

    <div class="install" id="chartdiv" style="height: 400px; width: 800px"></div>

    </body>

    <footer>
        <script type="text/javascript">
            //First chart
            data = [<?php include_once('./connection.php'); echo chart1('values');?>];
            ticks = [<?php include_once('./connection.php'); echo chart1('ticks');?>];
            $.jqplot.config.enablePlugins = true;
            plot1 = $.jqplot('chartdiv',[data] ,{
                animate: !$.jqplot.use_excanvas,
                            seriesDefaults:{
                                renderer:$.jqplot.BarRenderer,
                                pointLabels: { show: true }
                            },
                            axes: {
                                xaxis: {
                                    renderer: $.jqplot.CategoryAxisRenderer,
                                    ticks: ticks
                                }
                            },
                            highlighter: { show: false }
            });

        </script>

    </footer>

</html5>
