<?php
if(isset($_GET["id"]))
{
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.

	if (!$con){	die('Could not connect: ' . mysql_error());	}
	else
	{
		$id = mysql_real_escape_string($_GET["id"]); 
		mysql_select_db("DN_Modules", $con);
		$result = mysql_query("SELECT * FROM MODULES WHERE ID = '$id'");
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

?>
