<html5>
    <header>
        <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css">
        <!--[if IE]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
        <script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    </header>
    <body>

    <div class="install" id="chartdiv" style="height: 400px; width: 300px"></div>

    </body>

    <footer>
        <?php  //Retrive Data
            include('./connection.php');
            $resultado = installationperversion();
            $keys = array_keys($resultado[0]);
            foreach( $resultado[0] as $value ) {
                $chart1 .= "['". $value['portal_version'] . "'," .$value["COUNT( 'id' )"]. "]," ;
            }

        ?>
        <script type="text/javascript">
            //First chart
            $.jqplot('chartdiv',  [[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]]);
        </script>

    </footer>

</html5>
