<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network </title>
<link rel="stylesheet" type="text/css" href="MainTheme.css">
</head>

<body>

<?php include("defaultNavigation.php");?>


<div id = "Header">
<h2> Welcome to Dev Net </h2>
<p>Dev Net is a place for open source projects and programmers to collaborate and share resources</p>

</div>

<br>

<h2> Module Highlights </h2>
<?php
//$con = mysql_connect("localhost","Username","Password");		// TODO Fill in this line with the database login details & uncomment. Erased before uploading for obvious reasons
mysql_select_db("DN_Modules", $con);

$topModule = mysql_fetch_object(mysql_query("SELECT * FROM MODULES ORDER BY POINTS DESC"));
echo '<h3><a href = "Modules/?ID='.$topModule->ID.'">'.$topModule->NAME."</a></h3>";
echo '<p>'.$topModule->DESCRIPTION.'</p>';
echo '<hr>';

$newestModule = mysql_fetch_object(mysql_query("SELECT * FROM MODULES ORDER BY CREATED DESC"));
echo '<h3><a href = "Modules/?ID='.$newestModule->ID.'">'.$newestModule->NAME."</a></h3>";
echo '<p>'.$newestModule->DESCRIPTION.'</p>';
echo '<hr>';

$randomModule = mysql_fetch_object(mysql_query("SELECT * FROM MODULES WHERE ID = ". rand(1, $newestModule->ID)) );
echo '<h3><a href = "Modules/?ID='.$randomModule->ID.'">'.$randomModule->NAME."</a></h3>";
echo '<p>'.$randomModule->DESCRIPTION.'</p>';
echo '<hr>';

/*		// Give up projects for now...
echo '<br>
<h1>Project Highlights</h1>

<h3>Test Project 2</h3>
<p> Project 2 description not exceeding 120 characters </p>
<hr>

<h3>Test Project 3</h3>
<p> Project 3 description not exceeding 120 characters </p>
<hr>';

*/

echo '<h2> User Highlights </h2>
<h3> Top 10 Programmers </h3>';

mysql_select_db("DN_Users", $con);


$topUsers = mysql_query("SELECT * FROM USERS ORDER BY POINTS DESC");

$count = 0;
while( ($row = mysql_fetch_array($topUsers)) && ($count < 10) ){
	echo '<h3><a href = "USERS/?USERNAME='.$row["USERNAME"].'"> [ '.$row["POINTS"].' ] '.$row["USERNAME"]."</a></h3>";
	$count++;
}

$newestUser = mysql_fetch_object(mysql_query("SELECT * FROM USERS ORDER BY JOINED DESC"));
echo '<h3> Newest User: <a href = "USERS/?USERNAME='.$newestUser->USERNAME.'">'.$newestUser->USERNAME."</a></h3>";

?>





<?php include("Footer.php");?>


</body>
</html>
