
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Települések</title>
	<link rel="stylesheet" type="text/css" href="../../../css/telepulesek.css">
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>   


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Települések kezelése</div>

		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Települések megtekintése" onclick="window.location.href='telepulesek_show.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Új település" onclick="window.location.href='telepulesek_add.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Átnevezés" onclick="window.location.href='telepulesek_update.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Törlés" onclick="window.location.href='telepulesek_delete.php'">
		</div>
		<br>
	</div>

</body>
</html>