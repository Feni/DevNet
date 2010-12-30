<?php 
session_start(); 
chdir(dirname(getcwd()));

if(isset($_GET["USERNAME"])){	// Display a specific module
	include("UserIndex.php");
}
else{	// Display recent modules and an option to create new modules...
	include("UsersMain.php");
}

?>
