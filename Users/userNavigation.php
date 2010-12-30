<div id = "MainNavigation">

<?php
	echo '<a href="index.php?USERNAME='.$_GET["USERNAME"].'" >'.$_GET["USERNAME"].'</a>';
	echo '<a href="UserComments.php?USERNAME='.$_GET["USERNAME"].'" >Comments</a>';
	echo '<a href="UserModules.php?USERNAME='.$_GET["USERNAME"].'" >Modules</a>';
?>

</div>

<div id = "UserNavigation">

<?php
if (!session_is_registered("USERNAME") || !session_is_registered("PASSWORD")) 
{
	echo '
	<a href="/Login.php">Login</a>
	<a href="/Signup.php">Signup</a>
	';
	echo $_SESSION["USERNAME"];
}
else
{
	echo '
	<a href = "/Email.php?'.$_GET["USERNAME"].'">Send Message</a>
	';
}
?>
</div>

<br>
<hr>