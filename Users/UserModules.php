<?php
	session_start();
	chdir(dirname(getcwd()));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network : <?php echo $_GET["USERNAME"] ?></title>

<?php include("MainTheme.css"); ?>

</head>
<body>
<?php include("defaultNavigation.php"); ?>
<?php include("userNavigation.php"); ?>

<div id = "Header">
<h2> <?php echo $_GET["USERNAME"] ?></h2>

<?php
	echo "<p>A member of DevNet since ".getValueByUser($_GET["USERNAME"],"JOINED")."</p>";
	echo "<p> Experience: ".getValueByUser($_GET["USERNAME"],"EXP")."</p>";
	echo "<p> Points: ".getValueByUser($_GET["USERNAME"],"POINTS")."</p>";
	
	echo "</div>";
	
	$id = getValueByUser($_GET["USERNAME"],"ID");
	
//	$modC = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

	if (!$modC){	die('Could not connect: ' . mysql_error());	}
	else{
		mysql_select_db("DN_Modules", $modC);
		
		$result = mysql_query("SELECT * FROM MODULES WHERE USERID = ".$id." ORDER BY ID DESC");
		
		echo "<h1>Modules</h1>";
		
		// TODO: Build in the pages function...
		while ( ($row = mysql_fetch_array($result))){
			echo '
			<hr>
			<h3> [ '.$row["POINTS"].' ] <a href = "/Modules/?ID='.$row["ID"].'">'.$row["NAME"].'</a></h3>
			<p>'.$row["DESCRIPTION"].'</p>
			';
			
		}

	}


	

	
	
?>
</div>

<?php 
	include("Footer.php");
?>
</body>
</html>	
