</br>
<hr>
<div id = "MainNavigation">
<?php
	$oldest = ceil($latestId/5) - 1;
	echo '
	<a href = "?PAGE='.$oldest.'"> |&#60&#60 </a>';	// |<< Display oldest. Oldest is in page latest / 5
	
	$page = 0;
	if(isset($_GET["PAGE"])){
		$page = $_GET["PAGE"];
	}
		
	if($page < $oldest){	// < Display something older...
		$page = $page + 1;
		echo '<a href = "?PAGE='.$page.'">Older</a>';
	}
	
	if($page > 0) {	// Display something newer. 
		$page = $page - 1;
		echo '<a href = "?PAGE='.$page.'">Newer</a>';
	}
	echo '<a href = "?PAGE=0"> &#62&#62| </a>';	// >>| Display latest
?>
</div>
<div id = "UserNavigation">
<a href = "#CreateNewModule" onClick = "showNewModuleForm()">Create New Module</a>
</div>

</br>
<hr>