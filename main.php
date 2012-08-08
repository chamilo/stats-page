<?php

include_once('connection.php');

/* Retrive DATA */
/* Retrieve Installation per version */

/* Crate the VIEWS in the database ...

** This views are for per version statistics **

CREATE VIEW register AS SELECT portal_ip AS portal_ip, portal_url AS portal_url, MAX(registered_on) AS max_register FROM community GROUP BY portal_ip, portal_url;
CREATE VIEW resume AS
SELECT community.portal_ip, community.portal_url, community.portal_version, community.number_of_courses, community.number_of_users
FROM register, association.community AS community
WHERE register.portal_ip = community.portal_ip
AND register.portal_url = community.portal_url
AND register.max_register = community.registered_on;

** This views are for historical growth **

*/

function retrivedata()
{

    $mydb = new mysqli(SERVER, DBUSER, DBPASSWORD, DEFDB);

    /* Retrieve Installation per version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, COUNT( 'id' ) AS number FROM " . DEFDB . ".resume AS resume GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[0][] = $row;
    }

    /* Retrieve Courses per Version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, SUM( number_of_courses ) AS numcourses FROM " . DEFDB . ".resume AS resume GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[1][] = $row;
    }


    /* Retrieve Courses per Version */

    $sql = "SELECT LEFT(portal_version,5) AS portal, SUM( number_of_users ) AS numusers FROM " . DEFDB . ".resume AS resume GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[2][] = $row;
    }

    /* Retieve History per portals */

    $sql = "SELECT LEFT(portal_version,5) AS portal, SUM( number_of_users ) AS numusers FROM " . DEFDB . ".resume AS resume GROUP BY portal HAVING ( ( portal BETWEEN '1.8' AND '1.9.0' ) )";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[3][] = $row;
    }

    /* Number of portals per month since 2010*/

    $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha, MAX(numportals) as N FROM " . DEFDB . ".history GROUP BY fecha;";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[4][] = $row;
    }

    /* Number of courses per month since 2010*/

    $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha, MAX(numcourses) as N FROM " . DEFDB . ".history GROUP BY fecha;";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[5][] = $row;
    }

    /* Number of users per month since 2010*/

    $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha, MAX(numusers) as N FROM " . DEFDB . ".history GROUP BY fecha;";
    $result = $mydb->query($sql);
    while ($row = $result->fetch_assoc()) {
        $table[6][] = $row;
    }


    $result->close();
    $mydb->close();

    return $table;
}

function chart($num = 0, $op = 'values')
{
    $chart1 = "";
    $dato = "";

    switch ($num) {
        case 0:
            $etiqueta = "portal";
            $dato = "number";
            break;
        case 1:
            $etiqueta = "portal";
            $dato = "numcourses";
            break;
        case 2:
            $etiqueta = "portal";
            $dato = "numusers";
            break;
        case 4:
        case 5:
        case 6:
            $etiqueta = "fecha";
            $dato = "N";
            break;
    }

    $resultado = retrivedata();
    $keys = array_keys($resultado[0]);
    foreach ($resultado[$num] as $value) {
        switch ($op) {
            case "values":
                $chart1 .= $value[$dato] . ",";
                break;
            case "ticks":
                $chart1 .= "'" . $value[$etiqueta] . "',";
                break;
            case "pie":
                $chart1 .= "['" . $value[$etiqueta] . "'," . $value[$dato] . "],";
                break;
        }
    }
    return rtrim($chart1, ',');

}

