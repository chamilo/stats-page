<?php

/* Database connection values */

define("SERVER", "localhost");
define("DBUSER", "root");
define("DBPASSWORD", "atv1972");
define("DEFDB", "association");

/* Retrive DATA */
/* Retrieve Installation per version */

function installationperversion()
{

    $mydb = new mysqli(SERVER, DBUSER, DBPASSWORD, DEFDB);

    /* Retrieve Installation per version */

    $sql = "SELECT portal_version, COUNT( 'id' ) FROM association.community AS community GROUP BY portal_version HAVING ( ( portal_version BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[0][] = $row;
    }
    ;


    /* Retrieve Courses per Version */

    $sql = "SELECT portal_version, SUM( number_of_courses ) FROM association.community AS community GROUP BY portal_version HAVING ( ( portal_version BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[1][] = $row;
    }
    ;


    /* Retrieve Courses per Version */

    $sql = "SELECT portal_version, SUM( number_of_users ) FROM association.community AS community GROUP BY portal_version HAVING ( ( portal_version BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[2][] = $row;
    }
    ;


    $result->close();
    $mydb->close();

    return $table;
}

function chart( $num = 0, $op = 'values')
{
    $chart1 = "";
    $resultado = installationperversion();
    $keys = array_keys($resultado[0]);
    foreach ($resultado[$num] as $value) {
        switch($op) {
            case "values":
                $chart1 .= $value["COUNT( 'id' )"] .",";
                break;
            case "ticks":
                $chart1 .= "'" . $value['portal_version'] . "',";
                break;
            case "pie":
                $chart1 .= "['". $value['portal_version'] . "'," . $value["COUNT( 'id' )"] ."],";
                break;
        }
    }
    return rtrim($chart1, ',');

}

