<!DOCTYPE html>
<!-- HTML5 Document -->
<html>
<meta charset="utf-8">
<title>Chamilo statistics page</title>
<head>
    <link rel="stylesheet" href="css/jquery.jqplot.css">
    <link rel="stylesheet" href="css/style.css">
    <!--[if IE]>
    <script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.jqplot.min.js"></script>
    <script src="js/plugins/jqplot.barRenderer.min.js"></script>
    <script src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script src="js/plugins/jqplot.pointLabels.min.js"></script>
    <script src="js/plugins/jqplot.pieRenderer.min.js"></script>
    <script src="js/plugins/jqplot.dateAxisRenderer.min.js"></script>
    <script src="js/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script src="js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script src="js/plugins/jqplot.barRenderer.min.js"></script>
    <script src="js/plugins/jqplot.highlighter.min.js"></script>
    <script src="js/plugins/jqplot.cursor.min.js"></script>
    <script src="js/csgfx.js"></script>
</head>
<body>
<div id="title">
    <h1>Chamilo Stats</h1>
</div>
<a name="history-portal" />
<div id="Chart4" class="chart-history">
    <h2>History of Portals Installation (*)</h2>

    <div id="history-portal"></div>
</div>

<a name="history-courses" />
<div id="Chart5" class="chart-history">
    <h2>History of Courses creation (*)</h2>

    <div id="history-courses"></div>
</div>

<a name="history-users" />
<div id="Chart6" class="chart-history">
    <h2>History of Users in portals (*)</h2>

    <div id="history-users"></div>
</div>

<a name="history-sessions" />
<div id="Chart7" class="chart-history">
    <h2>History of Sessions in portals (*)</h2>

    <div id="history-sessions"></div>
</div>
<h4>(*) Last 18 months.</h4>

<div id="Chart8" class="chart-history">
    <h2>Range of users per portal</h2>

    <div id="range-users"></div>
</div>

<a name="chart-install" />
<div id="Chart1" class="chart-section">
    <h2>Installation per version</h2>

    <div id="chart-install" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie1" class="pie" style="height: 400px; width: 400px"></div>

</div>
<a name="chart-courses" />
<div id="Chart2" class="chart-section">
    <h2>Courses per version</h2>

    <div id="chart-courses" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie2" class="pie" style="height: 400px; width: 400px"></div>
</div>
<a name="chart-users" />
<div id="Chart3" class="chart-section">
    <h2>Users per version</h2>

    <div id="chart-users" class="bar" style="height: 400px; width: 600px"></div>

    <div id="chart-pie3" class="pie" style="height: 400px; width: 400px"></div>
</div>
</body>

<footer>
    <script>
        //Required functions
        <?php include_once('./main.php');?>
        //First chart - Installation
        $.jqplot.config.enablePlugins = true;
        var data1 = [<?php echo chart(0, 'values');?>];
        var ticks1 = [<?php echo chart(0, 'ticks');?>];
        csbarplot('chart-install', data1, ticks1);
        var pie1 = [<?php echo chart(0, 'pie');?>];
        cspieplot("chart-pie1", pie1);
        //Second chart courses
        var data2 = [<?php echo chart(1, 'values');?>];
        var ticks2 = [<?php echo chart(1, 'ticks');?>];
        csbarplot('chart-courses', data2, ticks2);
        var pie2 = [<?php echo chart(1, 'pie');?>];
        cspieplot('chart-pie2', pie2);
        //Third chart users
        var data3 = [<?php echo chart(2, 'values');?>];
        var ticks3 = [<?php echo chart(2, 'ticks');?>];
        csbarplot('chart-users', data3, ticks3);
        //Pie chart users
        var pie3 = [<?php echo chart(2, 'pie');?>];
        cspieplot('chart-pie3', pie3);
        //History portals
        var data4 = [<?php echo chart(4, 'values');?>];
        var ticks4 = [<?php echo chart(4, 'ticks');?>];
        cshbarplot('history-portal', data4.splice(data4.length-24,24),ticks4.splice(ticks4.length-24,24), 'Portals', '#4BB2C5');
        //History courses
        var data5 = [<?php echo chart(5, 'values');?>];
        var ticks5 = [<?php echo chart(5, 'ticks');?>];
        cshbarplot('history-courses', data5.splice(data5.length-24,24),ticks5.splice(ticks5.length-24,24), 'Courses', '#839557');
        //History users
        var data6 = [<?php echo chart(6, 'values');?>];
        var ticks6 = [<?php echo chart(6, 'ticks');?>];
        cshbarplot('history-users', data6.splice(data6.length-24,24),ticks6.splice(ticks6.length-24,24), 'Users', '#C5B47F');
        //History sessions
        var data7 = [<?php echo chart(7, 'values');?>];
        var ticks7 = [<?php echo chart(7, 'ticks');?>];
        cshbarplot('history-sessions', data7.splice(data7.length-24,24),ticks7.splice(ticks7.length-24,24), 'Sessions', '#C5542F');
        //Ranges of users
        var data8 = [<?php echo chart(8, 'values');?>];
        var ticks8 = [<?php echo chart(8, 'ticks');?>];
        cshbarplot('range-users', data8.splice(data8.length-10,10),ticks8.splice(ticks8.length-10,10), 'Ranges', '#C5B47F');
    </script>
</footer>
</html>
