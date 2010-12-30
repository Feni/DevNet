<?php

function addChange($newChange)
{	

	$con = mysql_connect("localhost","root","");
	
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	else{
	
		if (mysql_query("CREATE DATABASE my_db",$con))
		{
			echo "Database created";
			
			mysql_select_db("my_db", $con);
			$sql = "CREATE TABLE Persons
			(
			FirstName varchar(15),
			LastName varchar(15),
			Age int
			)";

			// Execute query
			mysql_query($sql,$con);
		}
		else
		{
			echo "Error creating database: " . mysql_error();
		}	
		
	}
	
	
	mysql_close($con);


	$newline="\n";
	$fileR = fopen("Changes\Changes.html", "r") or exit("Unable to open changes file");	
	$one = "1";
	
	$previous = fgets($fileR);
	fclose($fileR);
	echo "Previous = ".$previous;
	
	$wasOne = strpos($previous, $one);

	$fileWriter = fopen("Changes\Changes.html","a") or exit("Unable to open changes file");
	fwrite($fileWriter, '<div id = "Item');
	
	if($wasOne === false){
		echo "Next item is 1";
		fwrite($fileWriter, '1">'.$newline);
	}
	else{
		echo "Next item is 2";
		fwrite($fileWriter, '2">'.$newline);
	}

	fwrite($fileWriter, "<p>".$newline);
	fwrite($fileWriter, $newChange);
	fwrite($fileWriter, "</p>".$newline);
	fwrite($fileWriter, "</div>".$newline);
	
	echo "Done Writing...";

	fclose($fileWriter);
}


addChange("Blah");

?>