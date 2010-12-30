
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network Project: Test</title>

<?php 
$currentDir = getcwd();
chdir(dirname(dirname(getcwd())));
include("MainTheme.css");
chdir($currentDir);
?>

</head>
<body>

<?php 
$currentDir = getcwd();
chdir(dirname(dirname(getcwd())));
include("\defaultNavigation.php");
include("\projectNavigation.php");
chdir($currentDir);
?>

<div id = "Header">
<h1> Test </h1>

<p>
<?php include("Description.php");?>
</p>
<hr>
</div>

<?php include("Changes.php");?>

<?php include("Changes\Changes.html");?>


</body>
</html>
