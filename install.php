<?php
/**
 * Created by JetBrains PhpStorm.
 * User: albert1t0
 * Date: 21/08/12
 * Time: 12:28 PM
 * To change this template use File | Settings | File Templates.
 */

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

include_once('connection.php');

$mydb = new mysqli(SERVER, DBUSER, DBPASSWORD, DEFDB);

$sql1 = "CREATE VIEW register AS SELECT portal_ip AS portal_ip, portal_url AS portal_url, MAX(registered_on) AS max_register FROM community GROUP BY portal_ip, portal_url";
$sql2 = <<<QUERY
   CREATE VIEW resume AS
   SELECT community.portal_ip, community.portal_url, community.portal_version, community.number_of_courses, community.number_of_users
   FROM register, association.community AS community
   WHERE register.portal_ip = community.portal_ip
   AND register.portal_url = community.portal_url
   AND register.max_register = community.registered_on;
QUERY;

$result1 = $mydb->query($sql1);
$result2 = $mydb->query($sql2);

