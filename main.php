<?php
/**
 * This script generates data for graphics on the Chamilo stats page, as shown on
 * http://version.chamilo.org/stats/
 * @package chamilo.website.stats
 * @author Alberto Torreblanca <alberto@chamilo.org>
 * @author Yannick Warnier <yannick@chamilo.org>
 */
/**
 * Includes the database and versions settings
 */
include_once('connection.php');
/**
 * Functions
 */
/* Retrieve DATA */
/* Retrieve Installation per version */
$dsn = 'mysql:dbname='.DEFDB.';host='.SERVER;
try {
    $myDB = new PDO($dsn, DBUSER, DBPASSWORD);
} catch (PDOException $e) {
    die('Could not connect to the database');
}
// Before anything, collect an array of all the portals in their latest version
$ids = '';
$sql = "SELECT portal_url, max(id) as pid 
        FROM community 
        WHERE portal_version IN (".CHA_VERSIONS.")
        GROUP BY portal_url
        ";
$result = $myDB->query($sql);
while ($row = $result->fetch()) {
    $ids .= $row['pid'].',';
}
$ids = substr($ids, 0, -1);

// Prepare an ordered list of versions
$versions = str_replace("'", '', CHA_VERSIONS);
$versions = preg_split('/,/', $versions);

/**
 * Retrieves the data from the database and return it as a table
 * @param int $type Type of data we want
 * @return array Table of results
 */
function retrieveData($type) {
    global $myDB, $ids, $versions;
    $table = [];

    switch ($type) {
        case 0:
            /* Retrieve number of installations per version */
            $sql = "SELECT portal_version as portal,
                        COUNT(portal_url) AS number
                        FROM community
                        WHERE id IN ($ids)
                        GROUP BY portal
                    ";
            $result = $myDB->query($sql);
            $temp = [];
            while ($row = $result->fetch()) {
                $temp[$row['portal']] = $row;
            }
            foreach ($versions as $version) {
                if (!empty($temp[$version])) {
                    $table[] = $temp[$version];
                }
            }
            break;

        case 1:
            /* Retrieve Courses per Version */
            /*
            $sql = "SELECT LEFT(portal_version,6) AS portal,
                      SUM( number_of_courses ) AS numcourses 
                      FROM resume 
                      GROUP BY portal 
                      HAVING ( ( portal IN (".CHA_VERSIONS.") ) )
                      ";
            */
            $sql = "SELECT portal_version as portal,
                        SUM(number_of_courses) AS numcourses
                        FROM community
                        WHERE id IN ($ids)
                        GROUP BY portal
                    ";
            $result = $myDB->query($sql);
            $temp = [];
            while ($row = $result->fetch()) {
                $temp[$row['portal']] = $row;
            }
            foreach ($versions as $version) {
                if (!empty($temp[$version])) {
                    $table[] = $temp[$version];
                }
            }
            break;

        case 2:
            /* Retrieve Users per Version */
            // this should use the CHA_NO_USERS constant, but not really important for now
            $sql = "SELECT portal_version as portal,
                        SUM(number_of_users) AS numusers
                        FROM community
                        WHERE id IN ($ids)
                        GROUP BY portal
                    ";
            $result = $myDB->query($sql);
            $temp = [];
            while ($row = $result->fetch()) {
                $temp[$row['portal']] = $row;
            }
            foreach ($versions as $version) {
                if (!empty($temp[$version])) {
                    $table[] = $temp[$version];
                }
            }
            break;

        case 3:
            /* Retrieve History per portals */
            $sql = "SELECT portal_version as portal,
                        SUM(number_of_users) AS numusers
                        FROM community
                        WHERE id IN ($ids)
                        GROUP BY portal
                    ";
            $result = $myDB->query($sql);
            $temp = [];
            while ($row = $result->fetch()) {
                $temp[$row['portal']] = $row;
            }
            foreach ($versions as $version) {
                if (!empty($temp[$version])) {
                    $table[] = $temp[$version];
                }
            }
            break;

        case 4:
            /* Number of portals per month since 2010*/
            $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha,
                      MAX(numportals) as N 
                      FROM history
                      GROUP BY fecha
                    ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;

        case 5:
            /* Number of courses per month since 2010*/
            $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha,
                      MAX(numcourses) as N
                      FROM history GROUP BY fecha
                      ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;

        case 6:
            /* Number of users per month since 2010*/
            $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha,
                      MAX(numusers) as N
                      FROM history
                      GROUP BY fecha
                      ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;

        case 7:
            /* Number of sessions per month since 2010*/
            $sql = "SELECT RIGHT(LEFT(log_time,7),5) AS fecha,
                      MAX(numsessions) as N 
                      FROM history
                      GROUP BY fecha
                      ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;

        case 8:
            /* Ranges of number of users per portal*/
            $ranges = preg_split('/,/', CHA_USERS_RANGES);
            foreach ($ranges as $range) {
                list($from, $to) = preg_split('/-/', $range);
                $sql = "SELECT '$range' AS myrange, 
                          COUNT(*) as N
                          FROM community
                          WHERE id IN ($ids)
                            AND number_of_users >= $from
                            AND number_of_users <= $to
                        ";
                $result = $myDB->query($sql);
                $num = $result->rowCount();
                if ($num == 0) {
                    $row = array($range, 0);
                } else {
                    $row = $result->fetch();
                }
                $table[] = $row;
            }
            break;

        case 9: 
            // Select only "relevant" portals with more than 65 users (demo set is = 60)
            $twoYears = time()-(86400*365*2);
            $twoYearsAgo = date('Y-m-d', $twoYears);
            $sql = "SELECT distinct(language) AS language, count(id) as N
                FROM community
                WHERE language in (".CHA_LANGUAGES.")
                AND number_of_users > 65
                AND updated_on > '$twoYearsAgo'
                GROUP BY language order by 2 DESC LIMIT 20";
            $result = $myDB->query($sql);
            $num = $result->rowCount();
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;
        case 10:
            // Select packagers vs number of portals in the last 2 years
            $twoYears = time()-(86400*365*2);
            $twoYearsAgo = date('Y-m-d', $twoYears);
            $sql = "SELECT distinct(packager) AS packager, count(id) as N
                FROM community
                WHERE updated_on > '$twoYearsAgo'
                GROUP BY packager ORDER BY 2 DESC LIMIT 20";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;
        case 11:
            // Select portals per year
            $sql = "SELECT LEFT(log_time,4) AS fecha,
                      MAX(numportals) as N 
                      FROM history
                      GROUP BY fecha
                    ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;
        case 12:
            // Select users per year
            $sql = "SELECT LEFT(log_time,4) AS fecha,
                      MAX(numusers) as N
                      FROM history
                      GROUP BY fecha
                    ";
            $result = $myDB->query($sql);
            while ($row = $result->fetch()) {
                $table[] = $row;
            }
            break;
    }
    return $table;
}
/**
 * Formats the charts data
 * @param int Type of data to show in chart
 * @param string Type of chart
 * @return string Formatted chart data to be treated by JS
 */
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
        case 7:
            $etiqueta = "fecha";
            $dato = "N";
            break;
        case 8:
            $etiqueta = "myrange";
            $dato = "N";
            break;
        case 9:
            $etiqueta = "language";
            $dato = "N";
            break;
        case 10:
            $etiqueta = "packager";
            $dato = "N";
            break;
        case 11:
        case 12:
            $etiqueta = 'fecha';
            $dato = 'N';
            break;
    }

    $apcu = false;
    $apcuVar = 'statschamiloorg_retrieve_'.$num;
    if (function_exists('apcu_fetch')) {
        $apcu = true;
    }
    // @todo This function is still called 2 or 3 times per chart. Reduce that!
    if ($apcu) {
        if (apcu_exists($apcuVar) && (empty($_GET['r']))) {
            $serialized = apcu_fetch($apcuVar);
            $table = unserialize($serialized);
        } else {
            $table = retrieveData($num);
            $serialized = serialize($table);
            apcu_store($apcuVar, $serialized, 300);
        }
    } else {
        $table = retrieveData($num);
    }

    foreach ($table as $value) {
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
    $chart1 = substr($chart1, 0, -1);
    return rtrim($chart1, ',');

}

