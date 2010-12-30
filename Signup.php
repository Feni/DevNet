<?php session_start(); ?>

<html>
<head>

<title>DevNet Registration Page</title>
<link rel="stylesheet" type="text/css" href="MainTheme.css">
<script type="text/javascript">
function checkRegisterForm(thisform)
{
	alert("Checking registration form");
	with (thisform){
      if(USERNAME.value == null || USERNAME.value == ""){
        alert("It appears you've left the Username field blank... \nBlank is great if it's the Amount field in a check I get!\nBut for a username...  Sorry!");
        USERNAME.focus();
        return false;
      }
      if(USERNAME.value.length < 5){
        alert("Longer names are the new trend. \nPlease choose a username that's atleast 5 characters long");
        USERNAME.focus();
        return false;
      }
	  if(startsWithNum(USERNAME.value)){
		alert("Sorry, a username can't start with a number... \nWhy? Well, does your name start with a number? \nSo why should your username?");
		USERNAME.focus();
		return false;
	  }
      if(PASSWORD.value == null || PASSWORD.value == "")
      {
          alert("Easiest password to guess : The blank password. \nPlease fill out your password");
          PASSWORD.focus();
          return false;
      }
      if(PASSWORD.value.length < 5){
          alert("Even my dog can guess a password less than 5 characters long. \nPlease pick a longer password");
          PASSWORD.focus();
          return false;
      } 
      if(PASSWORD2.value == null || PASSWORD2.value == ""){
          alert("Fill out the confirm password field, just so we can make sure you didn't make a typo \n(Not that you would ever make a typo, but just to be sure)");
          PASSWORD2.focus();
          return false;
      }
	  
      if(EMAIL.value == null || EMAIL.value == ""){
       	alert("Comon, how can you not have an email address in the 21st Century!\nYou left the Email Address field blank");
        EMAIL.focus();
        return false;          
      }
	  
      atPos = EMAIL.value.indexOf("@");
      dotPos= EMAIL.value.lastIndexOf(".");
	
      if(atPos < 0 || dotPos-atPos < 2)
      {
        alert("That email address doesn't look right. \nPlease enter a valid email address");
        EMAIL.focus();
        return false;
      }
      if(PASSWORD.value != PASSWORD2.value){
        alert("Alas, my fears came true! You've seem to have made a typo somewhere! Please recheck your password...");
        PASSWORD.focus();
        return false;
      }
	}
}

function startsWithNum(str){
	return isNum(str.charAt(0));
}

function isNum(c){
	return (c == '0' || c == '1' || c == '2' || c == '3' || c == '4' ||c == '4' ||c == '5' ||c == '6' ||c == '7' ||c == '8' || c == '9');
}
</script>
</head>

<body>

<?php include("defaultNavigation.php"); ?>

<div id = "Header">
<h2> Register </h2>
</div>

<?php
	register();
	function register()
	{
		if(isset($_POST['USERNAME']) && isset($_POST['PASSWORD']) && isset($_POST['EMAIL']))
		{
//			echo "Values set, proceeing to connect";
//			$con = mysql_connect("localhost","Username","Password");	// TODO Fill in this line with the database login details & uncomment.
			if (!$con){	die('Could not connect: ' . mysql_error());	}
			else
			{
//				echo "Connectin established";
				mysql_select_db("DN_Users", $con);
				$username = strtolower(mysql_real_escape_string($_POST['USERNAME'])); 
				$password = md5($_POST['PASSWORD']); 
				$email = mysql_real_escape_string($_POST['EMAIL']);  
				
				
				$result = mysql_query("SELECT * FROM USERS WHERE USERNAME = '$username'");
				while($row = mysql_fetch_array($result))
				{
					echo "<h1>Sorry, that username's already taken...</h1>";
					displayForm();
					return;
				}
//				echo "Username available";
				
				$result2 = mysql_query("SELECT * FROM USERS WHERE EMAIL = '$email'");
				while($row = mysql_fetch_array($result2))
				{
					echo "<h1>Seems like you've already registered an account with that email address...</h1>";
					echo "<p>Don't think you can get away with it that easily!</p>";
					echo "<p>Please restrain yourself to one account per person...</p>";
					displayForm();
					return;
				}
				
//				echo "Email Available";
				
				$finalRslt = mysql_query("INSERT INTO USERS (USERNAME, PASSWORD, EMAIL) VALUES ('$username' , '$password' , '$email')");
				if(!$finalRslt){
					echo "Oops! <br> Looks like something messed up somewhere while trying to create your account...";
				}
				
				echo "<p>Account created. You may now <a href = '/Login.php'>Log In</a></p>";
				mysql_close($con);			
			}
		}
		else
		{
			displayForm();
		}
	}
	function displayForm()
	{
		echo '
			<form action= "Signup.php" method="post" onsubmit = "return checkRegisterForm(this)">
				Username: </br>
				<input type="text" name="USERNAME" />
				</br></br>
				Password: </br>
				<input type="password" name="PASSWORD" />
				</br>
				Confirm Password: </br>
				<input type="password" name="PASSWORD2" />
				</br></br>
				Email: </br>
				<input type="text" name="EMAIL" />
				</br></br>
				<input type="submit" value = "Submit"/>
			</form>	';
	}	
	
?>
</body>
</html>
