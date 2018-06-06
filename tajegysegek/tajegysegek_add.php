<?php
   include("../config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myname = mysqli_real_escape_string($con,$_POST['nev']); 

	  $query = "INSERT INTO tajegyseg(`Nev`) VALUES ('$myname')";
	  mysqli_query($con, $query);

	  mysqli_close($con);

	  header("location: tajegysegek_show.php");

   }
?>
<!DOCTYPE html>
<html>
<?php
	include('../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
	<link rel="stylesheet" type="text/css" href="tajegysegek_show.css">
	<link rel="stylesheet" type="text/css" href="../mainpage.css">

</head>
<body>
	<div id="container">
		<br>
		<br>
		<div id="item">
			<form action = "" method = "post" accept-charset="UTF-8">
		      <label>Tájegység neve:</label><input type = "text" name = "nev"/>
		      <input type = "submit" value = " Hozzáad "/>
			  <br>
		   </form>
	   </div>
	   <br><br>
	   <div id="menuOption"><input id="btn" type="button" value="Vissza"  onclick="window.location.href='./tajegysegek_menu.php'">
        </div>
        <br>
        <br>
   </div>
</body>
</html>