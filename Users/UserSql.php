<?php
	function getValue($attr){
		if(isset($_SESSION['USERNAME']))
		{
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

			if (!$con){	die('Could not connect: ' . mysql_error());	}
			else
			{
				mysql_select_db("DN_Users", $con);
				$username = strtolower(mysql_real_escape_string($_SESSION['USERNAME'])); 
//				$password = $_SESSION['PASSWORD']; 	// It's already in it's MD5 form...
				$result = mysql_query("SELECT * FROM USERS WHERE USERNAME = '$username'");
				
				while($row = mysql_fetch_array($result))
				{
					return $row[$attr];
				}
				mysql_close($con);
				return "-1";
			}
		}
		else
		{
			return "-1";
		}
	}
	
	function getValueByUser($username, $attr){
		if(isset($username))
		{
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

			if (!$con){	die('Could not connect: ' . mysql_error());	}
			else
			{
				mysql_select_db("DN_Users", $con);
				$username = strtolower(mysql_real_escape_string($username)); 
				$result = mysql_query("SELECT * FROM USERS WHERE USERNAME = '$username'");
				while($row = mysql_fetch_array($result))
				{
					return $row[$attr];
				}
				mysql_close($con);
				return "Unknown";
			}
		}
		else
		{
			return "Unknown";
		}		
	}
	function getValueById($id, $attr){
		if(isset($id))
		{
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

			if (!$con){	die('Could not connect: ' . mysql_error());	}
			else
			{
				mysql_select_db("DN_Users", $con);
				$id = strtolower(mysql_real_escape_string($id)); 
				$result = mysql_query("SELECT * FROM USERS WHERE ID = '$id'");
				while($row = mysql_fetch_array($result))
				{
					return $row[$attr];
				}
				mysql_close($con);
				return "Unknown";
			}
		}
		else
		{
			return "Unknown";
		}		
	}	
	
?>
