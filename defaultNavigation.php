<script type='text/javascript' src='/jquery.js'></script>
<script type='text/javascript' src='/jquery.simplemodal.js'></script>
<script type='text/javascript' src='/basic.js'></script>

<script type="text/javascript">
function checkLoginForm(thisform){
	with (thisform){
		if(USERNAME.value == null || USERNAME.value == "")
		{
			alert("Can't log in with a blank username!");
			USERNAME.focus();
			return false;
		}
		if(PASSWORD.value == null || PASSWORD.value == "")
		{
			  alert("The blank password. /nI'll tell you that's wrong without even having to check!");
			  PASSWORD.focus();
			  return false;
		}
		$.post("/Login.php", { USERNAME: USERNAME.value, PASSWORD: PASSWORD.value},  function(data){
			alert("Status : "+data);
		});
		
		alert("Logging in...");
	}
}
</script>


<div id = "MainNavigation">
<a href="/index.php">DevNet</a>
<a href="/Users">Users</a>
<a href="/Projects.php">Projects</a>
<a href="/Modules">Modules</a>
</div>

<div id = "UserNavigation">

<?php
include("Users/UserSql.php");
if (!session_is_registered("USERNAME") || !session_is_registered("PASSWORD")) 
{
	echo '
	<div id="basic-modal"><a href="#" class="basic">Login</a>
	<a href="/Signup.php">Signup</a></div>
	';
	echo $_SESSION["USERNAME"];
}
else
{
	echo '
	<a href = /Users/?USERNAME='.$_SESSION["USERNAME"].'>'.$_SESSION["USERNAME"]. ' [ '.getValue("EXP").' , '.getValue("POINTS"). ' ] </a>
	<a href = "/Logout.php">Logout</a>
	';
}
?>


<div id="basic-modal-content">
	<h1>Log In </h1>
	
	<form name = "login" method = "post" onsubmit = "return checkLoginForm(this)">
				Username: </br>
				<input type="text" name="USERNAME" />
				</br></br>
				Password: </br>
				<input type="password" name="PASSWORD" />
				</br>
				<input type="submit" value = "Submit"/>
	</form>
</div>

</div>

<br>
<hr>