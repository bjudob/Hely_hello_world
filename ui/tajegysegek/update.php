<?php

   if (isset($_POST['yes_button'])) {
	      include("../../config.php");
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $myid = mysqli_real_escape_string($con, $_GET['id']);
	      $newname = mysqli_real_escape_string($con, $_POST['new_name']);

	      $sql = "UPDATE tajegyseg 
	              SET Nev = '$newname' 
	              WHERE ID = '$myid'";
	      
	      mysqli_query($con, $sql);

      	  header("location: tajegysegek_show.php");
	} else if (isset($_POST['no_button'])) {
    	  header("location: tajegysegek_menu.php");
	} else {
    //no button pressed
	}
?>

<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Átnevezés</title>
	<link rel="stylesheet" type="text/css" href="../../mainpage.css">
</head>
<body>
	<div id="container">
		<br>
		<div id="title">Írja be az új  nevét: <?php echo $_GET['name'] ?></div>
		<br><br><br><br>
		<div id="yesno">
			<form action = "" method = "post">
			  <input id="fullSizeInput" type="text" name="new_name">
			  <br><br>
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