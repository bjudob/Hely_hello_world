<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Névszerkezet</title>
	<link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Névszerkezet szerint</div>

		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Összes" onclick="window.location.href='./helynevek_show_nevszerkezet_all.php'">
		</div>
                <br>
                <div id="menuOption">
		<input id="btn" type="button" value="Településenként" onclick="window.location.href='./helynevek_show_nevszerkezet.php'">
		</div>
                <br>

		
	</div>

</body>
</html>