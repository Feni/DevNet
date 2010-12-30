<?php
	session_start();
	if(isset($_POST['USERNAME']) && isset($_POST['PASSWORD']))
	{
	//	$con = mysql_connect("localhost","Username","Password");		// TODO Fill in this line with the database login details & uncomment.
		if (!$con){	die('Could not connect: ' . mysql_error());	}
		else{
			mysql_select_db("DN_Users", $con);
			$username = strtolower(mysql_real_escape_string($_POST['USERNAME'])); 
			$password = md5($_POST['PASSWORD']); 
			
			$result = mysql_query("SELECT * FROM USERS WHERE USERNAME = '$username' and PASSWORD = '$password'");
			
			if(mysql_num_rows($result) == 0){
				echo "Inccorect username and password combination. \nDid you make a typo? ";
				mysql_close($con);
				return;
			}
			$_SESSION['USERNAME']=$_POST['USERNAME'];	// Preserve the formatting of the input...
			$_SESSION['PASSWORD']=$password;
			
			// All done, redirect them back to the homepage...
			echo 'Login successful';
			mysql_close($con);
			return;
		}
	}

?>
