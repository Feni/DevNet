<?php
// Yay, presents! Name, Descrption and *wow* even CODE!!! *Busy* *Busy* *Busy* *Making a new module!*

// Just making sure it's not their trick to get me my yearly flu shot and sql injection... No me gusta!
$name = mysql_real_escape_string($_POST['NAME']);
$desc = mysql_real_escape_string($_POST['DESC']);
$lang = mysql_real_escape_string($_POST['LANG']);

$code = mysql_real_escape_string($_POST['CODE']);
$codename = mysql_real_escape_string($_POST['CODENAME']);
$codedesc = mysql_real_escape_string($_POST['CODEDESC']);

$userid = getValue("ID");	// WARNING: selects the user table and leaves us in the blank. !@(#*ing BUG!!!

mysql_select_db("DN_Modules", $modC);

// Check if the dude already gave a present with this name. Trying to repeat? Otherwise, there will be a conflict when you try to load it...
$check = mysql_query("SELECT * FROM MODULES WHERE NAME = '$name' and DESCRIPTION = '$desc' and USERID = '$userid'");
$existingRows = mysql_num_rows($check);
if($existingRows > 0){
	echo '
	<h1>Sems like you already have a module with that name...</h1>
	';
	return;
}
echo $name."<br>".$desc."<br>".$userid."<br>";
$finalRslt = mysql_query("INSERT INTO MODULES (NAME , DESCRIPTION , USERID, LANG) VALUES ('$name' , '$desc' , '$userid', '$lang')");
if(!$finalRslt){ 	// My bad!
	echo "Oops! <br> Looks like something messed up somewhere while trying to create your module...". mysql_error();
}
else{	// Let's see the results!
	$result = mysql_query("SELECT * FROM MODULES WHERE NAME = '$name' and DESCRIPTION = '$desc' and USERID = '$userid'");
	$obj = mysql_fetch_object($result);
	// Create a table to store the versions...
	
	mysql_query('CREATE TABLE '.$obj->ID.'_VERSIONS ( VID int(16) NOT NULL AUTO_INCREMENT, PRIMARY KEY(VID), NAME varchar(32) NULL, DESCRIPTION  varchar(32) NULL, CODE text)', $modC);
	// Insert version 1 into our newly created table!
	mysql_query("INSERT INTO ".$obj->ID."_VERSIONS (NAME , DESCRIPTION , CODE) VALUES ('$codename' , '$codedesc' , '$code')");
	
	
	mysql_select_db("DN_Users", $modC);
	
	// Reward the creator with an extra points and experience...
	mysql_query("UPDATE USERS SET POINTS = POINTS + 10 WHERE ID = '$userid'");
	mysql_query("UPDATE USERS SET EXP = EXP + 10 WHERE ID = '$userid'");
	
	
		echo '
<script type="text/javascript">
   	document.location.href="/Modules/?ID='.$obj->ID.'";
</script>
';
}

?>