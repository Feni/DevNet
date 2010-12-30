<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network Module</title>

<?php 
include("MainTheme.css");
?>

</head>
<body>

<?php
include("\defaultNavigation.php");
include("moduleNavigation.php");
?>


<script type="text/javascript">
function voteUp(){
	$.get("voteUp.php", { ID: <?php echo $_GET["ID"]; ?>},  function(data){
		alert("Status : "+data);
	});
	update();
}

function voteDown(){
	$.get("voteDown.php", { ID: <?php echo $_GET["ID"]; ?>},  function(data){
		alert("Status : "+data);
	});
	update();
}

function update(){
	$.get("getModuleAttribute.php", { id : <?php echo $_GET["ID"]; ?>, attribute : "POINTS"},  function(data){
		document.getElementById("Points").innerHTML="<a href = '#' onClick = 'voteUp()'>+</a>"+data+" Points <a href = '#' onClick = 'voteDown()'>-</a>";
		
	});

	// Do this later... Gotta mess with default navigation to update the user points... It gets it though..
	$.get("getUserAttribute.php", {attribute : "POINTS"},  function(data){
		alert("User Points: "+data);
//		document.getElementById("Points").innerHTML="<a href = '#' onClick = 'voteUp()'>+</a>"+data+" Points <a href = '#' onClick = 'voteDown()'>-</a>";
	});
	
	
}

</script>




<div id = "Header">
<h1> <?php echo getModuleValue("NAME"); ?>  </h1>
<?php
	echo "<h2 id = 'Points'> <a href = '#' onClick = 'voteUp()'>+</a>".getModuleValue("POINTS")." Points <a href = '#' onClick = 'voteDown()'>-</a> </h2>";
	
	$user = getValueById(getModuleValue("USERID"), "USERNAME");
	
	echo '<p> Created on : '.getModuleValue("CREATED").' By <a href = "/Users/'.$user.'">'.$user.'</a></p>';
	
	echo '<hr>
	<p>'.getModuleValue("DESCRIPTION").'</p>';
?>
<hr>
</div>

</body>
</html>