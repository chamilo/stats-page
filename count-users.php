<?php
/**
 * This script shows the total number of users of Chamilo, globally
 * http://version.chamilo.org/stats/
 * @package chamilo.website.stats
 * @author Yannick Warnier <yannick@chamilo.org>
 */
/**
 * Includes the database and versions settings
 */
include_once('connection.php');
$dsn = 'mysql:dbname='.DEFDB.';host='.SERVER;
try {
    $db = new PDO($dsn, DBUSER, DBPASSWORD);
} catch (PDOException $e) {
    die('Could not connect to the database');
}
$totalUsers = 0;
$sqlb = "SELECT id, max(updated_on), number_of_users 
    FROM community
    WHERE portal_url NOT LIKE '%127.0.%' 
    AND portal_url NOT LIKE '%192.168.%' 
    AND portal_url NOT LIKE '%localhost%'
    AND number_of_users > 65
    GROUP BY portal_url 
    ";
$resb = $db->query($sqlb);

if ($resb->rowCount() > 0) {
    while ($row = $resb->fetch(PDO::FETCH_ASSOC)) {
        $totalUsers += $row['number_of_users'];
    }
}
echo $totalUsers;