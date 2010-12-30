<?php
$hostname = "YOUR_HOSTNAME";
$db_username = "YOUR_USERNAME";
$db_password = "YOUR_PASSWORD";

$link = mysql_connect($hostname, $db_username, $db_password) or die("Cannot connect to the database");
mysql_select_db("YOUR_DATABASE_NAME") or die("Cannot select the database");


?>