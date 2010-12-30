<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>DevNet : Developers Network </title>
<link rel="stylesheet" type="text/css" href="MainTheme.css">


<script type="text/javascript">
function checkForm(thisform)
{
	with (thisform){
      if(USERNAME.value == null || USERNAME.value == ""){
        alert("It appears you've left the Username field blank... \nBlank is great if it's the Amount field in a check I get!\nBut for a username...  Sorry!");
        USERNAME.focus();
        return false;
      }
      if(USERNAME.value.length < 5){
        alert("Longer names are the new trend. \nPlease choose a username that's atleast 5 characters long");
        USERNAME.FOCUS();
        return false;
      }
	  if(startsWithNum(USERNAME.value)){
		alert("Sorry, a username can't start with a number... \nWhy? Well, does your name start with a number? \nSo why should your username?");
		USERNAME.focus();
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

<?php include("defaultNavigation.php");?>

<h2> Project Highlights </h2>

<form action="NewProject.php" onSubmit = "return checkForm(this)" method="post">
Project Name: <input type="text" name="pname"/>
<br>
<p>Project Description<br></p> 
<textarea name="pdesc" rows="4" cols="48" wrap=virtual>Sample long description</textarea>


<input type="submit" />
</form>

<br>


<h3>Test Project 1</h3>
<p> Project 1 description not exceeding 120 characters </p>
<hr>

<h3>Test Project 2</h3>
<p> Project 2 description not exceeding 120 characters </p>
<hr>

<h3>Test Project 3</h3>
<p> Project 3 description not exceeding 120 characters </p>
<hr>

<h2> User Highlights </h2>
<h3> Top 10 Programmers </h3>
<a href = "/Users/TopUser1.php" > Top User 1 </a><br>
<a href = "/Users/TopUser2.php" > Top User 2 </a><br>
<a href = "/Users/TopUser3.php" > Top User 3 </a><br>
<a href = "/Users/TopUser4.php" > Top User 4 </a><br>
<a href = "/Users/TopUser5.php" > Top User 5 </a><br>
<a href = "/Users/TopUser6.php" > Top User 6 </a><br>
<a href = "/Users/TopUser7.php" > Top User 7 </a><br>
<a href = "/Users/TopUser8.php" > Top User 8 </a><br>
<a href = "/Users/TopUser9.php" > Top User 9 </a><br>
<a href = "/Users/TopUser10.php" > Top User 10 </a><br>
<hr>


<?php include("Footer.php");?>

</body>
</html>