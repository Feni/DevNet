<?php session_start(); ?>
<html>
<head>
<title>LogOut</title>
</head>
<body>
<div id = "Header">
<h2> LogOut </h2>
</div>

<?php
	if(isset($_SESSION['USERNAME'])){
		session_unset();
		session_destroy();
		echo "<p>You are now logged out</p>";
	}
	else{
		echo "<p>Session information not found.</p>";
	}
?>

<script type="text/javascript">
    	document.location.href="/index.php";
</script>
</body>
</html>