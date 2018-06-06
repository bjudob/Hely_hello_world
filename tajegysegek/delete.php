<?php

   if (isset($_POST['yes_button'])) {
	      include("../config.php");
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $myid = mysqli_real_escape_string($con, $_GET['id']);;

	      $sql = "DELETE FROM tajegyseg 
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
	include('../navbar_lvl1.php');
?>
<head>
	<title>Törlés</title>
	<link rel="stylesheet" type="text/css" href="../mainpage.css">
</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Biztosan törölni szeretné: <?php echo $_GET['name'] ?></div>
		<br><br><br><br>
		<div id="yesno">
			<form action = "" method = "post">
		      <input id="btn" type = "submit" name="yes_button" value = " Igen "/>
		      <input id="btn" type = "submit" name="no_button" value = " Nem "/>
			  <br>
		   </form>
	   </div>
	   <br>
	   <br>
	</div>
</body>
</html>