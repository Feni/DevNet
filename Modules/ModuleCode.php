<?php
	session_start();
	chdir(dirname(getcwd()));
?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network | Code</title>

<script type="text/javascript">
function checkForm(thisform){
	with (thisform){
	  if(CODE.value == "" || CODE.value == null){
		alert("Comon now, can't have a module without code! /nIt just so happens to be the most important part..");
		CODE.focus();
		return false;
	  }
	}
	return true;
}
</script>
<?php 
include("MainTheme.css");
?>

</head>
<body>

<?php 
include("\defaultNavigation.php");
include("\moduleNavigation.php");

if(!isset($_GET["ID"])){
	echo "<p>No Module selected</p>
	</body>
	</html>
	";
	exit;
}
else{
echo '<script type="text/javascript">';
echo 'function showEdit(){';
	echo "var newCode = '";
	if(isset($_SESSION["USERNAME"])){
		$user = getValueById(getModuleValue("USERID"), "USERNAME");
		if(strtolower($_SESSION["USERNAME"]) == strtolower($user)){		// This is my own module, let me edit it...
			echo '<h2>Edit Module</h2>';
			echo '<form action="/Modules/ModuleCode.php?ID='.$_GET["ID"].'" method="post" onsubmit = "return checkForm(this)">';
			echo '<p>*Code</p>';
			echo '<textarea name="CODE" rows="12" cols="64" wrap=virtual>' .$_POST["OLDCODE"]. '</textarea>';
			echo '<p>Code Version Name: <input type="text" name="CODENAME"/></p>';
			echo '<p>Code Version Description: </p>';
			echo '<textarea name="CODEDESC" rows="4" cols="48" wrap=virtual></textarea>';
			echo '<p>Note: * denotes required fields...</p>';
			echo '<input type="submit" value = "Create new Version" />';
			echo '</form>';
		}
		else{	// Some other dude trying to change the module...
			echo '<h2> New Module </h2>';
			echo '<form action="/Modules/ModuleCode.php?ID='.$_GET["ID"].'" method="post" onsubmit = "return checkForm(this)">';
			echo '	Module Name: <input type="text" name="NAME"/>';
			echo '	<br>';
			echo '	<p>Module Description<br></p> ';
			echo '	<textarea name="DESC" rows="4" cols="48" wrap=virtual></textarea>';
			echo '	<br>';
			echo '	<p>Code</p>';
			echo '	<textarea name="CODE" rows="12" cols="64" wrap=virtual>'.$_POST["OLDCODE"].'</textarea>';
			echo '	<input type="submit" />';
			echo '	</form>';
			echo '	<br>';
		}
	}
	else{
		echo '<p>Please Log In to edit modules</p>';
	}
	echo "';";
	echo 'document.getElementById("Edit").innerHTML=newCode;';
echo '
}
';
echo '</script>';
}
?>

<div id = "Header">
<h1> <?php echo getModuleValue("NAME"); ?>  </h1>
<hr>
</div>
<?php
include_once 'geshi/geshi.php';

//$modC = mysql_connect("localhost","username","password");	// TODO Fill in this line with the database login details & uncomment.

if (!$modC){	die('Could not connect: ' . mysql_error());	}
else{
	$user = getValueById(getModuleValue("USERID"), "USERNAME");	// Messed up select again..
	
	mysql_select_db("DN_Modules", $modC);
	
	// Submit the new version of the code
	if(isset($_POST["CODE"])){
		if(strtolower($_SESSION["USERNAME"]) == strtolower($user)){
			$code = mysql_real_escape_string($_POST['CODE']);
			$codename = mysql_real_escape_string($_POST['CODENAME']);
			$codedesc = mysql_real_escape_string($_POST['CODEDESC']);
			
			$finalRslt = mysql_query("INSERT INTO ".$_GET["ID"]."_VERSIONS (NAME , DESCRIPTION , CODE) VALUES ('$codename' , '$codedesc' , '$code')");
			if(!$finalRslt)
			{
				echo "Oops! <br> Something went wrong...". mysql_error();
			}
			
//			mysql_select_db("DN_Users", $modC);
			
// 			Reward the creator with an extra points and experience...
//			mysql_query("UPDATE USERS SET POINTS = POINTS + 3 WHERE ID = '$userid'");
//			mysql_query("UPDATE USERS SET EXP = EXP + 3 WHERE ID = '$userid'");	
		}
		else{
			$_POST['LANG'] = getModuleValue("LANG");	// The language will be the same...
			include("NewModule.php");
		}
	}
	$vsearch = mysql_query("SELECT * FROM ".$_GET['ID']."_VERSIONS ORDER BY VID DESC");	
	$obj = mysql_fetch_object($vsearch);
	$latestVersion = $obj->VID;
		
	$vid = $latestVersion;
	$result = mysql_query("SELECT * FROM ".$_GET['ID']."_VERSIONS ORDER BY VID DESC");
	if(isset($_GET["VID"])){
		$vid = $_GET["VID"];
		$result = mysql_query("SELECT * FROM ".$_GET['ID']."_VERSIONS WHERE VID = '$vid'");
	}
	if(!$result){
		echo "Oops! <br> Error trying to access that specific version of code.". mysql_error();
	}
	else{
		$obj = mysql_fetch_object($result);
		$_POST["OLDCODE"] = $obj->CODE;
		
		$lang = getModuleValue("LANG");
		if(!isset($lang)){
			$lang = "html4strict";
		}
		
		$code = new GeSHi($obj->CODE,$lang);
		$code->set_header_type(GESHI_HEADER_PRE);
		$code->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
		$code->set_line_style('background: #e7e7e7;', true);		

		echo'
		<div id = "Header">
		<h2> Version '.$obj->VID.' : '.$obj->NAME.'</h2>
		<p>'.$obj->DESCRIPTION.'</p>
		</div>';
		echo '<pre>';
		echo $code->parse_code();
		echo '</pre>';
	}
	
// Navigation between versions..
	include("versionNavigation.php");
	echo '<div name = "Edit" id = "Edit"></div>';
}
?>

</body>
</html>
