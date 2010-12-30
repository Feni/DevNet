<?php session_start(); ?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network </title>
<?php include("MainTheme.css"); ?>
</head>

<body>

<?php include("defaultNavigation.php");

$projUrl = "Projects\\".$_POST["pname"];

if(file_exists($projUrl)){
 
	echo "<p><br> Sorry, that name already exists...<br></p>";	
	
	$points = fopen($projUrl."\\Points.php","r") or exit("Unable to open points file!");
	echo '<a href = "Projects/'.$_POST["pname"].'/index.php">'.$_POST["pname"].' ('.fgets($points).')</a> <br>';
	
	$file = fopen($projUrl."\\ShortDescription.php","r") or exit("Unable to open file!");
	while(!feof($file))
	{
		echo fgets($file)."<br>";
	}
	fclose($file);
}
else{
	echo "Yay, that name is still open!";
	echo "<br> Making project directory.... : ".mkdir(projUrl);
	echo "<br> Creating short description.... : ";
	
	$file = fopen($projUrl."\\ShortDescription.php","w") or exit("Unable to open file!");	
}

?>


</body>
</html>
