
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
?>
</div>

<?php 
	include("Footer.php");
?>
</body>
</html>