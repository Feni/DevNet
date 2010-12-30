<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network | Users</title>

<?php
include("MainTheme.css");
?>
</head>
<body>
<?php include("defaultNavigation.php");?>
<div id = "Header">
<h2> Users </h2>
</div>
<?php
// Establish the connection
//	$modC = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

mysql_select_db("DN_Users", $modC);

if (!$modC){	die('Could not connect: ' . mysql_error());	}
else{
echo "<h1> Users </h1>";
$result = mysql_query("SELECT * FROM USERS ORDER BY ID DESC");
$latestId = mysql_fetch_object($result)->ID;

if(isset($_GET["PAGE"])){
	$threshold = $latestId - ($_GET["PAGE"] * 5);
	$result = mysql_query("SELECT * FROM MODULES WHERE ID < ".$threshold." ORDER BY ID DESC ");
}

$count = 0;
while( ($row = mysql_fetch_array($result)) && ($count < 5) ){
	echo '
	<hr>
	<h3> [ '.$row["POINTS"].' ] <a href = "?USERNAME='.$row["USERNAME"].'">'.$row["USERNAME"].'</a></h3>
	';
	$count++;
}
//include("usersMainNavigation.php");
// Ahh finally, we're done. I bet the connection's pretty tired. Give it some rest...
mysql_close($modC);
}
?>
<?php include("Footer.php");?>

</body>
</html>
