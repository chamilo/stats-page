<?php

/* Database connection values */
require '../config.php';
define("SERVER", "localhost");
define("DBUSER", $user);
define("DBPASSWORD", $pass);
define("DEFDB", 'community');
define('CHA_VERSIONS', "'1.9.4','1.9.6','1.9.8','1.9.10.2','1.10.0','1.10.2','1.10.4','1.10.6','1.10.8','1.11.0','1.11.2','1.11.4'");
// special temporary fix to avoid showing users of version 1.10.0
define('CHA_VERSIONS_NO_USERS', "'1.9.4','1.9.6','1.9.8','1.9.10.2','1.10.0','1.10.2','1.10.4','1.10.6','1.10.8','1.11.0','1.11.2','1.11.4'");
//define('CHA_VERSIONS', "'1.8.5','1.8.6','1.8.7','1.8.8','1.9.0','1.9.2','1.9.4','1.9.6','2.0','2.1','3.0','3.1'"); //only shows about 2200 users in total and definitely will confuse people even more - YW 2013/03/09
// ranges of users per portal
define('CHA_USERS_RANGES', '10-50,51-100,101-250,251-500,501-1000,1001-2500,2501-5000,5001-25000,25001-100000,100001-2000000');
