<html>
<head>

<script type='text/javascript' src='\jquery.js'></script>
<script type='text/javascript' src='\jquery.simplemodal.js'></script>
<script type='text/javascript' src='basic.js'></script>


</head>

<script type = "text/javascript">

function CheckMe(thisform){
	return true;
}

</script>


<body>


<?php
	if(isset($_POST["USERNAME"])){
		echo "Got me a username".$_POST["USERNAME"];
	}
?>


<form method="post" action="test.php" onsubmit = "return CheckMe(this)">
		Username: </br>
		<input type="text" name="USERNAME" />
		</br>
		<input type="submit" value="Submit">
</form>


</body>

</html>