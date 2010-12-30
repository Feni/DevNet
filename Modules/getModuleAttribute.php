<?php
include("ModuleSql.php");
echo getModuleValueByID($_GET["id"], $_GET["attribute"]);
?>