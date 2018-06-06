
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>   


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Tájegységek kezelése</div>

		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Tájegységek megtekintése" onclick="window.location.href='./tajegysegek_show.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Új tájegység" onclick="window.location.href='./tajegysegek_add.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Átnevezés" onclick="window.location.href='./tajegysegek_update.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Törlés" onclick="window.location.href='./tajegysegek_delete.php'">
		</div>
		<br>
	</div>

</body>
</html>