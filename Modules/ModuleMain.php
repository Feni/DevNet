<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network | Modules</title>

<?php
include("MainTheme.css");
?>

<script type="text/javascript">
function checkForm(thisform){
	with (thisform){
      if(NAME.value == null || NAME.value == ""){
        alert("Please fill out a name for your module...");
        NAME.focus();
        return false;
      }
      if(NAME.value.length < 5 || NAME.value.length > 32){
        alert("Names must be between 5 and 32 characters long");
        NAME.focus();
        return false;
      }
	  if(startsWithNum(NAME.value)){
		alert("Sorry, a module name can't start with a number...");
		NAME.focus();
		return false;
	  }
	  if(DESC.value == "" || DESC.value == null){
		alert("Enter a description for your module");
		DESC.focus();
		return false;
	  }
	  if(CODE.value == "" || CODE.value == null){
		alert("Comon now, can't have a module without code! /nIt just so happens to be the most important part..");
		CODE.focus();
		return false;
	  }
	  if(LANG.value == "" || LANG.value == null){
		alert("You must define what programming language (html4strict, java, php) your module is in.");
		LANG.focus();
		return false;
	  }
	}
	return true;
}

function startsWithNum(str){
	return isNum(str.charAt(0));
}

function isNum(c){
	return (c == '0' || c == '1' || c == '2' || c == '3' || c == '4' ||c == '4' ||c == '5' ||c == '6' ||c == '7' ||c == '8' || c == '9');
}

</script>
</head>
<body>

<?php include("defaultNavigation.php");?>

<div id = "Header">
<h2> Modules </h2>
</div>

<?php

// Establish the connection
//$modC = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

mysql_select_db("DN_Modules", $modC);

if (!$modC){	die('Could not connect: ' . mysql_error());	}
else{
if(isset($_POST['CODE'])){// Presents?
	include("NewModule.php");
}
// Show off to the world the modules we have!
echo "<h1> Modules </h1>";

$result = mysql_query("SELECT * FROM MODULES ORDER BY ID DESC");
$newest = mysql_fetch_object($result);
$latestId = $newest->ID;

if(isset($_GET["PAGE"])){
	$threshold = $latestId - ($_GET["PAGE"] * 5);
	$result = mysql_query("SELECT * FROM MODULES WHERE ID <= ".$threshold." ORDER BY ID DESC ");
}
else{	// Redo the query, since the first one has a messed up pointer thanks to get obj
	$result = mysql_query("SELECT * FROM MODULES ORDER BY ID DESC");
}

$count = 0;
while ( ($row = mysql_fetch_array($result)) && ($count < 5) ){
	echo '
	<hr>
	<h3> [ '.$row["POINTS"].' ] <a href = "?ID='.$row["ID"].'">'.$row["NAME"].'</a></h3>
	<p>'.$row["DESCRIPTION"].'</p>
	';
	$count++;
}


echo '<script type="text/javascript">';
echo "function showNewModuleForm(){
	var formCode = '";

if(isset($_SESSION["USERNAME"])){
	echo '<h1> New Module </h1>';
	echo '<form action="index.php" method="post" onsubmit = "return checkForm(this)">';
	echo '<p>*Module Name: <input type="text" name="NAME"/></p>';
	echo '<p>*Module Description</p> ';
	echo '<textarea name="DESC" rows="4" cols="48" wrap=virtual></textarea>';
	echo '<p>*Programming Language: <input type = "text" name = "LANG"/></p>';
	echo '<br>';
	echo '<p>*Code</p>';
	echo '<textarea name="CODE" rows="12" cols="64" wrap=virtual></textarea>';
	echo '<p>Code Version Name: <input type="text" name="CODENAME"/></p>';
	echo '<p>Code Version Description: </p><textarea name="CODEDESC" rows="4" cols="48" wrap=virtual></textarea>';
	echo '<p>Note: * denotes required fields...</p>';
	echo '<input type="submit" value = "Create new Module" />';
	echo '</form>';
	echo '<br>';		
}
else{	// Not one of the cool kids. They can't be allowed to create modules, no way!
	echo '<p>Please <a href = "/Login.php">Log In</a> to create modules</p>';
}
echo "';";
	echo '
	document.getElementById("CreateNewModule").innerHTML=formCode;
}
</script>
';

include("modulesMainNavigation.php");
// Ahh finally, we're done. I bet the connection's pretty tired. Give it some rest...
mysql_close($modC);
}
?>
<div id = "CreateNewModule" name = "CreateNewModule"></div>

<?php include("Footer.php");?>

</body>
</html>
