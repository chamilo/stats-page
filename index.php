<!DOCTYPE html>
<!-- HTML5 Document -->
<html>
<meta charset="utf-8">
<title>Chamilo statistics Page</title>
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
<div id="Chart4" class="chart-history">
    <h2>History of Portals Installations since 2010</h2>

    <div id="history-portal"></div>
</div>

<div id="Chart5" class="chart-history">
    <h2>History of Course creation since 2010</h2>

    <div id="history-courses"></div>
</div>

<div id="Chart6" class="chart-history">
    <h2>History of Users in portals since 2010</h2>

    <div id="history-users"></div>
</div>

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
    cspieplot('chart-pie2',pie2);
    //Third chart users
    var data3 = [<?php echo chart(2, 'values');?>];
    var ticks3 = [<?php echo chart(2, 'ticks');?>];
    csbarplot('chart-users', data3, ticks3);
    //Pie chart users
    var pie3 = [<?php echo chart(2, 'pie');?>];
    cspieplot('chart-pie3',pie3);
    //History portals
    var data4 = [<?php echo chart(4, 'values');?>];
    var ticks4 = [<?php echo chart(4, 'ticks');?>];
    cshbarplot('history-portal', data4, ticks4, 'Portals');
    //History courses
    var data5 = [<?php echo chart(5, 'values');?>];
    var ticks5 = [<?php echo chart(5, 'ticks');?>];
    cshbarplot('history-courses', data5, ticks5, 'Courses');
    //History users
    var data6 = [<?php echo chart(6, 'values');?>];
    var ticks6 = [<?php echo chart(6, 'ticks');?>];
    cshbarplot('history-users', data6, ticks6, 'Users');
</script>
</footer>
</html>
