<?php

include_once('connection.php');

/* Retrive DATA */
/* Retrieve Installation per version */

function installationperversion()
{

    $mydb = new mysqli(SERVER, DBUSER, DBPASSWORD, DEFDB);

    /* Retrieve Installation per version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, COUNT( 'id' ) AS number FROM ".DEFDB.".community AS community GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[0][] = $row;
    }

    /* Retrieve Courses per Version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, SUM( number_of_courses ) AS numcourses FROM ".DEFDB.".community AS community GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[1][] = $row;
    }


    /* Retrieve Courses per Version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, SUM( number_of_users ) AS numusers FROM ".DEFDB.".community AS community GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[2][] = $row;
    }


    $result->close();
    $mydb->close();

    return $table;
}

function chart( $num = 0, $op = 'values')
{
    $chart1 = "";
    $dato = "";

    switch($num) {
        case 0:
            $dato = "number";
            break;
        case 1:
            $dato = "numcourses";
            break;
        case 2:
            $dato = "numusers";
            break;
    }

    $resultado = installationperversion();
    $keys = array_keys($resultado[0]);
    foreach ($resultado[$num] as $value) {
        switch($op) {
            case "values":
                $chart1 .= $value[$dato] .",";
                break;
            case "ticks":
                $chart1 .= "'" . $value['portal'] . "',";
                break;
            case "pie":
                $chart1 .= "['". $value['portal'] . "'," . $value[$dato] ."],";
                break;
        }
    }
    return rtrim($chart1, ',');

}

