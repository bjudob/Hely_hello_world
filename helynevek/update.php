<?php

   if (isset($_POST['yes_button'])) {
	      include("../config.php");
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $myid = mysqli_real_escape_string($con, $_GET['id']);
	      $newname = mysqli_real_escape_string($con, $_POST['new_name']);

	      $sql = "UPDATE helynev 
	              SET Standard = '$newname' 
	              WHERE ID = '$myid'";
	      
	      mysqli_query($con, $sql);

      	  header("location: helynevek_show.php");
	} else if (isset($_POST['no_button'])) {
    	  header("location: helynevek_menu.php");
	} else {
    //no button pressed
	}
?>

<!DOCTYPE html>
<html>
<?php
	include('../navbar_lvl1.php');
?>
<head>
	<title>Átnevezés</title>
	<link rel="stylesheet" type="text/css" href="../mainpage.css">
</head>
<body>
	<div id="container">
		<div id="title">Írja be az új  nevét: <?php echo $_GET['name'] ?></div>
		<br>
		<br>
		<div id="yesno">
			<form id="yesnoform" action = "" method = "post">
			  <input type="text" name="new_name">
		      <input id="btn" type = "submit" name="yes_button" value = " Átnevez "/>
		      <input id="btn" type = "submit" name="no_button" value = " Mégsem "/>
			  <br>
		   </form>
	   </div>
	   <br>
	   <br>
	</div>
</body>
</html>