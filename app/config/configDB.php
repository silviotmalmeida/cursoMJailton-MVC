<?php
$envFile = parse_ini_file(realpath(dirname(__FILE__) . '/env.ini'));

define("MYSQL_IP", $envFile['mysql_IP']);
define("MYSQL_PORT", $envFile['mysql_port']);
define("MYSQL_USER", $envFile['mysql_user']);
define("MYSQL_PASSWORD", $envFile['mysql_password']);
define("MYSQL_DB", $envFile['mysql_DB']);
define("CHARSET","UTF8");