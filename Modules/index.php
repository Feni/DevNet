<?php 
session_start(); 
chdir(dirname(getcwd()));

if(isset($_GET["ID"])){	// Display a specific module
	include("ModuleIndex.php");
}
else{	// Display recent modules and an option to create new modules...
	include("ModuleMain.php");
}

?>
