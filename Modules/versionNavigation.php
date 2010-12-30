</br>
<hr>
<div id = "MainNavigation">
<?php
	echo '
	<a href = "?ID='.$_GET["ID"].'&VID=1"> |&#60&#60 </a>';		 
	if($vid > 1){
		$previd = $vid - 1;
		echo '<a href = "?ID='.$_GET["ID"].'&VID='.$previd.'">Previous</a>';
	}
	if($vid < $latestVersion) {
		$nextvid = $vid + 1;
		echo '<a href = "?ID='.$_GET["ID"].'&VID='.$nextvid.'">Next</a>';
	}
	echo '<a href = "?ID='.$_GET["ID"].'&VID='.$latestVersion.'"> &#62&#62| </a>';
?>
</div>
<div id = "UserNavigation">
<a href = "#Edit" onClick = "showEdit()">Edit</a>
</div>

</br>
<hr>