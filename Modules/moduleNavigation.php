<?php
include("ModuleSql.php");
?>

<div id = "MainNavigation">
<?php
echo '
<a href= "index.php?ID='.$_GET["ID"].'">'.getModuleValue("NAME").'</a>
<a href= "ModuleCode.php?ID='.$_GET["ID"].'">Code</a>
<a href= "Comments.php?ID='.$_GET["ID"].'">Comments</a>
';
?>

</div>


<div id = "UserNavigation">

</div>

<br>
<hr>