
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Települések</title>
	<link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Helynevek kezelése</div>

		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Helynevek megtekintése" onclick="window.location.href='./helynevek_show.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Új helynév" onclick="window.location.href='./helynevek_add.php'">
		</div>
		<br>
		
	</div>

</body>
</html>