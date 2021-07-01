<?php

   if (isset($_POST['yes_button'])) {
	      include("../../config.php");
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $myid = mysqli_real_escape_string($con, $_GET['id']);;

	      $sql = "DELETE FROM `helynev` 
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
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Törlés</title>
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
</head>
<body>
	<div id="container">
		<div id="title">Biztosan törölni szeretné: <?php echo $_GET['name'] ?></div>
		<br>
		<br>
		<div id="yesno">
			<form action = "" method = "post">
		      <input type = "submit" name="yes_button" value = " Igen "/>
		      <input type = "submit" name="no_button" value = " Nem "/>
			  <br>
		   </form>
	   </div>
	   <br>
	   <br>
	</div>
</body>
</html>