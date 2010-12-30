<?php
session_start(); 
include("ModuleSql.php");

chdir(dirname(getcwd()));

include("Users/UserSql.php");
$userPoints = getValue("POINTS");
echo "You have '$userPoints' points";
if($userPoints >= 1){
	if(isset($_GET['ID'])){
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

		if (!$con){	die('Could not connect: ' . mysql_error());	}
		else{
			$id = mysql_real_escape_string($_GET['ID']); 
			mysql_select_db("DN_Modules", $con);
			$result = mysql_query("UPDATE MODULES SET POINTS = POINTS - 1 WHERE ID = '$id'");
			$username = strtolower(mysql_real_escape_string($_SESSION['USERNAME']));
			
			// Current user id
			$usernameID = getValue("ID");
			$creatorID = strtolower(getModuleValueByID($_GET['ID'], "USERID"));
			
			mysql_select_db("DN_USERS",$con);
			if($usernameID  == $creatorID){
				mysql_query("UPDATE USERS SET POINTS = POINTS - 1 WHERE USERNAME = '$username'");
			}
			else{
				// Don't make them loose points though... Be nice :)
			}
			echo "Success";
			mysql_close($con);
		}
	}
	else{
		echo "Wrong request syntax, ID not specified...";
	}
}
else{
	echo "Gotta have points before you can spend it...";
}
?>
