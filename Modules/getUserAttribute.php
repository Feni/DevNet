<?php
session_start();
chdir(dirname(getcwd()));
include("Users\UserSql.php");
echo getValue($_GET["attribute"]);
?>